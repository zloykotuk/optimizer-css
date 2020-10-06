<?php


namespace Html;
use Sabberworm\CSS\OutputFormat;
use Sabberworm\CSS\Parser;

class CSS
{

    public $searched = false;

    public function parse($path, $arrayUrls)
    {
        $css = (new Parser(file_get_contents($path)))->parse();
        $htmlArrays = (new Html($arrayUrls))->get();

        foreach($css->getAllDeclarationBlocks() as $oBlock) {
            foreach($oBlock->getSelectors() as $oSelector) {
                $array = preg_split('/ /', $oSelector);

                // Filter css style

                foreach ($array as &$value) {

                    //Delete ":" from css selector
                    if(strpos($value, ":")) {
                        $deg = strpos($value, ":");
                        $value = substr($value, 0, strpos($value, ":"));
                    }

                    // .md - reformat class
                    if($value[0] === '.'){
                        $str = substr($value, 1, strlen($value));
                        $value = ['class' => str_replace('.',' ',$str)];
                    }

                    // #md - reformat id
                    if($value[0] === '#'){
                        $str = substr($value, 1, strlen($value));
                        $value = ['id' => str_replace('#',' ',$str)];
                    }
                }
                unset($value);
                $this->searched = false;

                foreach ($array as $value) {

                    foreach ($htmlArrays as $htmlArray) {
                        if (is_array($value)) {
                            foreach ($value as $searchTag => $searchValue){
                                $this->searchCssInHtml($htmlArray, $searchValue, $searchTag);
                            }
                        } else {
                            $this->searchCssInHtml($htmlArray, $value, 'tag');
                        }
                    }
                }

                if (!$this->searched) {
                    $css->remove($oBlock);
                }

            }
        }
        $oFormat = OutputFormat::create()->indentWithSpaces(4)->setSpaceBetweenRules("\n");
        print_r($css->render($oFormat));
    }

    public function searchCssInHtml($array, $searchValue, $searchTag)
    {
        foreach ($array as $key => $value) {
            if ($searchTag === 'tag' && $value->tag == $searchValue) {
                $this->searched = true;
            }

            if ($searchTag === 'class') {
                if (isset($value->attributes)) {
                    foreach ($value->attributes as $attributeValue) {
                        if (isset($attributeValue->class)) {
                            if (strpos($attributeValue->class, $searchValue) !== false) {
                                $this->searched = true;
                            }
                        }
                    }
                }
            }

            if ($searchTag === 'id') {
                if (isset($value->attributes)) {
                    foreach ($value->attributes as $attributeValue) {
                        if (isset($attributeValue->id)) {
                            if (strpos($attributeValue->id, $searchValue) !== false) {
                                $this->searched = true;
                            }
                        }
                    }
                }
            }

            if(is_array($value->child)) {
                $this->searchCssInHtml($value->child, $searchValue, $searchTag);
            }
        }
    }

}
