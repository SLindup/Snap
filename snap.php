<?php
    require 'deck.php';
    require 'hand.php';

    class Snap
    {
        private $deck;
        private $playerHands = [];

        //a hand to store the centre cards
        private $centrePile;
        private $players = 2;

        public function __construct($players = 2)
        {
            $this->deck = new Deck();

            $this->players = $players;

            $hands = $this->deck->shuffle($this->players);

            foreach ($hands as $hand) {
                $this->playerHands[] = new Hand($hand);
            }

            if (count($this->playerHands) > $this->players) {
                $this->centrePile = $this->playerHands[$this->players];
                unset($this->playerHands[$this->players]);
            } else {
                $this->centrePile = new Hand();
            }
        }

        /*
         *
         */
        public function playCard($player)
        {
            //if centrePile is empty, just move one and skip rest of go
            if ($this->centrePile->getCount() == 0) {
                $this->moveToCentre($this->playerHands[$player]->shiftTopCard());

                return true;
            }

            //check for match with centre pile to move cards
            $this->checkForMatch($player);

            if ($this->checkForWin($player)) {
                //game over, won by $player
                echo $player+1 . " wins";
            }
        }

        /*
         *
         */
        public function checkForMatch($player)
        {
            $card = $this->playerHands[$player]->shiftTopCard();
            if ($this->centrePile->getTopCard()->{'number'} == $card->{'number'}) {
                //lose
                $this->moveCentreToPlayer($player);
            } else {
                $this->moveToCentre($card);
            }
        }

        /*
         *
         */
        public function checkForWin($player)
        {
            //need to check if this player has 0 cards left
            if ($this->playerHands[$player]->getCount() == 0) {
                return true;
            }
            return false;
        }

        /*
         *
         */
        public function moveCentreToPlayer($player)
        {
            //player lost, they get all the central cards!
            for ($i = 0; $i < $this->getCentrePileCount(); $i++) {
                $this->playerHands[$player]->addCard($this->centrePile->shiftTopCard());
            }
        }

        /*
         * Move card to centre pile
         */
        public function moveToCentre($card)
        {
            $this->centrePile->addCard($card);
        }

        /*
         *
         */
        public function getCentrePileCount()
        {
            return $this->centrePile->getCount();
        }

        /*
         *
         */
        public function getCardCount($player)
        {
            return $this->playerHands[$player]->getCount();
        }

        /*
         *
         */
        public function viewCentrePileTopCard()
        {
            return $this->centrePile->viewTopCard();
        }

        /*
         *
         */
        public function getPlayers()
        {
            return $this->players;
        }
    }