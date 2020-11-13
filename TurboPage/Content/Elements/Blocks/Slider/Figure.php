<?php

namespace TurboPage\Content\Elements\Blocks\Slider;


use DOMDocument;
use DOMElement;
use TurboPage\Content\Elements\Element;

class Figure extends Element
{

    /**
     * @param  \DOMDocument  $dom
     *
     * @return \DOMElement
     */
    public function build(DOMDocument $dom): DOMElement
    {
        return $dom->createElement('figure');
    }
}
