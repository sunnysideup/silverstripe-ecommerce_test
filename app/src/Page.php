<?php

use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\ORM\DataObject;
use SilverStripe\SiteConfig\SiteConfig;

class Page extends SiteTree
{

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * OLD: private static $db (case sensitive)
  * NEW: 
    private static $table_name = '[SEARCH_REPLACE_CLASS_NAME_GOES_HERE]';

    private static $db (COMPLEX)
  * EXP: Check that is class indeed extends DataObject and that it is not a data-extension!
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
    
    private static $table_name = 'Page';


/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: private static $db = (case sensitive)
  * NEW: private static $db = (COMPLEX)
  * EXP: Make sure to add a private static $table_name!
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
    private static $db = array(
        "SetupCompleted" => "Boolean"
    );


/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: private static $has_one = (case sensitive)
  * NEW: private static $has_one = (COMPLEX)
  * EXP: Make sure to add a private static $table_name!
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
    private static $has_one = array(
        "BackgroundImage" => Image::class
    );

    public function MyBackgroundImage()
    {
        if ($this->BackgroundImageID) {
            if ($image = $this->BackgroundImage()) {
                return $image;
            }
        }
        if ($this->ParentID) {
            if ($parent = DataObject::get_by_id(SiteTree::class, $this->ParentID)) {
                return $parent->MyBackgroundImage();
            }
        }
        if ($siteConfig = SiteConfig::current_site_config()) {
            return $siteConfig->BackgroundImage();
        }
    }
}

