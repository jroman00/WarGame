<?php

namespace App;

class FullDeck extends CardCollection implements DeckInterface
{
    /**
     * @return static
     */
    public static function generate()
    {
        $cards = [];

        foreach (CardSuit::VALID_SUITS as $suitValue) {
            foreach (CardValue::VALID_VALUES as $value) {
                $cards[] = new Card(
                    new CardSuit($suitValue),
                    new CardValue($value)
                );
            }
        }

        $deck = new static($cards);
        $deck = $deck->shuffle();

        return $deck;
    }
}
