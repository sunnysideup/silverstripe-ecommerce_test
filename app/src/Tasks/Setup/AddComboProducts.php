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

class AddComboProducts extends SetUpBase
{
    public function run()
    {
        // $pages = new ArrayList();
        // $productGroups = ProductGroup::get()
        //     ->where("ParentID > 0")
        //     ->Sort("\"Sort\" DESC")
        //     ->limit(3);
        // foreach ($productGroups as $productGroup) {
        //     $i = rand(1, 500);
        //     $imageID = $this->getRandomImageID();
        //     DB::query("Update \"File\" SET \"ClassName\" = 'Product_Image' WHERE ID = ".$imageID);
        //     $numberSold = $i;
        //     $fields = array(
        //         "ClassName" => "CombinationProduct",
        //         "ImageID" => $imageID,
        //         "URLSegment" => "combo-product-$i",
        //         "Title" => "Combination Product $i",
        //         "MenuTitle" => "Combi Product $i",
        //         "ParentID" => $productGroup->ID,
        //         "Content" => "<p>
        //             This is a combination Product.
        //             Aenean tincidunt nisl id ante pretium quis ornare libero varius. Nam cursus, mi quis dignissim laoreet, mauris turpis molestie ligula, et luctus urna nibh et ligula. Morbi in arcu ante, sit amet fermentum lacus. Cras elit lacus, feugiat sit amet faucibus quis, condimentum a leo. Donec molestie lacinia nisl a ullamcorper.
        //             For testing purposes - the following characteristics were added to this product:
        //         <p>
        //         <ul>
        //             <li>featured: <i>YES</i></li>
        //             <li>allow purchase: <i>YES</i></li>
        //             <li>number sold: <i>".$numberSold."</i></li>
        //         </ul>",
        //         "InternalItemID" => "combo".$i,
        //         "FeaturedProduct" => 1,
        //         "AllowPurchase" => 1,
        //         "NumberSold" => $numberSold,
        //         "NewPrice" => 10
        //     );
        //     $this->MakePage($fields);
        //     $page = CombinationProduct::get()
        //         ->where("ParentID = ".$productGroup->ID)
        //         ->First();
        //     $includedProducts = $page->IncludedProducts();
        //     $products = Product::get()
        //         ->where("\"AllowPurchase\" = 1")
        //         ->limit(3);
        //     foreach ($products as $product) {
        //         $includedProducts->add($product);
        //     }
        //     $page->write();
        //     $page->Publish('Stage', 'Live');
        //     $pages->push($page);
        // }
        // $this->addExamplePages(1, "Combination Products", $pages);
    }

}
