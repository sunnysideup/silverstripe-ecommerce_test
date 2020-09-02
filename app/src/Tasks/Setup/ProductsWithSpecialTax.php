<?php

namespace Sunnysideup\EcommerceTest\Tasks\Setup;

use Sunnysideup\Ecommerce\Pages\Product;




// use ProductAttributeType;
// use ProductAttributeValue;
// use ProductVariation;

// use CombinationProduct;
// use EcommerceProductTag;
// use ProductGroupWithTags;



// use ComplexPriceObject;


use Sunnysideup\EcommerceTax\Model\GSTTaxModifierOptions;
use Sunnysideup\EcommerceTest\Tasks\SetUpBase;

class ProductsWithSpecialTax extends SetUpBase
{
    public function run()
    {
        $products = Product::get()
            ->where("\"ClassName\" = '" . addslashes(Product::class) . "'")
            ->sort('RAND()')
            ->limit(2);
        $taxToAdd = GSTTaxModifierOptions::get()
            ->where("\"Code\" = 'ADD'")
            ->First();
        if ($taxToAdd && $products->count()) {
            foreach ($products as $product) {
                $additionalTax = $product->AdditionalTax();
                $additionalTax->addMany([$taxToAdd->ID]);
            }
            $this->addExamplePages(2, 'product with additional taxes (add to cart to see this feature in action)', $products);
        }
        /*
        $products = AnyPriceProductPage::get();
        $allStandardTaxes = GSTTaxModifierOptions::get()
            ->where("\"DoesNotApplyToAllProducts\" = 0");
        if($allStandardTaxes && $products->count()) {
            foreach($products as $product) {
                $excludedTax = $product->ExcludedFrom();
                foreach($allStandardTaxes as $taxToExclude) {
                    $excludedTax->addMany(array($taxToExclude->ID));
                }
            }
            $this->addExamplePages(2, "product without taxes (add to cart to see this feature in action)", $products);
        }
        */
    }
}
