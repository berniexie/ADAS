<?php
require "vendor/autoload.php";
require_once("./dompdf/dompdf_config.inc.php");
include_once('./src/DataManager.php');
require_once('./vendor/Twig/Autoloader.php');
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('./views/templates');
$twig = new Twig_Environment($loader, array(
   // 'cache' => './tmp/cache',  # turned off for development purposes
));
session_cache_limiter(false);
session_start();
$app = new \Slim\Slim();

$app->get('/', function () use ($app, $twig) {	
	$_SESSION['dataManager'] = new DataManager();
	$template = $twig->loadTemplate('home.phtml');
	$_SESSION['history'] = [];
	$_SESSION['history']["History"] = -1;
	$params = array('title' => 'Another Day Another Scholar',
					'history' => $_SESSION['history']);
	$template->display($params);
});

$app->get('/cloud/', function () use ($app, $twig) {
	$search = $app->request()->params('search');
	$type = $app->request()->params('type');
	$limit = $app->request()->params('limit');
	if ($type == 'author') {
		$_SESSION['cloud'] = $_SESSION['dataManager']->getCloudByAuthor($search, $limit);
	} else if ($type = 'keyword') {
		$_SESSION['cloud'] = $_SESSION['dataManager']->getCloudByKeyWord($search, $limit);
	} else {
		// should not get here
	}
	$_SESSION['history'][$search] = $_SESSION['cloud']->getId();
	$wordArray = json_encode($_SESSION['cloud']->getWordArray());
	$template = $twig->loadTemplate('wordCloud.phtml');
	$params = array(
		'title' => "Another Day Another Scholar",
		'wordArray' => $wordArray,
		'history' => $_SESSION['history']
	);
	$template->display($params); 
});

$app->get('/papers/', function () use ($app, $twig) {
	$template = $twig->loadTemplate('paperList.phtml');
	$term = $app->request()->params('term');
	$showButtons = true;
	if ($term[0] == "'") {
		$papers = $_SESSION['dataManager']->getPapersByJournal($term);
		$showButtons = false;
		foreach($papers as $paper) {
			$journal[] = array(
			'title' => $paper->getParsedTitle(),
			'author' => $paper->getAuthor(),
			'journal' => $paper->getJournal(),
			'frequency' => 0,
			'link' => $paper->getLink()
			);
		}
		$papers = $journal;
	} else {
		$wordObject = $_SESSION['cloud']->getWordObject($term);
		$ids = $wordObject->getTermFrequency();
		$papers;
		foreach($ids as $id => $freq) {
			$paper = $_SESSION['cloud']->getPaperObject($id);
			$papers[] = array(
				'title' => $paper->getParsedTitle(),
				'author' => $paper->getAuthor(),
				'journal' => $paper->getJournal(),
				'frequency' => $freq,
				'link' => $paper->getLink()
				);
		}
	}
	$params = array(
			'title' => "Another Day Another Scholar", 
			'searchword' => $term,
			'papers' => $papers,
			'buttons' => $showButtons
			);

	$template->display($params);
});

$app->get('/pdf/:term/:subset', function ($term, $subset) use ($app, $twig) {
	$wordObject = $_SESSION['cloud']->getWordObject($term);
	$ids = $wordObject->getTermFrequency();
	$papers;
	$subset = substr($subset, 0, -1);
	$checked = explode(",", $subset);
	$file = '<html><body>'.'<h1> "'.$term.'"</h1>';
	$counter = 3;
 	foreach($ids as $id => $freq) {
 		if(in_array(strval($counter), $checked)) {
 			$paper = $_SESSION['cloud']->getPaperObject($id);
			$file = $file.implode(" ", $paper->getParsedTitle());
			$file = $file."<br>".implode(" ", $paper->getAuthor())."<br>";
			$file = $file.$paper->getJournal()."<br><br>";
 		}
 		$counter += 1;
	}
	$file = $file.'</body></html>';

	$dompdf = new DOMPDF();
	$dompdf->load_html($file);
	$dompdf->render();
	$dompdf->stream("sample.pdf");
});

$app->get('/sscloud/:term/:subset', function ($term, $subset) use ($app, $twig) {
	$subset = substr($subset, 0, -1);
	$checked = explode(",", $subset);
	$wordObject = $_SESSION['cloud']->getWordObject($term);
	$ids = $wordObject->getTermFrequency();
	$paperIds = array();
	$counter = 3;
	foreach($ids as $id => $freq) {
		if(in_array(strval($counter), $checked)) {
 			$paperIds[] = $id;
			echo $id;	
 		}
 		$counter += 1;
	}

	$_SESSION['cloud'] = $_SESSION['dataManager']->getSubsetCloud($paperIds);

	$wordArray = json_encode($_SESSION['cloud']->getWordArray());
	$template = $twig->loadTemplate('wordCloud.phtml');
	$params = array(
		'title' => "Another Day Another Scholar",
		'wordArray' => $wordArray,
		'history' => $_SESSION['history']
	);
	$template->display($params); 
});

$app->get('/history', function () use ($app, $twig) {
	$cloudid = $app->request()->params('cloudid');
	$_SESSION['cloud'] = $_SESSION['dataManager']->getCloud($cloudid);
	$wordArray = json_encode($_SESSION['cloud']->getWordArray());
	$template = $twig->loadTemplate('wordCloud.phtml');
	$params = array(
		'title' => "Another Day Another Scholar",
		'wordArray' => $wordArray,
		'history' => $_SESSION['history']
	);
	$template->display($params); 
});

$app->run();
