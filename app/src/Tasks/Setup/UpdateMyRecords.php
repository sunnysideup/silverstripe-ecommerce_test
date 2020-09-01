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

class UpdateMyRecords extends SetUpBase
{
    public function run()
    {
        $array = [
            ['T' => SiteConfig::class, 'F' => 'Title', 'V' => 'Silverstripe Ecommerce Demo', 'W' => ''],
            ['T' => SiteConfig::class, 'F' => 'Tagline', 'V' => 'Built by Sunny Side Up', 'W' => ''],
            //array("T" => "SiteConfig", "F" => "CopyrightNotice", "V" => "This demo (not the underlying modules) are &copy; Sunny Side Up Ltd", "W" => ""),
            ['T' => SiteConfig::class, 'F' => 'Theme', 'V' => 'main', 'W' => ''],
            ['T' => EcommerceDBConfig::class, 'F' => 'ShopClosed', 'V' => '0', 'W' => ''],
            ['T' => EcommerceDBConfig::class, 'F' => 'ShopPricesAreTaxExclusive', 'V' => '0', 'W' => ''],
            ['T' => EcommerceDBConfig::class, 'F' => 'ShopPhysicalAddress', 'V' => '<address>The Shop<br />1 main street<br />Coolville 123<br />Landistan</address>', 'W' => ''],
            ['T' => EcommerceDBConfig::class, 'F' => 'ReceiptEmail', 'V' => '"Silverstrip E-comerce Demo" <sales@silverstripe-ecommerce.com>', 'W' => ''],
            ['T' => EcommerceDBConfig::class, 'F' => 'PostalCodeURL', 'V' => 'http://tools.nzpost.co.nz/tools/address-postcode-finder/APLT2008.aspx', 'W' => ''],
            ['T' => EcommerceDBConfig::class, 'F' => 'PostalCodeLabel', 'V' => 'Check Code', 'W' => ''],
            ['T' => EcommerceDBConfig::class, 'F' => 'NumberOfProductsPerPage', 'V' => '5', 'W' => ''],
            ['T' => EcommerceDBConfig::class, 'F' => 'OnlyShowProductsThatCanBePurchased', 'V' => '0', 'W' => ''],
            ['T' => EcommerceDBConfig::class, 'F' => 'ProductsHaveWeight', 'V' => '1', 'W' => ''],
            ['T' => EcommerceDBConfig::class, 'F' => 'ProductsHaveModelNames', 'V' => '1', 'W' => ''],
            ['T' => EcommerceDBConfig::class, 'F' => 'ProductsHaveQuantifiers', 'V' => '1', 'W' => ''],
            ['T' => EcommerceDBConfig::class, 'F' => 'ProductsAlsoInOtherGroups', 'V' => '1', 'W' => ''],
            ['T' => EcommerceDBConfig::class, 'F' => 'EmailLogoID', 'V' => $this->getRandomImageID(), 'W' => ''],
            ['T' => EcommerceDBConfig::class, 'F' => 'DefaultProductImageID', 'V' => $this->getRandomImageID(), 'W' => ''],
        ];
        foreach ($array as $innerArray) {
            if (isset($innerArray['W']) && $innerArray['W']) {
                $innerArray['W'] = ' WHERE ' . $innerArray['W'];
            } else {
                $innerArray['W'] = '';
            }
            $T = $innerArray['T'];
            $F = $innerArray['F'];
            $V = $innerArray['V'];
            $W = $innerArray['W'];
            DB::query("UPDATE \"${T}\" SET \"${F}\" = '${V}' ${W}");
            DB::alteration_message(" SETTING ${F} TO ${V} IN ${T} ${W} ", 'created');
        }
    }
}
