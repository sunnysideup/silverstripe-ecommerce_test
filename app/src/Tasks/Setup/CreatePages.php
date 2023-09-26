<?php

namespace Sunnysideup\EcommerceTest\Tasks\Setup;

use Page;
use SilverStripe\ORM\DB;
// use ProductAttributeType;
// use ProductAttributeValue;
// use ProductVariation;

// use CombinationProduct;
use SilverStripe\Security\Group;
use SilverStripe\Versioned\Versioned;
use Sunnysideup\Ecommerce\Model\Order;
// use EcommerceProductTag;
// use ProductGroupWithTags;

// use ComplexPriceObject;
use Sunnysideup\Ecommerce\Pages\AccountPage;
use Sunnysideup\Ecommerce\Pages\CartPage;
use Sunnysideup\Ecommerce\Pages\CheckoutPage;
use Sunnysideup\Ecommerce\Pages\OrderConfirmationPage;
use Sunnysideup\Ecommerce\Pages\Product;
use Sunnysideup\Ecommerce\Pages\ProductGroup;
use Sunnysideup\Ecommerce\Pages\ProductGroupSearchPage;
use Sunnysideup\EcommerceTest\Tasks\SetupBase;

class CreatePages extends SetupBase
{
    public function run()
    {
        $pages = $this->getPages();
        foreach ($pages as $fields) {
            $this->MakePage($fields);
        }
        $termsPage = Page::get()
            ->where("URLSegment = 'terms-and-conditions'")
            ->First()
        ;
        $checkoutPage = CheckoutPage::get()
            ->First()
        ;
        $checkoutPage->TermsPageID = $termsPage->ID;
        $checkoutPage->writeToStage(Versioned::DRAFT);
        $checkoutPage->PublishRecursive();
        $checkoutPage->flushCache();
        DB::alteration_message('adding terms page to checkout page');
    }

    private function getProductGroups($numberOfGroups = 7)
    {
        --$numberOfGroups;
        $array = [];
        for ($j = 1; $j < $numberOfGroups; ++$j) {
            $parentCode = $this->randomName();
            if ((-1 === $j) && ($numberOfGroups > 3)) {
                $children1 = $this->getProductGroups($numberOfGroups);
                $children2 = $this->getProductGroups($numberOfGroups);
                $children = array_merge($children1, $children2);
            } else {
                $children = $this->getProducts($parentCode);
            }
            $levelOfProductsToShow = rand(1, 3);
            $filterNumber = rand(0, 4);
            switch ($filterNumber % 4) {
                case 0:
                    $filter = 'inherit';

                    break;
                case 1:
                    $filter = '';

                    break;
                case 2:
                    $filter = 'featuredonly';

                    break;
                case 3:
                    $filter = 'nonfeaturedonly';

                    break;
                default:
                    $filter = '';
            }
            $styleNumber = rand(0, 4);
            switch ($styleNumber % 4) {
                case 0:
                    $style = 'inherit';
                    $numberOfProductsPerPage = 0;
                    $sortOrder = 'inherit';

                    break;
                case 1:
                    $style = 'Short';
                    $numberOfProductsPerPage = 50;
                    $sortOrder = 'price';

                    break;
                case 2:
                    $style = '';
                    $numberOfProductsPerPage = 9;
                    $sortOrder = '';

                    break;
                case 3:
                    $style = 'MoreDetail';
                    $numberOfProductsPerPage = 5;
                    $sortOrder = 'title';

                    break;
            }
            $array[$j] = [
                'ClassName' => ProductGroup::class,
                'URLSegment' => 'product-group-' . $parentCode,
                'Title' => 'Product Group ' . $parentCode,
                'MenuTitle' => 'Product group ' . $parentCode,
                'LevelOfProductsToShow' => $levelOfProductsToShow,
                'NumberOfProductsPerPage' => $numberOfProductsPerPage,
                'DefaultSortOrder' => $sortOrder,
                'DefaultFilter' => $filter,
                'DisplayStyle' => $style,
                'ImageID' => $this->getRandomImageID(),
                'Content' => '<p>
                        ' . $this->lipsum() . '
                        <br /><br />For testing purposes - the following characteristics were added to this product group:
                    </p>
                    <ul>
                        <li>level of products to show: ' . $levelOfProductsToShow . '</li>
                        <li>number of products per page: ' . ($levelOfProductsToShow + 5) . '</li>
                        <li>sort order: ' . ($sortOrder ?: '[default]') . '</li>
                        <li>filter: ' . ($filter ?: '[default]') . '</li>
                        <li>display style: ' . ($style ?: '[default]') . '</li>
                    </ul>
                    ',
                'Children' => $children,
            ];
        }

        return $array;
    }

