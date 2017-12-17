<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Model\User;
use App\Repository\UserRepository;


$app->match('/user/create', function (Request $request) use ($app) {

	$em = $app['orm.em'];
	$user = new User();

	if ($request->get('first_name'))
		$user->setFirstName($request->get('first_name'));

	else
		return new Response($app->json("Firt name missing or null"), 406);

	if ($request->get('last_name'))
		$user->setLastName($request->get('last_name'));
	else
		return new Response($app->json("Last name missing or null"), 406);

	if ($request->get('email'))
		$user->setEmail($request->get('email'));
	else
		return new Response($app->json("Email missing or null"), 406);

	$em->persist($user);
	$em->flush();

    return new Response($app->json(array('msg' => 'User correctly added', 'id' => $user->getId())), 201);
});

$app->match('user/get/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$user = $em->find(User::class, $id);

	if (!$user) {
        return new Response($app->json('The user with id: ' . $id . ' was not found.'), 404);
    }

    return new Response($user->toJson(), 200);
});

$app->match('user/update/{id}', function (Request $request, $id) use ($app) {
	$em = $app['orm.em'];
	$user = $em->find(User::class, $id);

	if (!$user) {
        return new Response($app->json('The user with id: ' . $id . ' was not found.'), 404);
    }

	if ($request->get('first_name'))
		$user->setFirstName($request->get('first_name'));

	if ($request->get('last_name'))
		$user->setLastName($request->get('last_name'));

	if ($request->get('email'))
		$user->setEmail($request->get('email'));
	
	$em->persist($user);
	$em->flush();

    return new Response($app->json('User correctly updated'), 200);
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