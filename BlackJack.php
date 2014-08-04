<?php

/**
 * Black Jack score 
 * @author sanil shrestha <santonil2003@gmail.com>
 */
class BlackJack {

    private $_score = 0;
    private $_cards = array();

    /*
     * Number of cards to input
     */

    const NUMBER_OF_CARDS = 2;

    /**
     * check if enviornment is cli or apache
     * @return boolean
     */
    public function __construct() {
        $sapi_type = php_sapi_name();

        if (!preg_match('/cli|cgi/', $sapi_type)) {
            $messages['system'] = 'Please use run this script on CLI mode !';
            self::display($messages);
            exit();
        }
    }

    /**
     * Input Cards 
     * @return boolean
     */
    private function _getCards() {

        echo "\n Input Card :";
        $line = trim(fgets(STDIN));

        $portion = array();
        if (preg_match('/^([2-9]{1}|10|[A,J,Q,K])\@([S, C, D, H])$/i', $line, $portion)) {
            $this->_cards[] = array(
                'face_value' => $portion[1],
                'suit' => $portion[2],
            );
            return true;
        }
        return false;
    }

    /**
     * calculate score on the basis of face
     * @param type $face
     * @return int
     */
    private static function _individualScore($face) {

        $face = (!is_numeric($face)) ? strtoupper($face) : $face;

        switch ($face) {
            case 'A':
                return 11;
                break;
            case 'J':
            case 'Q':
            case 'K':
                return 10;
            default:
                return (int) $face;
                break;
        }
    }

    /**
     * calculate overall black jack score
     */
    private function _calculateBlackJackScore() {
        $total = 0;

        foreach ($this->_cards as $card) {
            $total+=self::_individualScore($card['face_value']);
        }

        $this->_score = $total;
    }

    /**
     * temp display method
     * @param type $data
     */
    public static function display($data) {

        if (is_array($data)) {
            foreach ($data as $title => $value) {
                echo "\n" . $title . ':' . $value;
            }
        } else {
            echo $data;
        }
    }

    /**
     * start black jack game
     */
    public function playBlackJack() {

        echo "\n INPUT CARD";
        echo "\n > the first part representing the face value from 2-10, plus A, K, Q, J. ";
        echo "\n > The second part represents the suit S, C, D, H.";
        echo "\n > e.g 2@H";
        echo "\n > press Ctr+Z to exit";

        $no_of_inputs = self::NUMBER_OF_CARDS;

        while ($no_of_inputs > 0) {
            if ($this->_getCards()) {
                $no_of_inputs--;
                continue;
            }

            self::display("\n Invalid card Input \n");
        }

        $this->_calculateBlackJackScore();

        self::display("\n Black Jack Score :");
        self::display($this->_score);
        self::display("\n");
    }

}

$Game = new BlackJack();
$Game->playBlackJack();



