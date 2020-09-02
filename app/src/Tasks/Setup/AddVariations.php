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

class AddVariations extends SetUpBase
{
    public function run()
    {
        // $colourObject = ProductAttributeType::get()
        //     ->where("\"Name\" = 'Colour'")
        //     ->First();
        // if (!$colourObject) {
        //     $colourObject = new ProductAttributeType();
        //     $colourObject->Name = "Colour";
        //     $colourObject->Label = "Colour";
        //     $colourObject->IsColour = true;
        //     $colourObject->Sort = 100;
        //     $colourObject->write();
        // }
        // if ($colourObject) {
        //     $redObject = ProductAttributeValue::get()
        //         ->where("\"Value\" = 'red'")
        //         ->First();
        //     if (!$redObject) {
        //         $redObject = new ProductAttributeValue();
        //         $redObject->Value = "red";
        //         $redObject->RGBCode = "ff0000";
        //         $redObject->ContrastRGBCode = "BFC1C1";
        //         $redObject->TypeID = $colourObject->ID;
        //         $redObject->Sort = 100;
        //         $redObject->write();
        //     }
        //     $blueObject = ProductAttributeValue::get()
        //         ->where("\"Value\" = 'blue'")
        //         ->First();
        //     if (!$blueObject) {
        //         $blueObject = new ProductAttributeValue();
        //         $blueObject->Value = "blue";
        //         $blueObject->RGBCode = "0000ff";
        //         $blueObject->ContrastRGBCode = "BFC1C1";
        //         $blueObject->TypeID = $colourObject->ID;
        //         $blueObject->Sort = 110;
        //         $blueObject->write();
        //     }
        // } else {
        //     die("COULD NOT CREATE COLOUR OBJECT");
        // }
        // $sizeObject = ProductAttributeType::get()
        //     ->filter("Name", 'Size')
        //     ->First();
        // ;
        // if (!$sizeObject) {
        //     $sizeObject = new ProductAttributeType();
        //     $sizeObject->Name = "Size";
        //     $sizeObject->Label = "Size";
        //     $sizeObject->Sort = 110;
        //     $sizeObject->write();
        // }
        // if ($sizeObject) {
        //     $smallObject = ProductAttributeValue::get()
        //         ->where("\"Value\" = 'S'")
        //         ->First();
        //     if (!$smallObject) {
        //         $smallObject = new ProductAttributeValue();
        //         $smallObject->Value = "S";
        //         $smallObject->TypeID = $sizeObject->ID;
        //         $smallObject->Sort = 100;
        //         $smallObject->write();
        //     }
        //     $xtraLargeObject = ProductAttributeValue::get()
        //         ->where("\"Value\" = 'XL'")
        //         ->First();
        //     if (!$xtraLargeObject) {
        //         $xtraLargeObject = new ProductAttributeValue();
        //         $xtraLargeObject->Value = "XL";
        //         $xtraLargeObject->TypeID = $sizeObject->ID;
        //         $xtraLargeObject->Sort = 110;
        //         $xtraLargeObject->write();
        //     }
        // } else {
        //     die("COULD NOT CREATE SIZE OBJECT");
        // }
        // $products = Product::get()
        //     ->where("ClassName = 'Product'")
        //     ->sort("RAND()")
        //     ->limit(2);
        // $this->addExamplePages(1, "products with variations (size, colour, etc...)", $products);
        // if ($products->count() && $colourObject && $sizeObject) {
        //     $variationCombos = array(
        //         array("Size" => $xtraLargeObject, "Colour" => $redObject),
        //         array("Size" => $xtraLargeObject, "Colour" => $blueObject),
        //         array("Size" => $smallObject, "Colour" => $redObject),
        //         array("Size" => $smallObject, "Colour" => $blueObject)
        //     );
        //     foreach ($products as $product) {
        //         $existingAttributeTypes = $product->VariationAttributes();
        //         $existingAttributeTypes->add($sizeObject);
        //         $existingAttributeTypes->add($colourObject);
        //         $this->addToTitle($product, "with variation", false);
        //         $product->Content .= "<p>On this page you can see two example of how you customers can add variations to their products (form / table)... In a real-life shop you would probably choose one or the other.</p>";
        //         $product->write();
        //         $product->Publish('Stage', 'Live');
        //         $product->flushCache();
        //         $descriptionOptions = array("", "Per Month", "", "", "Per Year", "This option has limited warranty");
        //         if (!
        //             ProductVariation::get()
        //             ->where("ProductID  = ".$product->ID)
        //             ->count()
        //         ) {
        //             foreach ($variationCombos as $variationCombo) {
        //                 $productVariation = new ProductVariation();
        //                 $productVariation->ProductID = $product->ID;
        //                 $productVariation->Price = $product->Price * 2;
        //                 $productVariation->Description = $descriptionOptions[rand(0, 5)];
        //                 $productVariation->ImageID = rand(0, 1) ? 0 : $this->getRandomImageID();
        //                 $productVariation->write();
        //                 $existingAttributeValues = $productVariation->AttributeValues();
        //                 $existingAttributeValues->add($variationCombo["Size"]);
        //                 $existingAttributeValues->add($variationCombo["Colour"]);
        //                 DB::alteration_message(" Creating variation for ".$product->Title . " // COLOUR ".$variationCombo["Colour"]->Value. " SIZE ".$variationCombo["Size"]->Value, "created");
        //             }
        //         }
        //     }
        // }
    }
}
