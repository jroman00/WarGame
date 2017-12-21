<?php

use App\FullDeck;
use App\Player;
use App\WarGame;
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

ErrorHandler::register();
ExceptionHandler::register();

$player1 = new Player('Sam');
$player2 = new Player('Justin');
$deck = FullDeck::generate();

$game = new WarGame($player1, $player2, $deck);
$game->play();

echo $game->getWinner()->getName() . ' wins!!!';
