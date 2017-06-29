<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cd.php";
    use Symfony\Component\Debug\Debug;
    Debug::enable();

    session_start();

    if(empty($_SESSION['list_of_cds'])) {
        $_SESSION['list_of_cds'] = array();
    }

    $app = new Silex\Application();
$app['debug'] = true;
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('cd.html.twig', array('cds' => Cd::getAll()));
    });

    $app->post("/cd_create", function() use ($app) {
        $album = new Cd($_POST['album'], $_POST['artist']);
        $album->save();
        return $app['twig']->render('create.html.twig', array('cds' => $album));
    });

    $app->get("/list", function() use ($app) {
        return $app['twig']->render('cd_list.html.twig', array('cds' => Cd::getAll()));
    });

    $app->post("/delete", function() use ($app) {
        return $app['twig']->render('cd_delete.html.twig', array('cds' => Cd::deleteAll()));
    });

    $app->get("/search", function() use ($app) {
        $cds = Cd::getAll();
        $cds_matching_search = array();

        if (empty($cds_matching_search) == true) {
            foreach ($cds as $cd) {
                if ($cd->getArtist() == $_GET['search']) {
                    array_push($cds_matching_search, $cd);
                }
            }
        }
        // var_dump($cds);
        // $key = array();
        //  foreach ($cds as $cd) {
        //      if($cd->getArtist($_GET['search'])) {
        // }
        return $app['twig']->render('search.html.twig', array('cd' => $cds_matching_search));
});


    return $app;
?>
