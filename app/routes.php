<?php

use Symfony\Component\HttpFoundation\Request;

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

// Login formulaire
$app->get('/login', function(Request $request) use ($app) {
  $marques = $app['dao.marque']->findAll();
  $tailles = $app['dao.taille']->findAll();
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
		'marques'	=> $marques,
    'tailles' => $tailles
    ));
})->bind('login');

// Add a user
$app->match('/newuser', function(Request $request) use ($app) {
    $user = new PneuMoney\Domain\User();
    $userForm = $app['form.factory']->create(new PneuMoney\Form\Type\UserType(), $user);
    $userForm->handleRequest($request);
    $tailles = $app['dao.taille']->findAll();
    $marques = $app['dao.marque']->findAll();
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        // generate a random salt value
        $salt = substr(md5(time()), 0, 23);
        $user->setSalt($salt);
        $plainPassword = $user->getPassword();
        // find the default encoder
        $encoder = $app['security.encoder.digest'];
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password);
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was successfully created.');
    }
    return $app['twig']->render('user_form.html.twig', array(
        'title' => 'New user',
        'userForm' => $userForm->createView(),
        'marques'	=> $marques,
        'tailles' => $tailles
		));
})->bind('newuser');

//Edit a user
$app->match('/edituser', function(Request $request) use ($app) {
	$user = $app['security']->getToken()->getUser();
  $edit = $user;
    //$user = find($id);
	//$user=loadUserByUsername($mail);
	$userForm = $app['form.factory']->create(new PneuMoney\Form\Type\UserEdit(), $edit);
	//$userForm = $app['form.factory']->update($user);
    //$userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);
    $tailles = $app['dao.taille']->findAll();
    $marques = $app['dao.marque']->findAll();
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        // generate a random salt value
        $salt = substr(md5(time()), 0, 23);
        $edit->setSalt($salt);
        $plainPassword = $edit->getPassword();
        // find the default encoder
        $encoder = $app['security.encoder.digest'];
        // compute the encoded password
        $password = $encoder->encodePassword($plainPassword, $edit->getSalt());
        $edit->setPassword($password);
		$edit->setMail($user->getMail());
		//$edit->setPassword($user->getPassword());
        $app['dao.user']->update($edit);
    $app['session']->getFlashBag()->add('success', 'The user was succesfully edited.');
	}
  return $app['twig']->render('user_form.html.twig', array(
        'title' => 'Edit User',
        'userForm' => $userForm->createView(),
        'marques'	=> $marques,
        'tailles' => $tailles
		));
})->bind('edituser');

  // Remove a user
$app->get('/delete', function(Request $request) use ($app) {
   	$id = $app['security']->getToken()->getUser()->getMail();
    // Delete the user
    $app['dao.user']->delete($id);
    $app['session']->getFlashBag()->add('success', 'The user was succesfully removed.');
    return $app->redirect('/');
})->bind('deleteuser');
