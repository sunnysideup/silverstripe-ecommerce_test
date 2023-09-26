<?php

namespace Sunnysideup\EcommerceTest\Tasks\Setup;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\ORM\DB;
// use ProductAttributeType;
// use ProductAttributeValue;
// use ProductVariation;

// use CombinationProduct;
use Sunnysideup\Ecommerce\Pages\Product;
// use EcommerceProductTag;
// use ProductGroupWithTags;

// use ComplexPriceObject;

use Sunnysideup\EcommerceTest\Tasks\SetupBase;

class CreateRecommendedProducts extends SetupBase
{
    public function run()
    {
        // $products = Product::get()
        //     ->where("ClassName = 'Product'")
        //     ->orderBy("RAND()")
        //     ->limit(2);
        // $this->addExamplePages(1, "Products with recommended <i>additions</i>.", $products);
        // foreach ($products as $product) {
        //     $idArrayProducts[] = $product->ID;
        //     $this->addToTitle($product, "with recommendations", true);
        // }
        // $recommendedProducts = Product::get()
        //     ->where(" SiteTree.ID NOT IN (".implode(",", $idArrayProducts).") AND ClassName = 'Product'")
        //     ->orderBy("RAND()")
        //     ->limit(3);
        // foreach ($recommendedProducts as $product) {
        //     $idArrayRecommendedProducts[] = $product->ID;
        // }
        // foreach ($products as $product) {
        //     $existingRecommendations = $product->EcommerceRecommendedProducts();
        //     $existingRecommendations->addMany($idArrayRecommendedProducts);
        //     DB::alteration_message("adding recommendations for: ".$product->Title." (".implode(",", $idArrayRecommendedProducts).")", "created");
        // }
    }
}
