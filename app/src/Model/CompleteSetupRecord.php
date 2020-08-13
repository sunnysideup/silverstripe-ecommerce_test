<?php

namespace Sunnysideup\EcommerceTest\Model;

use SilverStripe\ORM\DataObject;

class CompleteSetupRecord extends DataObject
{
    private static $table_name = 'CompleteSetupRecord';

    private static $db = [
        'CompletedSetup' => 'Boolean',
    ];
}
