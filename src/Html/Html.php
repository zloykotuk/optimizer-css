<?php


namespace Html;

use Curl\Curl;
use DOMDocument;

class Html
{

    private $url;
    private $dom;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function get()
    {
        $response = (new Curl())->get($this->url);
        $dom = new DOMDocument();
        @$dom->loadHTML($response->response);
        $xpath = new \DOMXPath($dom);
//        $ls_ads = $xpath->query('/html/body');
        $ls_ads = $xpath->query('/html/body/header/div/div/div[1]');
        return ($this->parseHtml($ls_ads->item(0)));
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
