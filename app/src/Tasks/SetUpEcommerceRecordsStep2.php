<?php

namespace Sunnysideup\EcommerceTest\Tasks;

use SilverStripe\Core\ClassInfo;
use SilverStripe\Dev\BuildTask;
use SilverStripe\ORM\DB;
use Sunnysideup\EcommerceTest\Model\CompleteSetupRecord;
use Sunnysideup\EcommerceTest\Tasks\Setup\AddComboProducts;
use Sunnysideup\EcommerceTest\Tasks\Setup\AddFilesToElectronicDownloadProduct;
use Sunnysideup\EcommerceTest\Tasks\Setup\AddMyModifiers;
use Sunnysideup\EcommerceTest\Tasks\Setup\AddSpecialPrice;
use Sunnysideup\EcommerceTest\Tasks\Setup\AddStock;
use Sunnysideup\EcommerceTest\Tasks\Setup\AddVariations;
use Sunnysideup\EcommerceTest\Tasks\Setup\CheckReset;
use Sunnysideup\EcommerceTest\Tasks\Setup\CollateExamplePages;
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
// use ProductAttributeType;
// use ProductAttributeValue;
// use ProductVariation;

// use CombinationProduct;
use Sunnysideup\EcommerceTest\Tasks\Setup\ProductsWithSpecialTax;
// use EcommerceProductTag;
// use ProductGroupWithTags;

// use ComplexPriceObject;
use Sunnysideup\EcommerceTest\Tasks\Setup\RunEcommerceDefaults;
use Sunnysideup\EcommerceTest\Tasks\Setup\UpdateMyRecords;

class SetUpEcommerceRecordsStep2 extends BuildTask
{
    protected $title = 'Install Example E-commerce Data';

    protected $description = 'Installs pages, product, etc... so that you can see e-commerce in action with a full collection of data.';

    private static $segment = 'setup-ecommerce-records-step-2';

    private static $steps = [
        //first!
        CheckReset::class,
        RunEcommerceDefaults::class,
        CreateShopAdmin::class,
        CreateImages::class,
        CreatePages::class,
        CollateExamplePages::class,
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
                echo "<h2>Running {$step}</h2>";
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
