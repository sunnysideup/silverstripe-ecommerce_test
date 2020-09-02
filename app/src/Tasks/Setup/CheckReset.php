<?php

namespace Sunnysideup\EcommerceTest\Tasks\Setup;

use Sunnysideup\Ecommerce\Pages\Product;




// use ProductAttributeType;
// use ProductAttributeValue;
// use ProductVariation;

// use CombinationProduct;
// use EcommerceProductTag;
// use ProductGroupWithTags;



// use ComplexPriceObject;


use Sunnysideup\EcommerceTest\Tasks\SetUpBase;

class CheckReset extends SetUpBase
{
    public function run()
    {
        if (Product::get()->Count()) {
            echo '<script type="text/javascript">window.location = "/dev/tasks/setup-ecommerce-records-step-1/";</script>';
            die('data has not been reset yet... <a href="/dev/tasks/setup-ecommerce-records-step-1/">reset data now....</a>');
        }
    }
}
