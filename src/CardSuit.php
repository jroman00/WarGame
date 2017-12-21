<?php

namespace App;

use DomainException;

class CardSuit
{
    const CLUB = 1;
    const DIAMOND = 2;
    const HEART = 3;
    const SPADE = 4;

    const VALID_SUITS = [
        self::CLUB,
        self::DIAMOND,
        self::HEART,
        self::SPADE,
    ];

    const SUIT_ICON_MAP = [
        self::CLUB => '♣',
        self::DIAMOND => '♦',
        self::HEART => '♥',
        self::SPADE => '♠',
    ];

    /**
     * @var int
     */
    private $suit;

    public function __construct(int $suit)
    {
        if (!in_array($suit, static::VALID_SUITS)) {
            throw new DomainException('Invalid suit: ' . $suit);
        }

        $this->suit = $suit;
    }

    /**
     * @return string|int
     */
    public function getDisplayValue()
    {
        return array_key_exists($this->suit, static::SUIT_ICON_MAP)
            ? static::SUIT_ICON_MAP[$this->suit]
            : $this->suit;
    }
}
