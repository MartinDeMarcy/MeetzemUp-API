<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Model\Text;
use App\Repository\TextRepository;


$app->match('/text/create', function (Request $request) use ($app) {

	$em = $app['orm.em'];
	$text = new Text();

	if ($request->get('user_id')) {
		$user = $em->getRepository("Model\User")->find($request->get('user_id'));
		if ($user)
			$text->setUser($user);
		else
			return $app->json("No user with id " . $request->get('user_id') . " was found.", 404);
	}
	else
		return $app->json("User id missing or null", 406);

	if ($request->get('content'))
		$text->setContent($request->get('content'));
	else
		return $app->json("Content missing or null", 406);

	if ($request->get('context'))
		$text->setContext($request->get('context'));

	if ($request->get('feeling'))
		$text->setFeeling($request->get('feeling'));

	if ($request->get('representation'))
		$text->setRepresentation($request->get('representation'));

	if ($request->get('classification'))
		$text->setClassification($request->get('classification'));

	if ($request->get('relative_id'))
		$text->setRelativeId($request->get('relative_id'));

	if ($request->get('processed'))
		$text->setProcessed($request->get('processed'));

	$text->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
	$em->persist($text);
	$em->flush();

    return $app->json(array('msg' => 'Text correctly added', 'id' => $text->getId()), 201);
});

$app->match('text/get/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$text = $em->find(Text::class, $id);

	if (!$text) {
        return $app->json('The text with id: ' . $id . ' was not found.', 404);
    }

    return $text->toJson();
});

$app->match('text/update/{id}', function (Request $request, $id) use ($app) {
	$em = $app['orm.em'];
	$text = $em->find(Text::class, $id);

	if (!$text) {
        return $app->json('The text with id: ' . $id . ' was not found.', 404);
    }

	if ($request->get('user_id')) {
		$user = $em->getRepository("Model\User")->find($request->get('user_id'));
		if ($user)
			$text->setUser($user);
		else
			return $app->json("No user with id " . $request->get('user_id') . " was found.", 404);
	}

	if ($request->get('content'))
		$text->setContent($request->get('content'));

	if ($request->get('context'))
		$text->setContext($request->get('context'));

	if ($request->get('feeling'))
		$text->setFeeling($request->get('feeling'));

	if ($request->get('representation'))
		$text->setRepresentation($request->get('representation'));

	if ($request->get('classification'))
		$text->setClassification($request->get('classification'));

	if ($request->get('relative_id'))
		$text->setRelativeId($request->get('relative_id'));

	if ($request->get('processed'))
		$text->setProcessed($request->get('processed'));

	$text->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));
	$em->persist($text);
	$em->flush();

    return $app->json('Text correctly updated', 200);
});

$app->match('text/delete/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$text = $em->find(Text::class, $id);

	if (!$text) {
        return $app->json('The text with id: ' . $id . ' was not found.', 404);
    }

	$em->remove($text);
	$em->flush();

	return $app->json('Text correctly removed', 200);
});

$app->match('text/getbyuser/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$json = new \stdClass();
	$user = $em->getRepository("Model\User")->find($id);

	if (!$user) {
        return new Response($app->json('The user with id: ' . $id . ' was not found.'), 404);
    }

	$texts = $em->getRepository("Model\Text")->findBy(array('user' => $user->getId()));

	foreach ($texts as $key => $text) {
		$json->$key = json_decode($text->toJson(1), true);
	}
	
	return new JsonResponse($json, 200);
});