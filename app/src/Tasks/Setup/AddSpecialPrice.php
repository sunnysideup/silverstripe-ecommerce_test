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

class AddSpecialPrice extends SetUpBase
{




    public function run()
    {
        // $task = new EcommerceTaskCreateMemberGroups();
        // $task->run(false);
        // $customerGroup = EcommerceRole::get_customer_group();
        // if (!$customerGroup) {
        //     die("could not create customer group");
        // }
        // $group = new Group();
        // $group->Title = "Discount Customers";
        // $group->Code = "discountcustomers";
        // $group->ParentID = $customerGroup->ID;
        // $group->write();
        // $member = new Member();
        // $member->FirstName = 'Bob';
        // $member->Surname = 'Jones';
        // $member->Email = 'bob@silverstripe-ecommerce.com';
        // $member->Password = 'thisIsTestPassword99';
        // $member->write();
        // $member->Groups()->add($group);
        // $products = Product::get()
        //     ->where("ClassName = 'Product'")
        //     ->sort("RAND()")
        //     ->limit(2);
        // $this->addExamplePages(4, "Special price for particular customers", $products);
        // $i = 0;
        // foreach ($products as $product) {
        //     $i++;
        //     $complexObjectPrice = new ComplexPriceObject();
        //     if ($i == 1) {
        //         $complexObjectPrice->Price = $product->Price - 1.5;
        //     } elseif ($i == 2) {
        //         $complexObjectPrice->Percentage = 10;
        //         $complexObjectPrice->Reduction = 2.5;
        //     } else {
        //         $complexObjectPrice->Price = $product->Price - 1.5;
        //         $complexObjectPrice->Percentage = 10;
        //         $complexObjectPrice->Reduction = 2.5;
        //     }
        //     $complexObjectPrice->From = date("Y-m-d h:n:s", strtotime("now"));
        //     $complexObjectPrice->Until = date("Y-m-d h:n:s", strtotime("next year"));
        //     $complexObjectPrice->ProductID = $product->ID;
        //     $complexObjectPrice->write();
        //     $complexObjectPrice->Groups()->add($group);
        //     $product->Content = "<p><a href=\"Security/login/?BackURL=".$product->Link()."\">Login</a> as bob@silverstripe-ecommerce.com, password: thisIsTestPassword99 to get a special price. You can then <a href=\"Security/logout/?BackURL=".$product->Link()."\">log out</a> again to see the original price.</p>";
        //     $this->addToTitle($product, "member price", true);
        // }
        // $variations = ProductVariation::get()
        //     ->where("ClassName = 'ProductVariation'")
        //     ->sort("RAND()")
        //     ->limit(2);
        // $i = 0;
        // foreach ($variations as $variation) {
        //     $i++;
        //     $complexObjectPrice = new ComplexPriceObject();
        //     if ($i == 1) {
        //         $complexObjectPrice->Price = $product->Price - 1.5;
        //     } elseif ($i == 2) {
        //         $complexObjectPrice->Percentage = 10;
        //         $complexObjectPrice->Reduction = 2.5;
        //     } else {
        //         $complexObjectPrice->Price = $product->Price - 1.5;
        //         $complexObjectPrice->Percentage = 10;
        //         $complexObjectPrice->Reduction = 2.5;
        //     }
        //     $complexObjectPrice->Price = $variation->Price - 1.5;
        //     $complexObjectPrice->From = date("Y-m-d h:n:s", strtotime("now"));
        //     $complexObjectPrice->Until = date("Y-m-d h:n:s", strtotime("next year"));
        //     $complexObjectPrice->ProductVariationID = $variation->ID;
        //     $complexObjectPrice->write();
        //     $complexObjectPrice->Groups()->add($group);
        //     $product = $variation->Product();
        //     $this->addExamplePages(4, "Special price for particular customers for product variations $i", $product);
        //     $product->Content = "<p><a href=\"Security/login/?BackURL=".$product->Link()."\">Login</a> as bob@jones.com, password: thisIsTestPassword99 to get a special price</p>";
        //     $this->addToTitle($product, "member price", true);
        // }
    }
}
