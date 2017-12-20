<?php
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Model\Music;
use App\Repository\MusicRepository;


$app->match('/music/create', function (Request $request) use ($app) {

	$em = $app['orm.em'];
	$music = new Music();

	if ($request->get('user_id'))
		$music->setUserId($request->get('user_id'));
	else
		return $app->json("User id missing or null", 406);

	if ($request->get('direct_link'))
		$music->setDirectLink($request->get('direct_link'));
	else
		return $app->json("Direct link missing or null", 406);

	if ($request->get('genre'))
		$music->setGenre($request->get('genre'));
	else
		return $app->json("Genre missing or null", 406);

	if ($request->get('artist'))
		$music->setArtist($request->get('artist'));
	else
		return $app->json("Artist missing or null", 406);

	if ($request->get('title'))
		$music->setTitle($request->get('title'));
	else
		return $app->json("Title missing or null", 406);

	if ($request->get('last_update'))
		$music->setLastUpdate($request->get('last_update'));

	if ($request->get('processed'))
		$music->setProcessed($request->get('processed'));

	$em->persist($music);
	$em->flush();

    return $app->json(array('msg' => 'Music correctly added', 'id' => $music->getId()), 201);
});

$app->match('music/get/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$music = $em->find(Music::class, $id);

	if (!$music) {
        return $app->json('The music with id: ' . $id . ' was not found.', 404);
    }

    return $music->toJson();
});

$app->match('music/update/{id}', function (Request $request, $id) use ($app) {
	$em = $app['orm.em'];
	$music = $em->find(Music::class, $id);

	if (!$music) {
        return $app->json('The music with id: ' . $id . ' was not found.', 404);
    }

	if ($request->get('user_id'))
		$music->setUserId($request->get('user_id'));

	if ($request->get('direct_link'))
		$music->setDirectLink($request->get('direct_link'));

	if ($request->get('genre'))
		$music->setGenre($request->get('genre'));

	if ($request->get('artist'))
		$music->setArtist($request->get('artist'));

	if ($request->get('title'))
		$music->setTitle($request->get('title'));

	if ($request->get('last_update'))
		$music->setLastUpdate($request->get('last_update'));
	else
		$music->setLastUpdate(new DateTime(date('Y-m-d G:i:s')));

	if ($request->get('processed'))
		$music->setProcessed($request->get('processed'));

	$em->persist($music);
	$em->flush();

    return $app->json('Music correctly updated', 200);
});

$app->match('music/delete/{id}', function ($id) use ($app) {
	$em = $app['orm.em'];
	$music = $em->find(Music::class, $id);

	if (!$music) {
        return $app->json('The music with id: ' . $id . ' was not found.', 404);
    }

	$em->remove($music);
	$em->flush();

	return $app->json('Music correctly removed', 200);
});
