<?php

namespace Sunnysideup\EcommerceTest\Tasks\Setup;

use SilverStripe\CMS\Model\SiteTree;


use SilverStripe\ORM\DB;


// use ProductAttributeType;
// use ProductAttributeValue;
// use ProductVariation;

// use CombinationProduct;
use SilverStripe\Versioned\Versioned;
// use EcommerceProductTag;
// use ProductGroupWithTags;



// use ComplexPriceObject;
use Sunnysideup\Ecommerce\Model\Order;
use Sunnysideup\Ecommerce\Pages\Product;


use Sunnysideup\EcommerceTest\Tasks\SetUpBase;

class AddStock extends SetUpBase
{
    public function run()
    {
        // $extension = "";
        // if (Versioned::get_stage() == "Live") {
        //     $extension = "_Live";
        // }
        // $products = Product::get()
        //     ->where("SiteTree{$extension}.ClassName = 'Product' AND ProductVariation.ID IS NULL")
        //     ->sort("RAND()")
        //     ->leftJoin("ProductVariation", "ProductVariation.ProductID = Product{$extension}.ID")
        //     ->limit(3);
        // $i = 0;
        // $idArray = [];
        // foreach ($products as $product) {
        //     $i++;
        //     $idArray[$product->ID] = $product->ID;
        //     if ($i == 1) {
        //         $this->addExamplePages(3, "Minimum quantity per order", $product);
        //         $product->MinQuantity = 12;
        //         $this->addToTitle($product, "minimum per order of 12", true);
        //         DB::alteration_message("adding minimum quantity for: ".$product->Title, "created");
        //     }
        //     if ($i == 2) {
        //         $this->addExamplePages(3, "Maxiumum quantity per order", $product);
        //         $product->MaxQuantity = 12;
        //         $this->addToTitle($product, "maximum per order of 12", true);
        //         DB::alteration_message("adding maximum quantity for: ".$product->Title, "created");
        //     }
        //     if ($i == 3) {
        //         $this->addExamplePages(3, "Limited stock product", $product);
        //         $product->setActualQuantity(1);
        //         $product->UnlimitedStock = 0;
        //         $this->addToTitle($product, "limited stock", true);
        //         DB::alteration_message("adding limited stock for: ".$product->Title, "created");
        //     }
        // }
        // $variations = ProductVariation::get()
        //     ->where("ClassName = 'ProductVariation'")
        //     ->sort("RAND()")
        //     ->limit(3);
        // $i = 0;
        // foreach ($variations as $variation) {
        //     $i++;
        //     if ($i == 1) {
        //         $variation->MaxQuantity = 12;
        //         $variation->Description = " - min quantity per order 12!";
        //         $variation->write();
        //         $variation->writeToStage("Stage");
        //         $this->addExamplePages(3, "Minimum quantity product variation (colour / size / etc... option)", $variation->Product());
        //         DB::alteration_message("adding limited quantity for: ".$variation->Title, "created");
        //     }
        //     if ($i == 2) {
        //         $variation->MaxQuantity = 12;
        //         $variation->Description = " - max quantity per order 12!";
        //         $variation->write();
        //         $variation->writeToStage("Stage");
        //         $this->addExamplePages(3, "Maximum quantity product variation (colour / size / etc... option)", $variation->Product());
        //         DB::alteration_message("adding limited quantity for: ".$variation->Title, "created");
        //     }
        //     if ($i == 3) {
        //         $variation->setActualQuantity(1);
        //         $variation->Description = " - limited stock!";
        //         $variation->UnlimitedStock = 0;
        //         $variation->write();
        //         $variation->writeToStage("Stage");
        //         $this->addExamplePages(3, "Limited stock for product variation (colour / size / etc... option)", $variation->Product());
        //         DB::alteration_message("adding limited quantity for: ".$variation->Title, "created");
        //     }
        // }
    }
}
