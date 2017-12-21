<?php

namespace App;

use Psr\Log\LogLevel;

class WarGame
{
    /**
     * @var Player
     */
    private $player1;

    /**
     * @var Player
     */
    private $player2;

    /**
     * @var CardCollection
     */
    private $deck;

    /**
     * @var CardCollection
     */
    private $pot;

    /**
     * @var Player|null
     */
    private $winner;

    /**
     * @var Log
     */
    private $log;

    /**
     * WarGame constructor.
     * @param Player $player1
     * @param Player $player2
     * @param CardCollection $deck
     */
    public function __construct(Player $player1, Player $player2, CardCollection $deck)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->deck = $deck;

        $this->pot = new CardCollection();

        $this->log = new Log();
    }

    /**
     * @return Player
     */
    public function getWinner()
    {
        return $this->winner;
    }

    private function debugCards()
    {
        /**
         * Debug for Player 1
         */
        $message = $this->player1->getName() . '\'s cards: ' . $this->player1->getCards()->getDisplayValue();
        $this->log->log(LogLevel::INFO, '&nbsp;&nbsp;&nbsp;&nbsp;' . $message);

        $message = $this->player1->getName() . '\'s reserve: ' . $this->player1->getReserve()->getDisplayValue();
        $this->log->log(LogLevel::INFO, '&nbsp;&nbsp;&nbsp;&nbsp;' . $message);

        /**
         * Debug for Player 2
         */
        $message = $this->player2->getName() . '\'s cards: ' . $this->player2->getCards()->getDisplayValue();
        $this->log->log(LogLevel::INFO, '&nbsp;&nbsp;&nbsp;&nbsp;' . $message);

        $message = $this->player2->getName() . '\'s reserve: ' . $this->player2->getReserve()->getDisplayValue();
        $this->log->log(LogLevel::INFO, '&nbsp;&nbsp;&nbsp;&nbsp;' . $message);

        /**
         * Debug for pot
         */
        $message = 'Pot\'s cards: ' . $this->pot->getDisplayValue();
        $this->log->log(LogLevel::INFO, '&nbsp;&nbsp;&nbsp;&nbsp;' . $message);
    }

    private function playHand()
    {
        $player1Card = $this->player1->popCard();
        $player1CardValue = $player1Card->getValue();

        $player2Card = $this->player2->popCard();
        $player2CardValue = $player2Card->getValue();

        /**
         * Player 1 wins the hand!
         */
        if ($player1CardValue > $player2CardValue) {
            $this->log->log(LogLevel::INFO, $this->player1->getName() . ' wins hand (' . $this->player1->getName() . '=' . $player1Card->getDisplayValue() . ', ' . $this->player2->getName() . '=' . $player2Card->getDisplayValue() . ')');

            $this->player1->reserveCard($player1Card);
            $this->player1->reserveCard($player2Card);

            if ($this->pot->count() > 0) {
                $potMessage = $this->player1->getName() . ' wins pot containing: ';

                /** @var Card $potCard */
                foreach ($this->pot as $potCard) {
                    $potMessage .= $potCard->getDisplayValue() . ',';
                }

                $this->log->log(LogLevel::INFO, rtrim($potMessage, ','));

                $this->player1->addCards($this->pot);
                $this->pot = new CardCollection();
            }

            return;
        }

        /**
         * Player 2 wins the hand!
         */
        if ($player1CardValue < $player2CardValue) {
            $this->log->log(LogLevel::INFO, $this->player2->getName() . ' wins hand (' . $this->player1->getName() . '=' . $player1Card->getDisplayValue() . ', ' . $this->player2->getName() . '=' . $player2Card->getDisplayValue() . ')');

            $this->player2->reserveCard($player1Card);
            $this->player2->reserveCard($player2Card);

            if ($this->pot->count() > 0) {
                $potMessage = $this->player2->getName() . ' wins pot containing: ';

                /** @var Card $potCard */
                foreach ($this->pot as $potCard) {
                    $potMessage .= $potCard->getDisplayValue() . ',';
                }

                $this->log->log(LogLevel::INFO, rtrim($potMessage, ','));

                $this->player2->addCards($this->pot);
                $this->pot = new CardCollection();
            }

            return;
        }

        /**
         * It's a tie!
         */

        $this->log->log(LogLevel::INFO, 'Tie; ' . $this->player1->getName() . '=' . $player1Card->getDisplayValue() . ', ' . $this->player2->getName() . '=' . $player2Card->getDisplayValue());

        // Add the tying cards to the pot
        $this->pot->push($player1Card);
        $this->pot->push($player2Card);

        // Player 1 adds to the pot
        for ($i = 0; $i < 3; $i++) {
            if ($this->player1->getCardCount() === 0) {
                $this->log->log(LogLevel::INFO, $this->player1->getName() . ' is out of cards for the pot');
                break;
            }

            $potCard = $this->player1->popCard();

            $this->log->log(LogLevel::INFO, $this->player1->getName() . ' is adding to the pot: ' . $potCard->getDisplayValue());

            $this->pot->push($potCard);
        }

        // Player 2 adds to the pot
        for ($i = 0; $i < 3; $i++) {
            if ($this->player2->getCardCount() === 0) {
                $this->log->log(LogLevel::INFO, $this->player2->getName() . ' is out of cards for the pot');
                break;
            }

            $potCard = $this->player2->popCard();

            $this->log->log(LogLevel::INFO, $this->player2->getName() . ' is adding to the pot: ' . $potCard->getDisplayValue());

            $this->pot->push($potCard);
        }
    }

    public function play()
    {
        $splitCollection = $this->deck->split(2);

        $this->player1->setCards($splitCollection->get(0));
        $this->player2->setCards($splitCollection->get(1));

        while ($this->winner === null) {
            $this->playHand();

            if ($this->player1->getCardCount() === 0) {
                if ($this->player1->getReserveCount() > 0) {
                    $this->log->log(LogLevel::INFO, $this->player1->getName() . ' is using reserve');

                    $this->player1->useReserve();
                } else {
                    $this->winner = $this->player2;
                }
            }

            if ($this->player2->getCardCount() === 0) {
                if ($this->player2->getReserveCount() > 0) {
                    $this->log->log(LogLevel::INFO, $this->player2->getName() . ' is using reserve');

                    $this->player2->useReserve();
                } else {
                    $this->winner = $this->player1;
                }
            }
        }
    }
}
