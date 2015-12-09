<?php

class Finder {

    protected $strings = array();

    public function __construct($input) {
        $this->strings = explode("\n", mb_strtolower($input));
    }

    public function CheckWords() {
        $allWords = $this->GetAllWords($this->strings);
        $count = array_count_values($allWords);

        foreach ($count as $key => $value) {

            if ($value > 1) {

                $result[$key] = $value;
            }
        }

        $result = array_merge($result, $this->AdvancedSearch(array_keys($result)));
        return $result;
    }

    protected function AdvancedSearch($words = array()) {
        $count = 0;

        $all = implode(' ', $words);
        foreach ($this->strings as $string) {
            $str = explode(' ', $string);
            foreach ($words as $word) {
                $check[$word] = in_array($word, $str);
            }
            if (count(array_unique($check)) == 1) {
                $count++;
            }
        }
        $result[$all] = $count;
        return $result;
    }

    protected function GetAllWords($strings) {
        $text = '';
        foreach ($strings as $string) {
            $text .= empty($text) ? trim($string) : ' ' . trim($string);
        }
        $AllWords = explode(' ', trim($text));
        return $AllWords;
    }

}
