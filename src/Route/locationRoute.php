<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Model\Location;
use App\Repository\LocationRepository;


$app->match('/location/create', function (Request $request) use ($app) {

	$em = $app['orm.em'];
	$location = new Location();

	if ($request->get('user_id')) {
		$user = $em->getRepository("Model\User")->find($request->get('user_id'));
		if ($user)
			$location->setUser($user);
		else
			return $app->json("No user with id " . $request->get('user_id') . " was found.", 404);
	}
	else
		return $app->json("User id missing or null", 406);

	if ($request->get('latitude'))
		$location->setLatitude($request->get('latitude'));
	else
		return $app->json("Latitude missing or null", 406);

	if ($request->get('longitude'))
		$location->setLongitude($request->get('longitude'));
	else
		return $app->json("Longitude missing or null", 406);

	if ($request->get('city'))
		$location->setCity($request->get('city'));
	else
		return $app->json("City missing or null", 406);

	if ($request->get('country'))
		$location->setCountry($request->get('country'));
	else
		return $app->json("Country missing or null", 406);

	$location->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
	$em->persist($location);
	$em->flush();

    return $app->json(array('msg' => 'Location correctly added', 'id' => $location->getId()), 201);
});

$app->match('location/get/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$location = $em->find(Location::class, $id);

	if (!$location) {
        return $app->json('The location with id: ' . $id . ' was not found.', 404);
    }

    return $location->toJson(1);
});

$app->match('location/update/{id}', function (Request $request, $id) use ($app) {
	$em = $app['orm.em'];
	$location = $em->find(Location::class, $id);

	if (!$location) {
        return $app->json('The location with id: ' . $id . ' was not found.', 404);
    }

	if ($request->get('user_id')) {
		$user = $em->getRepository("Model\User")->find($request->get('user_id'));
		if ($user)
			$location->setUser($user);
		else
			return $app->json("No user with id " . $request->get('user_id') . " was found.", 404);
	}

	if ($request->get('latitude'))
		$location->setLatitude($request->get('latitude'));

	if ($request->get('longitude'))
		$location->setLongitude($request->get('longitude'));

	if ($request->get('city'))
		$location->setCity($request->get('city'));

	if ($request->get('country'))
		$location->setCountry($request->get('country'));

	
	$location->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
	$em->persist($location);
	$em->flush();

    return $app->json('Location correctly updated', 200);
});

$app->match('location/delete/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$location = $em->find(Location::class, $id);

	if (!$location) {
        return $app->json('The location with id: ' . $id . ' was not found.', 404);
    }

	$em->remove($location);
	$em->flush();

	return $app->json('Location correctly removed', 200);
});

$app->match('location/getbyuser/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$json = new \stdClass();
	$user = $em->getRepository("Model\User")->find($id);

	if (!$user) {
        return new Response($app->json('The user with id: ' . $id . ' was not found.'), 404);
    }

	$locations = $em->getRepository("Model\Location")->findBy(array('user' => $user->getId()));

	foreach ($locations as $key => $location) {
		$json->$key = json_decode($location->toJson(1), true);
	}
	
	return new JsonResponse($json, 200);
});