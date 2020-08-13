<?php

use SilverStripe\Core\Config\Config;
use SilverStripe\View\SSViewer;
use SilverStripe\View\Requirements;
use Sunnysideup\EcommerceTest\Model\CompleteSetupRecord;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Convert;
use SilverStripe\ORM\DB;
use SilverStripe\Control\Controller;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Control\Director;
use SilverStripe\ErrorPage\ErrorPage;
use SilverStripe\CMS\Controllers\ContentController;

class Page_Controller extends ContentController
{
    private static $allowed_actions = array(
        "settheme"
    );

    /**
     * An array of actions that can be accessed via a request. Each array element should be an action name, and the
     * permissions or conditions required to allow the user to access it.
     *
     * <code>
     * array (
     *     'action', // anyone can access this action
     *     'action' => true, // same as above
     *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
     *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
     * );
     * </code>
     *
     * @var array
     */



/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * OLD:     public function init() (ignore case)
  * NEW:     protected function init() (COMPLEX)
  * EXP: Controller init functions are now protected  please check that is a controller.
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
    protected function init()
    {
        //theme needs to be set TWO times...
        //$theme = Session::get("theme"); if(!$theme) {$theme = "simple";}SSViewer::set_theme($theme);
        parent::init();
        $theme = Config::inst()->get(SSViewer::class, "theme");
        $this->InsertGoogleAnalyticsAsHeadTag();
        if ($theme == "main") {
            Requirements::themedCSS('sunnysideup/ecommerce_test: reset');
            Requirements::themedCSS('sunnysideup/ecommerce_test: layout');
            Requirements::themedCSS('sunnysideup/ecommerce_test: typography');
            Requirements::themedCSS('sunnysideup/ecommerce_test: form');
            Requirements::themedCSS('sunnysideup/ecommerce_test: menu');

            Requirements::themedCSS('sunnysideup/ecommerce_test: ecommerce');

            Requirements::themedCSS('sunnysideup/ecommerce_test: individualPages');

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: THIRDPARTY_DIR . '/jquery/jquery.js' (case sensitive)
  * NEW: 'silverstripe/admin: thirdparty/jquery/jquery.js' (COMPLEX)
  * EXP: Check for best usage and inclusion of Jquery
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
            Requirements::javascript('sunnysideup/ecommerce_test: silverstripe/admin: thirdparty/jquery/jquery.js');
        } elseif ($theme == "simple") {
        }
    }

    public function index()
    {
        if ($this->URLSegment == "home") {
            if (!CompleteSetupRecord::get()->count()) {
                $this->redirect('/dev/tasks/CleanEcommerceTables/?flush=all');
            }
        }
        return array();
    }

    public function settheme(HTTPRequest $request)
    {
        $newTheme = $request->param("ID");
        $newTheme = Convert::raw2sql($newTheme);
        DB::query("Update SiteConfig SET Theme = '$newTheme';");

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: Session:: (case sensitive)
  * NEW: Controller::curr()->getRequest()->getSession()-> (COMPLEX)
  * EXP: If THIS is a controller than you can write: $this->getRequest(). You can also try to access the HTTPRequest directly. 
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
        Controller::curr()->getRequest()->getSession()->set("theme", $newTheme);
        SSViewer::flush_template_cache();
        $this->redirect($this->Link());
    }

    public function IsNotHome()
    {
        return $this->URLSegment != "home";
    }

    public function Siblings()
    {
        return SiteTree::get()
            ->filter(array("ShowInMenus" => 1, "ParentID" => $this->ParentID))
            ->exclude("ID", $this->ID);
    }

    public function MenuChildren()
    {
        return SiteTree::get()
            ->filter(array("ShowInMenus" => 1, "ParentID" => $this->ID));
    }

    public function HasNoExtendedMetatags()
    {
        return true;
    }

    public function ExtendedMetaTags()
    {
        return "
            <base href=\"".Director::absolutebaseURL()."\" />
            <meta charset=\"utf-8\" />
            <meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\" />
            <title>".$this->Title."</title>
            <link rel=\"icon\" href=\"".Director::absolutebaseURL()."favicon.ico\" type=\"image/x-icon\" />
            <link rel=\"shortcut icon\" href=\"".Director::absolutebaseURL()."favicon.ico\" type=\"image/x-icon\" />
            <meta name=\"robots\" content=\"NOODP, all, index, follow\" />
            <meta name=\"googlebot\" content=\"NOODP, all, index, follow\" />
            <meta name=\"geo.country\" content=\"New Zealand\" />
            <meta name=\"viewport\" content=\"width=device-width,initial-scale=1\" />

            <meta property=\"og:title\" content=\"".$this->Title."\" />
            <meta property=\"og:type\" content=\"website\" />
            <meta property=\"og:url\" content=\"".$this->Link()."/\" />
            <meta property=\"og:site_name\" content=\"Silverstripe E-commerce\" />
            <meta property=\"og:description\" content=\"".substr(strip_tags($this->Content), 0, 100)."\" />
        ";
    }

    public function IsInHouseTemplate()
    {
        if ($this->IsEcommercePage()) {
            return true;
        }
        $standard = array(
            'Page',
            'WebPortfolioPage',
            'PresentationPage',
            'TermsAndConditionsPage',
            ErrorPage::class,
            'HomePage',
            'TypographyTestPage',
            'TemplateOverviewPage'
        );


/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: $this->ClassName (case sensitive)
  * NEW: $this->ClassName (COMPLEX)
  * EXP: Check if the class name can still be used as such
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
        return in_array($this->ClassName, $standard);
    }
}
