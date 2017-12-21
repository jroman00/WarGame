<?php

namespace App;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class Log implements LoggerInterface
{
    use LoggerTrait;

    /**
     * Logs with an arbitrary level.
     *
     * @param int $level
     * @param string $message
     * @param array $context
     * @return void
     */
    public function log($level, $message, array $context = [])
    {
        echo '<p>' . $message . '</p>';
    }
}
