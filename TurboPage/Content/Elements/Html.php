<?php


namespace TurboPage\Content\Elements;


use DOMDocument;
use DOMElement;
use Exception;

class Html extends Element
{
    private $src = '';
    private $type = 'video/mp4';
    private $dataDuration = '';
    private $dataTitle = '';

    private $width = 0;
    private $height = 0;

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
            throw new Exception('A preview is required for that Video.');
        }

        if (empty($this->src)) {
            throw new Exception('A src is required for that Video.');
        }

        if (empty($this->type)) {
            throw new Exception('A type is required for that Video.');
        }

        $figure = $dom->createElement('figure');

        $video = $dom->createElement('video');

        if ($this->width) {
            $video->setAttribute('width', $this->width);
        }

        if ($this->height) {
            $video->setAttribute('height', $this->height);
        }

        $source = $dom->createElement('source');
        $source->setAttribute('src', $this->src);
        $source->setAttribute('type', $this->type);

        if ($this->dataDuration) {
            $source->setAttribute('data-duration', $this->dataDuration);
        }

        if ($this->dataTitle) {
            $source->setAttribute('data-title', $this->dataTitle);
        }

        $video->appendChild($source);

        $figure->appendChild($video);

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
     * @return Video
     */
    public function setImage(string $image): Video
    {
        $this->$image = $image;

        return $this;
    }

    /**
     * @param  string  $title
     * @return Video
     */
    public function setTitle(string $title): Video
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param  int  $height
     * @return Video
     */
    public function setHeight(int $height): Video
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @param  int  $width
     * @return Video
     */
    public function setWidth(int $width): Video
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @param  string  $dataTitle
     * @return Video
     */
    public function setDataTitle(string $dataTitle): Video
    {
        $this->dataTitle = $dataTitle;

        return $this;
    }

    /**
     * @param  string  $dataDuration
     * @return Video
     */
    public function setDataDuration(string $dataDuration): Video
    {
        $this->dataDuration = $dataDuration;

        return $this;
    }

    /**
     * @param  string  $type
     * @return Video
     */
    public function setType(string $type): Video
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param  string  $src
     * @return Video
     */
    public function setSrc(string $src): Video
    {
        $this->src = $src;

        return $this;
    }
}