2020-06-05 02:37

# running php upgrade recompose see: https://github.com/silverstripe/silverstripe-upgrader
cd /var/www/upgrades/upgradeto4
php /var/www/ss3/upgrader/vendor/silverstripe/upgrader/bin/upgrade-code recompose --recipe-core-constraint="~4@stable"  --root-dir=/var/www/upgrades/upgradeto4 --write -vvv

Upgrading PHP constraint
========================

 Done.

Rebuilding dependencies
=======================

 ! [NOTE] Trying to re-require all packages

 * Requiring php:">=5.6" .... ✔
 * Requiring silverstripe/recipe-core:"4.5.2" ...... ✔
 * Requiring silverstripe/recipe-cms:"*" ....... ✔
 * Requiring silverstripe/geoip:"*" ....... ✔
 * Requiring sunnysideup/ecommerce:"*" ........ ✔

 ! [NOTE] Trying to curate dependencies by switching to recipes.

 Adding `silverstripe/recipe-cms` to substitute:
 * silverstripe/recipe-core


 ! [NOTE] Set dependency constraint to specific version.

 * Requiring silverstripe/recipe-cms:"^4.5.2" ..... ✔

 Done.

Rebuilding dev dependencies
===========================

 ! [NOTE] Trying to re-require all packages

 * Requiring sunnysideup/huringa:"*" ........ ✔

 ! [NOTE] Set dependency constraint to specific version.

 * Requiring sunnysideup/huringa:"dev-master" ..... ✔

 Done.

Showing difference
==================

modified:	/var/www/upgrades/upgradeto4/composer.json
@@ -12,7 +12,8 @@
     "require": {
         "silverstripe/geoip": "*",
         "sunnysideup/ecommerce": "*",
-        "silverstripe/recipe-cms": "^4.4"
+        "silverstripe/recipe-cms": "^4.5.2",
+        "php": ">=5.6"
     },
     "scripts": {
         "post-install-cmd": [
@@ -54,4 +55,3 @@
         "sunnysideup/huringa": "dev-master"
     }
 }
-

 ! [NOTE] Changes have been saved.

Trying to install new dependencies
==================================

Loading composer repositories with package information
Updating dependencies (including require-dev)
Nothing to install or update
Writing lock file
Generating autoload files
> php framework/cli-script.php dev/build flush=all
Script php framework/cli-script.php dev/build flush=all handling the post-update-cmd event returned with error code 1

 [WARNING] Composer could not resolved your updated dependencies. You'll need to manually resolve conflicts.

✔✔✔
# running php upgrade environment see: https://github.com/silverstripe/silverstripe-upgrader
cd /var/www/upgrades/upgradeto4
php /var/www/ss3/upgrader/vendor/silverstripe/upgrader/bin/upgrade-code environment   --root-dir=/var/www/upgrades/upgradeto4 --write -vvv
Changes have been saved to your `.env` file
Converting `/var/www/_ss_environment.php`
modified:	/var/www/upgrades/upgradeto4/.env
@@ -1,1 +1,11 @@
+SS_ENVIRONMENT_TYPE="dev"
+SS_DEV="1"
+SS_DATABASE_SERVER="localhost"
+SS_DATABASE_USERNAME="root"
+SS_DATABASE_PASSWORD="x"
+SS_DATABASE_NAME="ss3_zenergy"
+SS_DEFAULT_ADMIN_USERNAME="x"
+SS_DEFAULT_ADMIN_PASSWORD="x"
+SENDGRID_SMTP_USERNAME=""
+SENDGRID_SMTP_PASSWORD=""


unchanged:	_ss_environment.php
Warnings for _ss_environment.php:
 - _ss_environment.php:0 Your environment file contains unusual constructs. It can still be converted, but take time to validate the result.
Changes have been saved to your `.env` file
✔✔✔
# running php upgrade reorganise see: https://github.com/silverstripe/silverstripe-upgrader
cd /var/www/upgrades/upgradeto4
php /var/www/ss3/upgrader/vendor/silverstripe/upgrader/bin/upgrade-code reorganise   --root-dir=/var/www/upgrades/upgradeto4 --write -vvv
 - README.md:51 `mysite/_config` folder (where available - otherwise search for `private static $` in the module to see what can be configured)
