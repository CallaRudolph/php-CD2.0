<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cd.php";

    session_start();

    if(empty($_SESSION['list_of_cds'])) {
        $_SESSION['list_of_cds'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('cd.html.twig', array('cds' => Cd::getAll()));
    });

    $app->post("/cd_create", function() use ($app) {
        $album = new Cd($_POST['album']);
        $album->save();
        return $app['twig']->render('create.html.twig', array('cds' => $album));
    });

    $app->get("/list", function() use ($app) {
        return $app['twig']->render('cd_list.html.twig', array('cds' => Cd::getAll()));
    });


    return $app;
?>
