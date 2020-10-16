<?php

namespace App\Parsing\DOM;

use DOMDocument;
use DOMElement;
use DOMXPath;
use Symfony\Component\CssSelector\CssSelectorConverter;

class Document extends DOMDocument
{
    /**
     * @param  string  $version
     * @param  string  $encoding
     */
    public function __construct($version = '', $encoding = '')
    {
        parent::__construct(
            $version, $encoding
        );

        $this->registerNodeClass(
            DOMElement::class, Element::class
        );
    }

    /**
     * @param  string  $source
     * @param  int  $options
     * @return bool
     */
    public function loadHTML($source, $options = 0)
    {
        libxml_use_internal_errors(true);
        $this->preserveWhiteSpace = false;
        $this->formatOutput = true;
        $result = parent::loadHTML($source, $options);
        libxml_clear_errors();
        $this->normalizeDocument();

        return $result;
    }

    /**
     * @param  string  $filename
     * @param  int  $options
     * @return bool
     */
    public function loadHTMLFile($filename, $options = 0)
    {
        libxml_use_internal_errors(true);
        $this->preserveWhiteSpace = false;
        $this->formatOutput = true;
        $result = parent::loadHTMLFile($filename, $options);
        libxml_clear_errors();
        $this->normalizeDocument();

        return $result;
    }

    /**
     * @param  string  $selector
     * @return \App\Parsing\DOM\Element|null
     */
    public function querySelector($selector)
    {
        return count($elements = $this->querySelectorAll($selector)) == 0
            ? null
            : $elements[0];
    }

    /**
     * @param  string  $selector
     * @return \App\Parsing\DOM\Element[]
     */
    public function querySelectorAll($selector)
    {
        $path = new DOMXPath($this);
        $converter = new CssSelectorConverter();
        $result = $path->query($converter->toXPath($selector));

        if ($result === false) {
            return [];
        }

        $elements = [];

        foreach ($result as $node) {
            if ($node->nodeType == XML_ELEMENT_NODE) {
                $elements[] = $node;
            }
        }

        return $elements;
    }

    /**
     * @return \App\Parsing\DOM\Element[]
     */
    public function childElements()
    {
        $elements = [];

        foreach ($this->childNodes as $node) {
            if ($node->nodeType == XML_ELEMENT_NODE) {
                $elements[] = $node;
            }
        }

        return $elements;
    }

    /**
     * @return \App\Parsing\DOM\Element|null
     */
    public function firstElementChild()
    {
        return count($elements = $this->childElements()) == 0
            ? null
            : $elements[0];
    }

    /**
     * @return \App\Parsing\DOM\Element|null
     */
    public function lastElementChild()
    {
        return ($count = count($elements = $this->childElements())) == 0
            ? null
            : $elements[$count - 1];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->saveHTML();
    }
}
