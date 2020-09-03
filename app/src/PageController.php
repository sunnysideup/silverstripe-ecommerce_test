<?php

use SilverStripe\Control\Session;
use SilverStripe\CMS\Controllers\ContentController;

class PageController extends ContentController
{
    public function onAfterInit()
    {
        $theme = Session::get('theme');
        $baseThemes = SSViewer::get_themes();

        if ($theme && in_array($theme, $baseThemes)) {
            // Put the theme at the top of the list
            array_unshift($baseThemes, $theme);
            SSViewer::set_themes(array_unique($baseThemes));
        }
    }

    public function SelectThemeForm()
    {
        $fields->addFieldToTab('Root.Main',
            DropdownField::create(
                'SiteConfigTheme',
                'Set the site theme',
                $this->getPickableThemes()
            )
        );
    }

    protected function getPickableThemes()
    {
        $baseThemes = Config::inst()->get(SSViewer::class, 'themes');
        // Pop off $default from array
        $defaultTheme = array_search(SSViewer::DEFAULT_THEME, $baseThemes);
        if ($defaultTheme !== false) {
            unset($baseThemes[$defaultTheme]);
        }

    }

}
