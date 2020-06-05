<?php

global $project;
$project = 'app';

global $database;
$database = 'ssecom';

require_once('conf/ConfigureFromEnv.php');

/*** ECOMMERCE ***/

if(Director::isLive()) {
        Director::forceSSL();
        SS_Log::add_writer(new SS_LogEmailWriter('ssuerrors@gmail.com'), SS_Log::ERR);
}
else {
//      BasicAuth::protect_entire_site();
        if(Director::isDev()) {
                Config::modify()->update('SSViewer', 'source_file_comments', true);
        }
}


/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: Session:: (case sensitive)
  * NEW: Controller::curr()->getRequest()->getSession()-> (COMPLEX)
  * EXP: If THIS is a controller than you can write: $this->getRequest(). You can also try to access the HTTPRequest directly. 
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
$theme = Controller::curr()->getRequest()->getSession()->get("theme");
if (!$theme) {
    $theme = "simple";
}
if (Config::inst()->get("SSViewer", "theme") != $theme) {
    Config::modify()->update("SSViewer", "theme", $theme);
}
