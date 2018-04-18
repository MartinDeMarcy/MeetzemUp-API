<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Model\Profile;
use App\Repository\ProfileRepository;


$app->match('/profile/create', function (Request $request) use ($app) {

	$em = $app['orm.em'];
	$profile = new Profile();

	if ($request->get('user_id')) {
		$user = $em->getRepository("Model\User")->find($request->get('user_id'));
		if ($user)
			$profile->setUser($user);
		else
			return $app->json("No user with id " . $request->get('user_id') . " was found.", 404);
	}
	else
		return $app->json("User id missing or null", 406);

	if ($request->get('leader'))
		$profile->setLeader($request->get('leader'));
	else
		return $app->json("Leader missing or null", 406);

	if ($request->get('creative'))
		$profile->setCreative($request->get('creative'));
	else
		return $app->json("Creative missing or null", 406);

	if ($request->get('class'))
		$profile->setClass($request->get('class'));
	else
		return $app->json("Class missing or null", 406);

	$profile->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
	$em->persist($profile);
	$em->flush();

    return $app->json(array('msg' => 'Profile correctly added', 'id' => $profile->getId()), 201);
});

$app->match('profile/get/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$profile = $em->find(Profile::class, $id);

	if (!$profile) {
        return $app->json('The profile with id: ' . $id . ' was not found.', 404);
    }

    return $profile->toJson(1);
});

$app->match('profile/update/{id}', function (Request $request, $id) use ($app) {
	$em = $app['orm.em'];
	$profile = $em->find(Profile::class, $id);

	if (!$profile) {
        return $app->json('The profile with id: ' . $id . ' was not found.', 404);
    }

	if ($request->get('user_id')) {
		$user = $em->getRepository("Model\User")->find($request->get('user_id'));
		if ($user)
			$profile->setUser($user);
		else
			return $app->json("No user with id " . $request->get('user_id') . " was found.", 404);
	}

	if ($request->get('leader'))
		$profile->setLeader($request->get('leader'));

	if ($request->get('creative'))
		$profile->setCreative($request->get('creative'));

	if ($request->get('class'))
		$profile->setClass($request->get('class'));
		
	$profile->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
	$em->persist($profile);
	$em->flush();

    return $app->json('Profile correctly updated', 200);
});

$app->match('profile/delete/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$profile = $em->find(Profile::class, $id);

	if (!$profile) {
        return $app->json('The profile with id: ' . $id . ' was not found.', 404);
    }

	$em->remove($profile);
	$em->flush();

	return $app->json('Profile correctly removed', 200);
});
