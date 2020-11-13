<?php


namespace TurboPage\Content\Elements;


use DOMDocument;
use DOMElement;
use Exception;

class Table extends Element
{
    private $theed = [];
    private $tbody = [];

    /**
     * @param  DOMDocument  $dom
     * @return DOMElement
     * @throws Exception
     */
    public function build(DOMDocument $dom): DOMElement
    {
        if (empty($this->theed) && empty($this->tbody)) {
            throw new Exception('A data is required for that Table.');
        }

        $table = $dom->createElement('table');

        if (!empty($this->theed)) {
            $theed = $dom->createElement('thead');
            $tr = $dom->createElement('tr');

            foreach ($this->theed as $title) {
                $th = $dom->createElement('th', $title);
                $tr->appendChild($th);
            }

            $theed->appendChild($tr);

            $table->appendChild($theed);
        }

        if (!empty($this->tbody)) {
            $tbody = $dom->createElement('tbody');

            foreach ($this->tbody as $row) {

                $tr = $dom->createElement('tr');

                foreach ($row as $value) {
                    $td = $dom->createElement('th', $value);
                    $tr->appendChild($td);
                }

                $tbody->appendChild($tr);
            }

            $table->appendChild($tbody);
        }

        return $table;
    }

    /**
     * @param  string  $ths
     * @return Table
     */
    public function setHead(...$ths): Table
    {
        $this->theed = $ths;

        return $this;
    }

    /**
     * @param  string  $tds
     * @return Table
     */
    public function addRow(...$tds): Table
    {
        $this->tbody[] = $tds;

        return $this;
    }
}