    private function getProducts($parentCode)
    {
        $endPoint = rand(10, 20);
        for ($j = 0; $j < $endPoint; ++$j) {
            $i = rand(1, 500);
            $q = rand(1, 500);
            $price = $q < 475 ? $q + ($q / 100) : 0;
            $q = rand(1, 500);
            $weight = $q % 3 ? 0 : 1.234;
            $q = rand(1, 500);
            $model = $q % 4 ? '' : "model {$i}";
            $q = rand(1, 500);
            $featured = $q % 9 ? 'NO' : 'YES';
            $q = rand(1, 500);
            $quantifier = $q % 7 ? '' : 'per month';
            $q = rand(1, 500);
            $allowPurchase = $q % 17 ? 'YES' : 'NO';
            $imageID = $this->getRandomImageID();
            $numberSold = $i;
            $array[$i] = [
                'ClassName' => Product::class,
                'ImageID' => $imageID,
                'URLSegment' => "product-{$parentCode}-{$i}",
                'Title' => "Product {$parentCode} {$i}",
                'MenuTitle' => "Product {$i}",
                'Content' => "<p>
                    Description for Product {$i} ...
                    " . $this->lipsum() . '
                    <br /><br />For testing purposes - the following characteristics were added to this product:
                <p>
                <ul>
                    <li>weight: <i>' . (0 === $weight ? '[none]' : $weight . ' grams') . '</i> </li>
                    <li>model: <i>' . ($model ?: '[none]') . "</i></li>
                    <li>featured: <i>{$featured}</i></li>
                    <li>quantifier: <i>" . ($quantifier ?: '[none]') . "</i></li>
                    <li>allow purchase: <i>{$allowPurchase}</i></li>
                    <li>number sold: <i>" . $numberSold . '</i></li>
                </ul>',
                'Price' => $price,
                'InternalItemID' => 'AAA' . $i,
                'Weight' => $weight ? '1.234' : 0,
                'Model' => $model ? "model {$i}" : '',
                'Quantifier' => $quantifier,
                'FeaturedProduct' => 'YES' === $featured ? 1 : 0,
                'AllowPurchase' => 'YES' === $allowPurchase ? 1 : 0,
                'NumberSold' => $numberSold,
            ];
        }

        return $array;
    }

