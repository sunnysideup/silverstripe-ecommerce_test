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

class CreateTags extends SetUpBase
{

    public function run()
    {
        // $products = Product::get()
        //     ->where("ClassName = 'Product'")
        //     ->sort("Rand()")
        //     ->limit(4);
        // $this->addExamplePages(1, "Product Tags", $products);
        // foreach ($products as $pos => $product) {
        //     $idArray[$pos] = $product->ID;
        //     $titleArray[] = $product->MenuTitle;
        //     $this->addToTitle($product, "with tag", true);
        // }
        // $page = Page::get()
        //     ->where("\"URLSegment\" = 'tag-explanation'")
        //     ->First();
        // $t1 = new EcommerceProductTag();
        // $t1->Title = "TAG 1";
        // $t1->ExplanationPageID = $page->ID;
        // $t1->Explanation = "explains Tag 1";
        // $t1->write();
        // $existingProducts = $t1->Products();
        // $existingProducts->addMany(array($idArray[0], $idArray[1]));
        // DB::alteration_message("Creating tag: ".$t1->Title." for ".implode(",", $titleArray), "created");
        // $t2 = new EcommerceProductTag();
        // $t2->Title = "TAG 2";
        // $t2->ExplanationPageID = $page->ID;
        // $t2->Explanation = "explains Tag 2";
        // $t2->write();
        // $existingProducts = $t2->Products();
        // $existingProducts->addMany(array($idArray[2], $idArray[3]));
        // DB::alteration_message("Creating tag: ".$t2->Title." for ".implode(",", $titleArray), "created");
        // $productGroupWithTags = ProductGroupWithTags::get()
        //     ->First();
        // $existingTags = $productGroupWithTags->EcommerceProductTags();
        // $existingTags->addMany(array($t1->ID, $t2->ID));
    }
}
