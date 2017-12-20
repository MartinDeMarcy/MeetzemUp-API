<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Model\Token;
use App\Repository\TokenRepository;


$app->match('/token/create', function (Request $request) use ($app) {

	$em = $app['orm.em'];
	$token = new Token();

	if ($request->get('user_id'))
		$token->setUserId($request->get('user_id'));
	else
		return $app->json("User id missing or null", 406);

	if ($request->get('type'))
		$token->setType($request->get('type'));
	else
		return $app->json("Type missing or null", 406);

	if ($request->get('access_token'))
		$token->setAccessToken($request->get('access_token'));
	else
		return $app->json("Access token missing or null", 406);

	if ($request->get('refresh_token'))
		$token->setRefreshToken($request->get('refresh_token'));
	else
		return $app->json("Refresh token missing or null", 406);

	if ($request->get('last_update'))
		$token->setLastUpdate($request->get('last_update'));

	$em->persist($token);
	$em->flush();

    return $app->json(array('msg' => 'Token correctly added', 'id' => $token->getId()), 201);
});

$app->match('token/get/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$token = $em->find(Token::class, $id);

	if (!$token) {
        return $app->json('The token with id: ' . $id . ' was not found.', 404);
    }

    return $token->toJson();
});

$app->match('token/update/{id}', function (Request $request, $id) use ($app) {
	$em = $app['orm.em'];
	$token = $em->find(Token::class, $id);

	if (!$token) {
        return $app->json('The token with id: ' . $id . ' was not found.', 404);
    }

	if ($request->get('user_id'))
		$token->setUserId($request->get('user_id'));

	if ($request->get('type'))
		$token->setType($request->get('type'));

	if ($request->get('access_token'))
		$token->setAccessToken($request->get('access_token'));

	if ($request->get('refresh_token'))
		$token->setRefreshToken($request->get('refresh_token'));

	if ($request->get('last_update'))
		$token->setLastUpdate($request->get('last_update'));
	else
		$token->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));

	$em->persist($token);
	$em->flush();

    return $app->json('Token correctly updated', 200);
});

$app->match('token/delete/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$token = $em->find(Token::class, $id);

	if (!$token) {
        return $app->json('The token with id: ' . $id . ' was not found.', 404);
    }

	$em->remove($token);
	$em->flush();

	return $app->json('Token correctly removed', 200);
});
