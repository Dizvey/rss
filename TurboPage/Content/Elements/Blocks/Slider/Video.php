<?php

namespace TurboPage\Content\Elements\Blocks\Slider;


use DOMDocument;
use DOMElement;
use Helpers\Validate;
use TurboPage\Content\Elements\Element;


class Video extends Figure
{

    private $width = 0;
    private $height = 0;
    private $preview = '';
    private $figcaption = '';
    private $src = "";
    private $type = "";
    private $duration = "";
    private $title = "";

    public function build(DOMDocument $dom): DOMElement
    {
        $figure = $dom->createElement('figure');

        $source = $dom->createElement('source');

        $source->setAttribute('src', $this->src);
        $source->setAttribute('type', $this->type);
        $source->setAttribute('data-duration', $this->duration);
        $source->setAttribute('data-title', $this->title);
        //        $figure->appendChild();
    }

}