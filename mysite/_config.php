<?php

global $project;
$project = 'mysite';

global $database;
$database = 'ecommerce_test';

require_once('conf/ConfigureFromEnv.php');

Email::setAdminEmail("sales@silverstripe-ecommerce.com");

/*** ECOMMERCE ***/


$theme = Session::get("theme");
if(!$theme) {$theme = "simple";}
if(Config::inst()->get("SSViewer", "theme") != $theme) {
	Config::inst()->update("SSViewer", "theme", $theme);
}
