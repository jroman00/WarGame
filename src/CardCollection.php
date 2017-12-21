<?php

namespace App;

use Illuminate\Support\Collection;

class CardCollection extends Collection
{
    /**
     * @return string
     */
    public function getDisplayValue()
    {
        if ($this->count() === 0) {
            return '<em>empty</em>';
        }

        $cards = [];

        /** @var Card $card */
        foreach ($this->all() as $card) {
            $cards[] = $card->getDisplayValue();
        }

        return implode(', ', $cards);
    }
}
