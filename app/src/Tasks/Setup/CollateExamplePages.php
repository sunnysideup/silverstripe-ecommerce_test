<?php

namespace Sunnysideup\EcommerceTest\Tasks\Setup;

use Page;
use Sunnysideup\Ecommerce\Model\Order;
// use ProductAttributeType;
// use ProductAttributeValue;
// use ProductVariation;

// use CombinationProduct;
// use EcommerceProductTag;
// use ProductGroupWithTags;

// use ComplexPriceObject;
use Sunnysideup\Ecommerce\Pages\AccountPage;
use Sunnysideup\Ecommerce\Pages\CartPage;
use Sunnysideup\Ecommerce\Pages\CheckoutPage;
use Sunnysideup\Ecommerce\Pages\OrderConfirmationPage;
use Sunnysideup\Ecommerce\Pages\Product;
use Sunnysideup\Ecommerce\Pages\ProductGroup;
use Sunnysideup\EcommerceTest\Tasks\SetUpBase;

class CollateExamplePages extends SetUpBase
{
    public function run()
    {
        $this->addExamplePages(0, 'Checkout page', CheckoutPage::get()->First());
        $this->addExamplePages(0, 'Order Confirmation page', OrderConfirmationPage::get()->First());
        $this->addExamplePages(0, 'Cart page (review cart without checkout)', CartPage::get()->where("ClassName = '" . addslashes(CartPage::class) . "'")->First());
        $this->addExamplePages(0, 'Account page', AccountPage::get()->First());
        //$this->addExamplePages(1, "Donation page", AnyPriceProductPage::get()->First());
        $this->addExamplePages(1, 'Products that can not be sold', Product::get()->where("\"AllowPurchase\" = 0 AND ClassName = '" . addslashes(Product::class) . "'")->First());
        $this->addExamplePages(1, 'Product group with short product display template', ProductGroup::get()->where("\"DisplayStyle\" = 'Short'")->First());
        $this->addExamplePages(1, 'Product group with medium length product display template', ProductGroup::get()->where("\"DisplayStyle\" = ''")->First());
        $this->addExamplePages(1, 'Product group with more detail product display template', ProductGroup::get()->where("\"DisplayStyle\" = 'MoreDetail'")->First());
        //$this->addExamplePages(1, "Quick Add page", AddToCartPage::get()->first());
        //$this->addExamplePages(1, "Shop by Tag page ", ProductGroupWithTags::get()->first());
        $this->addExamplePages(2, 'Delivery options (add product to cart first)', CheckoutPage::get()->First());
        $this->addExamplePages(2, 'Taxes (NZ based GST - add product to cart first)', CheckoutPage::get()->first());
        $this->addExamplePages(2, 'Discount Coupon (try <i>AAA</i>)', CheckoutPage::get()->First());
        $this->addExamplePages(4, 'Products with zero price', Product::get()->where("\"Price\" = 0 AND ClassName = '" . addslashes(Product::class) . "'")->First());
        //$this->addExamplePages(5, "Corporate Account Order page", AddUpProductsToOrderPage::get()->First());
        $html = '
        <h2>Some Interesting Features</h2>
        <p>
            Below are some features of this e-commerce application that may be of interest to you:
        </p>
        <ul>
            <li>customised search for users with search history graphs for admins</li>
            <li>ability to check-out with or without adding a password (creating an account)</li>
            <li>easy to use CMS</li>
            <li>very fast product listings, making extensive use of caching</li>
            <li>many ways to display products, allowing the content editor to set things like <i>products per page</i>, <i>product selctions</i>, <i>sorting orders</i></li>
            <li>multi-currency options and currency conversions</li>
            <li>step-by-step system for completed orders leading them from being submitted to archived via very steps.  This allows the admin to review orders where needed, add extra information, such as tracking codes for delivery, etc...</li>
            <li>code that is very easy to customise and adjust for your needs</li>
            <li>a ton of additional modules are available - you can add them directly to your e-commece install or use these as examples for building your own extensions </li>
            <li>geo-coding for addresses</li>
            <li>extensive developer assistance through various tools and personalised help</li>
        </ul>
        <h2>examples shown on this demo site</h2>';
        foreach ($this->examplePages as $key => $exampleGroups) {
            $html .= '<h3>' . $exampleGroups['Title'] . '</h3><ul>';
            foreach ($exampleGroups['List'] as $examplePages) {
                $html .= '<li><span class="exampleTitle">' . $examplePages['Title'] . '</span>' . $examplePages['List'] . '</li>';
            }
            $html .= '</ul>';
        }
        $html .= '
        <h2>API Access</h2>
        <p>
            E-commerce allows you to access its model using the built-in Silverstripe API.
            This is great for communication with third party applications.
            Access examples are listed below:
        </p>
        <ul>
            <li><a href="/api/v1/Order/">view all orders</a></li>
            <li><a href="/api/v1/Order/1">view order with ID = 1</a></li>
        </ul>
        <p>
            For more information on the restful server API, you can visit the modules home: <a href="https://github.com/silverstripe/silverstripe-restfulserver">https://github.com/silverstripe/silverstripe-restfulserver</a> to find out more on this topic.
        </p>
        ';
        $featuresPage = Page::get()
            ->where("URLSegment = 'features'")
            ->First()
        ;
        $featuresPage->Content = (string) $featuresPage->Content . $html;
        $featuresPage->writeToStage(Versioned::DRAFT);
        $featuresPage->PublishRecursive();
        $featuresPage->flushCache();

    }
}
