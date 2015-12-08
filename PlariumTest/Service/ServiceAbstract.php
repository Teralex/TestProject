<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServiceAbstract
 *
 * @author ПК
 */
class ServiceAbstract {

    protected $strings = array();

    public function __construct($input) {
        if (is_array($input)) {
            foreach ($input as $value) {

                $this->strings[] = trim(mb_strtolower($value, 'UTF-8'));
            }
        } else {
            $this->strings = trim(mb_strtolower($input, 'UTF-8'));
        }
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
