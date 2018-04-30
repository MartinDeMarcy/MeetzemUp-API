<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Model\Text;
use App\Repository\TextRepository;


$app->match('/text/create', function (Request $request) use ($app) {

	$em = $app['orm.em'];
	$relation = false;

	if ($request->get('network_id')) {
		$text = $em->getRepository("Model\Text")->findOneBy(array('network_id' => $request->get('network_id')));
		if ($text) {
			return $app->json(array('msg' => 'Text already added', 'id' => $text->getId()), 200);
		}
	}

	if ($request->get('content') && $request->get('context')) {
		$text = $em->getRepository("Model\Text")->findOneBy(array('content' => $request->get('content')));
		if (strcmp($request->get('context'), "t_hashtag") == 0 && $text) {
			if ($request->get('relative_id')) {
				$parent = $em->getRepository("Model\Text")->find($request->get('relative_id'));
				if ($parent) {
					foreach ($parent->getTextChild() as $value) {
						$relation = true;
					}
					if ($relation)
						return $app->json(array('msg' => 'Text already added and linked', 'id' => $text->getId()), 200);
					else if ($text->getId() == $parent->getId())
						return $app->json("You can not link a text with itself", 406);
					else
						$text->addTextParent($parent);
				}
				else
					return $app->json("No text with id " . $request->get('relative_id') . " was found.", 404);
			}
			else
				return $app->json("Relative id missing or null for hashtag", 406);
		}
		else {
			$text = new Text();
			$text->setContent($request->get('content'));
			$text->setContext($request->get('context'));

			if ($request->get('user_id')) {
				$user = $em->getRepository("Model\User")->find($request->get('user_id'));
				if ($user)
					$text->setUser($user);
				else
					return $app->json("No user with id " . $request->get('user_id') . " was found", 404);
			}

			if ($request->get('relative_id')) {
				$parent = $em->getRepository("Model\Text")->find($request->get('relative_id'));
				if ($parent) {
					$text->addTextParent($parent);
				}
				else
					return $app->json("No text with id " . $request->get('relative_id') . " was found.", 404);
			}

			if ($request->get('processed'))
				$text->setProcessed($request->get('processed'));
		}
	}
	else
		return $app->json("Content or context missing or null", 406);

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

	return $text->toJson(1);
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

	/*if ($request->get('relative_id'))
	$text->setRelativeId($request->get('relative_id'));*/

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
