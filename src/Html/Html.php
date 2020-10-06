<?php


namespace Html;

use Curl\Curl;
use DOMDocument;

class Html
{

    private $urls;
    private $dom;

    public function __construct($urls)
    {
        $this->urls = $urls;
    }

    public function get()
    {
        $result = [];
        foreach ($this->urls as $url) {
            $response = (new Curl())->get($url);
            $dom = new DOMDocument();
            @$dom->loadHTML($response->response);
            $ls_ads = (new \DOMXPath($dom))->query('/html/body');
            array_push( $result, ($this->parseHtml($ls_ads->item(0))));
        }

        return $result;
    }

    public function parseHtml( $el)
    {
        $mapEl = [];
        if ($el->hasChildNodes()) {
            foreach ($el->childNodes as $node) {
                if ($node->tagName === null) {
                   continue;
                }
                $elHtml = (object) [
                    'tag' => $node->tagName
                ];
                if ($node->hasAttributes()) {
                    $elHtml->attributes = [];
                    foreach ($node->attributes as $atr) {
                        $mapId = (object) [
                            $atr->name => $atr->value
                        ];
                        array_push($elHtml->attributes, $mapId);
                    }
                }

                $child = $this->parseHtml($node);
                if (!empty($child)) {
                    $elHtml->child = $child;
                }
                array_push($mapEl, $elHtml);
            }
        }
        return $mapEl;
    }

}
