<?php

namespace Sunnysideup\EcommerceTest\Tasks\Setup;

use SilverStripe\ORM\DataObject;




// use ProductAttributeType;
// use ProductAttributeValue;
// use ProductVariation;

use SilverStripe\ORM\DB;
// use CombinationProduct;
use SilverStripe\SiteConfig\SiteConfig;
// use EcommerceProductTag;
// use ProductGroupWithTags;



// use ComplexPriceObject;
use Sunnysideup\Ecommerce\Model\Config\EcommerceDBConfig;
use Sunnysideup\EcommerceTest\Tasks\SetUpBase;

class UpdateMyRecords extends SetUpBase
{
    public function run()
    {
        $schema = DataObject::getSchema();
        $array = [
            [
                'T' => $schema->tableName(SiteConfig::class),
                'F' => 'Title',
                'V' => 'Silverstripe Ecommerce Demo',
                'W' => '',
            ],

            [
                'T' => $schema->tableName(SiteConfig::class),
                'F' => 'Tagline',
                'V' => 'Built by Sunny Side Up',
                'W' => '',
            ],
            // [
            //     'T' => $schema->tableName(SiteConfig::class),
            //     'F' => 'Theme',
            //     'V' => 'main',
            //     'W' => ''
            // ],

            [
                'T' => $schema->tableName(EcommerceDBConfig::class),
                'F' => 'ShopClosed',
                'V' => '0',
                'W' => '',
            ],

            ['T' => $schema->tableName(EcommerceDBConfig::class),
                'F' => 'ShopPricesAreTaxExclusive',
                'V' => '0',
                'W' => '',
            ],
            [
                'T' => $schema->tableName(EcommerceDBConfig::class),
                'F' => 'ShopPhysicalAddress',
                'V' => '<address>The Shop<br />1 main street<br />Coolville 123<br />Landistan</address>',
                'W' => '',
            ],
            [
                'T' => $schema->tableName(EcommerceDBConfig::class),
                'F' => 'ReceiptEmail',
                'V' => '"Silverstrip E-comerce Demo" <sales@silverstripe-ecommerce.com>',
                'W' => '',
            ],
            [
                'T' => $schema->tableName(EcommerceDBConfig::class),
                'F' => 'PostalCodeURL',
                'V' => 'http://tools.nzpost.co.nz/tools/address-postcode-finder/APLT2008.aspx',
                'W' => '',
            ],
            [
                'T' => $schema->tableName(EcommerceDBConfig::class),
                'F' => 'PostalCodeLabel',
                'V' => 'Check Code',
                'W' => '',
            ],
            [
                'T' => $schema->tableName(EcommerceDBConfig::class),
                'F' => 'NumberOfProductsPerPage',
                'V' => '5',
                'W' => '',
            ],
            [
                'T' => $schema->tableName(EcommerceDBConfig::class),
                'F' => 'OnlyShowProductsThatCanBePurchased',
                'V' => '0',
                'W' => '',
            ],
            [
                'T' => $schema->tableName(EcommerceDBConfig::class),
                'F' => 'ProductsHaveWeight',
                'V' => '1',
                'W' => '',
            ],
            [
                'T' => $schema->tableName(EcommerceDBConfig::class),
                'F' => 'ProductsHaveModelNames',
                'V' => '1',
                'W' => '',
            ],
            [
                'T' => $schema->tableName(EcommerceDBConfig::class),
                'F' => 'ProductsHaveQuantifiers',
                'V' => '1',
                'W' => '',
            ],
            [
                'T' => $schema->tableName(EcommerceDBConfig::class),
                'F' => 'ProductsAlsoInOtherGroups',
                'V' => '1',
                'W' => '',
            ],
            [
                'T' => $schema->tableName(EcommerceDBConfig::class),
                'F' => 'EmailLogoID',
                'V' => $this->getRandomImageID(),
                'W' => '',
            ],
            [
                'T' => $schema->tableName(EcommerceDBConfig::class),
                'F' => 'DefaultProductImageID',
                'V' => $this->getRandomImageID(),
                'W' => '',
            ],
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
