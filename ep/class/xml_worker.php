<?php

namespace easypay {

    class XmlWorker {

        public function formatToXml($array)
        {
            $result = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<Response>";

            foreach ($array as $arrKey => $arrValue) {
                if(is_array($arrValue)) {
                    $result .= "\n\t<" . $arrKey . ">";
                    foreach ($arrValue as $key => $value) {
                        $result .= "\n\t\t<".$key.">".$value."</".$key.">";
                    }
                    $result .= "\n\t</" . $arrKey . ">";
                } else {
                    $result .= "\n\t<".$arrKey.">".$arrValue."</".$arrKey.">";
                }
            }

            return XmlWorker::tab2space($result . "\n</Response>");
        }

        public function getValueByTag($xmlArray, $tag)
        {
            foreach ($xmlArray as $xml) {
                if($xml['tag'] == strtoupper($tag))
                    return $xml['value'];
            }
        }

        public function xmlToArray($inXmlset)
        {
            $resource    =    xml_parser_create();
            xml_parse_into_struct($resource, $inXmlset, $outArray);

            xml_parser_free($resource);
            unset($resource);

            return $outArray;
        }

        private function tab2space($text, $spaces = 2)
        {
            $lines = explode("\n", $text);
            foreach ($lines as $line)
            {        
                while (false !== $tab_pos = strpos($line, "\t"))
                {
                    $start = substr($line, 0, $tab_pos);
                    $tab = str_repeat(' ', $spaces - $tab_pos % $spaces);
                    $end = substr($line, $tab_pos + 1);
                    $line = $start . $tab . $end;
                }
                $result[] = $line;
            }
            return implode("\n", $result);
        }
    }
}
