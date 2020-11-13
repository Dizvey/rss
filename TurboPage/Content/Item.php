<?php


namespace TurboPage\Content;


use DateTime;
use DOMDocument;
use DOMElement;
use Exception;

class Item
{
    /**
     * @var bool
     */
    private $isTurbo = true;

    /**
     * @var string
     */
    private $title = '';

    /**
     * @var string
     */
    private $link = '';

    /**
     * @var string
     */
    private $turboSource = '';

    /**
     * @var string
     */
    private $turboTopic = '';

    /**
     * @var string
     */
    private $pubDate = '';

    /**
     * @var string
     */
    private $author = '';

    /**
     * @var array
     */
    private $yandexRelatedLinks = [];

    /**
     * @var bool
     */
    private $yandexRelatedInfinity = false;

    /**
     * @var TurboContent
     */
    private $turboContent = null;

    /**
     * @param  DOMDocument  $dom
     * @return DOMElement
     * @throws Exception
     */
    public function build(DOMDocument $dom): DOMElement
    {
        $item = $dom->createElement('item');
        $item->setAttribute('turbo', $this->isTurbo ? 'true' : 'false');

        if ($this->link) {
            $link = $dom->createElement('link', $this->link);
            $item->appendChild($link);
        } else {
            throw new Exception('A link is required for that item.');
        }

        if ($this->title) {
            $title = $dom->createElement('title', $this->title);
            $item->appendChild($title);
        }

        if ($this->turboSource) {
            $turboSource = $dom->createElement('turbo:source', $this->turboSource);
            $item->appendChild($turboSource);
        }

        if ($this->turboTopic) {
            $turboTopic = $dom->createElement('turbo:topic', "Турбо {$this->turboTopic}");
            $item->appendChild($turboTopic);
        }

        if ($this->pubDate) {
            $pubDateToTime = strtotime($this->pubDate);
            $pubDate = new DateTime($pubDateToTime);
            $pubDateFormatted = $pubDate->format(DateTime::RFC822);

            $pubDateItem = $dom->createElement('pubDate', $pubDateFormatted);
            $item->appendChild($pubDateItem);
        }

        if ($this->author) {
            $author = $dom->createElement('author', $this->author);
            $item->appendChild($author);
        }

        if ($this->turboContent) {
            $turboContent = $this->turboContent->build($dom);

            $item->appendChild($turboContent);
        } else {
            throw new Exception('A cData is required for that turbo:content.');
        }

        if ($this->yandexRelatedLinks) {
            $yandexRelatedItem = $dom->createElement('yandex:related');

            if ($this->yandexRelatedInfinity) {
                $yandexRelatedItem->setAttribute('type', 'infinity');
            }

            /** @var YandexRelatedLink $yandex_related_link */
            foreach ($this->yandexRelatedLinks as $yandex_related_link) {
                $yandexRelatedLinkItem = $dom->createElement('link', $yandex_related_link->getTitle());

                $yandexRelatedLinkItem->setAttribute('url', $yandex_related_link->getUrl());

                $yandexRelatedLinkItem->setAttribute('img', $yandex_related_link->getImg());

                $yandexRelatedItem->appendChild($yandexRelatedLinkItem);
            }

            $item->appendChild($yandexRelatedItem);
        }

        return $item;
    }

    /**
     * @param  string  $title
     *
     * @return \TurboPage\Content\Item
     */
    public function setTitle(string $title): Item
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param  bool  $isTurbo
     *
     * @return \TurboPage\Content\Item
     */
    public function setIsTurbo(bool $isTurbo): Item
    {
        $this->isTurbo = $isTurbo;

        return $this;
    }

    /**
     * @param  string  $link
     *
     * @return \TurboPage\Content\Item
     */
    public function setLink(string $link): Item
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @param  string  $turboSource
     *
     * @return \TurboPage\Content\Item
     */
    public function setTurboSource(string $turboSource): Item
    {
        $this->turboSource = $turboSource;

        return $this;
    }

    /**
     * @param  string  $turboTopic
     *
     * @return \TurboPage\Content\Item
     */
    public function setTurboTopic(string $turboTopic): Item
    {
        $this->turboTopic = $turboTopic;

        return $this;
    }

    /**
     * @param  string  $pubDate
     *
     * @return \TurboPage\Content\Item
     */
    public function setPubDate(string $pubDate): Item
    {
        $this->pubDate = $pubDate;

        return $this;
    }

    /**
     * @param  string  $author
     *
     * @return \TurboPage\Content\Item
     */
    public function setAuthor(string $author): Item
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @param  string  $url
     * @param  string  $title
     * @param  string  $img
     *
     * @return \TurboPage\Content\Item
     */
    public function addYandexRelated(string $url, string $title, string $img) : Item
    {
        $this->yandexRelatedLinks[] = new YandexRelatedLink($url, $title, $img);

        return $this;
    }

    /**
     * @param  bool  $yandexRelatedInfinity
     *
     * @return \TurboPage\Content\Item
     */
    public function setYandexRelatedInfinity(bool $yandexRelatedInfinity): Item
    {
        $this->yandexRelatedInfinity = $yandexRelatedInfinity;

        return $this;
    }

    /**
     * @return TurboContent
     */
    public function createTurboContent(): TurboContent
    {
        if ($this->turboContent) {
            return $this->turboContent;
        }

        return $this->turboContent = new TurboContent();
    }
}