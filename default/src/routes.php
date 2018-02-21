<?php

use Slim\Http\Request;
use Slim\Http\Response;
use simplon\entities\User;
use simplon\entities\Article;
use simplon\dao\DaoUser;
use simplon\dao\DaoArticle;

// Routes

// $app->get('/login', function (Request $request, Response $response) {
//     // Sample log message
//     $this->logger->info("Slim-Skeleton '/login' route");
 
//     // Render index view
//     return $this->view->render($response, 'login.twig');
//  })->setName('index');
 
 $app->post('/login', function (Request $request, Response $response, array $args) {
    $this->logger->info("Slim-Skeleton '/login' route");
    $body = $request->getParsedBody();
    $dao = new DaoUser();
    $user = $dao->getByEmail($body['email']);
    $connect = false;

    if (($body['email'] === $user->getEmail()) && ($body['password'] === $user->getPassword()) ) {
        $_SESSION['user'] = $user;
        $connect = true;
        return $response->withRedirect('/myblog');
    }

    return $this->view->render($response, 'login.twig', [
        'connect'=> $connect,
        'user'=> $user
        ]);
 })->setName('login');

$app->get('/adduser', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'index.twig');
})->setName('adduser');


$app->post('/adduser', function (Request $request, Response $response, array $args) {
    //On récupère les données du formulaire
    $form = $request->getParsedBody();
    //On crée une Person à partir de ces données
    $newUser = new User($form['name'], $form['surname'], $form['email'], $form['password']);
    //On instancie le DAO
    $dao = new DaoUser();
    //On utilise la méthode add du DAO en lui donnant la Person qu'on vient de créer
    $dao->add($newUser);
    //On affiche la même vue que la route en get
    return $this->view->render($response, 'index.twig', [
        'newId' => $newUser->getId()
    ]);
})->setName('adduser');

$app->get('/myblog', function (Request $request, Response $response, array $args) {
    $user = $_SESSION['user'];
    $dao = new DaoArticle();
    $articles = $dao->getByUser($user->getId());
    return $this->view->render($response, 'myblog.twig', [
        'articles' => $articles
    ]);
})->setName('myblog');

$app->post('/addarticle', function (Request $request, Response $response, array $args) {
    $body = $request->getParsedBody();
    $newArticle = new Article($body['title'], $body['description']);
    $dao = new DaoArticle();
    $dao->add($newArticle);

    return $this->view->render($response, 'connexion.twig', [
        'new' => $newArticle->getId_user()
    ]);
})->setName('addarticle');


$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
 
    // Render index view
    return $this->view->render($response, 'index.twig', [
        'args' => $args
    ]);
 })->setName('index');