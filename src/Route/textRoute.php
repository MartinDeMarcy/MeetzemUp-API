<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Model\Text;
use App\Repository\TextRepository;


$app->match('/text/create', function (Request $request) use ($app) {

	$em = $app['orm.em'];
	$text = new Text();

	if ($request->get('user_id'))
		$text->setUserId($request->get('user_id'));
	else
		return $app->json("User id missing or null", 406);

	if ($request->get('content'))
		$text->setContent($request->get('content'));
	else
		return $app->json("Content missing or null", 406);

	if ($request->get('context'))
		$text->setContext($request->get('context'));
	else
		return $app->json("Context missing or null", 406);

	if ($request->get('feeling'))
		$text->setFeeling($request->get('feeling'));
	else
		return $app->json("Feeling missing or null", 406);

	if ($request->get('representation'))
		$text->setRepresentation($request->get('representation'));
	else
		return $app->json("Representation missing or null", 406);

	if ($request->get('classification'))
		$text->setClassification($request->get('classification'));
	else
		return $app->json("Classification missing or null", 406);

	if ($request->get('last_update'))
		$text->setLastUpdate($request->get('last_update'));

	if ($request->get('processed'))
		$text->setProcessed($request->get('processed'));


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

	if ($request->get('user_id'))
		$text->setUserId($request->get('user_id'));

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

	if ($request->get('last_update'))
		$text->setLastUpdate($request->get('last_update'));
	else
		$text->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));

	if ($request->get('processed'))
		$text->setProcessed($request->get('processed'));

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