Your `code` folder as already been renamed to `src`
Your `mysite` folder as already been renamed to `app`
Your project has been reorganised

We found occurrences of `mysite` in your code base. You might need to replace those with `app`.
unchanged:	app/upgrade_notes.md
Warnings for app/upgrade_notes.md:
 - app/upgrade_notes.md:22 [2020-06-05 15:00:14] Applying UpdateConfigClasses to mysite.yml...
unchanged:	composer.json
Warnings for composer.json:
 - composer.json:43             "app/_config/mysite.yml",
unchanged:	ecommerce/_config.php
Warnings for ecommerce/_config.php:
 - ecommerce/_config.php:14 // CACHING RECOMMENDATION - you can overrule that in the mysite _config.php file...
unchanged:	ecommerce/_config/ecommerce_custom_classes.yml.example
Warnings for ecommerce/_config/ecommerce_custom_classes.yml.example:
 - ecommerce/_config/ecommerce_custom_classes.yml.example:6 # to mysite/_config/config.yml
unchanged:	ecommerce/_config/config.yml
Warnings for ecommerce/_config/config.yml:
 - ecommerce/_config/config.yml:3 Before: 'mysite/*'
unchanged:	ecommerce/_config/payment.yml
Warnings for ecommerce/_config/payment.yml:
 - ecommerce/_config/payment.yml:3 Before: 'mysite/*'
unchanged:	ecommerce/_config/ecommerce.yml
Warnings for ecommerce/_config/ecommerce.yml:
 - ecommerce/_config/ecommerce.yml:3 Before: 'mysite/*'
 - ecommerce/_config/ecommerce.yml:9 # 1. copy this file to another location (e.g. mysite/_config)
 - ecommerce/_config/ecommerce.yml:339 # these can be overriden in mysite/_config/config.yml #
unchanged:	ecommerce/code/tasks/EcommerceTaskCreateMemberGroups.php
Warnings for ecommerce/code/tasks/EcommerceTaskCreateMemberGroups.php:
 - ecommerce/code/tasks/EcommerceTaskCreateMemberGroups.php:84 	 * @param Member | String $member Default Member added to the group (e.g. sales@mysite.co.nz). You can also provide an email address
unchanged:	ecommerce/code/tasks/EcommerceTaskMigration.php
Warnings for ecommerce/code/tasks/EcommerceTaskMigration.php:
 - ecommerce/code/tasks/EcommerceTaskMigration.php:1568 			$this->DBAlterationMessageNow("Could not find any config files (most usual place: mysite/_config/ecommerce.yml)", "deleted");
unchanged:	ecommerce/code/tasks/EcommerceTaskCheckConfiguration.php
Warnings for ecommerce/code/tasks/EcommerceTaskCheckConfiguration.php:
 - ecommerce/code/tasks/EcommerceTaskCheckConfiguration.php:276 			DB::alteration_message("Recommended course of action: add the above configs to your mysite/_config/ecommerce.yml file if you required them.", "edited");
unchanged:	ecommerce/code/tasks/EcommerceTaskDeleteAllOrders.php
Warnings for ecommerce/code/tasks/EcommerceTaskDeleteAllOrders.php:
 - ecommerce/code/tasks/EcommerceTaskDeleteAllOrders.php:69 				die("<h1>ARE YOU SURE?</h1><br /><br /><br /> please add the 'i-am-sure' get variable to your request and set it to 'yes' ... e.g. <br />http://www.mysite.com/dev/ecommerce/ecommercetaskdeleteallorders/?i-am-sure=yes");
unchanged:	ecommerce/code/config/EcommerceConfigDefinitions.php
Warnings for ecommerce/code/config/EcommerceConfigDefinitions.php:
 - ecommerce/code/config/EcommerceConfigDefinitions.php:330 				"admin_group_user_email" => "Email address for the shop administrator (e.g. johnsmith@mysite.co.nz).",
unchanged:	ecommerce/code/config/EcommerceConfig.php
Warnings for ecommerce/code/config/EcommerceConfig.php:
 - ecommerce/code/config/EcommerceConfig.php:14  * 1. Copy ecommerce/_config/ecommerce.yml and move it your project folder, e.g. mysite/_config/ecommerce.yml
 - ecommerce/code/config/EcommerceConfig.php:24  *     - "mysite/_config/ecommerce.yml"
