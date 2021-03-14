<?php
    require 'card.php';

    class Deck
    {
        public $deck = [];

        public function __construct()
        {
            //nested loops to create the deck
            for ($suit = 0; $suit < 4; $suit++) {
                for ($number = 0; $number < 13; $number++) {
                    $this->deck[] = new Card($suit, $number);
                }
            }
        }

        /*
         * Shuffles deck to set number of players
         *
         * @param int $player number of players
         *
         * @return array of shuffled cards
         */
        public function shuffle($players = 2)
        {
            shuffle($this->deck);
            $hands = array_chunk($this->deck, count($this->deck)/$players);

            return $hands;
        }
    }