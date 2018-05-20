<?php
defined('APPLICATION_PATH') || 
define('APPLICATION_PATH', realpath(dirname(__FILE__). '/../app'));
const DS = DIRECTORY_SEPARATOR;

require APPLICATION_PATH .DS.'config'.DS.'config.php';
//echo '<pre>';

$page = get('page','home');
$model = $config['MODEL_PATH'].$page.'.php';
$view = $config['VIEW_PATH'].$page.'.html';
$_404 = $config['VIEW_PATH'].'404.html';

if(file_exists($model)){
	require $model;
}
$content = $_404;
if(file_exists($view)){
	$content = $view;
}

include $config['VIEW_PATH'].'bootlayout.html';