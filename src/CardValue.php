<?php

namespace App;

use DomainException;

class CardValue
{
    const JACK = 11;
    const QUEEN = 12;
    const KING = 13;
    const ACE = 14;

    const VALID_VALUES = [
        2,
        3,
        4,
        5,
        6,
        7,
        8,
        9,
        10,
        self::JACK,
        self::QUEEN,
        self::KING,
        self::ACE,
    ];

    const SPECIAL_VALUE_MAP = [
        self::JACK => 'J',
        self::QUEEN => 'Q',
        self::KING => 'K',
        self::ACE => 'A',
    ];

    /**
     * @var int
     */
    private $value;

    public function __construct(int $value)
    {
        if (!in_array($value, static::VALID_VALUES)) {
            throw new DomainException('Invalid card value: ' . $value);
        }

        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string|int
     */
    public function getDisplayValue()
    {
        return array_key_exists($this->value, static::SPECIAL_VALUE_MAP)
            ? static::SPECIAL_VALUE_MAP[$this->value]
            : $this->value;
    }
}
