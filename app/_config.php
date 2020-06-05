<?php

global $project;
$project = 'mysite';

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
                SSViewer::set_source_file_comments(true);
        }
}

$theme = Session::get("theme");
if (!$theme) {
    $theme = "simple";
}
if (Config::inst()->get("SSViewer", "theme") != $theme) {
    Config::inst()->update("SSViewer", "theme", $theme);
}
