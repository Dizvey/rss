<?php


use Exceptions\RssException;
use TurboPage\Content\Elements\Blocks\Audio;
use TurboPage\Content\Elements\Blocks\Slider\Slider;
use TurboPage\Content\Elements\Table;
use TurboPage\Content\YandexRelatedLink;
use TurboPage\ContentRss;

class Test
{
    public function run () {
        try {

            $rss = (new ContentRss())
                ->setTitle('Site name')
                ->setLink('Domain name')
                ->setLanguage('ru');

            # Start first item

            $item = $rss->createItem()
                        ->setIsTurbo(true)
                        ->setTitle('Article title')
                        ->setLink('/link-article');

            //        $item->addYandexRelated('/link-article', 'Article title', '/path-to-image-preview');

            $turboContent = $item->createTurboContent();

            $turboContent->setTitle('Header H1');

            $slider = (new Slider('landscape', 'contain'))
                ->setHeader('asdasd');

            $slider->addAd('asdasd');
            $slider->addLink('asdasd');

            $turboContent->addElement($slider);

            //        $turboContent->setImage('/article-image', 'Image title');
            //        $turboContent->setSubTitle('Header H2');
            //
            //        $turboContent->addMenuLink('/', 'home');
            //        $turboContent->addMenuLink('/', 'home');
            //        $turboContent->addMenuLink('/', 'home');
            //        $turboContent->addMenuLink('/', 'home');
            //
            //        $turboContent->addBreadcrumbsLink('/', 'bread');
            //        $turboContent->addBreadcrumbsLink('/', 'bread');
            //        $turboContent->addBreadcrumbsLink('/', 'bread');
            //        $turboContent->addBreadcrumbsLink('/', 'bread');

            # End first item

            $rss->output('rss-content.xml');
        } catch (RssException $e) {
            $e->output();
        }
    }
}