<?php

class Config {

    /**
     * @var array $declinations
     * Contain declination rules by endings and sex
     */
    protected $declinations = array(
        'ка' => array(
            'м' => 'first',
            'ж' => 'first'
        ),
        'а' => array(
            'м' => 'first',
            'ж' => 'first'
        ),
        'я' => array(
            'м' => 'first',
            'ж' => 'first'
        ),
        'ь' => array(
            'м' => 'second',
            'ж' => 'third'
        ),
    );

    /**
     * @var string $rule
     */
    protected $rule;

    public function __construct($sex, $endings) {

        $this->rule = 'second';
        if ($endings == 'мя') {
            $this->rule = 'heteroclite';
        } elseif (isset($this->declinations["$endings"]["$sex"])) {
            $this->rule = $this->declinations["$endings"]["$sex"];
        }
    }

    public function getRule() {
        return $this->rule;
    }

    public function secondCase($end) {
        $changes = array(
            'ок' => array('ок', 'ка', 'ку', 'ок', 'ком', 'кe'),
            'ек' => array('ек', 'ка', 'ку', 'ек', 'ком', 'кe'),
            'ёк' => array('ёк', 'ка', 'ку', 'ёк', 'ком', 'кe'),
            'е' => array('e', 'я', 'ю', 'e', 'ем', 'e'),
            'ё' => array('ё', 'я', 'ю', 'ё', 'ем', 'e'),
            'о' => array('о', 'а', 'у', 'о', 'ом', 'e')
        );
        if (isset($changes["$end"])) {
            return $changes["$end"];
        }
        return array('', 'а', 'у', '', 'ом', 'e');
    }

    public function firstCase($end) {
        $changes = array(
            'а' => array('а', 'ы', 'е', 'у', 'ой', 'e'),
            'я' => array('я', 'и', 'е', 'ю', 'ёй', 'e'),
            'ка' => array('ка', 'ки', 'ке', 'ку', 'кой', 'кe')
        );
        return $changes["$end"];
    }

    public function thirdCase($end) {
        return array($end, 'и', 'и', $end, $end . 'ю', 'и');
    }

    public function heterocliteCase($end) {
        return array($end, 'мени', 'мени', $end, 'менем', 'мени');
    }

}