<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Picture;
use App\Repository\PictureRepository;


$app->match('/picture/create', function (Request $request) use ($app) {

	$em = $app['orm.em'];
	$picture = new Picture();

	if ($request->get('user_id'))
		$picture->setUserId($request->get('user_id'));
	else
		return $app->json("User id missing or null", 406);

	if ($request->get('direct_link'))
		$picture->setDirectLink($request->get('direct_link'));
	else
		return $app->json("Direct link missing or null", 406);

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

	if ($request->get('last_update'))
		$picture->setLastUpdate($request->get('last_update'));

	if ($request->get('processed'))
		$picture->setProcessed($request->get('processed'));

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

    return $picture->toJson();
});

$app->match('picture/update/{id}', function (Request $request, $id) use ($app) {
	$em = $app['orm.em'];
	$picture = $em->find(Picture::class, $id);

	if (!$picture) {
        return $app->json('The picture with id: ' . $id . ' was not found.', 404);
    }

	if ($request->get('user_id'))
		$picture->setUserId($request->get('user_id'));

	if ($request->get('direct_link'))
		$picture->setDirectLink($request->get('direct_link'));

	if ($request->get('meta'))
		$picture->setMeta($request->get('meta'));

	if ($request->get('content'))
		$picture->setContent($request->get('content'));

	if ($request->get('context'))
		$picture->setContext($request->get('context'));

	if ($request->get('last_update'))
		$picture->setLastUpdate($request->get('last_update'));

	if ($request->get('processed'))
		$picture->setProcessed($request->get('processed'));

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
