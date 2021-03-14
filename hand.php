<?php

    class Hand
    {
        public $hand = [];

        public function __construct($cards = [])
        {
            $this->hand = $cards;
        }

        public function shiftTopCard()
        {
            return array_shift($this->hand);
        }

        public function getTopCard()
        {
            return reset($this->hand);
        }

        public function viewTopCard()
        {
            $card = reset($this->hand);
            $card = $card->{'number'} . ' of ' . $card->{'suit'};
            return $card;
        }

        public function addCard(object $card)
        {
            array_unshift($this->hand, $card);
        }

        public function getCount()
        {
            return count($this->hand);
        }
    }