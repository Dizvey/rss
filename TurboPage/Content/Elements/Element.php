<?php


namespace TurboPage\Content\Elements;


use DOMDocument;
use DOMNodeList;

abstract class Element implements ElementInterface
{
    public function getNodesToString(DomNodeList $nodes) : string {
        $dom = new DOMDocument('2.0');
        $dom->encoding = 'utf-8';


        foreach ($nodes as $node) {

            $node_cloned = $node->cloneNode(TRUE);
            $node_imported = $dom->importNode($node_cloned,TRUE);

            $dom->appendChild($node_imported);
        }

        $domToString = $dom->saveHTML();

        // Translation of special characters into Russian characters
        return html_entity_decode($domToString);
    }
}