unchanged:	ecommerce/code/OrderConfirmationPage.php
Warnings for ecommerce/code/OrderConfirmationPage.php:
 - ecommerce/code/OrderConfirmationPage.php:343 		isset($project) ? $themeBaseFolder = $project : $themeBaseFolder = "mysite";
 - ecommerce/code/OrderConfirmationPage.php:424 		isset($project) ? $themeBaseFolder = $project : $themeBaseFolder = "mysite";
unchanged:	ecommerce/code/control/EcommercePaymentController.php
Warnings for ecommerce/code/control/EcommercePaymentController.php:
 - ecommerce/code/control/EcommercePaymentController.php:55 		isset($project) ? $themeBaseFolder = $project : $themeBaseFolder = "mysite";
unchanged:	ecommerce/code/control/ShoppingCart_Controller.php
Warnings for ecommerce/code/control/ShoppingCart_Controller.php:
 - ecommerce/code/control/ShoppingCart_Controller.php:673 	 * Log in as an administrator and visit mysite/shoppingcart/debug
unchanged:	ecommerce/code/model/config/EcommerceDBConfig.php
Warnings for ecommerce/code/model/config/EcommerceDBConfig.php:
 - ecommerce/code/model/config/EcommerceDBConfig.php:296 			"ReceiptEmail" => _t("EcommerceDBConfig.RECEIPTEMAIL_DESCRIPTION_DESCRIPTION", "e.g. sales@mysite.com, you can also use something like: \"Our Shop Name Goes Here\" &lt;sales@mysite.com&gt;"),
unchanged:	ecommerce/code/model/OrderAttribute.php
Warnings for ecommerce/code/model/OrderAttribute.php:
 - ecommerce/code/model/OrderAttribute.php:18 	 * what variables are accessible through  http://mysite.com/api/ecommerce/v1/ShippingAddress/
unchanged:	ecommerce/code/model/address/EcommerceRegion.php
Warnings for ecommerce/code/model/address/EcommerceRegion.php:
 - ecommerce/code/model/address/EcommerceRegion.php:19 	 * what variables are accessible through  http://mysite.com/api/ecommerce/v1/EcommerceRegion/
unchanged:	ecommerce/code/model/address/ShippingAddress.php
Warnings for ecommerce/code/model/address/ShippingAddress.php:
 - ecommerce/code/model/address/ShippingAddress.php:17 	 * what variables are accessible through  http://mysite.com/api/ecommerce/v1/ShippingAddress/
unchanged:	ecommerce/code/model/address/EcommerceCountry.php
Warnings for ecommerce/code/model/address/EcommerceCountry.php:
 - ecommerce/code/model/address/EcommerceCountry.php:19 	 * what variables are accessible through  http://mysite.com/api/ecommerce/v1/EcommerceCountry/
unchanged:	ecommerce/code/model/address/BillingAddress.php
Warnings for ecommerce/code/model/address/BillingAddress.php:
 - ecommerce/code/model/address/BillingAddress.php:17 	 * what variables are accessible through  http://mysite.com/api/ecommerce/v1/BillingAddress/
unchanged:	ecommerce/code/model/OrderItem.php
Warnings for ecommerce/code/model/OrderItem.php:
 - ecommerce/code/model/OrderItem.php:17 	 * what variables are accessible through  http://mysite.com/api/ecommerce/v1/OrderItem/
unchanged:	ecommerce/code/model/OrderModifier.php
Warnings for ecommerce/code/model/OrderModifier.php:
 - ecommerce/code/model/OrderModifier.php:35 	 * what variables are accessible through  http://mysite.com/api/ecommerce/v1/OrderModifier/
unchanged:	ecommerce/code/money/EcommercePaymentSupportedMethodsProvider.php
Warnings for ecommerce/code/money/EcommercePaymentSupportedMethodsProvider.php:
 - ecommerce/code/money/EcommercePaymentSupportedMethodsProvider.php:7  * mysite/_config/config.yml:
