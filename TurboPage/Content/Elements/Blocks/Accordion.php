<?php

namespace TurboPage\Content\Elements\Blocks;


use DOMDocument;
use DOMElement;
use Exception;
use stdClass;
use TurboPage\Content\Elements\Element;


class Accordion extends Element
{
    private $accordion = [];

    public function build(DOMDocument $dom): DOMElement
    {
        $accordion = $dom->createElement('div');
        $accordion->setAttribute('data-block', 'accordion');

        /** @var stdClass $item */
        foreach ($this->accordion as $question) {
            $item = $dom->createElement('div');
            $item->setAttribute('data-block', 'item');
            $item->setAttribute('data-title', $question->question);
            $item->setAttribute('data-expanded', $question->expanded ? 'true': 'false');

            $p = $dom->createElement('p', $question->answer);

            $item->appendChild($p);

            $accordion->appendChild($item);
        }

        return $accordion;
    }

    /**
     * @param  string  $question
     * @param  string  $answer
     * @param  bool  $expanded
     *
     * @return $this
     */
    public function addItem(string $question, string $answer, bool $expanded = false) : Accordion {

        $item = new stdClass();

        $item->question = $question;
        $item->answer = $answer;
        $item->expanded = $expanded;

        $this->accordion[] = $item;

        return $this;
    }
}