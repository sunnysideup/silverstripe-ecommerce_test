<?php

namespace Sunnysideup\EcommerceTest\Tasks\Setup;

use SilverStripe\Assets\Image;


use SilverStripe\ORM\ArrayList;


// use ProductAttributeType;
// use ProductAttributeValue;
// use ProductVariation;

use SilverStripe\ORM\DB;
// use CombinationProduct;
use Sunnysideup\Ecommerce\Pages\Product;
// use EcommerceProductTag;
// use ProductGroupWithTags;



// use ComplexPriceObject;


use Sunnysideup\Ecommerce\Pages\ProductGroup;
use Sunnysideup\EcommerceTest\Tasks\SetUpBase;

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
