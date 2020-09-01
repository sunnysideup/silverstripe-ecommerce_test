<?php

namespace Sunnysideup\EcommerceTest\Tasks;

use Sunnysideup\EcommerceTest\Tasks\Setup\AddComboProducts;
use Sunnysideup\EcommerceTest\Tasks\Setup\AddFilesToElectronicDownloadProduct;
use Sunnysideup\EcommerceTest\Tasks\Setup\AddMyModifiers;
use Sunnysideup\EcommerceTest\Tasks\Setup\AddSpecialPrice;
use Sunnysideup\EcommerceTest\Tasks\Setup\AddStock;
use Sunnysideup\EcommerceTest\Tasks\Setup\AddVariations;
use Sunnysideup\EcommerceTest\Tasks\Setup\CheckReset;
use Sunnysideup\EcommerceTest\Tasks\Setup\CollateExamplePages;
use Sunnysideup\EcommerceTest\Tasks\Setup\CompleteAll;
use Sunnysideup\EcommerceTest\Tasks\Setup\CreateCurrencies;
use Sunnysideup\EcommerceTest\Tasks\Setup\CreateCustomisationSteps;
use Sunnysideup\EcommerceTest\Tasks\Setup\CreateImages;
use Sunnysideup\EcommerceTest\Tasks\Setup\CreateOrder;
use Sunnysideup\EcommerceTest\Tasks\Setup\CreatePages;
use Sunnysideup\EcommerceTest\Tasks\Setup\CreateRecommendedProducts;
use Sunnysideup\EcommerceTest\Tasks\Setup\CreateShopAdmin;
use Sunnysideup\EcommerceTest\Tasks\Setup\CreateTags;
use Sunnysideup\EcommerceTest\Tasks\Setup\DeleteDownloads;
use Sunnysideup\EcommerceTest\Tasks\Setup\ProductsInManyGroups;
use Sunnysideup\EcommerceTest\Tasks\Setup\ProductsWithSpecialTax;
use Sunnysideup\EcommerceTest\Tasks\Setup\RunEcommerceDefaults;
use Sunnysideup\EcommerceTest\Tasks\Setup\UpdateMyRecords;;

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
use SilverStripe\Core\ClassInfo;
use SilverStripe\Core\Config\Config;
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

class SetUpEcommerceRecordsStep2 extends BuildTask
{
    protected $title = 'Install Example E-commerce Data';

    protected $description = 'Installs pages, product, etc... so that you can see e-commerce in action with a full collection of data.';

    private static $segment = 'setup-ecommerce-records-step-2';


    private static $steps = [
        CreateShopAdmin::class,
        RunEcommerceDefaults::class,
        CreateImages::class,
        CreatePages::class,
        CollateExamplePages::class,
        CheckReset::class,
        CompleteAll::class,
        CreateCurrencies::class,
        CreateCustomisationSteps::class,
        CreateOrder::class,
        CreateRecommendedProducts::class,
        CreateTags::class,
        DeleteDownloads::class,
        ProductsInManyGroups::class,
        ProductsWithSpecialTax::class,
        UpdateMyRecords::class,
        AddComboProducts::class,
        AddFilesToElectronicDownloadProduct::class,
        AddMyModifiers::class,
        AddSpecialPrice::class,
        AddStock::class,
        AddVariations::class,
    ];

    public function run($request)
    {
        $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
        set_time_limit(6000);
        DB::alteration_message('
        Wait for <br />
        ----------------------------- COMPLETE ---------------------------
        <br />
        which will show AGAIN at the end of this task.');
        foreach ($this->Config()->get('steps') as $className) {
            $step = ClassInfo::shortName($className);
            if (! $action || $action === $step) {
                echo "<h2>Running ${step}</h2>";
                $obj = new $className();
                $obj->run();
            }
        }
        $this->completeall();
    }



    private function completeall()
    {
        $obj = new CompleteSetupRecord();
        $obj->CompletedSetup = 1;
        $obj->write();
        DB::alteration_message('----------------------------- COMPLETE --------------------------- ');
    }
}
