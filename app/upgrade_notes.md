2020-06-05 03:00

# running php upgrade upgrade see: https://github.com/silverstripe/silverstripe-upgrader
cd /var/www/upgrades/upgradeto4
php /var/www/ss3/upgrader/vendor/silverstripe/upgrader/bin/upgrade-code upgrade /var/www/upgrades/upgradeto4/app  --root-dir=/var/www/upgrades/upgradeto4 --write -vvv
Writing changes for 7 files
Running upgrades on "/var/www/upgrades/upgradeto4/app"
[2020-06-05 15:00:14] Applying RenameClasses to _config.php...
[2020-06-05 15:00:14] Applying ClassToTraitRule to _config.php...
[2020-06-05 15:00:14] Applying RenameClasses to PageController.php...
[2020-06-05 15:00:14] Applying ClassToTraitRule to PageController.php...
[2020-06-05 15:00:14] Applying RenameClasses to Page_Controller.php...
[2020-06-05 15:00:14] Applying ClassToTraitRule to Page_Controller.php...
[2020-06-05 15:00:14] Applying RenameClasses to CompleteSetupRecord.php...
[2020-06-05 15:00:14] Applying ClassToTraitRule to CompleteSetupRecord.php...
[2020-06-05 15:00:14] Applying RenameClasses to DefaultRecordsForEcommerce.php...
[2020-06-05 15:00:14] Applying ClassToTraitRule to DefaultRecordsForEcommerce.php...
[2020-06-05 15:00:14] Applying RenameClasses to CleanEcommerceTables.php...
[2020-06-05 15:00:14] Applying ClassToTraitRule to CleanEcommerceTables.php...
[2020-06-05 15:00:14] Applying RenameClasses to Page.php...
[2020-06-05 15:00:14] Applying ClassToTraitRule to Page.php...
[2020-06-05 15:00:14] Applying UpdateConfigClasses to mysite.yml...
[2020-06-05 15:00:14] Applying UpdateConfigClasses to config.yml...
PHP Warning:  Invalid argument supplied for foreach() in /var/www/ss3/upgrader/vendor/silverstripe/upgrader/src/UpgradeRule/YML/YMLUpgradeRule.php on line 32
[2020-06-05 15:00:14] Applying UpdateConfigClasses to ecommerce.yml...
modified:	_config.php
@@ -1,4 +1,9 @@
 <?php
+
+use SilverStripe\Control\Director;
+use SilverStripe\Core\Config\Config;
+use SilverStripe\View\SSViewer;
+use SilverStripe\Control\Controller;

 global $project;
 $project = 'app';
@@ -17,7 +22,7 @@
 else {
 //      BasicAuth::protect_entire_site();
         if(Director::isDev()) {
-                Config::modify()->update('SSViewer', 'source_file_comments', true);
+                Config::modify()->update(SSViewer::class, 'source_file_comments', true);
         }
 }

@@ -34,7 +39,7 @@
 if (!$theme) {
     $theme = "simple";
 }
