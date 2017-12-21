<?php

namespace App;

class Card
{
    /**
     * @var CardSuit
     */
    private $cardSuit;

    /**
     * @var CardValue
     */
    private $cardValue;

    /**
     * Card constructor.
     * @param CardSuit $cardSuit
     * @param CardValue $cardValue
     */
    public function __construct(CardSuit $cardSuit, CardValue $cardValue)
    {
        $this->cardSuit = $cardSuit;
        $this->cardValue = $cardValue;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->cardValue->getValue();
    }

    public function getDisplayValue()
    {
        return $this->cardValue->getDisplayValue() . $this->cardSuit->getDisplayValue();
    }
}
