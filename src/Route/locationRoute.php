<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Location;
use App\Repository\LocationRepository;


$app->match('/location/create', function (Request $request) use ($app) {

	$em = $app['orm.em'];
	$location = new Location();

	if ($request->get('user_id'))
		$location->setUserId($request->get('user_id'));
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

	if ($request->get('last_update'))
		$location->setLastUpdate($request->get('last_update'));

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

    return $location->toJson();
});

$app->match('location/update/{id}', function (Request $request, $id) use ($app) {
	$em = $app['orm.em'];
	$location = $em->find(Location::class, $id);

	if (!$location) {
        return $app->json('The location with id: ' . $id . ' was not found.', 404);
    }

	if ($request->get('user_id'))
		$location->setUserId($request->get('user_id'));

	if ($request->get('latitude'))
		$location->setLatitude($request->get('latitude'));

	if ($request->get('longitude'))
		$location->setLongitude($request->get('longitude'));

	if ($request->get('city'))
		$location->setCity($request->get('city'));

	if ($request->get('country'))
		$location->setCountry($request->get('country'));

	if ($request->get('last_update'))
		$location->setLastUpdate($request->get('last_update'));

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
