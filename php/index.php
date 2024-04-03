<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/AlunniController.php';

$app = AppFactory::create();

$app->get('/alunni', "AlunniController:index");
$app->get('/alunni/{parameter}', "AlunniController:FoundId");
$app->post('/alunni', "AlunniController:AddAlunno");
$app->put('/alunni/{parameter}', "AlunniController:ApdateAlunno");
$app->delete('/alunni/{parameter}', "AlunniController:DeleteAlunno");



$app->run();
