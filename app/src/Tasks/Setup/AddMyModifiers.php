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

class AddMyModifiers extends SetUpBase
{
    public function run()
    {
        if (! PickUpOrDeliveryModifierOptions::get()
            ->where("Code = 'pickup'")
            ->First()
        ) {
            $obj = new PickUpOrDeliveryModifierOptions();
            $obj->IsDefault = 1;
            $obj->Code = 'pickup';
            $obj->Name = 'pickup from Store';
            $obj->MinimumDeliveryCharge = 0;
            $obj->MaximumDeliveryCharge = 0;
            $obj->MinimumOrderAmountForZeroRate = 0;
            $obj->WeightMultiplier = 0;
            $obj->WeightUnit = 0;
            $obj->Percentage = 0;
            $obj->FixedCost = 0;
            $obj->Sort = 0;
            $obj->write();
        }
        $obj = null;
        if (! PickUpOrDeliveryModifierOptions::get()
            ->where("Code = 'delivery'")
            ->First()
        ) {
            $obj = new PickUpOrDeliveryModifierOptions();
            $obj->IsDefault = 0;
            $obj->Code = 'delivery';
            $obj->Name = 'delivery via Courier Bob';
            $obj->MinimumDeliveryCharge = 0;
            $obj->MaximumDeliveryCharge = 0;
            $obj->MinimumOrderAmountForZeroRate = 0;
            $obj->WeightMultiplier = 0;
            $obj->WeightUnit = 0;
            $obj->Percentage = 0;
            $obj->FixedCost = 13;
            $obj->Sort = 100;
            $obj->write();
        }
        $obj = null;
        if (! PickUpOrDeliveryModifierOptions::get()
            ->where("Code = 'personal'")
            ->First()
        ) {
            $obj = new PickUpOrDeliveryModifierOptions();
            $obj->IsDefault = 1;
            $obj->Code = 'personal';
            $obj->Name = 'personal delivery';
            $obj->MinimumDeliveryCharge = 0;
            $obj->MaximumDeliveryCharge = 0;
            $obj->MinimumOrderAmountForZeroRate = 0;
            $obj->WeightMultiplier = 0;
            $obj->WeightUnit = 0;
            $obj->Percentage = 0.1;
            $obj->FixedCost = 0;
            $obj->Sort = 0;
            $obj->write();
        }
        $obj = null;
        if (! GSTTaxModifierOptions::get()
            ->where("Code = 'GST'")
            ->First()
        ) {
            $obj = new GSTTaxModifierOptions();
            $obj->CountryCode = 'NZ';
            $obj->Code = 'GST';
            $obj->Name = 'Goods and Services Tax';
            $obj->InclusiveOrExclusive = 'Inclusive';
            $obj->Rate = 0.15;
            $obj->PriceSuffix = '';
            $obj->AppliesToAllCountries = false;
            $obj->write();
        }
        $obj = null;
        if (! GSTTaxModifierOptions::get()
            ->where("Code = 'ACT'")
            ->First()
        ) {
            $obj = new GSTTaxModifierOptions();
            $obj->CountryCode = 'AU';
            $obj->Code = 'ACT';
            $obj->Name = 'Australian Carbon Tax';
            $obj->InclusiveOrExclusive = 'Exclusive';
            $obj->Rate = 0.05;
            $obj->PriceSuffix = '';
            $obj->AppliesToAllCountries = false;
            $obj->write();
        }
        if (! GSTTaxModifierOptions::get()
            ->where("Code = 'ADD'")
            ->First()
        ) {
            $obj = new GSTTaxModifierOptions();
            $obj->CountryCode = '';
            $obj->Code = 'ADD';
            $obj->Name = 'Additional Tax';
            $obj->InclusiveOrExclusive = 'Inclusive';
            $obj->Rate = 0.65;
            $obj->PriceSuffix = '';
            $obj->DoesNotApplyToAllProducts = true;
            $obj->AppliesToAllCountries = true;
            $obj->write();
        }
        $obj = null;
        if (! DiscountCouponOption::get()
            ->where("\"Code\" = 'AAA'")
            ->First()
        ) {
            $obj = new DiscountCouponOption();
            $obj->Title = 'Example Coupon';
            $obj->Code = 'AAA';
            $obj->StartDate = date('Y-m-d', strtotime('Yesterday'));
            $obj->EndDate = date('Y-m-d', strtotime('Next Year'));
            $obj->DiscountAbsolute = 10;
            $obj->DiscountPercentage = 7.5;
            $obj->CanOnlyBeUsedOnce = false;
            $obj->write();
        }
    }
}
