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

class CreateImages extends SetUpBase
{


    public function run($width = 170, $height = 120)
    {
        $data = get_loaded_extensions();
        if (! in_array('gd', $data, true)) {
            die("<span style='color: red;'>Cannot Initialize new GD image stream, please install GD: e.g. <i>apt-get install php5-gd</i></span>");
        }
        $dirPath = ASSETS_PATH .'/randomimages';
        $folder = Folder::find_or_make(basename($dirPath));
        $folder->write();
        if(! file_exists($dirPath)) {
            mkdir($dirPath);
        }
        DB::alteration_message('checking randomimages');
        if ($folder->Children()->count() < 250) {
            for ($i = 0; $i < 10; $i++) {
                $r = mt_rand(0, 255);
                $g = mt_rand(0, 255);
                $b = mt_rand(0, 255);
                $im = @imagecreate($width, $height) or die('Cannot Initialize new GD image stream');
                $background_color = imagecolorallocate($im, $r, $g, $b);
                $fileName = $dirPath.'/img_' . sprintf('%03d', $r) . '_' . sprintf('%03d', $g) . '_' . sprintf('%03d', $b) . '.png';
                if (! file_exists($fileName)) {
                    imagepng($im, $fileName);
                    DB::alteration_message("creating images: ${fileName}", 'created');
                }
                imagedestroy($im);
            }
        }
    }
}
