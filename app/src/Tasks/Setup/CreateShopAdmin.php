<?php

namespace Sunnysideup\EcommerceTest\Tasks\Setup;

use SilverStripe\Security\Member;
// use ProductAttributeType;
// use ProductAttributeValue;
// use ProductVariation;

// use CombinationProduct;
// use EcommerceProductTag;
// use ProductGroupWithTags;

use Sunnysideup\Ecommerce\Model\Extensions\EcommerceRole;
// use ComplexPriceObject;
use Sunnysideup\EcommerceTest\Tasks\SetUpBase;

class CreateShopAdmin extends SetUpBase
{
    public function run()
    {
        $member = new Member();
        $member->FirstName = 'Shop';
        $member->Surname = 'Admin';
        $member->Email = 'shop@silverstripe-ecommerce.com';
        $member->SetPassword = 'thisIsTestPassword99';
        $member->Password = 'thisIsTestPassword99';
        $member->write();
        $group = EcommerceRole::get_admin_group();
        $member->Groups()->add($group);
    }
}
