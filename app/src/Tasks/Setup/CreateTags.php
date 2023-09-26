<?php

namespace Sunnysideup\EcommerceTest\Tasks\Setup;

use Page;
use SilverStripe\ORM\DB;
// use ProductAttributeType;
// use ProductAttributeValue;
// use ProductVariation;

// use CombinationProduct;
use Sunnysideup\Ecommerce\Pages\Product;
// use EcommerceProductTag;
// use ProductGroupWithTags;

// use ComplexPriceObject;

use Sunnysideup\EcommerceTest\Tasks\SetUpBase;

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
