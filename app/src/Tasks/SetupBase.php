<?php

namespace Sunnysideup\EcommerceTest\Tasks;

use Page;
use SilverStripe\Assets\Folder;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
// use ProductAttributeType;
// use ProductAttributeValue;
// use ProductVariation;

// use CombinationProduct;
use SilverStripe\ORM\DataList;
use SilverStripe\ORM\DB;

// use EcommerceProductTag;
// use ProductGroupWithTags;

// use ComplexPriceObject;

class SetupBase
{
    protected $fruitArray = [
        'Apple',
        'Crabapple',
        'Hawthorn',
        'Pear',
        'Apricot',
        'Peach',
        'Nectarines',
        'Plum',
        'Cherry',
        'Blackberry',
        'Raspberry',
        'Mulberry',
        'Strawberry',
        'Cranberry',
        'Blueberry',
        'Barberry',
        'Currant',
        'Gooseberry',
        'Elderberry',
        'Grapes',
        'Grapefruit',
        'Kiwi fruit',
        'Rhubarb',
        'Pawpaw',
        'Melon',
        'Watermelon',
        'Figs',
        'Dates',
        'Olive',
        'Jujube',
        'Pomegranate',
        'Lemon',
        'Lime',
        'Key Lime',
        'Mandarin',
        'Orange',
        'Sweet Lime',
        'Tangerine',
        'Avocado',
        'Guava',
        'Kumquat',
        'Lychee',
        'Passion Fruit',
        'Tomato',
        'Banana',
        'Gourd',
        'Cashew Fruit',
        'Cacao',
        'Coconut',
        'Custard Apple',
        'Jackfruit',
        'Mango',
        'Neem',
        'Okra',
        'Pineapple',
        'Vanilla',
        'Carrot',
    ];

    protected $imageArray = [];

    protected $examplePages = [
        0 => ['Title' => 'Basics', 'List' => []],
        1 => ['Title' => 'Products and Product Groups', 'List' => []],
        2 => ['Title' => 'Checkout Options', 'List' => []],
        // 3 => array("Title" => "Stock Control", "List" => array()),
        4 => ['Title' => 'Pricing', 'List' => []],
        5 => ['Title' => 'Other', 'List' => []],
    ];

    protected function deleteFolder($path)
    {
        if (true === is_dir($path)) {
            $files = array_diff(scandir($path), ['.', '..']);
            foreach ($files as $file) {
                if (file_exists(realpath($path) . '/' . $file)) {
                    unlink(realpath($path) . '/' . $file);
                }
            }

            return rmdir($path);
        }
        if (true === is_file($path)) {
            return unlink($path);
        }

        return false;
    }

    protected function MakePage($fields, $parentPage = null)
    {
        $page = SiteTree::get()
            ->where("\"URLSegment\" = '" . $fields['URLSegment'] . "'")
            ->First()
        ;
        if (! $page) {
            if (isset($fields['ClassName'])) {
                $className = $fields['ClassName'];
            } else {
                $className = Page::class;
            }
            $page = new $className();
        }
        $children = null;
        foreach ($fields as $field => $value) {
            if ('Children' === $field) {
                $children = $value;
            }
            $page->{$field} = $value;
        }
        if ($parentPage) {
            $page->ParentID = $parentPage->ID;
        }
        $page->write();
        $page->PublishRecursive();
        $page->flushCache();
        DB::alteration_message('Creating / Updating ' . $page->Title, 'created');
        if ($children) {
            foreach ($children as $child) {
                $this->MakePage($child, $page);
            }
        }
    }

    protected function addToTitle($page, $toAdd, $save = false)
    {
        $title = $page->Title;
        $newTitle = $title . ' - ' . $toAdd;
        $page->Title = $newTitle;
        $page->MenuTitle = $newTitle;
        if ($save) {
            $page->write();
            $page->Publish('Stage', 'Live');
            $page->flushCache();
        }
    }

    protected function addExamplePages($group, $name, $pages)
    {
        $html = '<ul>';
        if ($pages instanceof DataList) {
            foreach ($pages as $page) {
                $html .= '<li><a href="' . $page->Link() . '">' . $page->Title . '</a></li>';
            }
        } elseif ($pages instanceof SiteTree) {
            $html .= '<li><a href="' . $pages->Link() . '">' . $pages->Title . '</a></li>';
        } else {
            $html .= '<li>not available yet</li>';
        }
        $html .= '</ul>';
        $i = count($this->examplePages[$group]['List']);
        $this->examplePages[$group]['List'][$i]['Title'] = $name;
        $this->examplePages[$group]['List'][$i]['List'] = $html;
    }

    protected function randomName()
    {
        return array_pop($this->fruitArray);
    }

