<?php

namespace Sunnysideup\EcommerceTest\Tasks\Setup;

use SilverStripe\Assets\Folder;
use SilverStripe\ORM\DB;
// use ProductAttributeType;
// use ProductAttributeValue;
// use ProductVariation;

// use CombinationProduct;
use Sunnysideup\EcommerceTest\Tasks\SetupBase;

// use EcommerceProductTag;
// use ProductGroupWithTags;

// use ComplexPriceObject;

class CreateImages extends SetupBase
{
    public function run($width = 170, $height = 120)
    {
        $data = get_loaded_extensions();
        if (! in_array('gd', $data, true)) {
            die("<span style='color: red;'>Cannot Initialize new GD image stream, please install GD: e.g. <i>apt-get install php5-gd</i></span>");
        }
        $dirPath = ASSETS_PATH . '/randomimages';
        $folder = Folder::find_or_make(basename($dirPath));
        $folder->write();
        if (! file_exists($dirPath)) {
            mkdir($dirPath);
        }
        DB::alteration_message('checking randomimages');
        if ($folder->Children()->count() < 250) {
            for ($i = 0; $i < 10; ++$i) {
                $r = mt_rand(0, 255);
                $g = mt_rand(0, 255);
                $b = mt_rand(0, 255);
                $im = @imagecreate($width, $height) or die('Cannot Initialize new GD image stream');
                $background_color = imagecolorallocate($im, $r, $g, $b);
                $fileName = $dirPath . '/img_' . sprintf('%03d', $r) . '_' . sprintf('%03d', $g) . '_' . sprintf('%03d', $b) . '.png';
                if (! file_exists($fileName)) {
                    imagepng($im, $fileName);
                    DB::alteration_message("creating images: {$fileName}", 'created');
                }
                imagedestroy($im);
            }
        }
    }
}
