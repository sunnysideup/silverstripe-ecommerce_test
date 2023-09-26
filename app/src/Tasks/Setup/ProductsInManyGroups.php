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

use Sunnysideup\Ecommerce\Pages\ProductGroup;
use Sunnysideup\EcommerceTest\Tasks\SetupBase;

class ProductsInManyGroups extends SetupBase
{
    public function run()
    {
        $products = Product::get()
            ->where("\"ClassName\" = '" . addslashes(Product::class) . "'")
            ->orderBy('RAND()')
            ->limit(2)
        ;
        $productGroups = ProductGroup::get()
            ->where("\"ClassName\" = '" . addslashes(ProductGroup::class) . "'")
            ->orderBy('RAND()')
            ->limit(3)
        ;
        foreach ($products as $product) {
            $groups = $product->ProductGroups();
            foreach ($productGroups as $productGroup) {
                $groups->add($productGroup);
            }
        }
        $this->addExamplePages(1, 'Product shown in more than one Product Group', $products);
    }
}
