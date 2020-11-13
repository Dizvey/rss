<?php


namespace TurboPage\Content;

use DOMDocument;
use DOMElement;
use Exception;
use TurboPage\Content\Elements\Element;
use stdClass;

class TurboContent extends Element
{
    private $title;
    private $subTitle;
    private $image;
    private $menu = [];
    private $breadcrumbs = [];
    private $elements = [];

    public function __construct()
    {
        $this->image = new stdClass();
        $this->image->src = null;
        $this->image->alt = null;
    }

    /**
     * @param $dom
     * @return DOMElement
     * @throws Exception
     */
    public function build(DOMDocument $dom) : DOMElement {

        $cData = $dom->createElement('cdata');

        $header = $this->getHeader($dom);
        $cData->appendChild($header);

        /** @var Element $element */
        foreach ($this->elements as $element) {
            $cData->appendChild($element->build($dom));
        }

//        $cData->appendChild($callbackButton);
//        $cData->appendChild($widgetFeedback);

        $cDataToString = $this->getNodesToString($cData->childNodes);

        $cDataSectionItem = $dom->createCDATASection($cDataToString . '$text');

        $turboContent = $dom->createElement('turbo:content');
       $turboContent->appendChild($cData);
        // $turboContent->appendChild($cDataSectionItem);

        return $turboContent;
    }

    /**
     * @param $dom
     * @return DOMElement|false
     * @throws Exception
     */
    private function getHeader(DOMDocument $dom) : DOMElement {
        $header = $dom->createElement('header');

        if ($this->title) {
            $title = $dom->createElement('h1', $this->title);

            $header->appendChild($title);
        } else {
            throw new Exception('A title is required for that header.');
        }

        if ($this->image->src) {
            $figure = $dom->createElement('figure');

            $image = $dom->createElement('img');
            $image->setAttribute('src', $this->image->src);

            $figure->appendChild($image);

            if ($this->image->alt) {
                $figcaption = $dom->createElement('figcaption', $this->image->alt);

                $figure->appendChild($figcaption);
            }

            $header->appendChild($figure);
        }

        if ($this->subTitle) {
            $subTitle = $dom->createElement('h2', $this->subTitle);

            $header->appendChild($subTitle);
        }

        if ($this->menu) {

            $menu = $dom->createElement('menu');

            foreach ($this->menu as $menuLink) {
                $menuLinkTag = $dom->createElement('a', $menuLink->title);
                $menuLinkTag->setAttribute('href', $menuLink->href);

                $menu->appendChild($menuLinkTag);
            }

            $header->appendChild($menu);
        }

        if ($this->breadcrumbs) {

            $breadcrumb = $dom->createElement('div');
            $breadcrumb->setAttribute('data-block', 'breadcrumblist');

            foreach ($this->breadcrumbs as $breadcrumbLink) {
                $breadcrumbLinkTag = $dom->createElement('a', $breadcrumbLink->title);
                $breadcrumbLinkTag->setAttribute('href', $breadcrumbLink->href);

                $breadcrumb->appendChild($breadcrumbLinkTag);
            }

            $header->appendChild($breadcrumb);
        }

        return $header;
    }

    /**
     * @param  string  $src
     * @param  string  $alt
     *
     * @return \TurboPage\Content\TurboContent
     */
    public function setImage(string $src, string $alt = '') : TurboContent {
        $this->image->src = $src;
        $this->image->alt = $alt;

        return $this;
    }

    /**
     * @param  string  $href
     * @param  string  $title
     *
     * @return \TurboPage\Content\TurboContent
     */
    public function addMenuLink(string $href, string $title = '') : TurboContent {
        $menuLink = new stdClass();

        $menuLink->href = $href;
        $menuLink->title = $title ? $title : $href;

        $this->menu[] = $menuLink;

        return $this;
    }

    /**
     * @param  string  $href
     * @param  string  $title
     *
     * @return \TurboPage\Content\TurboContent
     */
    public function addBreadcrumbsLink(string $href, string $title = '') : TurboContent {
        $breadcrumbLink = new stdClass();

        $breadcrumbLink->href = $href;
        $breadcrumbLink->title = $title ? $title : $href;

        $this->breadcrumbs[] = $breadcrumbLink;

        return $this;
    }

    /**
     * @param  string  $title
     *
     * @return \TurboPage\Content\TurboContent
     */
    public function setTitle(string $title): TurboContent
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param  string  $subTitle
     *
     * @return \TurboPage\Content\TurboContent
     */
    public function setSubTitle(string $subTitle): TurboContent
    {
        $this->subTitle = $subTitle;

        return $this;
    }

    /**
     * @param  \TurboPage\Content\Elements\Element  ...$element
     *
     * @return \TurboPage\Content\TurboContent
     */
    public function addElement(Element ...$element): TurboContent
    {
        $this->elements += $element;

        return $this;
    }
}