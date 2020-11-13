<?php


namespace TurboPage\Content\Elements;


use DOMDocument;
use DOMElement;

interface ElementInterface
{
    public function build(DOMDocument $dom) : DOMElement;
}