<?php


class DownloadPage extends Page {

	function canDownload(){
		return true;
		if($member = Member::currentUser()) {
			if($member->IsShopAdmin()) {
				return true;
			}
		}
	}

}

class DownloadPage_Controller extends Page_Controller {

	protected $defaultDownloadArray = array(
		"all" => array(
			"Title" => "Entire Site (use svn link for best results)",
			"SVNLink" => "http://sunny.svnrepository.com/svn/sunny-side-up-general/ecommerce_test/trunk/",
			"GITLink" => "https://github.com/sunnysideup/silverstripe-ecommerce_test",
			"DownloadLink" => "assets/download-all/ecommerce"
			),
		"silverstripe-framework" => array(
			"Title" => "Sapphire 3.1.4 (provided by Silverstripe Ltd)",
			"FolderPadded" => "sapphire",
			"SVNLink" => "https://github.com/silverstripe/silverstripe-framework/tags/3.1.4",
			"GITLink" => "https://github.com/silverstripe/silverstripe-framework/tree/3.1.4",
			"DownloadLink" => ""
			),
		"silverstripe-cms" => array(
			"Title" => "CMS 3.1.4 (provided by Silverstripe Ltd)",
			"FolderPadded" => "cms",
			"SVNLink" => "https://github.com/silverstripe/silverstripe-cms/tags/3.1.4",
			"GITLink" => "https://github.com/silverstripe/silverstripe-cms/tree/3.1.4",
			"DownloadLink" => ""
			),
		"mysite" => array(
			"Title" => "mysite (example only)",
			"SVNLink" => "http://sunny.svnrepository.com/svn/sunny-side-up-general/ecommerce_test/trunk/mysite",
			"GITLink" => "https://github.com/sunnysideup/silverstripe-ecommerce_test/mysite/",
			"DownloadLink" => "assets/downloads/mysite"
			),
		"themes" => array(
			"Title" => "themes (example only)",
			"SVNLink" => "http://sunny.svnrepository.com/svn/sunny-side-up-general/ecommerce_test/trunk/themes",
			"GITLink" => "https://github.com/sunnysideup/silverstripe-ecommerce_test/themes/",
			"DownloadLink" => "assets/downloads/themes"
			)
	);

	function init() {
		parent::init();
		$this->createDownloads();
	}

	function index() {
		if($this->canDownload()){
			$this->createDownloads();
		}
		return array();
	}

	function Downloads(){
		$dos = new ArrayList();
		$folders = $this->getFolderList();

		//get details
		foreach($folders as $folder) {
			$svnLink = "https://silverstripe-ecommerce.googlecode.com/svn/modules/$folder/trunk/";
			if($folder == "ecommerce"){
				$svnLink = "https://silverstripe-ecommerce.googlecode.com/svn/trunk/";
			}
			$gitLink = "https://github.com/sunnysideup/silverstripe-$folder";
			$downloadLink = "assets/downloads/".trim($folder).".zip";
			if(!isset($this->defaultDownloadArray[$folder])) {
				$this->defaultDownloadArray[$folder] = array(
					"Title" => $folder,
					"FolderPadded" => $folder,
					"SVNLink" => $svnLink,
					"GITLink" => $gitLink
				);
			}
			$downloadFile = Director::baseFolder()."/".$downloadLink;
			if($this->canDownload() && file_exists($downloadFile)) {
				$this->defaultDownloadArray[$folder]["DownloadLink"] = $downloadLink;
			}
		}

		//sort
		ksort($this->defaultDownloadArray);

		//pad folder for svn externals and add to dos...
		foreach($this->defaultDownloadArray as $folder => $folderArray) {
			$folderArray["Folder"] = $folder;
			if(isset($folderArray["FolderPadded"])) {
				$folderArray["FolderPadded"] = str_pad(trim($folderArray["FolderPadded"]), 45, " ",STR_PAD_RIGHT);
			}
			if(isset($folderArray["GITLink"])) {
				$folderArray["GITLinkGIT"] = str_pad(str_replace("https://", "git://", $folderArray["GITLink"]), 85, " ",STR_PAD_RIGHT);
			}

			$dos->push(new ArrayData($folderArray));
		}
		return $dos;
	}

	private function createDownloads() {
		$folders = $this->getFolderList();
		foreach($folders as $folder) {
			exec('
				mkdir '.Director::baseFolder().'/
				cd '.Director::baseFolder().'/
				zip -r assets/downloads/'.$folder.'.zip '.$folder.'/ -x "*.svn/*" -x "*.git/*"'
			);
		}
		exec('
			mkdir '.Director::baseFolder().'/assets/download-all/
			cd '.Director::baseFolder().'/assets/download-all/
			zip -r assets/download-all/ecommerce.zip '.Director::baseFolder().'/assets/downloads/ -x "*.svn/*" -x "*.git/*"'
		);
	}

	private function getFolderList() {
		$dir = Director::baseFolder();
		$array = array();
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
					if(
						substr($file, 0, 10) == "ecommerce_" ||
						substr($file, 0, 8) == "payment_" ||
						$file == "ecommerce" ||
						$file == "themes" ||
						$file == "mysite"
					) {
						$array[] = $file;
					}
				}
				closedir($dh);
			}
		}
		return $array;
	}

}
