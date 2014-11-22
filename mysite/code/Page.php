<?php

class Page extends SiteTree {

	private static $db = array(
		"SetupCompleted" => "Boolean"
	);

	private static $has_one = array(
		"BackgroundImage" => "Image"
	);

	function MyBackgroundImage() {
		if($this->BackgroundImageID) {
			if($image = $this->BackgroundImage()) {
				return $image;
			}
		}
		if($this->ParentID) {
			if($parent = DataObject::get_by_id("SiteTree", $this->ParentID)) {
				return $parent->MyBackgroundImage();
			}
		}
		if($siteConfig = SiteConfig::current_site_config()) {
			return $siteConfig->BackgroundImage();
		}
	}

}


class Page_Controller extends ContentController {

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


	public function init() {
		//theme needs to be set TWO times...
		//$theme = Session::get("theme"); if(!$theme) {$theme = "simple";}SSViewer::set_theme($theme);
		parent::init();
		$theme = Config::inst()->get("SSViewer", "theme");
		if($theme == "main") {
			Requirements::themedCSS('reset');
			Requirements::themedCSS('layout');
			Requirements::themedCSS('typography');
			Requirements::themedCSS('form');
			Requirements::themedCSS('menu');

			Requirements::themedCSS('ecommerce');

			Requirements::themedCSS('individualPages');
			Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
		}
		elseif($theme == "simple") {
		}
	}

	public function index(){
		if($this->URLSegment == "home") {
			if(!CompleteSetupRecord::get()->count()) {
				$this->redirect('/dev/tasks/CleanEcommerceTables/?flush=all');
			}
		}
		return array();
	}

	public function settheme(HTTPRequest $request){
		$newTheme = $request->param("ID");
		$newTheme = Convert::raw2sql($newTheme);
		DB::query("Update SiteConfig SET Theme = '$newTheme';");
		Session::set("theme", $newTheme);
		SSViewer::flush_template_cache();
		$this->redirect($this->Link());

	}

	function IsNotHome() {
		return $this->URLSegment != "home";
	}

	function Siblings() {
		return SiteTree::get()
			->filter(array("ShowInMenus" => 1, "ParentID" => $this->ParentID))
			->exclude("ID", $this->ID);
	}

	function MenuChildren() {
		return SiteTree::get()
			->filter(array("ShowInMenus" => 1, "ParentID" => $this->ID));
	}

	function HasNoExtendedMetatags(){
		return true;
	}

	function ExtendedMetaTags(){
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
			<meta property=\"og:description\" content=\"".substr(strip_tags($this->Content),0, 100)."\" />
		";
	}

}

