<?php

/**
 * Description of Declination class
 *
 * @author Alexander Tereshenko
 */
class Declination {

    /**
     * @var array $cases
     */
    protected $cases = array('ип', 'рп', 'дп', 'вп', 'тп', 'пп');

    /**
     * @var array $doubleEnds
     * Array used to check double ends exeptions 
     */
    protected $doubleEnds = array('ок', 'ек', 'ёк', 'мя', 'ка', 'це');

    /**
     * @var string $doubleEnds
     */
    protected $ends;

    /**
     * @var string $sex
     */
    protected $sex = '';

    /**
     * @param string $word
     */
    public function __construct($word, $sex = '') {
        // check exeption endings
        $this->sex = !empty($sex) ? $sex : $this->getSex($word);
        $endings = mb_substr($word, -2);
        $this->ends = (in_array($endings, $this->doubleEnds)) ? $endings : mb_substr($endings, -1);

        // set clean word without ending
        $length = strlen($word) - strlen($this->ends);
        $this->word = substr($word, 0, $length);
    }

    /**
     * @return array()
     */
    public function GetDeclination() {

        //get endings by declination for our word
        $rules = $this->getDeclCases($this->sex);

        // return declinations
        foreach ($rules as $key => $value) {
            $result[$key] = $this->word . $value;
        }
        return $result;
    }

    /**
     * @return array()
     */
    protected function getDeclCases($sex) {
        //require config class and create an object
        require_once '/Service/config.php';
        $rules = new Config($sex, $this->ends);
        $func = $rules->getRule() . 'Case';
        return array_combine($this->cases, $rules->$func($this->ends));
    }

    /**
     * @return array()
     */
    protected function getSex($word) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://htmlweb.ru/service/api.php?sex=' . $word . '&charset=utf-8&json&fields=sex');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $out = json_decode(curl_exec($curl), true);
        curl_close($curl);
        return $out['sex'];
    }

}
