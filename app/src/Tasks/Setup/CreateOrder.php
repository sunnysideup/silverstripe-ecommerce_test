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

class CreateOrder extends SetUpBase
{



    public function run()
    {
        $order = new Order();
        $order->UseShippingAddress = true;
        $order->CustomerOrderNote = 'THIS IS AN AUTO-GENERATED ORDER';
        $order->write();

        $member = new Member();
        $member->FirstName = 'Tom';
        $member->Surname = 'Cruize';
        $member->Email = 'tom@silverstripe-ecommerce.com';
        $member->Password = 'thisIsTestPassword99';
        $member->write();
        $order->MemberID = $member->ID;

        $billingAddress = new BillingAddress();
        $billingAddress->Prefix = 'Dr';
        $billingAddress->FirstName = 'Tom';
        $billingAddress->Surname = 'Cruize';
        $billingAddress->Address = 'Lamp Drive';
        $billingAddress->Address2 = 'Linux Mountain';
        $billingAddress->City = 'Apache Town';
        $billingAddress->PostalCode = '555';
        $billingAddress->Country = 'NZ';
        $billingAddress->Phone = '555 5555555';
        $billingAddress->Email = 'tom@silverstripe-ecommerce.com';
        $billingAddress->write();
        $order->BillingAddressID = $billingAddress->ID;

        $shippingAddress = new ShippingAddress();
        $shippingAddress->ShippingPrefix = 'Dr';
        $shippingAddress->ShippingFirstName = 'Tom';
        $shippingAddress->ShippingSurname = 'Cruize';
        $shippingAddress->ShippingAddress = 'Lamp Drive';
        $shippingAddress->ShippingAddress2 = 'Linux Mountain';
        $shippingAddress->ShippingCity = 'Apache Town';
        $shippingAddress->ShippingPostalCode = '555';
        $shippingAddress->ShippingCountry = 'NZ';
        $shippingAddress->ShippingPhone = '555 5555555';
        $shippingAddress->write();
        $order->ShippingAddressID = $shippingAddress->ID;

        //get a random product
        $extension = '';
        if (Versioned::get_stage() === 'Live') {
            $extension = '_Live';
        }
        $count = 0;
        $noProductYet = true;
        $triedArray = [0 => 0];
        while ($noProductYet && $count < 50) {
            $product = Product::get()
                ->where("\"ClassName\" = '" . addslashes(Product::class) . "' AND \"Product{$extension}\".\"ID\" NOT IN (" . implode(',', $triedArray) . ') AND Price > 0')
                ->First();
            if ($product) {
                if ($product->canPurchase()) {
                    $noProductYet = false;
                } else {
                    $triedArray[] = $product->ID;
                }
            }
            $count++;
        }

        //adding product order item
        $item = new ProductOrderItem();
        $item->addBuyableToOrderItem($product, 7);
        $item->OrderID = $order->ID;
        $item->write();
        //final save
        $order->write();
        $order->tryToFinaliseOrder();
    }
}
