<?php

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

    private static $db = array(
        "SetupCompleted" => "Boolean"
    );

    private static $has_one = array(
        "BackgroundImage" => "Image"
    );

    public function MyBackgroundImage()
    {
        if ($this->BackgroundImageID) {
            if ($image = $this->BackgroundImage()) {
                return $image;
            }
        }
        if ($this->ParentID) {
            if ($parent = DataObject::get_by_id("SiteTree", $this->ParentID)) {
                return $parent->MyBackgroundImage();
            }
        }
        if ($siteConfig = SiteConfig::current_site_config()) {
            return $siteConfig->BackgroundImage();
        }
    }
}

