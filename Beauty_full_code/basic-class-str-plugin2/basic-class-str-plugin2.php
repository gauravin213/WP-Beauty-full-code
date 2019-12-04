<?php
/*
Plugin Name: Basic class str plugin2
Description: This is the machine test plugin 2
Author: Gaurav Sharma
*/

//require_once 'config.php';

function addDirClassPath(){

	$register_path = array(
		'BasicBackEnd' => 'app/BackEnd',
		'UserEditPage' => 'app/BackEnd/User',
	);

	return $register_path;
}

function autoload_register_service($register_path){

	foreach ($register_path as $key => $path) {
		$classes_pp = $key;
		new $classes_pp;
	}
}

function autoload_register_path($register_path, $class_name){

	foreach ($register_path as $path) {
		$pathv = $path.'/'.$class_name.'.php'; 
		include_once $pathv;
	}
}

spl_autoload_register(function ($class_name) { 
	$register_path = addDirClassPath();
	autoload_register_path($register_path, $class_name);
});

$register_path = addDirClassPath();
autoload_register_service($register_path);
?>