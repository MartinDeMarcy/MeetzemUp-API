<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Model\Picture;
use App\Repository\PictureRepository;


$app->match('/picture/create', function (Request $request) use ($app) {

	$em = $app['orm.em'];
	$picture = new Picture();

	if ($request->get('user_id')) {
		$user = $em->getRepository("Model\User")->find($request->get('user_id'));
		if ($user)
			$picture->setUser($user);
		else
			return $app->json("No user with id " . $request->get('user_id') . " was found.", 404);
	}
	else
		return $app->json("User id missing or null", 406);

	if ($request->get('direct_link'))
		$picture->setDirectLink($request->get('direct_link'));
	else
		return $app->json("Direct link missing or null", 406);

	if ($request->get('output_primary'))
		$picture->setOutputPrimary($request->get('output_primary'));

	if ($request->get('output_secondary'))
		$picture->setOutputSecondary($request->get('output_secondary'));

	if ($request->get('meta'))
		$picture->setMeta($request->get('meta'));
	else
		return $app->json("Meta missing or null", 406);

	if ($request->get('content'))
		$picture->setContent($request->get('content'));
	else
		return $app->json("Content missing or null", 406);

	if ($request->get('context'))
		$picture->setContext($request->get('context'));
	else
		return $app->json("Context missing or null", 406);

	if ($request->get('relative_id')) {
		$relative = $em->getRepository("Model\Picture")->find($request->get('relative_id'));
		if ($relative)
			$picture->setRelative($relative);
		else
			return $app->json("No picture with id " . $request->get('relative_id') . " was found.", 404);
	}

	$picture->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
	$em->persist($picture);
	$em->flush();

    return $app->json(array('msg' => 'Picture correctly added', 'id' => $picture->getId()), 201);
});

$app->match('picture/get/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$picture = $em->find(Picture::class, $id);

	if (!$picture) {
        return $app->json('The picture with id: ' . $id . ' was not found.', 404);
    }

    return $picture->toJson(1);
});

$app->match('picture/update/{id}', function (Request $request, $id) use ($app) {
	$em = $app['orm.em'];
	$picture = $em->find(Picture::class, $id);

	if (!$picture) {
        return $app->json('The picture with id: ' . $id . ' was not found.', 404);
    }

	if ($request->get('user_id')) {
		$user = $em->getRepository("Model\User")->find($request->get('user_id'));
		if ($user)
			$picture->setUser($user);
		else
			return $app->json("No user with id " . $request->get('user_id') . " was found.", 404);
	}

	if ($request->get('direct_link'))
		$picture->setDirectLink($request->get('direct_link'));

	if ($request->get('meta'))
		$picture->setMeta($request->get('meta'));

	if ($request->get('output_primary'))
		$picture->setOutputPrimary($request->get('output_primary'));

	if ($request->get('output_secondary'))
		$picture->setOutputSecondary($request->get('output_secondary'));

	if ($request->get('content'))
		$picture->setContent($request->get('content'));

	if ($request->get('context'))
		$picture->setContext($request->get('context'));

	if ($request->get('relative_id')) {
		$relative = $em->getRepository("Model\Picture")->find($request->get('relative_id'));
		if ($relative)
			$picture->setRelative($relative);
		else
			return $app->json("No picture with id " . $request->get('relative_id') . " was found.", 404);
	}

	$picture->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
	$em->persist($picture);
	$em->flush();

    return $app->json('Picture correctly updated', 200);
});

$app->match('picture/delete/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$picture = $em->find(Picture::class, $id);

	if (!$picture) {
        return $app->json('The picture with id: ' . $id . ' was not found.', 404);
    }

	$em->remove($picture);
	$em->flush();

	return $app->json('Picture correctly removed', 200);
});

$app->match('picture/getbyuser/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$json = new \stdClass();
	$user = $em->getRepository("Model\User")->find($id);

	if (!$user) {
        return new Response($app->json('The user with id: ' . $id . ' was not found.'), 404);
    }

	$pictures = $em->getRepository("Model\Picture")->findBy(array('user' => $user->getId()));

	foreach ($pictures as $key => $picture) {
		$json->$key = json_decode($picture->toJson(1), true);
	}

	return new JsonResponse($json, 200);
});
