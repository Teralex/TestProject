<?php

class Finder {

    protected $strings = array();

    public function __construct($input) {
        foreach ($input as $value) {

            $this->strings[] = trim(mb_strtolower($value, 'UTF-8'));
        }
    }

    public function CheckWords() {
        $allWords = $this->GetAllWords($this->strings);
        $count = array_count_values($allWords);

        foreach ($count as $key => $value) {
            if ($value > 1) {
                $result[$key] = $value;
            }
        }
        $result[] = $this->AdvancedSearch(array_keys($result));
        return $result;
    }

    protected function AdvancedSearch($words = array()) {
        $count = 0;
        foreach ($this->strings as $value) {
            for ($index = 0; $index < count($words); $index++) {

                $check[$index] = (strstr($value, $words[$index]) != FALSE) ? TRUE : FALSE;
            }
            echo '<PRE>';
            var_dump(($check));
            if (count(array_unique($check)) == 1) {
                $count++;
            }
        }
        return $count;
    }

    protected function GetAllWords($strings) {
        $text = '';
        foreach ($strings as $value) {
            $text .= empty($text) ? $value : ' ' . $value;
        }
        $AllWords = explode(' ', $text);
        return $AllWords;
    }

}
