<?php

namespace TurboPage\Content\Elements\Blocks\Slider;


use DOMDocument;
use DOMElement;

class Ad extends Figure
{

    private $turboAdId;

    /**
     * Ad constructor.
     *
     * @param  string  $turboAdId
     */
    public function __construct(string $turboAdId)
    {
        $this->turboAdId = $turboAdId;
    }

    /**
     * @param  \DOMDocument  $dom
     *
     * @return \DOMElement
     */
    public function build(DOMDocument $dom): DOMElement
    {
        $figure = $dom->createElement('figure');

        $figure->setAttribute('data-turbo-ad-id', $this->turboAdId);

        return $figure;
    }

}