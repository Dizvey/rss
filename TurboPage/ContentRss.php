<?php


namespace TurboPage;


use DOMImplementation;
use TurboPage\Content\Item;

class ContentRss
{

    private $title = '';
    private $link = '';
    private $description = '';
    private $turboAnalytics = '';
    private $language = 'ru';

    private $items = [];

    public function output($filename = null)
    {
        $implementation = new DOMImplementation();
        $dom            = $implementation->createDocument();
        $dom->encoding  = 'UTF-8';

        $rss = $dom->createElement('rss');
        $rss->setAttribute('xmlns:yandex', 'http://news.yandex.ru');
        $rss->setAttribute('xmlns:media', "http://search.yahoo.com/mrss/");
        $rss->setAttribute('xmlns:turbo', "http://turbo.yandex.ru");
        $rss->setAttribute('version', '2.0');
        $dom->appendChild($rss);

        $channel = $dom->createElement('channel');
        $rss->appendChild($channel);

        if ($this->title) {
            $title = $dom->createElement('title', $this->title);
            $channel->appendChild($title);
        }

        if ($this->link) {
            $link = $dom->createElement('link', $this->link);
            $channel->appendChild($link);
        }

        if ($this->description) {
            $description =
                $dom->createElement('description', $this->description);
            $channel->appendChild($description);
        }

        if ($this->language) {
            $language = $dom->createElement('language', $this->language);
            $channel->appendChild($language);
        }

        if ($this->turboAnalytics) {
            $turboAnalytics = $dom->createElement('turbo:analytics',
                $this->turboAnalytics);
            $channel->appendChild($turboAnalytics);
        }

        $error = false;
        /** @var Item $item */
        foreach ($this->items as $item) {
            $xml = $item->build($dom);
            $channel->appendChild($xml);
        }

        if ($filename) {
            $dom->save($filename);

            header('Content-type: application/xml');
            header("Content-Disposition: inline; filename=".$filename);
            readfile($filename);
        } else {
            return $dom->saveXML();
        }
    }

    /**
     * @param  string  $title
     *
     * @return \TurboPage\ContentRss
     */
    public function setTitle(string $title): ContentRss
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param  string  $link
     *
     * @return \TurboPage\ContentRss
     */
    public function setLink(string $link): ContentRss
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @param  string  $language
     *
     * @return \TurboPage\ContentRss
     */
    public function setLanguage(string $language): ContentRss
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return Item
     */
    public function createItem(): Item
    {
        return $this->items[] = new Item();
    }

    /**
     * @param  string  $description
     *
     * @return \TurboPage\ContentRss
     */
    public function setDescription(string $description): ContentRss
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param  string  $turboAnalytics
     *
     * @return \TurboPage\ContentRss
     */
    public function setTurboAnalytics(string $turboAnalytics): ContentRss
    {
        $this->turboAnalytics = $turboAnalytics;

        return $this;
    }

}