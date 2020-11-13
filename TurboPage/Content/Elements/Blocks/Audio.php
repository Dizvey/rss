<?php

namespace TurboPage\Content\Elements\Blocks;


use DOMDocument;
use DOMElement;
use Exception;
use TurboPage\Content\Elements\Element;


class Audio extends Element
{
    private $src = '';

    public function __construct($src)
    {
        $this->src = $src;
    }

    /**
     * @param  \DOMDocument  $dom
     *
     * @return \DOMElement
     * @throws \Exception
     */
    public function build(DOMDocument $dom): DOMElement
    {
        $audio = $dom->createElement('div');

        $audio->setAttribute('data-block', 'audio');
        $audio->setAttribute('src', $this->src);

        return $audio;
    }
}