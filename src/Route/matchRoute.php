<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Model\Match;
use App\Repository\MatchRepository;


$app->match('/match/create', function (Request $request) use ($app) {

	$em = $app['orm.em'];
	$tmp = 0;

	if ($request->get('user_id') && $request->get('match_id'))
	{
		$user = $em->getRepository("Model\User")->find($request->get('user_id'));
		if (!$user)
			return $app->json("No user with id " . $request->get('user_id') . " was found.", 404);
		$userM = $em->getRepository("Model\User")->find($request->get('match_id'));
		if (!$userM)
			return $app->json("No user with id " . $request->get('match_id') . " was found.", 404);

		$match = $em->getRepository("Model\Match")->findOneBy(array('user' => $user, 'mate' => $userM));
		if (!$match) {
			$tmp = 1;
			$match = new Match();

			$user = $em->getRepository("Model\User")->find($request->get('user_id'));
			if ($user)
				$match->setUser($user);
			else
				return $app->json("No user with id " . $request->get('user_id') . " was found.", 404);

			$userM = $em->getRepository("Model\User")->find($request->get('match_id'));
			if ($userM)
				$match->setMate($userM);
			else
				return $app->json("No user with id " . $request->get('match_id') . " was found.", 404);
		}
	}
	else
		return $app->json("User id or match id is missing or null", 406);
	if ($request->get('compatibility'))
		$match->setCompatibility($request->get('compatibility'));
	else
		return $app->json("Compatibility missing or null", 406);

	$match->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
	$em->persist($match);
	$em->flush();

	if ($tmp == 1)
		return $app->json(array('msg' => 'Match correctly added', 'id' => $match->getId()), 201);
	else
		return $app->json(array('msg' => 'Match already added but updated', 'id' => $match->getId()), 201);
});

$app->match('match/get/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$match = $em->find(Match::class, $id);

	if (!$match) {
		return $app->json('The match with id: ' . $id . ' was not found.', 404);
	}

	return $match->toJson(1);
});

$app->match('match/update/{id}', function (Request $request, $id) use ($app) {
	$em = $app['orm.em'];
	$match = $em->find(Match::class, $id);

	if (!$match) {
		return $app->json('The match with id: ' . $id . ' was not found.', 404);
	}

	if ($request->get('user_id')) {
		$user = $em->getRepository("Model\User")->find($request->get('user_id'));
		if ($user)
			$match->setUser($user);
		else
			return $app->json("No user with id " . $request->get('user_id') . " was found.", 404);
	}

	if ($request->get('match_id')) {
		$userM = $em->getRepository("Model\User")->find($request->get('match_id'));
		if ($userM)
			$match->setMate($userM);
		else
			return $app->json("No user with id " . $request->get('match_id') . " was found.", 404);
	}

	if ($request->get('compatibility'))
		$match->setCompatibility($request->get('compatibility'));

	$match->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
	$em->persist($match);
	$em->flush();

	return $app->json('Match correctly updated', 200);
});

$app->match('match/delete/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$match = $em->find(Match::class, $id);

	if (!$match) {
		return $app->json('The match with id: ' . $id . ' was not found.', 404);
	}

	$em->remove($match);
	$em->flush();

	return $app->json('Match correctly removed', 200);
});

$app->match('match/getbyuser/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$json = new \stdClass();
	$user = $em->getRepository("Model\User")->find($id);

	if (!$user) {
		return new Response($app->json('The user with id: ' . $id . ' was not found.'), 404);
	}

	$matches = $em->getRepository("Model\Match")->findBy(
		array('user' => $user->getId()),
		array('compatibility' => 'asc'));

	foreach ($matches as $key => $match)
		$json->$key = json_decode($match->toJson(0), true);

	return $app->json($json, 200);
});
