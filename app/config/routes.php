<?php

$app->get('/', 'App\Controller\DefaultController::indexAction')->value('page',1);

$app->get('/page-{page}', 'App\Controller\DefaultController::indexAction')->assert('page','\d+');

$app->get('/login', 'App\Controller\DefaultController::loginAction');
$app->post('/login', 'App\Controller\DefaultController::loginAction');

$app->get('/admin/dashboard', 'App\Controller\AdminController::dashboardAction');