unchanged:	ecommerce/README.md
Warnings for ecommerce/README.md:
 - ecommerce/README.md:40 DEFINE('_SECURE_URL', "https://www.mysite.co.nz");
 - ecommerce/README.md:41 DEFINE('_STANDARD_URL', "http://www.mysite.co.nz");
unchanged:	ecommerce/docs/api/xml/index.xml
Warnings for ecommerce/docs/api/xml/index.xml:
 - ecommerce/docs/api/xml/index.xml:66     <class name="EcommercePaymentSupportedMethodsProvider" src="code/money/EcommercePaymentSupportedMethodsProvider.php" description="if you want to implement rules around selecting specific payment gateways for specific orders then you need to extend this class and add the following to mysite/_config/config.yml: &lt;code yml&gt;  Injector:    EcommercePaymentSupportedMethodsProvider:      class: MyCustom_EcommercePaymentSupportedMethodsProvider &lt;/code&gt;" xml="classes/EcommercePaymentSupportedMethodsProvider.xml"/>
 - ecommerce/docs/api/xml/index.xml:118     <class name="EcommerceDevelopmentAdminDecorator" src="code/cms/dev/EcommerceDevelopmentAdminDecorator.php" description="EcommerceDevelopmentAdminDecorator adds extra functionality to the DevelopmentAdmin It creates a developer view (as in www.mysite.com/dev/) specifically for ecommerce." xml="classes/EcommerceDevelopmentAdminDecorator.xml"/>
unchanged:	ecommerce/docs/api/xml/classes/OrderItem.xml
Warnings for ecommerce/docs/api/xml/classes/OrderItem.xml:
 - ecommerce/docs/api/xml/classes/OrderItem.xml:15       <description compact="what variables are accessible through  http://mysite.com/api/ecommerce/v1/OrderItem/"/>
unchanged:	ecommerce/docs/api/xml/classes/EcommerceDatabaseAdmin.xml
Warnings for ecommerce/docs/api/xml/classes/EcommerceDatabaseAdmin.xml:
 - ecommerce/docs/api/xml/classes/EcommerceDatabaseAdmin.xml:13 ##################### in mysite/code/tasks/MyMigration.php
 - ecommerce/docs/api/xml/classes/EcommerceDatabaseAdmin.xml:47 ##################### in mysite/_config.php:
unchanged:	ecommerce/docs/api/xml/classes/EcommerceRegion.xml
Warnings for ecommerce/docs/api/xml/classes/EcommerceRegion.xml:
 - ecommerce/docs/api/xml/classes/EcommerceRegion.xml:16       <description compact="what variables are accessible through  http://mysite.com/api/ecommerce/v1/EcommerceRegion/"/>
unchanged:	ecommerce/docs/api/xml/classes/EcommerceConfig.xml
Warnings for ecommerce/docs/api/xml/classes/EcommerceConfig.xml:
 - ecommerce/docs/api/xml/classes/EcommerceConfig.xml:9 1. Copy ecommerce/_config/ecommerce.yml and move it your project folder, e.g. mysite/_config/ecommerce.yml
 - ecommerce/docs/api/xml/classes/EcommerceConfig.xml:19     - "mysite/_config/ecommerce.yml"
unchanged:	ecommerce/docs/api/xml/classes/ShoppingCart_Controller.xml
Warnings for ecommerce/docs/api/xml/classes/ShoppingCart_Controller.xml:
 - ecommerce/docs/api/xml/classes/ShoppingCart_Controller.xml:601       <description compact="Handy debugging action visit.">Log in as an administrator and visit mysite/shoppingcart/debug</description>
unchanged:	ecommerce/docs/api/xml/classes/BillingAddress.xml
Warnings for ecommerce/docs/api/xml/classes/BillingAddress.xml:
 - ecommerce/docs/api/xml/classes/BillingAddress.xml:15       <description compact="what variables are accessible through  http://mysite.com/api/ecommerce/v1/BillingAddress/"/>
unchanged:	ecommerce/docs/api/xml/classes/EcommerceTaskCreateMemberGroups.xml
Warnings for ecommerce/docs/api/xml/classes/EcommerceTaskCreateMemberGroups.xml:
 - ecommerce/docs/api/xml/classes/EcommerceTaskCreateMemberGroups.xml:39       <param description="| String $member Default Member added to the group (e.g. sales@mysite.co.nz). You can also provide an email address" type="object">
