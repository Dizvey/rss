<?php

namespace TurboPage\Content\Elements\Blocks\Slider;


use DOMDocument;
use DOMElement;

class Link extends Figure
{

    private $title;
    private $link;

    /**
     * Link constructor.
     *
     * @param  string  $link
     * @param  string|null  $title
     */
    public function __construct(string $link, ?string $title = null)
    {
        $this->link = $link;
        $this->title = $title ? $title : $link;
    }

    /**
     * @param  \DOMDocument  $dom
     *
     * @return \DOMElement
     */
    public function build(DOMDocument $dom): DOMElement
    {
        $figure = parent::build($dom);

        $link = $dom->createElement('a', $this->title);

        $link->setAttribute('href', $this->link);

        $figure->appendChild($link);

        return $figure;
    }

}