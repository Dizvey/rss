<?php

namespace TurboPage\Content\Elements\Blocks\Slider;


use DOMDocument;
use DOMElement;
use Helpers\Validate;
use TurboPage\Content\Elements\Element;


class Slider extends Element
{

    private $slides = [];

    private $view = '';
    private $itemView = '';

    private $header = '';

    /**
     * Slider constructor.
     *
     * @param  string  $view
     * @param  string  $itemView
     *
     * @throws \Exceptions\RssException
     */
    public function __construct(
        string $view = 'landscape',
        string $itemView = 'contain'
    ) {
        Validate::inArray('data-view', $view,
            ['landscape', 'portrait', 'square']);

        $this->view = $view;

        Validate::inArray('data-item-view', $itemView, ['contain', 'cover']);

        $this->itemView = $itemView;
    }

    /**
     * @param  \DOMDocument  $dom
     *
     * @return \DOMElement
     * @throws \Exception
     */
    public function build(DOMDocument $dom): DOMElement
    {
        $slider = $dom->createElement('div');

        $slider->setAttribute('data-block', 'slider');
        $slider->setAttribute('data-view', $this->view);
        $slider->setAttribute('data-item-view', $this->itemView);

        foreach ($this->slides as $figure) {
            if ($figure instanceof Figure)
            {
                $slide = $figure->build($dom);
                $slider->appendChild($slide);
            }
        }

        return $slider;
    }

    public function setHeader(string $header): Slider
    {
        $this->header = $header;

        return $this;
    }

    public function addVideo(): Video
    {
        return $this->slides[] = new Video();
    }

    public function addImage(): Image
    {
        return $this->slides[] = new Image();
    }

    public function addLink(string $link, ?string $title = null): Link
    {
        return $this->slides[] = new Link($link, $title);
    }

    public function addAd(string $turboAdId): Ad
    {
        return $this->slides[] = new Ad($turboAdId);
    }

    public function addSlide(Figure $figure): Figure
    {
        return $this->slides[] = $figure;
    }

}