unchanged:	ecommerce/docs/api/xml/classes/ShippingAddress.xml
Warnings for ecommerce/docs/api/xml/classes/ShippingAddress.xml:
 - ecommerce/docs/api/xml/classes/ShippingAddress.xml:15       <description compact="what variables are accessible through  http://mysite.com/api/ecommerce/v1/ShippingAddress/"/>
unchanged:	ecommerce/docs/api/xml/classes/EcommerceDevelopmentAdminDecorator.xml
Warnings for ecommerce/docs/api/xml/classes/EcommerceDevelopmentAdminDecorator.xml:
 - ecommerce/docs/api/xml/classes/EcommerceDevelopmentAdminDecorator.xml:5     <description compact="EcommerceDevelopmentAdminDecorator adds extra functionality to the DevelopmentAdmin It creates a developer view (as in www.mysite.com/dev/) specifically for ecommerce."/>
unchanged:	ecommerce/docs/api/xml/classes/EcommerceCountry.xml
Warnings for ecommerce/docs/api/xml/classes/EcommerceCountry.xml:
 - ecommerce/docs/api/xml/classes/EcommerceCountry.xml:16       <description compact="what variables are accessible through  http://mysite.com/api/ecommerce/v1/EcommerceCountry/"/>
unchanged:	ecommerce/docs/api/xml/classes/OrderAttribute.xml
Warnings for ecommerce/docs/api/xml/classes/OrderAttribute.xml:
 - ecommerce/docs/api/xml/classes/OrderAttribute.xml:18       <description compact="what variables are accessible through  http://mysite.com/api/ecommerce/v1/ShippingAddress/"/>
unchanged:	ecommerce/docs/api/xml/classes/OrderModifier.xml
Warnings for ecommerce/docs/api/xml/classes/OrderModifier.xml:
 - ecommerce/docs/api/xml/classes/OrderModifier.xml:18       <description compact="what variables are accessible through  http://mysite.com/api/ecommerce/v1/OrderModifier/"/>
unchanged:	ecommerce/docs/api/xml/classes/EcommercePaymentSupportedMethodsProvider.xml
Warnings for ecommerce/docs/api/xml/classes/EcommercePaymentSupportedMethodsProvider.xml:
 - ecommerce/docs/api/xml/classes/EcommercePaymentSupportedMethodsProvider.xml:5     <description compact="if you want to implement rules around selecting specific payment gateways for specific orders then you need to extend this class and add the following to mysite/_config/config.yml: &lt;code yml&gt;  Injector:    EcommercePaymentSupportedMethodsProvider:      class: MyCustom_EcommercePaymentSupportedMethodsProvider &lt;/code&gt;">in PHP you will have something like this:
unchanged:	ecommerce/docs/api/classes.xhtml
Warnings for ecommerce/docs/api/classes.xhtml:
 - ecommerce/docs/api/classes.xhtml:265               <td>EcommerceDevelopmentAdminDecorator adds extra functionality to the DevelopmentAdmin It creates a developer view (as in www.mysite.com/dev/) specifically for ecommerce.</td>
 - ecommerce/docs/api/classes.xhtml:306               <td>if you want to implement rules around selecting specific payment gateways for specific orders then you need to extend this class and add the following to mysite/_config/config.yml: &lt;code yml&gt;  Injector:    EcommercePaymentSupportedMethodsProvider:      class: MyCustom_EcommercePaymentSupportedMethodsProvider &lt;/code&gt;</td>
unchanged:	ecommerce/docs/api/classes/EcommerceRegion.xhtml
Warnings for ecommerce/docs/api/classes/EcommerceRegion.xhtml:
 - ecommerce/docs/api/classes/EcommerceRegion.xhtml:128                 array<br/><span class="indent">what variables are accessible through  http://mysite.com/api/ecommerce/v1/EcommerceRegion/</span></li>
unchanged:	ecommerce/docs/api/classes/OrderModifier.xhtml
Warnings for ecommerce/docs/api/classes/OrderModifier.xhtml:
 - ecommerce/docs/api/classes/OrderModifier.xhtml:184                 array<br/><span class="indent">what variables are accessible through  http://mysite.com/api/ecommerce/v1/OrderModifier/</span></li>
