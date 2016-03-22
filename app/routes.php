<?php

// Home page
$app->get('/', function () use ($app) {
    $pneus = $app['dao.pneu']->findAll();
    $marques = $app['dao.marque']->findAll();
    $tailles = $app['dao.taille']->findAll();
    return $app['twig']->render('index.html.twig', array('pneus' => $pneus, 'marques' => $marques, 'tailles' => $tailles));
})->bind('home');


// Details sur un pneu
$app->get('/pneu/{id}', function ($id) use ($app) {
    $pneu = $app['dao.pneu']->find($id);
    $marques = $app['dao.marque']->findAll();
    return $app['twig']->render('pneu.html.twig', array('pneu' => $pneu, 'marques' => $marques));
})->bind('pneu');

//Liste des pneus appartenant à une marque
$app->get('/marque/{id}', function ($id) use ($app) {
    $marque = $app['dao.marque']->find($id);
    $pneus = $app['dao.pneu']->findByMarque($marque->getNom());
    $marques = $app['dao.marque']->findAll();
    $tailles = $app['dao.taille']->findAll();
    return $app['twig']->render('marque.html.twig', array('marque' => $marque, 'pneus' => $pneus, 'marques' => $marques, 'tailles' => $tailles));
})->bind('marque');

//Liste des pneus d'une taille
$app->get('/taille/{nom}', function ($nom) use ($app) {
    $taille = $app['dao.taille']->find($nom);
    $pneus = $app['dao.pneu']->findByTaille($taille->getNom());
    $tailles = $app['dao.taille']->findAll();
    $marques = $app['dao.marque']->findAll();
    return $app['twig']->render('taille.html.twig', array('taille' => $taille, 'pneus' => $pneus, 'marques' => $marques, 'tailles' => $tailles));
})->bind('taille');
