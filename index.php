<?php
require "vendor/autoload.php";

include_once('./src/DataManager.php');
require_once('./vendor/Twig/Autoloader.php');
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('./views/templates');
$twig = new Twig_Environment($loader, array(
#    'cache' => './tmp/cache',  # turned off for development purposes
));
session_cache_limiter(false);
session_start();
$app = new \Slim\Slim();

$app->get('/', function () use ($app, $twig) {	
	$template = $twig->loadTemplate('home.phtml');
	$params = array('title' => 'Another Day Another Scholar');
	$template->display($params);
});

$app->get('/cloud/:flow', function ($flow) use ($app, $twig) {
	$search = $app->request()->params('search');
	$type = $app->request()->params('type');
	$limit = $app->request()->params('limit');
	$_SESSION['dataManager'] = new DataManager();
	if ($type == 'author') {
		$_SESSION['cloud'] = $_SESSION['dataManager']->getCloudByAuthor($search, $limit);
	} else if ($type = 'keyword') {
		$_SESSION['cloud'] = $_SESSION['dataManager']->getCloudByKeyWord($search, $limit);
	} else {
		// should not get here
	}
	if ($flow == "new" || $flow == "back") {
		$wordArray = $_SESSION['cloud']->getWordArray();
		$template = $twig->loadTemplate('wordCloud.phtml');
		$params = array(
			'title' => "Another Day Another Scholar",
			'wordArray' => $wordArray
		);
	$template->display($params);
	}
});

$app->get('/papers/', function () use ($app, $twig) {
	$template = $twig->loadTemplate('paperList.phtml');
	$term = $app->request()->params('term');
	$wordObject = $_SESSION['cloud']->getWordObject($term);
	
	// papers = data manager get papers (term)
	$params = array(
		'title' => "Another Day Another Scholar", 
		'searchword' => $term,
		'papers' => array(
			array(
			'title' => "Multi-column deep neural networks for image classification ",
			'author' => "Ciresan, D.",
			'journal' => "IEEE",
			'frequency' => 14,
			'link' => "http://ieeexplore.ieee.org/xpl/login.jsp?tp=&arnumber=6248110&url=http%3A%2F%2Fieeexplore.ieee.org%2Fxpls%2Fabs_all.jsp%3Farnumber%3D6248110"
			),
			array(
			'title' => "Leakage current mechanisms and leakage reduction techniques in deep-submicrometer CMOS circuits",
			'author' => "Roy, K.",
			'journal' => "IEEE",
			'frequency' => 10,
			'link' => "http://ieeexplore.ieee.org/xpl/login.jsp?tp=&arnumber=1182065&url=http%3A%2F%2Fieeexplore.ieee.org%2Fxpls%2Fabs_all.jsp%3Farnumber%3D1182065")
		)
		);
	$template->display($params);
});

$app->get('/auto', function () use ($app, $twig) {
	$tags = $app->request()->params('q');
	$callback = $app->request()->params('callback');
	$auto = $_SESSION['dataManager']->getAutofillSuggestions($tags);
	echo $callback . '(' . json_encode($auto) . ');';
});

$app->run();