unchanged:	ecommerce/docs/api/classes/EcommerceDevelopmentAdminDecorator.xhtml
Warnings for ecommerce/docs/api/classes/EcommerceDevelopmentAdminDecorator.xhtml:
 - ecommerce/docs/api/classes/EcommerceDevelopmentAdminDecorator.xhtml:65         <h4>EcommerceDevelopmentAdminDecorator adds extra functionality to the DevelopmentAdmin It creates a developer view (as in www.mysite.com/dev/) specifically for ecommerce.</h4>
unchanged:	ecommerce/docs/api/classes/EcommerceCountry.xhtml
Warnings for ecommerce/docs/api/classes/EcommerceCountry.xhtml:
 - ecommerce/docs/api/classes/EcommerceCountry.xhtml:164                 array<br/><span class="indent">what variables are accessible through  http://mysite.com/api/ecommerce/v1/EcommerceCountry/</span></li>
unchanged:	ecommerce/docs/api/classes/EcommercePaymentSupportedMethodsProvider.xhtml
Warnings for ecommerce/docs/api/classes/EcommercePaymentSupportedMethodsProvider.xhtml:
 - ecommerce/docs/api/classes/EcommercePaymentSupportedMethodsProvider.xhtml:62         <h4>if you want to implement rules around selecting specific payment gateways for specific orders then you need to extend this class and add the following to mysite/_config/config.yml: &lt;code yml&gt;  Injector:    EcommercePaymentSupportedMethodsProvider:      class: MyCustom_EcommercePaymentSupportedMethodsProvider &lt;/code&gt;</h4>
unchanged:	ecommerce/docs/api/classes/OrderAttribute.xhtml
Warnings for ecommerce/docs/api/classes/OrderAttribute.xhtml:
 - ecommerce/docs/api/classes/OrderAttribute.xhtml:151                 array<br/><span class="indent">what variables are accessible through  http://mysite.com/api/ecommerce/v1/ShippingAddress/</span></li>
unchanged:	ecommerce/docs/api/classes/ShoppingCart_Controller/debug.xhtml
Warnings for ecommerce/docs/api/classes/ShoppingCart_Controller/debug.xhtml:
 - ecommerce/docs/api/classes/ShoppingCart_Controller/debug.xhtml:63         <p>Log in as an administrator and visit mysite/shoppingcart/debug</p>
unchanged:	ecommerce/docs/api/classes/EcommerceDatabaseAdmin.xhtml
Warnings for ecommerce/docs/api/classes/EcommerceDatabaseAdmin.xhtml:
 - ecommerce/docs/api/classes/EcommerceDatabaseAdmin.xhtml:69         <p>You can customise this menu by "decorating" this class<br/>and adding the method: "updateEcommerceDevMenu".<br/><br/>Here is an example:<br/><br/>ode php&gt;<br/>php<br/><br/>##################### in mysite/code/tasks/MyMigration.php<br/><br/>ass MyMigration extends BuildTask {<br/><br/>otected $title = "Mysite Database Fixes";<br/><br/>otected $description = "General DB fixes";<br/><br/>nction run(SS_HTTPRequest $request) {<br/>::query("TRUNCATE TABLE MyUselessTable;");<br/><br/><br/><br/><br/>ass MyMigration_EXT extends Extension {<br/><br/>ivate static $allowed_actions = array(<br/>ymigration" =&gt; true<br/><br/><br/>NOTE THAT updateEcommerceDevMenuConfig adds to Config options<br/>but you can als have: updateEcommerceDevMenuDebugActions, or updateEcommerceDevMenuMaintenanceActions<br/>nction updateEcommerceDevMenuConfig($buildTasks){<br/>uildTasks[] = "mymigration";<br/>turn $buildTasks;<br/><br/><br/>nction mymigration(SS_HTTPRequest $request){<br/>his-&gt;owner-&gt;runTask("MyMigration", $request);<br/><br/><br/><br/><br/><br/>##################### in mysite/_config.php:<br/><br/>ject::add_extension("EcommerceDatabaseAdmin", "MyMigration_EXT");<br/><br/><br/>code&gt;<br/><br/><br/>SECTIONS<br/><br/>0. check settings<br/>1. ecommerce setup (default records)<br/>2. data review<br/>3. regular maintance<br/>4. debug<br/>5. migration<br/>6. reset<br/>7. tests</p>
