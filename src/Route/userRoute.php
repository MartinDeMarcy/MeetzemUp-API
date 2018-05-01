<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Model\User;
use App\Repository\UserRepository;


$app->match('/user/create', function (Request $request) use ($app) {

	$em = $app['orm.em'];
	$email = $request->get('email');

	if (!$email)
		return $app->json(array('msg' => "Email missing or null",
		'code' => 406));

	$user = $em->getRepository("Model\User")->findOneBy(array('email' => $email));
	if ($user) {
		return $app->json(array('msg' => "User already exists",
		'code' => 200, 'id' => $user->getId()));
	}

	$user = new User();
	if ($request->get('first_name'))
		$user->setFirstName($request->get('first_name'));
	/*else
		return new Response($app->json("Firt name missing or null"), 406);*/

	if ($request->get('last_name'))
		$user->setLastName($request->get('last_name'));
	/*else
		return new Response($app->json("Last name missing or null"), 406);*/

	if ($request->get('email'))
		$user->setEmail($request->get('email'));

	if ($request->get('profile_picture'))
		$user->setProfilePicture($request->get('profile_picture'));

	if ($request->get('facebook_linked'))
		$user->setFacebookLinked($request->get('facebook_linked'));

	if ($request->get('twitter_linked'))
		$user->setTwitterLinked($request->get('twitter_linked'));

	if ($request->get('pinterest_linked'))
		$user->setPinterestLinked($request->get('pinterest_linked'));

	if ($request->get('gplus_linked'))
		$user->setGplusLinked($request->get('gplus_linked'));

	if ($request->get('instagram_linked'))
		$user->setInstagramLinked($request->get('instagram_linked'));

	$user->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
	$em->persist($user);
	$em->flush();

    return $app->json(array('msg' => 'User correctly added', 'id' => $user->getId(), 'code' => 201));
});

$app->match('user/get/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$user = $em->find(User::class, $id);

	if (!$user) {
        return new Response($app->json('The user with id: ' . $id . ' was not found.'), 404);
    }

    return new Response($user->toJson(0), 200);
});

$app->match('user/update/{id}', function (Request $request, $id) use ($app) {
	$em = $app['orm.em'];
	$user = $em->find(User::class, $id);

	if (!$user) {
        return $app->json(array('msg' => 'The user with id: ' . $id . ' was not found.', 'code' => 404));
    }

	if ($request->get('first_name'))
		$user->setFirstName($request->get('first_name'));

	if ($request->get('last_name'))
		$user->setLastName($request->get('last_name'));

	if ($request->get('email'))
		$user->setEmail($request->get('email'));

	if ($request->get('profile_picture'))
		$user->setProfilePicture($request->get('profile_picture'));

	if ($request->get('facebook_linked'))
		$user->setFacebookLinked($request->get('facebook_linked'));

	if ($request->get('twitter_linked'))
		$user->setTwitterLinked($request->get('twitter_linked'));

	if ($request->get('pinterest_linked'))
		$user->setPinterestLinked($request->get('pinterest_linked'));

	if ($request->get('gplus_linked'))
		$user->setGplusLinked($request->get('gplus_linked'));

	if ($request->get('instagram_linked'))
		$user->setInstagramLinked($request->get('instagram_linked'));

	$user->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
	$em->persist($user);
	$em->flush();

    return $app->json(array('msg' => 'User correctly updated', 'code' => 200));
});


$app->match('user/delete/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$user = $em->find(User::class, $id);

	if (!$user) {
        return new Response($app->json('The user with id: ' . $id . ' was not found.'), 404);
    }

	$em->remove($user);
	$em->flush();

	return new Response($app->json('User correctly removed'), 200);
});
