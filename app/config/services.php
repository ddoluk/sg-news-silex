<?php

//Doctrine
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => 'pdo_mysql',
        'host' => 'localhost',
        'port' => '3306',
        'dbname' => 'sg-news',
        'user' => 'root',
        'password' => '',
        'charset' => 'utf8'
    )
));

//Twig
$app->register(new \Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => array(__DIR__ . '/../../resources')
));

//Forms
$app->register(new \Silex\Provider\FormServiceProvider());

//Validation
$app->register(new Silex\Provider\ValidatorServiceProvider());

//Translation
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.domains' => array()
));

//Session
$app->register(new Silex\Provider\SessionServiceProvider());