unchanged:	ecommerce/docs/api/classes/BillingAddress.xhtml
Warnings for ecommerce/docs/api/classes/BillingAddress.xhtml:
 - ecommerce/docs/api/classes/BillingAddress.xhtml:165                 array<br/><span class="indent">what variables are accessible through  http://mysite.com/api/ecommerce/v1/BillingAddress/</span></li>
unchanged:	ecommerce/docs/api/classes/OrderItem.xhtml
Warnings for ecommerce/docs/api/classes/OrderItem.xhtml:
 - ecommerce/docs/api/classes/OrderItem.xhtml:204                 array<br/><span class="indent">what variables are accessible through  http://mysite.com/api/ecommerce/v1/OrderItem/</span></li>
unchanged:	ecommerce/docs/api/classes/ShippingAddress.xhtml
Warnings for ecommerce/docs/api/classes/ShippingAddress.xhtml:
 - ecommerce/docs/api/classes/ShippingAddress.xhtml:165                 array<br/><span class="indent">what variables are accessible through  http://mysite.com/api/ecommerce/v1/ShippingAddress/</span></li>
unchanged:	ecommerce/docs/en/CustomisationChart.yaml
Warnings for ecommerce/docs/en/CustomisationChart.yaml:
 - ecommerce/docs/en/CustomisationChart.yaml:3     - Go to http://www.mysite.com/admin/shop/ and check settings.
 - ecommerce/docs/en/CustomisationChart.yaml:16   Create and update mysite/_config/ecommerce.yml:
 - ecommerce/docs/en/CustomisationChart.yaml:17     - Go to http://www.mysite.com/dev/ecommerce/ecommercetaskcheckconfiguration and carefully review options.
 - ecommerce/docs/en/CustomisationChart.yaml:19     - Update mysite/_config/ecommerce.yml with the required settings.  Bear in mind, that by default, arrays settings are added to any existing array elements.  To replace an array outright, use Config::inst()->update("MyClassName", "my_variable_as_array", $newArray);.
 - ecommerce/docs/en/CustomisationChart.yaml:48     - Make sure to add the modifier in the mysite/_config/ecommerce.yml file in the Order.modifiers variable.
 - ecommerce/docs/en/CustomisationChart.yaml:49     - If your OrderModifier includes any options (e.g. see /ecommerce_tax/code/model/GSTTaxModifierOptions.php) then add to StoreAdmin (using /mysite/_config/ecommerce.yml)
 - ecommerce/docs/en/CustomisationChart.yaml:68     - Add MyOrderStatusLog to /mysite/_config/ecommerce.yml file in the OrderStatusLog.available_log_classes_array variable.
 - ecommerce/docs/en/CustomisationChart.yaml:75     - Add MyOrderStep to /mysite/_config/ecommerce.yml file in the OrderStep.order_steps_to_include variable.
 - ecommerce/docs/en/CustomisationChart.yaml:79     - "The easiest way to change an email is to adjust the css. The location for the CSS is specified in the config file (see - http://www.mysite.com/dev/ecommerce/ecommercecheckconfiguration to see where the config file lives). The setting is: Order_Email.css_file_location. The file specified here is automatically included inline, using the emogrifier extension."
 - ecommerce/docs/en/CustomisationChart.yaml:87     - There are plenty of Payment Class examples out there... Create your own class and add a reference to it in your /mysite/_config/config.yml file.
 - ecommerce/docs/en/CustomisationChart.yaml:100     - Create your custom class and add the following to your mysite/_config.php file - Object::useCustomClass('CoreClass','MyClass'); .
 - ecommerce/docs/en/CustomisationChart.yaml:102     - In some cases, the designated core class can be selected in the /mysite/_config/ecommerce.yml.
unchanged:	README.md
Warnings for README.md:
 - README.md:51 `mysite/_config` folder (where available - otherwise search for `private static $` in the module to see what can be configured)
✔✔✔