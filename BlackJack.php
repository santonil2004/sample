<?php

class BlackJack {

    private $_messages;
    private $_score;
    private $_cards;
    private $_no_of_players = 2;

    public function __construct() {
        $sapi_type = php_sapi_name();
        if (substr($sapi_type, 0, 3) != 'cgi') {
            $this->_messages['system'] = 'Please use run this script on CLI mode !';
            return false;
        }
    }

    private function _getCards() {

        echo "\n Input Card (e.g A@H for Ace of Heart)";
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

    public static function display($data) {

        $border = implode('', array_fill(0, 20, '_'));
        echo "\n$border\n";
        print_r($data);
        echo "\n$border\n";
    }

    public function playBlackJack() {

        $no_of_inputs = $this->_no_of_players;

        while ($no_of_inputs > 0) {
            if ($this->_getCards()) {
                
                $no_of_inputs--;
            }
        }
        
        self::display($this->_cards);
    }

}

$Game = new BlackJack();
$Game->playBlackJack();



