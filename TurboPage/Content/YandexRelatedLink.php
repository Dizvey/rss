<?php


namespace TurboPage\Content;


class YandexRelatedLink
{
    private $url = null;
    private $img = null;
    private $title = null;

    public function __construct($url, $title, $img = null)
    {
        $this->url = $url;
        $this->title = $title;
        $this->img = $img;
    }

    /**
     * @return null
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed|null
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @return null
     */
    public function getTitle()
    {
        return $this->title;
    }
}