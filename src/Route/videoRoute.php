<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Model\Video;
use App\Repository\VideoRepository;


$app->match('/video/create', function (Request $request) use ($app) {

	$em = $app['orm.em'];
	$video = new Video();

	if ($request->get('user_id'))
		$video->setUserId($request->get('user_id'));
	else
		return $app->json("User id missing or null", 406);

	if ($request->get('direct_link'))
		$video->setDirectLink($request->get('direct_link'));
	else
		return $app->json("Direct link missing or null", 406);

	if ($request->get('context'))
		$video->setContext($request->get('context'));
	else
		return $app->json("Context missing or null", 406);

	if ($request->get('title'))
		$video->setTitle($request->get('title'));
	else
		return $app->json("Title missing or null", 406);

	if ($request->get('last_update'))
		$video->setLastUpdate($request->get('last_update'));

	if ($request->get('processed'))
		$video->setProcessed($request->get('processed'));

	$em->persist($video);
	$em->flush();

    return $app->json(array('msg' => 'Video correctly added', 'id' => $video->getId()), 201);
});

$app->match('video/get/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$video = $em->find(Video::class, $id);

	if (!$video) {
        return $app->json('The video with id: ' . $id . ' was not found.', 404);
    }

    return $video->toJson();
});

$app->match('video/update/{id}', function (Request $request, $id) use ($app) {
	$em = $app['orm.em'];
	$video = $em->find(Video::class, $id);

	if (!$video) {
        return $app->json('The video with id: ' . $id . ' was not found.', 404);
    }

	if ($request->get('user_id'))
		$video->setUserId($request->get('user_id'));

	if ($request->get('direct_link'))
		$video->setDirectLink($request->get('direct_link'));

	if ($request->get('context'))
		$video->setContext($request->get('context'));

	if ($request->get('title'))
		$video->setTitle($request->get('title'));

	if ($request->get('last_update'))
		$video->setLastUpdate($request->get('last_update'));
	else
		$token->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));

	if ($request->get('processed'))
		$video->setProcessed($request->get('processed'));

	$em->persist($video);
	$em->flush();

    return $app->json('Video correctly updated', 200);
});

$app->match('video/delete/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$video = $em->find(Video::class, $id);

	if (!$video) {
        return $app->json('The video with id: ' . $id . ' was not found.', 404);
    }

	$em->remove($video);
	$em->flush();

	return $app->json('Video correctly removed', 200);
});
