<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Model\Video;
use App\Repository\VideoRepository;


$app->match('/video/create', function (Request $request) use ($app) {

	$em = $app['orm.em'];

	if ($request->get('network_id')) {
		$video = $em->getRepository("Model\Video")->findOneBy(array('network_id' => $request->get('network_id')));
		if ($video) {
			return $app->json(array('msg' => 'Video already added', 'id' => $video->getId()), 200);
		}
		$video = new Video();
		$video->setNetworkId($request->get('network_id'));
	}
	else
		return $app->json("Network id missing or null", 406);

	if ($request->get('user_id')) {
		$user = $em->getRepository("Model\User")->find($request->get('user_id'));
		if ($user)
			$video->setUser($user);
		else
			return $app->json("No user with id " . $request->get('user_id') . " was found.", 404);
	}
	else
		return $app->json("User id missing or null", 406);

	if ($request->get('direct_link'))
		$video->setDirectLink($request->get('direct_link'));
	else
		return $app->json("Direct link missing or null", 406);

	if ($request->get('output_primary'))
		$video->setOutputPrimary($request->get('output_primary'));

	if ($request->get('output_secondary'))
		$video->setOutputSecondary($request->get('output_secondary'));

	if ($request->get('context'))
		$video->setContext($request->get('context'));
	else
		return $app->json("Context missing or null", 406);

	if ($request->get('content'))
		$video->setContent($request->get('content'));
	else
		return $app->json("Content missing or null", 406);

	if ($request->get('is_liked'))
		$video->setIsLiked($request->get('is_liked'));

	if ($request->get('relative_id')) {
		$relative = $em->getRepository("Model\Video")->find($request->get('relative_id'));
		if ($relative)
			$video->setRelative($relative);
		else
			return $app->json("No video with id " . $request->get('relative_id') . " was found.", 404);
	}

	$video->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
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

    return $video->toJson(1);
});

$app->match('video/update/{id}', function (Request $request, $id) use ($app) {
	$em = $app['orm.em'];
	$video = $em->find(Video::class, $id);

	if (!$video) {
        return $app->json('The video with id: ' . $id . ' was not found.', 404);
    }

	if ($request->get('user_id')) {
		$user = $em->getRepository("Model\User")->find($request->get('user_id'));
		if ($user)
			$video->setUser($user);
		else
			return $app->json("No user with id " . $request->get('user_id') . " was found.", 404);
	}

	if ($request->get('network_id'))
		$video->setNetworkId($request->get('network_id'));

	if ($request->get('direct_link'))
		$video->setDirectLink($request->get('direct_link'));

	if ($request->get('output_primary'))
		$video->setOutputPrimary($request->get('output_primary'));

	if ($request->get('output_secondary'))
		$video->setOutputSecondary($request->get('output_secondary'));

	if ($request->get('context'))
		$video->setContext($request->get('context'));

	if ($request->get('content'))
		$video->setContent($request->get('content'));

	if ($request->get('is_liked'))
		$video->setIsLiked($request->get('is_liked'));

	if ($request->get('relative_id')) {
		$relative = $em->getRepository("Model\Video")->find($request->get('relative_id'));
		if ($relative)
			$video->setRelative($relative);
		else
			return $app->json("No video with id " . $request->get('relative_id') . " was found.", 404);
	}

	$video->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
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

$app->match('video/getbyuser/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$json = new \stdClass();
	$user = $em->getRepository("Model\User")->find($id);

	if (!$user) {
        return new Response($app->json('The user with id: ' . $id . ' was not found.'), 404);
    }

	$videos = $em->getRepository("Model\Video")->findBy(array('user' => $user->getId()));

	foreach ($videos as $key => $video) {
		$json->$key = json_decode($video->toJson(1), true);
	}

	return new JsonResponse($json, 200);
});
