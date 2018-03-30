<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Model\Interest;
use App\Repository\InterestRepository;


$app->match('/interest/create', function (Request $request) use ($app) {

	$em = $app['orm.em'];
	$interest = new Interest();

	if ($request->get('user_id')) {
		$user = $em->getRepository("Model\User")->find($request->get('user_id'));
		if ($user)
			$interest->setUser($user);
		else
			return $app->json("No user with id " . $request->get('user_id') . " was found.", 404);
	}
	else
		return $app->json("User id missing or null", 406);

	if ($request->get('name'))
		$interest->setName($request->get('name'));
	else
		return $app->json("Name missing or null", 406);

	if ($request->get('parent'))
		$interest->setParent($request->get('parent'));
	else
		return $app->json("Parent missing or null", 406);

	if ($request->get('occurence'))
		$interest->setOccurence($request->get('occurence'));
	else
		return $app->json("Occurence missing or null", 406);

	$interest->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
	$em->persist($interest);
	$em->flush();

    return $app->json(array('msg' => 'Interest correctly added', 'id' => $interest->getId()), 201);
});

$app->match('interest/get/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$interest = $em->find(Interest::class, $id);

	if (!$interest) {
        return $app->json('The interest with id: ' . $id . ' was not found.', 404);
    }

    return $interest->toJson();
});

$app->match('interest/update/{id}', function (Request $request, $id) use ($app) {
	$em = $app['orm.em'];
	$interest = $em->find(Interest::class, $id);

	if (!$interest) {
        return $app->json('The interest with id: ' . $id . ' was not found.', 404);
    }

	if ($request->get('user_id')) {
		$user = $em->getRepository("Model\User")->find($request->get('user_id'));
		if ($user)
			$interest->setUser($user);
		else
			return $app->json("No user with id " . $request->get('user_id') . " was found.", 404);
	}

	if ($request->get('name'))
		$interest->setName($request->get('name'));

	if ($request->get('parent'))
		$interest->setParent($request->get('parent'));

	if ($request->get('occurence'))
		$interest->setOccurence($request->get('occurence'));

	
	$interest->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
	$em->persist($interest);
	$em->flush();

    return $app->json('Interest correctly updated', 200);
});

$app->match('interest/delete/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$interest = $em->find(Interest::class, $id);

	if (!$interest) {
        return $app->json('The interest with id: ' . $id . ' was not found.', 404);
    }

	$em->remove($interest);
	$em->flush();

	return $app->json('Interest correctly removed', 200);
});
