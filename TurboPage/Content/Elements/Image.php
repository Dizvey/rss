<?php


namespace TurboPage\Content\Elements;


use DOMDocument;
use DOMElement;
use Exception;

class Image extends Element
{

    private $image = '';
    private $title = '';

    /**
     * @param  DOMDocument  $dom
     * @return DOMElement
     * @throws Exception
     */
    public function build(DOMDocument $dom): DOMElement
    {
        if (empty($this->image)) {
            throw new Exception('A src is required for that Image.');
        }

        $figure = $dom->createElement('figure');

        $image = $dom->createElement('img');
        $image->setAttribute('src', $this->image);

        $figure->appendChild($image);

        if ($this->title) {
            $figcaption = $dom->createElement('figcaption', $this->title);

            $figure->appendChild($figcaption);
        }

        return $figure;
    }

    /**
     * @param  string  $image
     * @return Image
     */
    public function setImage(string $image): Image
    {
        $this->$image = $image;

        return this;
    }

    /**
     * @param  string  $title
     * @return Image
     */
    public function setTitle(string $title): Image
    {
        $this->title = $title;

        return this;
    }
}