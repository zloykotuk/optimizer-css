<?php


namespace Html;


use Curl\Curl;
use DOMDocument;
use DOMXPath;

class UrlParser
{

    private $baseUrl;
    private $arrayUrls = [];
    private $format = ['.jpeg', '.jpg', '.png', '.webp', '.pdf'];

    public function __construct($baseUrl)
    {
        if ($baseUrl[strlen($baseUrl) - 1] === '/') {
            $baseUrl = substr($baseUrl, 0, strlen($baseUrl) - 1);
        }

        $this->baseUrl = $baseUrl;
    }


    public function getAllUrls()
    {
        $this->findUrlsInPage($this->baseUrl);
        sleep(1);
        $lengthArrayLast = 0;
        $lengthArray = count($this->arrayUrls);

        while ($lengthArrayLast != $lengthArray) {

            for ($i = $lengthArrayLast; $i < $lengthArray; $i++) {
                $this->findUrlsInPage($this->arrayUrls[$i]);
            }

            $lengthArrayLast = $lengthArray;
            $lengthArray = count($this->arrayUrls);
        }

        echo "[";
        foreach ($this->arrayUrls as $url) {
            echo "\"";
            echo $url;
            echo "\"\n";
        }
        echo "]";

//        return $this->arrayUrls;

    }

    public function findUrlsInPage($url)
    {
        $response = (new Curl())->get($url);
        $dom = new DOMDocument();
        @$dom->loadHTML($response->response);
        foreach ($dom->getElementsByTagName('a') as $el) {
            if ($el->hasAttributes()) {
                foreach ($el->attributes as $atr) {
                    if (isset($atr->name) && isset($atr->value) && is_string($atr->value)) {
                        if ($atr->name === 'href') {

                            $tmp = $atr->value;

                            if ($tmp[0] === '/') {
                                $tmp = $this->baseUrl . $tmp;
                            }
                            if ($tmp[strlen($tmp) - 1] === '/') {
                                $tmp = substr($tmp, 0, strlen($tmp) - 1);
                            }

                            if ($atr->value != '#' && !in_array($tmp, $this->arrayUrls) && preg_match('/^(http|https):\/\/deutscher-fenstershop\.de.+/', $tmp) && !$this->strpos_arr($tmp, $this->format)) {
                                array_push($this->arrayUrls, $tmp);
                            }
                        }
                    }
                }
            }
        }
    }

    private function strpos_arr($haystack, $needle)
    {
        if (!is_array($needle)) {
            $needle = array($needle);
        }
        foreach ($needle as $what) {
            if (($pos = strpos($haystack, $what)) !== false) {
                return $pos;
            }
        }
        return false;
    }
}
