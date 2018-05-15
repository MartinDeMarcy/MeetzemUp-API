<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Model\Token;
use App\Repository\TokenRepository;


$app->match('/token/create', function (Request $request) use ($app) {

	$em = $app['orm.em'];
	$token = new Token();

	if ($request->get('user_id')) {
		$user = $em->getRepository("Model\User")->find($request->get('user_id'));
		if ($user)
			$token->setUser($user);
		else
			return $app->json(array('msg' => "No user with id " . $request->get('user_id') . " was found.", 'code' => 404));
	}
	else
		return $app->json(array('msg' => "User id missing or null", 'code' => 406));

	if ($request->get('type'))
		$token->setType($request->get('type'));
	else
		return $app->json(array('msg' => "Type missing or null", 'code' => 406));

	if ($request->get('network_id'))
		$token->setNetworkId($request->get('network_id'));

	if ($request->get('access_token'))
		$token->setAccessToken($request->get('access_token'));
	else
		return $app->json("Access token missing or null", 406);

	if ($request->get('refresh_token'))
		$token->setRefreshToken($request->get('refresh_token'));

	if ($request->get('secret_token'))
		$token->setSecretToken($request->get('secret_token'));

	$token->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
	$em->persist($token);
	$em->flush();

    return $app->json(array('msg' => 'Token correctly added', 'id' => $token->getId(), 'code' => 201));
});

$app->match('token/get/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$token = $em->find(Token::class, $id);

	if (!$token) {
        return $app->json('The token with id: ' . $id . ' was not found.', 404);
    }

    return $token->toJson(1);
});

$app->match('token/update/{id}', function (Request $request, $id) use ($app) {
	$em = $app['orm.em'];
	$token = $em->find(Token::class, $id);

	if (!$token) {
        return $app->json('The token with id: ' . $id . ' was not found.', 404);
    }

	if ($request->get('user_id')) {
		$user = $em->getRepository("Model\User")->find($request->get('user_id'));
		if ($user)
			$token->setUser($user);
		else
			return $app->json("No user with id " . $request->get('user_id') . " was found.", 404);
	}

	if ($request->get('type'))
		$token->setType($request->get('type'));

	if ($request->get('network_id'))
		$token->setNetworkId($request->get('network_id'));

	if ($request->get('access_token'))
		$token->setAccessToken($request->get('access_token'));

	if ($request->get('refresh_token'))
		$token->setRefreshToken($request->get('refresh_token'));

	if ($request->get('secret_token'))
		$token->setSecretToken($request->get('secret_token'));

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

$app->match('token/getbyuser/{type}/{id}', function ($id, $type) use ($app) {
	$em = $app['orm.em'];
	$user = $em->getRepository("Model\User")->find($id);

	if ($user) {
		$token = $em->getRepository("Model\Token")->findOneBy(array('user' => $user, 'type' => $type));
		if (!$token) {
			return $app->json('The token with id: ' . $id . ' was not found.', 404);
		}
		else {
			return $token->toJson(1);
		}
	}
	return $app->json('The user with id: ' . $id . ' was not found.', 404);
});
