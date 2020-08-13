<?php

use SilverStripe\Control\Director;
use SilverStripe\Core\Config\Config;
use SilverStripe\View\SSViewer;
use SilverStripe\Control\Controller;



/*** ECOMMERCE ***/

if(Director::isLive()) {
    Director::forceSSL();
}
