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