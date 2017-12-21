<?php

namespace App;

class Player
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var CardCollection
     */
    private $cards;

    /**
     * @var CardCollection
     */
    private $cardReserve;

    /**
     * Player constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->cards = new CardCollection();
        $this->cardReserve = new CardCollection();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Card $card
     */
    public function reserveCard(Card $card)
    {
        $this->cardReserve->push($card);
    }

    /**
     * @return Card
     */
    public function popCard()
    {
        return $this->cards->pop();
    }

    /**
     * @return int
     */
    public function getCardCount()
    {
        return $this->cards->count();
    }

    /**
     * @return int
     */
    public function getReserveCount()
    {
        return $this->cardReserve->count();
    }

    /**
     * @param CardCollection $cards
     */
    public function setCards(CardCollection $cards)
    {
        $this->cards = $cards;
    }

    public function addCards(CardCollection $cards)
    {
        $this->cards = $this->cards->merge($cards->all());
    }

    public function useReserve()
    {
        $this->cards = $this->cardReserve;
        $this->cards = $this->cards->shuffle();

        $this->cardReserve = new CardCollection();
    }

    /**
     * @return CardCollection
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * @return CardCollection
     */
    public function getReserve()
    {
        return $this->cardReserve;
    }
}
