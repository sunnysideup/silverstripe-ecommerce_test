<?php

namespace Sunnysideup\EcommerceTest\Tasks\Setup;

use Sunnysideup\Ecommerce\Model\Config\EcommerceDBConfig;
// use ProductAttributeType;
// use ProductAttributeValue;
// use ProductVariation;

// use CombinationProduct;
// use EcommerceProductTag;
// use ProductGroupWithTags;

// use ComplexPriceObject;
use Sunnysideup\EcommerceTest\Tasks\SetupBase;

class RunEcommerceDefaults extends SetupBase
{
    public function run()
    {
        $request = true;
        $obj = new EcommerceDBConfig();
        $obj->Title = 'Test Configuration';
        $obj->UseThisOne = 1;
        $obj->write();
    }
}
