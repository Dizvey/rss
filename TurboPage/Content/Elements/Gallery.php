<?php


namespace TurboPage\Content\Elements;


use DOMDocument;
use DOMElement;
use Exception;

class Gallery extends Element
{

    private $images = [];
    private $header = '';

    /**
     * @param  DOMDocument  $dom
     * @return DOMElement
     * @throws Exception
     */
    public function build(DOMDocument $dom): DOMElement
    {
        if (empty($this->images)) {
            throw new Exception('A image is required for that Gallery.');
        }

        $gallery = $dom->createElement('div');
        $gallery->setAttribute('data-block', 'gallery');

        foreach ($this->images as $link) {
            $image = $dom->createElement('img');
            $image->setAttribute('src', $link);

            $gallery->appendChild($image);
        }

        if ($this->header) {
            $header = $dom->createElement('header', $this->header);

            $gallery->appendChild($header);
        }

        return $gallery;
    }

    /**
     * @param  string  $imageLink
     * @return Gallery
     */
    public function addImage(string $imageLink): Gallery
    {
        $this->images[] = $imageLink;

        return $this;
    }

    /**
     * @param  string  $header
     * @return Gallery
     */
    public function setTitle(string $header): Gallery
    {
        $this->header = $header;

        return $this;
    }
}