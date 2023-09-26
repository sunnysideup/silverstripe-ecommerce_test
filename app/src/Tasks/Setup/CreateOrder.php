<?php

namespace Sunnysideup\EcommerceTest\Tasks\Setup;

use SilverStripe\Security\Member;
// use ProductAttributeType;
// use ProductAttributeValue;
// use ProductVariation;

// use CombinationProduct;
// use EcommerceProductTag;
// use ProductGroupWithTags;

use SilverStripe\Versioned\Versioned;
// use ComplexPriceObject;
use Sunnysideup\Ecommerce\Model\Address\BillingAddress;
use Sunnysideup\Ecommerce\Model\Address\ShippingAddress;
use Sunnysideup\Ecommerce\Model\Order;
use Sunnysideup\Ecommerce\Model\ProductOrderItem;
use Sunnysideup\Ecommerce\Pages\Product;
use Sunnysideup\EcommerceTest\Tasks\SetupBase;

class CreateOrder extends SetupBase
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
        if ('Live' === Versioned::get_stage()) {
            $extension = '_Live';
        }
        $count = 0;
        $noProductYet = true;
        $triedArray = [0 => 0];
        while ($noProductYet && $count < 50) {
            $product = Product::get()
                ->where("\"ClassName\" = '" . addslashes(Product::class) . "' AND \"Product{$extension}\".\"ID\" NOT IN (" . implode(',', $triedArray) . ') AND Price > 0')
                ->First()
            ;
            if ($product) {
                if ($product->canPurchase()) {
                    $noProductYet = false;
                } else {
                    $triedArray[] = $product->ID;
                }
            }
            ++$count;
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
