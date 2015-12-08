<?php

class Finder extends ServiceAbstract {

    public function CheckWords() {
        $allWords = $this->GetAllWords($this->strings);
        echo '<PRE>';
        //var_dump(array_unique($allWords));
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

}
