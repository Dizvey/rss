<?php

namespace Exceptions;

use Exception;

class RssException extends Exception
{

    public function output()
    {
        $style_block = "style=\"padding: 15px 20px; border: 1px solid #a43a3a; margin-bottom: 10px\"";
        $style = "style=\"color: #5f5f5f; font-size: 0.8em; margin-top: 5px\"";

        $dir = str_replace('/', '\\', $_SERVER['DOCUMENT_ROOT']).'\\';

        $message = $this->getMessage();

        $output_string = '';
        $output_string .= "<div>{$message}</div>";

        foreach ($this->getTrace() as $trace) {
            $file = str_replace($dir, '', $trace['file']);
            $output_string .= "<div {$style}>{$file} : {$trace['line']}</div>";
        }

        echo "<div {$style_block}>{$output_string}</div>";

        exit(0);
    }

}