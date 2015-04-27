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
	$template = $twig->loadTemplate('home.phtml');
	$params = array('title' => 'Another Day Another Scholar');
	$template->display($params);
});

$app->get('/cloud/', function () use ($app, $twig) {
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
	// if ($flow == "new") {
		$wordArray = json_encode($_SESSION['cloud']->getWordArray());
	// }
	$template = $twig->loadTemplate('wordCloud.phtml');
	$params = array(
		'title' => "Another Day Another Scholar",
		'wordArray' => $wordArray
	);
	$template->display($params); 
});

$app->get('/papers/', function () use ($app, $twig) {
	$template = $twig->loadTemplate('paperList.phtml');
	$term = $app->request()->params('term');
	if ($term[0] == "'") {
		$papers = $_SESSION['dataManager']->getPapersByJournal($term);
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
			'papers' => $papers
			);

	$template->display($params);
});

$app->get('/auto', function () use ($app, $twig) {
	$tags = $app->request()->params('q');
	$callback = $app->request()->params('callback');
	$auto = (['Autofill','Suggestion','Test','USC']);
	// $auto = $_SESSION['dataManager']->getAutofillSuggestions($tags);
	echo $callback . '(' . json_encode($auto) . ');';
});

$app->get('/pdf/:term/:subset', function ($term, $subset) use ($app, $twig) {
	$wordObject = $_SESSION['cloud']->getWordObject($term);
	$ids = $wordObject->getTermFrequency();
	$papers;
	$subset = substr($subset, 0, -1);
	$checked = explode(",", $subset);
	$file = '<html><body>'.'<h1> "'.$term.'"</h1>';
	$counter = 2;
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

$app->run();