-if (Config::inst()->get("SSViewer", "theme") != $theme) {
-    Config::modify()->update("SSViewer", "theme", $theme);
+if (Config::inst()->get(SSViewer::class, "theme") != $theme) {
+    Config::modify()->update(SSViewer::class, "theme", $theme);
 }


modified:	src/Page_Controller.php
@@ -1,4 +1,17 @@
 <?php
+
+use SilverStripe\Core\Config\Config;
+use SilverStripe\View\SSViewer;
+use SilverStripe\View\Requirements;
+use Sunnysideup\EcommerceTest\Model\CompleteSetupRecord;
+use SilverStripe\Control\HTTPRequest;
+use SilverStripe\Core\Convert;
+use SilverStripe\ORM\DB;
+use SilverStripe\Control\Controller;
+use SilverStripe\CMS\Model\SiteTree;
+use SilverStripe\Control\Director;
+use SilverStripe\ErrorPage\ErrorPage;
+use SilverStripe\CMS\Controllers\ContentController;

 class Page_Controller extends ContentController
 {
@@ -36,7 +49,7 @@
         //theme needs to be set TWO times...
         //$theme = Session::get("theme"); if(!$theme) {$theme = "simple";}SSViewer::set_theme($theme);
         parent::init();
-        $theme = Config::inst()->get("SSViewer", "theme");
+        $theme = Config::inst()->get(SSViewer::class, "theme");
         $this->InsertGoogleAnalyticsAsHeadTag();
         if ($theme == "main") {
             Requirements::themedCSS('sunnysideup/ecommerce_test: reset');
@@ -72,7 +85,7 @@
         return array();
     }

-    public function settheme(SS_HTTPRequest $request)
+    public function settheme(HTTPRequest $request)
     {
         $newTheme = $request->param("ID");
         $newTheme = Convert::raw2sql($newTheme);
@@ -146,7 +159,7 @@
             'WebPortfolioPage',
             'PresentationPage',
             'TermsAndConditionsPage',
-            'ErrorPage',
+            ErrorPage::class,
             'HomePage',
             'TypographyTestPage',
             'TemplateOverviewPage'

modified:	src/Model/CompleteSetupRecord.php
@@ -2,7 +2,9 @@

 namespace Sunnysideup\EcommerceTest\Model;

-use DataObject;
+
+use SilverStripe\ORM\DataObject;
+


 class CompleteSetupRecord extends DataObject

modified:	src/Tasks/DefaultRecordsForEcommerce.php
@@ -2,19 +2,19 @@

 namespace Sunnysideup\EcommerceTest\Tasks;

-use BuildTask;
-use DB;
+
+
 use Product;
 use EcommerceTaskCreateMemberGroups;
 use EcommerceDBConfig;
-use Folder;
-use Director;
+
+
 use Page;
 use CheckoutPage;
 use ProductAttributeType;
 use ProductAttributeValue;
 use ProductVariation;
-use ArrayList;
+
 use ProductGroup;
 use CombinationProduct;
 use PickUpOrDeliveryModifierOptions;
@@ -22,10 +22,10 @@
 use DiscountCouponOption;
 use EcommerceProductTag;
 use ProductGroupWithTags;
-use Versioned;
+
 use EcommerceRole;
-use Group;
-use Member;
+
+
 use ComplexPriceObject;
 use Order;
 use BillingAddress;
@@ -35,10 +35,23 @@
 use CartPage;
 use AccountPage;
 use Spyc;
-use SiteTree;
+
 use DataObjectSet;
-use Image;
-use CompleteSetupRecord;
+
+
+use SilverStripe\ORM\DB;
+use SilverStripe\Assets\Folder;
+use SilverStripe\Control\Director;
+use SilverStripe\ORM\ArrayList;
+use SilverStripe\Versioned\Versioned;
+use SilverStripe\Security\Group;
+use SilverStripe\Security\Member;
+use SilverStripe\CMS\Model\SiteTree;
+use SilverStripe\SiteConfig\SiteConfig;
+use SilverStripe\Assets\Image;
+use Sunnysideup\EcommerceTest\Model\CompleteSetupRecord;
+use SilverStripe\Dev\BuildTask;
+


 class DefaultRecordsForEcommerce extends BuildTask
@@ -1781,10 +1794,10 @@
     private function UpdateMyRecords()
     {
         $array = array(
-            array("T" => "SiteConfig", "F" => "Title", "V" => "Silverstripe Ecommerce Demo", "W" => ""),
-            array("T" => "SiteConfig", "F" => "Tagline", "V" => "Built by Sunny Side Up", "W" => ""),
+            array("T" => SiteConfig::class, "F" => "Title", "V" => "Silverstripe Ecommerce Demo", "W" => ""),
+            array("T" => SiteConfig::class, "F" => "Tagline", "V" => "Built by Sunny Side Up", "W" => ""),
             //array("T" => "SiteConfig", "F" => "CopyrightNotice", "V" => "This demo (not the underlying modules) are &copy; Sunny Side Up Ltd", "W" => ""),
-            array("T" => "SiteConfig", "F" => "Theme", "V" => "main", "W" => ""),
+            array("T" => SiteConfig::class, "F" => "Theme", "V" => "main", "W" => ""),
             array("T" => "EcommerceDBConfig", "F" => "ShopClosed", "V" => "0", "W" => ""),
             array("T" => "EcommerceDBConfig", "F" => "ShopPricesAreTaxExclusive", "V" => "0", "W" => ""),
             array("T" => "EcommerceDBConfig", "F" => "ShopPhysicalAddress", "V" => "<address>The Shop<br />1 main street<br />Coolville 123<br />Landistan</address>", "W" => ""),

Warnings for src/Tasks/DefaultRecordsForEcommerce.php:
 - src/Tasks/DefaultRecordsForEcommerce.php:1758 PhpParser\Node\Expr\Variable
 - WARNING: New class instantiated by a dynamic value on line 1758

modified:	src/Tasks/CleanEcommerceTables.php
@@ -2,11 +2,17 @@

 namespace Sunnysideup\EcommerceTest\Tasks;

-use BuildTask;
-use Permission;
-use Director;
-use Security;
-use DB;
+
+
+
+
+
+use SilverStripe\Security\Permission;
+use SilverStripe\Control\Director;
+use SilverStripe\Security\Security;
+use SilverStripe\ORM\DB;
+use SilverStripe\Dev\BuildTask;
+




modified:	src/Page.php
@@ -1,4 +1,9 @@
 <?php
+
+use SilverStripe\Assets\Image;
+use SilverStripe\CMS\Model\SiteTree;
+use SilverStripe\ORM\DataObject;
+use SilverStripe\SiteConfig\SiteConfig;

 class Page extends SiteTree
 {
@@ -39,7 +44,7 @@
   * ### @@@@ STOP REPLACEMENT @@@@ ###
   */
     private static $has_one = array(
-        "BackgroundImage" => "Image"
+        "BackgroundImage" => Image::class
     );

     public function MyBackgroundImage()
@@ -50,7 +55,7 @@
             }
         }
         if ($this->ParentID) {
-            if ($parent = DataObject::get_by_id("SiteTree", $this->ParentID)) {
+            if ($parent = DataObject::get_by_id(SiteTree::class, $this->ParentID)) {
                 return $parent->MyBackgroundImage();
             }
         }

Warnings for src/Page.php:
 - src/Page.php:42 Renaming ambiguous string Image to SilverStripe\Assets\Image

modified:	_config/config.yml
@@ -3,18 +3,14 @@
 EcommerceConfig:
   folder_and_file_locations:
     - "app/_config/ecommerce.yml"
-
 SSViewer:
   theme: main
-
-
 WebpackPageControllerExtension:
   webpack_enabled_themes:
     - sswebpack
-
 Email:
   admin_email: ssuerrors@gmail.com
-
 GoogleAnalyticsSTE:
   main_code: 'UA-26108878-1' #e.g. UA-xxxx-y
-
+---
+{  }

Writing changes for 7 files
✔✔✔