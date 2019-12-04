<?php

function addDirClassPath(){

	$register_path = array(
		'App' => 'app',
		'BackEndClass' => 'app/BackEnd',
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