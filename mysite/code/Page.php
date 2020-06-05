<?php

class Page extends SiteTree
{
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

