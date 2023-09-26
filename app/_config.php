<?php

use SilverStripe\Control\Director;

// ECOMMERCE

if (Director::isLive()) {
    Director::forceSSL();
}
