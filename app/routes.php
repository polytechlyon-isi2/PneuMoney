<?php

// Home page
$app->get('/', function () use ($app) {
    $pneus = $app['dao.pneu']->findAll();
    $marques = $app['dao.marque']->findAll();
    return $app['twig']->render('index.html.twig', array('pneus' => $pneus, 'marques' => $marques));
})->bind('home');


// Details sur un pneu
$app->get('/pneu/{id}', function ($id) use ($app) {
    $pneu = $app['dao.pneu']->find($id);
    return $app['twig']->render('pneu.html.twig', array('pneu' => $pneu));
})->bind('pneu');;

$app->get('/marque/{id}', function ($id) use ($app) {
    $marque = $app['dao.marque']->find($id);
    return $app['twig']->render('marque.html.twig', array('marque' => $marque));
})->bind('marque');;
