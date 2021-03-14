<?php

    class Card
    {
        const suits = ['Hearts', 'Spades', 'Clubs', 'Diamonds'];
        const numbers = ['Ace', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jack', 'Queen', 'King'];

        public $suit;
        public $number;

        public function __construct($suit, $number)
        {
            $this->suit = self::suits[$suit];
            $this->number = self::numbers[$number];
        }
    }