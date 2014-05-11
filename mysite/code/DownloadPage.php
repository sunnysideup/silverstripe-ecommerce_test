<?php


class DownloadPage extends Page {


}

class DownloadPage_Controller extends Page_Controller {

	protected $defaultDownloadArray = array(
		"all" => array(
			"Title" => "Entire Site (git users must download submodules separately)",
			"SVNLink" => "http://sunny.svnrepository.com/svn/sunny-side-up-general/ecommerce_test/trunk/",
			"GITLink" => "https://github.com/sunnysideup/silverstripe-ecommerce_test",
			"DownloadLink" => "assets/download-all/ecommerce.zip"
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
			if(file_exists($downloadFile)) {
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
			$folderToZip = Director::baseFolder(). '/'.$folder.'/';
			$destinationFile = Director::baseFolder(). '/assets/downloads/'.$folder.'.zip';
			if(!file_exists($destinationFile)) {
				exec('
					mkdir '.Director::baseFolder().'/assets/downloads/
					cd '.Director::baseFolder().'/
					zip -r assets/downloads/'.$folder.'.zip '.Director::baseFolder().'/'.$folder.'/ -x "*.svn/*" -x "*.git/*" -x "_ss_environment.php"'
				);

				//@mkdir(dirname($destinationFile));
				//$this->makeZipFileFromFolder($folderToZip, $destinationFile);
			}
		}
		if(!file_exists(Director::baseFolder() . '/assets/download-all/ecommerce.zip')) {
			exec('
				mkdir '.Director::baseFolder().'/assets/download-all/
				cd '.Director::baseFolder().'/
				zip -r assets/download-all/ecommerce.zip '.Director::baseFolder().'/ -x "*.svn/*" -x "*.git/*" -x "_ss_environment.php"'
			);
		}
	}

	private function makeZipFileFromFolder($folderToZip, $destinationFile) {
		// Get real path for our folder

		// Initialize archive object
		$zip = new ZipArchive;
		$zip->open($destinationFile, ZipArchive::CREATE);

		// Create recursive directory iterator
		$files = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator($folderToZip),
				RecursiveIteratorIterator::LEAVES_ONLY
		);

		foreach ($files as $name => $file) {
			// Get real path for current file
			$filePath = $file->getRealPath();
			if(is_dir($file) && basename($filePath) == ".svn") {
				//do nothing...
			}
			else {
				// Add current file to archive
				$zip->addFile($filePath, str_replace(Director::baseFolder(), "", $filePath));
			}
		}

		// Zip archive will be created only after closing object
		$zip->close();

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
