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
    protected $doubleEnds = array('ок', 'ек', 'ёк', 'мя', 'ка');

    /**
     * @var string $doubleEnds
     */
    protected $ends;

    /**
     * @var string $sex
     */
    protected $sex;

    /**
     * @param string $word
     */
    public function __construct($word) {
        // check exeption endings
        $this->sex = $this->getSex($word);
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
        return 'ж';
        $header = array(
            'Content-Type: text/html; utf-8; charset=UTF-8',
        );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://htmlweb.ru/service/api.php?sex=' . $word);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $out = curl_exec($curl);
        curl_close($curl);
        die($out);
    }

}
