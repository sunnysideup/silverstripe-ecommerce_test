<?php

use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\ORM\DataObject;
use SilverStripe\SiteConfig\SiteConfig;

class Page extends SiteTree
{


    private static $table_name = 'Page';


    private static $db = array(
        "SetupCompleted" => "Boolean"
    );


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