    private function getPages()
    {
        return [
            [
                'URLSegment' => 'home',
                'Title' => 'Sunny Side Up Silverstripe E-commerce Demo',
                'MenuTitle' => 'Home',
                'Content' => '

                <h2>What is this?</h2>
                <p>
                    This is a demo site for the Silverstripe E-commerce, developed by <a href="http://www.sunnysideup.co.nz">Sunny Side Up</a>.
                    It showcases the <a href="http://code.google.com/p/silverstripe-ecommerce">Silverstripe e-commerce project</a>.
                    It <a href="/home/features/">features</a> all the core e-commerce functionality as well as a selection of <i>add-on</i> modules - such as tax and delivery.
                    For the <i>theme</i>, or visual presentation, we have used the default Simple theme, provided by Silverstripe Ltd.
                    <strong>
                        This site is for testing only so try anything you like.
                        Any feedback, recommendations, bug reports, pull requests, etc... are appreciated and, where practicable, will be acted on or implemented.
                    </strong>
                    Please feel free to starting <a href="/shop/">shopping</a>.
                </p>

                <h2>Testing</h2>
                <p>
                    This site can reset itself so please go ahead and try whatever you want.
                    At any time you can <a href="/shoppingcart/clear/">reset the shopping cart</a> to start a new order.
                    Also, make sure to <a href="admin/shop/">open the cms</a> (see login details above).
                    If you have some feedback then please <a href="http://www.ssmods.com/contact-us/">contact us</a>.
                    <a href="http://www.sunnysideup.co.nz">Sunny Side Up</a> is also available for <a href="/about-us/">paid support</a>.
                </p>
                <h3 id="LoginDetails">Log in details</h3>
                <p>
                    You can <a href="admin/shop/">log-in</a> as follows: shop@silverstripe-ecommerce.com / thisIsTestPassword99.
                </p>

                <h2>Silverstripe Version</h2>
                <p>
                    This website runs on Silverstripe 3.1.
                </p>


                <h2>For developers</h2>
                <p>
                    You can install a complete copy of this website, including its data and images.
                </p>
                <p>
                    If you are familiar with composer then you can enter the following command lines:
                </p>
                <h3>composer install</h3>
                <p>
                    Create a directory in which you wan to install the project (e.g. webroot of your server).
                    Next, browse to that folder and type:</p>
                <pre>
composer create-project sunnysideup/ecommerce_test:dev-master ./
                </pre>
                <p>It is important to install it from within the root folder of the site.</p>
                <p>After you install the project, you will need to do the following:</p>
                <ul>
                    <li>add <em>.htaccess</em> file - as per usual</li>
                    <li>add <em>_ss_enviroment.php</em> file - as per usual</li>
                    <li>edit the name of your database in app/_config.php</li>
                    <li>run <em>/dev/build/?flush=all</em></li>
                    <li>run <em>/dev/tasks/CleanEcommerceTables</em></li>
                    <li>run <em>?flush=all</em> at least one more time, as e-commerce includes aggressive caching which needs to be cleared</li>
                </ul>
                <p>
                    The .htaccess files only works on apache servers of course, for other web-servers, please use the appropriate alternatives.
                    An example is included.
                </p>
                <h3>downloads and git</h3>
                <p>
                    Please visit <a href="https://github.com/sunnysideup/silverstripe-ecommerce">our e-commerce git repository</a> for versions and downloads.
                    To see available sub-modules, please visit <a href="https://www.versioneye.com/php/sunnysideup:ecommerce/references">an extensive list of e-commerce sub-modules</a>
                    or have a look at our <a href="https://github.com/sunnysideup?page=1&tab=repositories&utf8=%E2%9C%93&q=ecommerce">git repositories</a> that make use of e-commerce.
                    You can also have a look at our <a href="https://packagist.org/packages/sunnysideup/ecommerce">packagist silverstripe e-commerce entry</a>.
                </p>
                <h3>themes</h3>
                <p>
                    This website showcases the Simple theme.
                    You can also view it in the Sunny Side Up Flavour
                    Use the links below to switch themes:
                </p>
                <ul>
                    <li><a href="/home/settheme/main/">View Sunny Side Up Theme</a></li>
                    <li><a href="/home/settheme/simple/">View Simple Theme</a></li>
                </ul>
                <p>
                    <strong>
                        If you would like to contribute a theme to e-commerce then we would be delighted.
                        Please contact us for more information.
                    </strong>
                </p>
                <h3>data model</h3>
                <p>
                    Please review the latest <a href="/ecommerce/docs/en/DataModel.png">e-commerce data model</a>.
                    This data model can be a bit out of date, but it gives a very good overview of the e-commerce model.
                </p>

                <h3>customisation</h3>
                <p>
                    Please follow our <a href="/home/customisation-guide/">e-commerce customisation guide</a> for the best way to customise your e-commerce application. You will be amazed how easy this is.
                </p>
                <h3>documentation</h3>
                <p>
                    The documentation for this module is rather sparse, but we hope the resources listed here provide some help.
                    You can also access the automatically created <a href="/ecommerce/docs/api/classes.xhtml">API documentations included with this module</a>.
                    Our strategy is to improve the in-file comments with classes, methods, and so on so that the API will be able to provide you with all the documentation you may need.
                </p>
                <h3>other tools</h3>
                <p>
                    This module has a bunch of tools, not seen in many other modules, that will help you build and maintain your application.
                    Here are some examples:
                </p>
                <ul>
                    <li>a complete <a href="/dev/ecommerce/">dev screen</a> with a ton of tasks you can run</li>
                    <li>tools to migrate from earlier versions</li>
                    <li>lots of <a href="/ecommercetemplatetest/">information on how to build templates</a></li>
                    <li>a complete list of all configs with explanations</li>
                    <li>a bunch of debug tools</li>
                    <li>maintenance tools (clear old orders, etc...)</li>
                </ul>
                <p>Make sure to also have a look at our <a href="/home/customisation-guide/">customisation guide</a>.</p>
                <h3>bugs / feedback / questions</h3>
                <p>
                    The best place to start is the e-commerce google group mailing list: <a href="https://groups.google.com/forum/#!forum/silverstripe-ecommerce">https://groups.google.com/forum/#!forum/silverstripe-ecommerce</a>.
                </p>
                <p>
                    For more detailed questions / bug reports / etc... please visit our <a href="https://github.com/sunnysideup/silverstripe-ecommerce/issues">issue list on github</a> or email us [modules <i>at</i> sunnysideup .co .nz].
                    We welcome any feedback and we will act on it where we can.
                </p>

                <h2>Thank you</h2>
                <p>
                    Thank you <a href="http://www.silverstripe.org">Silverstripe Community</a> for the Silverstripe foundation.
                    A big <i>kia ora</i> also to all the developers who contributed to this project.
                </p>
                ',
                'Children' => [
                    [
                        'URLSegment' => 'tag-explanation',
                        'Title' => 'Tag Explanations',
                        'MenuTitle' => 'Tags',
                        'ShowInMenus' => false,
                        'ShowInSearch' => false,
                        'Content' => '<p>This page can explain the tags shown for various products. </p>',
                    ],
                    [
                        'URLSegment' => 'features',
                        'Title' => 'Silverstripe E-Commerce Features',
                        'MenuTitle' => 'Features',
                        'ShowInMenus' => true,
                        'ShowInSearch' => true,
                        'Content' => '',
                    ],
                    [
                        'URLSegment' => 'customisation-guide',
                        'Title' => 'Customisation Guide for Silverstripe E-commerce',
                        'MenuTitle' => 'Customisation',
                        'ShowInMenus' => true,
                        'ShowInSearch' => true,
                        'Content' => '<p>
                                To find out more about <a href="https://www.silverstripe.org/blog/making-a-module-fit-for-purpose/">Silverstripe customisation</a>,
                                please vist our <a href="https://www.silverstripe.org/blog/making-a-module-fit-for-purpose/">blog entry on hacking a Silverstripe module</a>.
                            </p>
                            ',
                    ],
                    [
                        'URLSegment' => 'others',
                        'Title' => 'Other Silverstripe E-Commerce Applications',
                        'MenuTitle' => 'Also See',
                        'ShowInMenus' => true,
                        'ShowInSearch' => true,
                        'Content' => '

                                    <p>Below are three other Silverstripe E-commerce Solutions (information updated 1 Oct 2012)</p>
                                    <table style="width: 100%">
                                        <tbody>
                                            <tr>
                                                <th style="width: 10%;" scope="col">&nbsp;</th>
                                                <th style="width: 30%;" scope="col">
                                                    <a href=""><a href="https://github.com/burnbright/silverstripe-shop">Shop</a>
                                                </th>
                                                <th style="width: 30%;" scope="col">
                                                    <a href="https://github.com/frankmullenger/silverstripe-swipestripe">Swipestripe</a>
                                                </th>
                                                <th style="width: 30%;" scope="col">
                                                    <a href="https://bitbucket.org/silvercart/">Silvercart</a>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th scope="row">Lead developer</th>
                                                <td>Jeremy</td>
                                                <td>Frank</td>
                                                <td>Roland</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Cost</th>
                                                <td>Free</td>
                                                <td>USD250ish + module cost</td>
                                                <td>Free</td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Demo</th>
                                                <td><a href="http://demo.ss-shop.org/">demo.ss-shop.org/</a></td>
                                                <td>
                                                    <a href="http://demo.swipestripe.com/">demo.swipestripe.com/</a>
                                                    <a href="http://ss3.swipestripe.com/">ss3.swipestripe.com/</a>
                                                </td>
                                                <td><a href="http://demo.trysilvercart.com">demo.trysilvercart.com</a></td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Features</th>
                                                <td>
                                                    <ul>
                                                        <li>Product catalog that can be stored in a categorized  tree hierarchy, or flat via model admin</li>
                                                        <li>Account page for members to view past orders, and pay for incomplete orders</li>
                                                        <li>Simplistic code base, intended to scale</li>
                                                        <li>Integrates with payment module</li>
                                                        <li>Product variations/options</li>
                                                        <li>Address book</li>
                                                        <li>Single page checkout</li>
                                                        <li>35 unit tests running on TravisCI</li>
                                                        <li>Self contained installer</li>
                                                        <li>Discount coupon codes</li>
                                                        <li>Zoned shipping system</li>
                                                        <li>Product enquiry form</li>
                                                        <li>Product searching</li>
                                                        <li>Google analytics recording</li>
                                                        <li>Bootstrap theme</li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <p>Aiming for a small and simple core codebase which is flexible enough to be extended easily in order to add features like product galleries, shipping, tax, coupon codes etc. Currently have a small selection of extensions (http://swipestripe.com/products/extensions/) that can be purchased seperately and provide common features for shopping carts such as:</p>
                                                    <ul>
                                                        <li>Product gallery with fancy box</li>
                                                        <li>Xero integrations</li>
                                                        <li>Virtual (downloadable) products</li>
                                                        <li>Region based shipping</li>
                                                        <li>Weight and region based shipping</li>
                                                        <li>Region based tax rates</li>
                                                        <li>Featured products</li>
                                                        <li>Courier codes for orders</li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>Master and slave products (product variations can be grouped while the variations can be independently maintained)</li>
                                                        <li>A products stock status can be displayed as quantity or with a traffic light as a symbol.</li>
                                                        <li>Products can be provided with multiple images or a gallery.</li>
                                                        <li>Unlimited quantity of products and product groups.</li>
                                                        <li>Products can be mirrored in several product groups.</li>
                                                        <li>Each product can have multiple files assigned (PDF,DOC,XLS, etc.)</li>
                                                        <li>Drag and drop reordering</li>
                                                        <li>manufacturer logo and link maintainable</li>
                                                        <li>various possibilities to filter products</li>
                                                        <li>Class diagram and API documentation</li>
                                                        <li>Integrated update mechanism</li>
                                                        <li>Import and export via CSV</li>
                                                        <li>User account area with order history</li>
                                                        <li>B2B or B2C</li>
                                                    </ul>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Planned</th>
                                                <td>
                                                    <ul>
                                                        <li>SubShops - allowing members to create their own semi-branded store, and set profits</li>
                                                        <li>SilverStripe 3 upgrade</li>
                                                        <li>US/International tax support</li>
                                                        <li>Multi-currency</li>
                                                        <li>Stock control</li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>Using new SilverStripe 3.0 compatible payment module</li>
                                                        <li>Multiple currency</li>
                                                        <li>Documentation</li>
                                                        <li>More comprehensive reporting</li>
                                                        <li>Further 3rd party integrations</li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>Amazon module</li>
                                                        <li>Groupon module</li>
                                                        <li>Saferpay payment module</li>
                                                        <li>Sofort banking module</li>
                                                    </ul>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">Support</th>
                                                <td>
                                                    <ul>
                                                        <li>Online: <a href="http://demo.ss-shop.org/docs/developer/en">docs</a>, <a href="http://api.ss-shop.org/">api</a></li>
                                                        <li>app.com/dev/shop - tools and tasks for development</li>
                                                        <li>Moderate forum support (shared with ecommerce module)</li>
                                                        <li>Ecommerce mailing list (shared with ecommerce module)</li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li><a href="http://docs.swipestripe.com/">API documentation</a></li>
                                                        <li><a href="http://swipestripe.com/docs">Installation documentation</a></li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    SilverCart uses the YAML CSS framework and customhtmlform module which takes care of SilverStripes HTML limitations for forms.
                                                    <a href="http://www.silvercart.org/forum/">support forum</a></td>
                                            </tr>

                                        </tbody>
                                    </table>


                        ',
                    ],
                ],
            ],
            [
                'ClassName' => ProductGroupSearchPage::class,
                'URLSegment' => 'shop',
                'Title' => 'Shop',
                'MenuTitle' => 'Shop',
                'Content' => '
                    <p>
                        On this test website, we have created a Product Search Page as the parent page of all product grops and products.
                        Product Group Pages allow the developer and content-editor to show products in a wide variety of ways.
                        Some options included are:
                    </p>
                    <ul>
                        <li>What products to show (e.g. all children and grandchildren),</li>
                        <li>how to display them,</li>
                        <li>how many per page, and</li>
                        <li>how they should be sorted (by default).</li>
                    </ul>
                    <p>You can also setup <i>custom list</i> of products, such as new products or specials, by using one of the page types that extend Product Group provided in several of the the e-commerce modules.</p>
                ',
                'Children' => [
                    [
                        'ClassName' => ProductGroup::class,
                        'URLSegment' => 'browse-products',
                        'Title' => 'Browse All Products',
                        'MenuTitle' => 'Browse Products',
                        'ShowInMenus' => 1,
                        'ShowInSearch' => 1,
                        'NumberOfProductsPerPage' => 70,
                        'Content' => '<p>In this section you can browse all the products...</p>',
                        'Children' => $this->getProductGroups(),
                    ],
                    [
                        'ClassName' => ProductGroup::class,
                        'URLSegment' => 'alternative-views',
                        'Title' => 'Alternative Views of Product and Product Groups',
                        'MenuTitle' => 'Alternative Views',
                        'ShowInMenus' => 1,
                        'ShowInSearch' => 1,
                        'Content' => '<p>
                            E-commerce is set up in such a way that you can present products in many different ways.
                            Products can be shown in several product group pages (many-to-many relationship between products and groups).
                            You can filter and sort them as you see fit.
                            There are also several display options for the products.
                            What is more, we have made a <a href="https://github.com/search?q=user%3Asunnysideup+ecommerce+&type=Repositories">large range of modules</a> available that can add functionality such as grouping products, creating price lists, etc...
                        </p>',
                        'Children' => [
                            // array(
                            //     "ClassName" => "ElectronicDownloadProduct",
                            //     "URLSegment" => "purchase-a-download",
                            //     "Title" => "Purchase some files for download",
                            //     "MenuTitle" => "Downloads",
                            //     "Price" => 11.95,
                            //     "Content" => "<p>This is an example of the ElectronicDownloadProduct page template.</p>",
                            // )
                            /*
                            array(
                                "ClassName" => "ProductGroupWithTags",
                                "URLSegment" => "shop-by-tag",
                                "Title" => "Shop by Tag",
                                "MenuTitle" => "Shop by Tag",
                                "Content" => "<p>Please use the tags to find the products you are after.</p>",
                            ),
                            array(
                                "ClassName" => "AddUpProductsToOrderPage",
                                "URLSegment" => "add-up-order",
                                "Title" => "Add Up Order",
                                "MenuTitle" => "Add Up Order",
                                "ShowInMenus" => 1,
                                "ShowInSearch" => 1,
                                "Content" => "
                                    <p>
                                        Choose your products below and continue through to the checkout...
                                        This page helps customers who want to put a <i>name</i> or <i>identifier</i> with each order item - for example a group of people purchasing together.
                                    </p>",
                            ),
                            array(
                                "ClassName" => "PriceListPage",
                                "URLSegment" => "price-list",
                                "Title" => "Price List",
                                "MenuTitle" => "Price List",
                                "ShowInMenus" => 1,
                                "ShowInSearch" => 1,
                                "LevelOfProductsToShow" => -1,
                                "NumberOfLevelsToHide" => 99,
                                "Content" => "<p>please review all our prices below...</p>"
                            ),
                            array(
                                "ClassName" => "AddToCartPage",
                                "URLSegment" => "quick-add",
                                "Title" => "Quick Add",
                                "MenuTitle" => "Quick Add",
                                "ShowInMenus" => 1,
                                "ShowInSearch" => 1,
                                "Content" => "<p>Choose your products below and continue through to the checkout...</p>",
                            )
                            */
                        ],
                    ],
                    /*
                    array(
                        "ClassName" => "AnyPriceProductPage",
                        "URLSegment" => "donation",
                        "Title" => "Make a donation (example!)",
                        "MenuTitle" => "Donate (example!)",
                        "Content" => "<p>You can try out our <i>Any Price Product</i> below, by entering a value you want to <i>Donate</i>. This page can be used to allow customers to make payments such as donations or wherever they can determine the price.  You can send them a link to this page with an amount like this: <i>/donate/setamount/11.11</i></p>",
                        "Price" => 0,
                        "Featured" => 0,
                        "InternalItemID" => "DONATE"
                    )
                    */
                ],
            ],
            [
                'ClassName' => CheckoutPage::class,
                'URLSegment' => 'checkout',
                'Title' => 'Checkout',
                'MenuTitle' => 'Checkout',
                'Content' => '
                    <p>
                        For further information on our terms of trade, please visit ....
                        To test the tax, set your country to New Zealand (GST inclusive) or Australia (exclusive tax).
                    </p>
                ',
                'InvitationToCompleteOrder' => '<p>Please complete your details below to finalise your order.</p>',
                'CurrentOrderLinkLabel' => 'View current order',
                'SaveOrderLinkLable' => 'Save order',
                'NoItemsInOrderMessage' => '<p>There are no items in your current order</p>',
                'NonExistingOrderMessage' => '<p>We are sorry, but we can not find this order.</p>',
                'LoginToOrderLinkLabel' => 'Log in now to checkout order',
                'HasCheckoutSteps' => 1,
                'ContinueShoppingLabel' => 'Continue Shopping',
                'CurrentOrderLinkLabel' => 'View Current Order',
                'LoadOrderLinkLabel' => 'Load order',
                'DeleteOrderLinkLabel' => 'Delete order',
                'Children' => [
                    [
                        'ClassName' => OrderConfirmationPage::class,
                        'URLSegment' => 'confirmorder',
                        'Title' => 'Order Confirmation',
                        'MenuTitle' => 'Order Confirmation',
                        'ShowInMenus' => 0,
                        'ShowInSearch' => 0,
                        'Content' => '<p>Please review your order below.</p>',
                        'CurrentOrderLinkLabel' => 'View current order',
                        'SaveOrderLinkLable' => 'Save order',
                        'NoItemsInOrderMessage' => '<p>There are no items in your current order</p>',
                        'NonExistingOrderMessage' => '<p>We are sorry, but we can not find this order.</p>',
                        'LoginToOrderLinkLabel' => 'Log in now to checkout order',
                        'ContinueShoppingLabel' => 'Continue Shopping',
                        'CurrentOrderLinkLabel' => 'View Current Order',
                        'LoadOrderLinkLabel' => 'Load order',
                        'DeleteOrderLinkLabel' => 'Delete order',
                    ],
                    [
                        'ClassName' => AccountPage::class,
                        'URLSegment' => 'my account',
                        'Title' => 'My Account',
                        'MenuTitle' => 'My Account',
                        'ShowInMenus' => 1,
                        'ShowInSearch' => 0,
                        'Content' => '<p>Update your details below.</p>',
                    ],
                    [
                        'ClassName' => Page::class,
                        'URLSegment' => 'terms-and-conditions',
                        'Title' => 'Terms and Conditions',
                        'MenuTitle' => 'Terms',
                        'ShowInMenus' => 1,
                        'ShowInSearch' => 1,
                        'Content' => '<p>All terms and conditions go here...</p>',
                    ],
                ],
            ],
            [
                'ClassName' => CartPage::class,
                'URLSegment' => 'cart',
                'Title' => 'Cart',
                'MenuTitle' => 'Cart',
                'ShowInMenus' => 0,
                'ShowInSearch' => 0,
                'Content' => '<p>Please review your order below. A Cart Page is like a checkout page but without the checkout form.</p>',
            ],
            [
                'ClassName' => Page::class,
                'URLSegment' => 'about-us',
                'Title' => 'About us',
                'MenuTitle' => 'About us',
                'ShowInMenus' => 1,
                'ShowInSearch' => 1,
                'Content' => '
                    <p>
                        This demo e-commerce website has been developed by <a href="http://www.sunnysideup.co.nz">Sunny Side Up</a> for evaluation and testing.
                        If you would like help in building an e-commerce website using the Silverstripe CMS then do not hesitate to contact us.
                        In many cases, we have provided the back-bone (PHP + HTML + Javascript) for projects, with our clients taking care of the front-end (CSS).
                    </p>
                ', ],
            [
                'ClassName' => Page::class,
                'URLSegment' => 'pricing',
                'Title' => 'Pricing',
                'MenuTitle' => 'Pricing',
                'ShowInMenus' => 1,
                'ShowInSearch' => 1,
                'Content' => '
                    <p>
                        If you like a quote for an e-commerce site then please <a href="http://www.sunnysideup.co.nz/contact-us/">contact us</a> directly.
                    </p>
                    <h2>Digital Agencies</h2>
                    <p>
                        Below are some pricing indications for digital agencies who are keen to tap into the Sunny Side Up <em>know-how</em> for Silverstripe e-commerce sites.
                    </p>
                    </p>
                    <h3>Help is free</h3>
                    <p>
                        Basic advice during your build of an e-commerce website can be provided free of charge.
                        Please please <a href="http://www.sunnysideup.co.nz/contact-us/">contact us</a> for more information.
                    </p>

                    <h3>Install</h3>
                    <p>
                        Our e-commerce module has seven core features.
                    </p>
                    <ol>
                        <li>configuration interface</li>
                        <li>products</li>
                        <li>product categories / listings</li>
                        <li>product search</li>
                        <li>account page (login / logout / update details)</li>
                        <li>checkout</li>
                        <li>post-sale order processing</li>
                    </ol>

                    <p>
                        For a basic install and configuration (install, tweak database, and review yml settings)
                        we charge <a href="http://www.x-rates.com/table/?from=NZD&amount=700">NZD700</a>
                    </p>
                    <h3>Customisation</h3>
                    <p>
                        For a tested, customised install, we charge around <a href="http://www.x-rates.com/table/?from=NZD&amount=5000">NZD5000</a>.
                    </p>

                    <h3>Need more features?</h3>
                    <p>
                        We also have a ton of
                            <a href="https://github.com/sunnysideup?utf8=%E2%9C%93&tab=repositories&q=ecommerce&type=&language=">extensions available</a>
                            (e.g. tax, delivery, dashboard, follow up, feedback, rating, payment gateways, internationalisation, apis, etc ... etc...).
                        Where available, we charge around <a href="http://www.x-rates.com/table/?from=NZD&amount=150">NZD150</a> for an <em>as is</em> installation.
                        For new or customised modules, you can expect to pay around <a href="http://www.x-rates.com/table/?from=NZD&amount=700">NZD700</a> (back-end, HTML and basic JS only) per extension.
                    </p>


                ',
            ],
            /*
            array(
                "ClassName" => "TypographyTestPage",
                "URLSegment" => "typo",
                "Title" => "Typography Test page",
                "MenuTitle" => "Typo Page",
                "ShowInMenus" => 0,
                "ShowInSearch" => 0,
            )
            */
        ];
    }
}
