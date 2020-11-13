<?php

namespace TurboPage\Content\Elements\Blocks\Slider;


use DOMDocument;
use DOMElement;

class Image extends Figure
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
        $figure = parent::build($dom);

        $source = $dom->createElement('source');

        $source->setAttribute('src', $this->src);
        $source->setAttribute('type', $this->type);
        $source->setAttribute('data-duration', $this->duration);
        $source->setAttribute('data-title', $this->title);
        //        $figure->appendChild();

        return $figure;
    }

}
