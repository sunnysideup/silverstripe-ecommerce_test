<?php

namespace Sunnysideup\EcommerceTest\Tasks\Setup;

use Sunnysideup\EcommerceTest\Tasks\SetUpBase;

use Page;

use SilverStripe\Assets\Folder;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;


use SilverStripe\Control\Director;
use SilverStripe\Dev\BuildTask;
// use ProductAttributeType;
// use ProductAttributeValue;
// use ProductVariation;

use SilverStripe\ORM\ArrayList;
// use CombinationProduct;
use SilverStripe\ORM\DataList;
use SilverStripe\ORM\DB;
use SilverStripe\Security\Group;
// use EcommerceProductTag;
// use ProductGroupWithTags;

use SilverStripe\Security\Member;


// use ComplexPriceObject;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\Versioned\Versioned;
use Sunnysideup\Ecommerce\Model\Address\BillingAddress;
use Sunnysideup\Ecommerce\Model\Address\ShippingAddress;
use Sunnysideup\Ecommerce\Model\Config\EcommerceDBConfig;
use Sunnysideup\Ecommerce\Model\Extensions\EcommerceRole;
use Sunnysideup\Ecommerce\Model\Order;
use Sunnysideup\Ecommerce\Model\ProductOrderItem;


use Sunnysideup\Ecommerce\Pages\AccountPage;
use Sunnysideup\Ecommerce\Pages\CartPage;
use Sunnysideup\Ecommerce\Pages\CheckoutPage;
use Sunnysideup\Ecommerce\Pages\OrderConfirmationPage;
use Sunnysideup\Ecommerce\Pages\Product;
use Sunnysideup\Ecommerce\Pages\ProductGroup;
use Sunnysideup\Ecommerce\Pages\ProductGroupSearchPage;
use Sunnysideup\Ecommerce\Tasks\EcommerceTaskCreateMemberGroups;
use Sunnysideup\EcommerceDelivery\Model\PickUpOrDeliveryModifierOptions;
use Sunnysideup\EcommerceDiscountCoupon\Model\DiscountCouponOption;
use Sunnysideup\EcommerceTax\Model\GSTTaxModifierOptions;
use Sunnysideup\EcommerceTest\Model\CompleteSetupRecord;

class CompleteAll extends SetUpBase
{

    public function run()
    {

    }
}
