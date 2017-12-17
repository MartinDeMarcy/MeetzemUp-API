<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\DoctrineOrmExtension;

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\RoutingServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\LocaleServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\MonologServiceProvider;

use Saxulum\DoctrineOrmManagerRegistry\Provider\DoctrineOrmManagerRegistryProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;

/* Bootstrapping... */
date_default_timezone_set('Europe/London');

$app->register(new RoutingServiceProvider);
$app->register(new ValidatorServiceProvider);

$app->register(new FormServiceProvider);
$app->register(new DoctrineOrmManagerRegistryProvider);

$app['form.extensions'] = $app->factory($app->extend('form.extensions', function ($extensions) use ($app) {
    $extensions[] = new DoctrineOrmExtension($app['doctrine']);
    return $extensions;
}));

/* translations and i18n */
$app->register(new LocaleServiceProvider);
$app->register(new TranslationServiceProvider, array(
        'translator.messages' => array(),
));

/* templating */
$app->register(new TwigServiceProvider, array(
    'twig.path' => __DIR__.'/view',
    'twig.form.templates' => array('bootstrap_3_layout.html.twig')
));

$app->register(new DoctrineOrmServiceProvider, array(
    'orm.proxies_dir' => sprintf('%s/doctrine/proxy', realpath(sprintf('%s/../cache', __DIR__))),
    'orm.auto_generate_proxies' => $app['debug'],
    'orm.em.options' => array(
        'mappings' => array(
            array(
                'type'      => 'yml',
                'namespace' => 'Model',
                'path'      => realpath(__DIR__.'/../config/doctrine/schema'),
            ),
        ),
    ),
));

/* load the database configurations */
$app->register(new DoctrineServiceProvider, array(
        'db.options' => $app['config']['db.options']
));

/* authorizations */
$app->after(function (Request $request, Response $response) {
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Access-Control-Allow-Headers', 'Authorization');
});

/* sessions */
$app->register(new SessionServiceProvider);

/* caching */
$app->register(new HttpCacheServiceProvider, array(
    'http_cache.cache_dir' => __DIR__.'/../cache/',
));

/* logging */
$app->register(new MonologServiceProvider, array(
    'monolog.logfile' => $app['config']['error.log.filename'],
    'monolog.name' => 'my-silex-app'
));

require __DIR__.'/Route/routes.php';

return $app;