    protected function getRandomImageID()
    {
        if (! count($this->imageArray)) {
            $folder = Folder::find_or_make('randomimages');
            $images = Image::get()
                ->where('ParentID = ' . $folder->ID)
                ->orderBy('RAND()')
            ;
            if ($images->count()) {
                $this->imageArray = $images->map('ID', 'ID')->toArray();
            } else {
                $this->imageArray = [0 => 0];
            }
        }

        return array_pop($this->imageArray);
    }

    protected function lipsum()
    {
        $str = '
            Suspendisse auctor eros non metus semper vel mattis enim auctor.
            Maecenas aliquam feugiat lectus, eu pretium neque imperdiet sed.
            Nullam semper velit quis velit condimentum ut hendrerit felis blandit.
            Phasellus quis massa vel dolor consectetur ornare vel in justo.
            Vivamus vel sem lacus, eget auctor nibh.
            Quisque a massa sit amet odio malesuada placerat.
            Cras ut nunc leo, eget bibendum diam.
            //
            Morbi feugiat leo ac mauris posuere dictum.
            Integer venenatis augue sit amet lectus auctor auctor.
            Integer rhoncus velit molestie sem vehicula mattis.
            Duis condimentum nunc a arcu ornare vitae fermentum ipsum egestas.
            Ut eget tellus ligula, id convallis dui.
            Pellentesque ultricies metus at nisi hendrerit ut fringilla sem fringilla.
            Donec sit amet sem risus, ac rutrum dolor.
            Maecenas nec elit quam, eget laoreet sem.
            Donec egestas dui et nibh pharetra in ullamcorper risus aliquet.
            Fusce vitae nibh quis erat cursus egestas non non turpis.
            Pellentesque ac nunc sed nisl sollicitudin gravida.
            Nulla sollicitudin velit consectetur lacus commodo lacinia non non mauris.
            Quisque dignissim ante et odio dictum sodales euismod eu tellus.
            Nunc rhoncus nibh vel augue posuere nec suscipit leo sagittis.
            //
            Sed et lorem turpis, eu hendrerit nunc.
            Vivamus varius faucibus orci, a gravida massa varius non.
            Quisque nec sem sed purus pretium malesuada.
            Suspendisse eget quam at justo tempus imperdiet eget nec purus.
            Nullam vel lacus sit amet sem volutpat rutrum vel at dui.
            Nulla scelerisque lorem a mi commodo vestibulum.
            Maecenas quis dui sed mauris mattis mollis.
            Morbi ac tortor id sapien ornare tincidunt ut quis enim.
            Fusce id nisi vulputate augue dictum volutpat molestie nec metus.
            Nunc ultricies iaculis ante, sed pellentesque nulla fringilla ut.
            Duis non nibh in tellus lobortis dapibus.
            //
            Vestibulum at est eu purus cursus semper.
            Ut eu neque et lectus auctor tempus sed vel libero.
            Donec in lorem at dolor facilisis vestibulum.
            Vivamus fermentum felis nec nisl accumsan faucibus.
            Maecenas at tellus ut nulla congue tempor vitae in nisi.
            Mauris vitae nulla in libero mollis semper.
            Cras ac eros lorem, in volutpat odio.
            Nullam tristique egestas turpis, accumsan fermentum turpis feugiat ac.
            Proin adipiscing turpis non nunc faucibus quis facilisis mauris fermentum.
            Praesent rhoncus leo sed libero cursus pellentesque.
            Cras luctus urna in sem scelerisque vestibulum scelerisque velit hendrerit.
            Maecenas eget diam eu quam congue pulvinar eu non neque.
            //
            Quisque consequat tellus quis eros facilisis lacinia.
            Morbi quis nibh eget elit vehicula vestibulum.
            Proin rutrum vestibulum dui, viverra rutrum nisl tempor non.
            Praesent quis nibh nec risus gravida sodales ac eu neque.
            Integer non leo non lectus convallis semper.
            Integer viverra sapien eu dui vehicula ultrices.
            Cras fermentum vulputate justo, ut pretium magna dignissim sed.
            Nam tristique tellus vel lacus condimentum ac lobortis tortor dapibus.
            Maecenas quis quam sapien, sed ullamcorper ligula.
            Sed eu urna quis libero porttitor euismod.
            //
            Proin eget enim quis diam rhoncus faucibus a in lorem.
            Phasellus vulputate volutpat tortor, consectetur convallis nisl mollis a.
            Vestibulum at turpis quis lacus commodo sollicitudin.
            Phasellus placerat molestie purus, sed elementum leo congue et.
            Sed volutpat massa id lacus sollicitudin vel vehicula magna imperdiet.
            Suspendisse sit amet dui lacus, id scelerisque sem.
            //
            Vestibulum bibendum nulla ac odio rutrum aliquet.
            Fusce pretium felis nec justo semper laoreet.
            Aenean porta turpis at metus dapibus non rutrum magna ullamcorper.
            Vivamus non orci risus, id commodo enim.
            Sed adipiscing felis a dui ultrices ornare.
            Praesent in risus nisl, id luctus sapien.
            //
            Nunc a risus sapien, a aliquet tellus.
            Cras non nisl non lectus volutpat elementum eu ac nisl.
            Donec mattis odio nec ante mollis mattis.
            //
            Integer auctor interdum nulla, ac semper velit aliquet sit amet.
            Pellentesque egestas ultrices metus, vehicula malesuada sem viverra a.
            Morbi blandit metus eu mi egestas imperdiet.
            Vivamus volutpat turpis et nibh ornare vitae blandit tellus egestas.
            Integer molestie dolor ut orci semper at luctus urna pharetra.
            Morbi feugiat dolor eget velit dignissim vel scelerisque ligula aliquam.
            Cras in lacus magna, sed gravida est.
            Duis vulputate eleifend erat, pellentesque eleifend purus cursus eget.
            Vivamus blandit egestas sem, sed gravida velit posuere sit amet.
            //
            Nam malesuada sollicitudin erat, eget egestas risus condimentum quis.
            In dictum sapien ut velit tincidunt lobortis.
            Nam nec lectus non leo vulputate rutrum et at erat.
            Nam varius tristique turpis, eget euismod nisl lacinia vitae.
            Maecenas euismod lorem sed mi dictum aliquam.
            Phasellus at dui vitae est eleifend dictum a vitae lorem.
            Fusce quis sapien et enim sollicitudin interdum sit amet imperdiet ligula.
            Proin egestas sem vel sapien pharetra at varius est malesuada.
            Quisque et lorem in dolor blandit suscipit.
            //
            Nullam congue est eu lectus laoreet euismod.
            Nulla eu sapien ligula, semper pellentesque neque.

            Nulla ut enim dui, nec pharetra leo.
            //
            Sed placerat ante vel enim convallis consectetur.
            Sed quis justo auctor arcu sagittis laoreet.
            Curabitur eu risus a eros ornare ullamcorper.
            Pellentesque posuere ante quis diam placerat sit amet eleifend purus volutpat.
            Aenean id tellus et nisl luctus rhoncus.
            Cras ut velit a diam lobortis tincidunt.
            Mauris sit amet libero ut magna lacinia suscipit.
            Nam ut risus nec mauris faucibus posuere pellentesque vitae est.
            Maecenas dignissim bibendum sapien, id viverra urna sollicitudin id.
            Aliquam non quam ac nulla convallis viverra quis eget nisi.
            Sed rhoncus lectus non nisi consequat semper fermentum non ipsum.
            Aenean tempus mauris ut lectus dictum eu eleifend purus ultrices.
            Etiam id erat nunc, sed mattis mauris.
            Suspendisse et metus orci, eget tempus urna.
            Ut eu ipsum a quam convallis scelerisque.
            //
            Nullam a nulla vitae mauris eleifend tristique.
            Pellentesque nec leo non nisl posuere cursus nec sit amet nisl.
            Aenean sit amet sapien ut ipsum porta condimentum.
            Nullam ullamcorper elementum augue, ut suscipit dolor adipiscing sed.
            Maecenas congue leo a mi faucibus congue.
            Sed imperdiet pharetra lorem, eget rhoncus sapien feugiat vitae.
            Nullam mollis nulla ut risus faucibus imperdiet.
            //
            Proin eu orci in nunc euismod fermentum et ac dolor.
            Duis nec risus in sapien tempus posuere sed nec massa.
            Cras commodo nulla sit amet orci pretium dapibus.
            Nulla sed elit eu justo hendrerit auctor.
            Pellentesque ut quam a metus consequat venenatis vitae ut mauris.
            Ut vulputate luctus arcu, at dapibus risus molestie ac.
            Etiam euismod est nec est iaculis tristique.
            Vivamus ornare felis quis leo aliquet elementum.
            Nunc pretium arcu convallis quam suscipit eu rutrum est auctor.
            //
            Phasellus eu ipsum ac lorem euismod vestibulum quis at metus.
            Donec aliquet condimentum mi, in consequat elit dignissim nec.
            Etiam eu ante vel libero congue vehicula.
            Suspendisse volutpat ante eu ligula semper vitae venenatis lectus imperdiet.
            Pellentesque porttitor nisl quam, a pretium nibh.
            Pellentesque nec sem in neque suscipit posuere ut id odio.
            //
            Integer sollicitudin enim sit amet leo lacinia varius.
            Fusce fermentum sem vel est iaculis eleifend.';
        $array = explode('//', $str);
        $length = count($array);
        $rand = rand(0, $length - 1);

        return $array[$rand];
    }

    // protected function addfilestoelectronicdownloadproduct()
    // {
    //     $pages = ElectronicDownloadProduct::get();
    //     $files = File::get()->limit(5)->orderBy("Rand()");
    //     foreach ($pages as $page) {
    //         DB::alteration_message("Adding files to ".$page->Title, "created");
    //         $page->DownloadFiles()->addMany($files);
    //     }
    // }
}
