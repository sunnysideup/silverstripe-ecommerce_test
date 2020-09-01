<?php

namespace Sunnysideup\EcommerceTest\Tasks;

use SilverStripe\Control\Director;
use SilverStripe\Dev\BuildTask;
use SilverStripe\ORM\DB;
use SilverStripe\Security\Permission;
use SilverStripe\Security\Security;

class SetUpEcommerceRecordsStep1 extends BuildTask
{
    protected $title = 'Delete Database';

    protected $description = 'WARNING! RESETS ALL tables in the database by deleting them!';

    private static $segment = 'setup-ecommerce-records-step-1';

    public function run($request)
    {
        if (! Permission::check('ADMIN') && ! Director::isDev() && PHP_SAPI !== 'cli') {
            Security::permissionFailure($this, _t('Security.PERMFAILURE', ' This page is secured and you need administrator rights to access it. Enter your credentials below and we will send you right along.'));
        }
        $rows = DB::query('SHOW TABLES');
        foreach ($rows as $tableArray) {
            $table = array_shift($tableArray);
            DB::query('TRUNCATE TABLE "' . $table . '";');
            DB::alteration_message('deleting ' . $table, 'deleted');
        }
        echo '<hr /><hr /><hr /><hr /><hr /><a href="/dev/build">build database</a>
		<script type="text/javascript">window.location = "/dev/build/?returnURL=/dev/tasks/setup-ecommerce-records-step-2";</script>'
        ;
    }
}
