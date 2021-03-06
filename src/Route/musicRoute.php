<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Model\Music;
use App\Repository\MusicRepository;


$app->match('/music/create', function (Request $request) use ($app) {

	$em = $app['orm.em'];
	$music = new Music();

	if ($request->get('user_id')) {
		$user = $em->getRepository("Model\User")->find($request->get('user_id'));
		if ($user)
			$music->setUser($user);
		else
			return $app->json("No user with id " . $request->get('user_id') . " was found.", 404);
	}
	else
		return $app->json("User id missing or null", 406);

	if ($request->get('direct_link'))
		$music->setDirectLink($request->get('direct_link'));
	else
		return $app->json("Direct link missing or null", 406);

	if ($request->get('genre'))
		$music->setGenre($request->get('genre'));
	else
		return $app->json("Genre missing or null", 406);

	if ($request->get('artist'))
		$music->setArtist($request->get('artist'));
	else
		return $app->json("Artist missing or null", 406);

	if ($request->get('title'))
		$music->setTitle($request->get('title'));
	else
		return $app->json("Title missing or null", 406);

	if ($request->get('processed'))
		$music->setProcessed($request->get('processed'));

	$music->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
	$em->persist($music);
	$em->flush();

    return $app->json(array('msg' => 'Music correctly added', 'id' => $music->getId()), 201);
});

$app->match('music/get/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$music = $em->find(Music::class, $id);

	if (!$music) {
        return $app->json('The music with id: ' . $id . ' was not found.', 404);
    }

    return $music->toJson(1);
});

$app->match('music/update/{id}', function (Request $request, $id) use ($app) {
	$em = $app['orm.em'];
	$music = $em->find(Music::class, $id);

	if (!$music) {
        return $app->json('The music with id: ' . $id . ' was not found.', 404);
    }

	if ($request->get('user_id')) {
		$user = $em->getRepository("Model\User")->find($request->get('user_id'));
		if ($user)
			$music->setUser($user);
		else
			return $app->json("No user with id " . $request->get('user_id') . " was found.", 404);
	}

	if ($request->get('direct_link'))
		$music->setDirectLink($request->get('direct_link'));

	if ($request->get('genre'))
		$music->setGenre($request->get('genre'));

	if ($request->get('artist'))
		$music->setArtist($request->get('artist'));

	if ($request->get('title'))
		$music->setTitle($request->get('title'));

	if ($request->get('processed'))
		$music->setProcessed($request->get('processed'));

	$music->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
	$em->persist($music);
	$em->flush();

    return $app->json('Music correctly updated', 200);
});

$app->match('music/delete/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$music = $em->find(Music::class, $id);

	if (!$music) {
        return $app->json('The music with id: ' . $id . ' was not found.', 404);
    }

	$em->remove($music);
	$em->flush();

	return $app->json('Music correctly removed', 200);
});

$app->match('music/getbyuser/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$json = new \stdClass();
	$user = $em->getRepository("Model\User")->find($id);

	if (!$user) {
        return new Response($app->json('The user with id: ' . $id . ' was not found.'), 404);
    }

	$musics = $em->getRepository("Model\Music")->findBy(array('user' => $user->getId()));

	foreach ($musics as $key => $music) {
		$json->$key = json_decode($music->toJson(1), true);
	}
	
	return new JsonResponse($json, 200);
});