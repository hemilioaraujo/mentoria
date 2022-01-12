<?php

declare(strict_types=1);

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Handlers;

use Monolog\Logger;
use RuntimeException;
use Monolog\Handler\Curl\Util;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\TelegramBotHandler;


class TelegramBotHandlerCustom extends TelegramBotHandler
{
    private $maxMessageLenght = 4050;

    protected function splitMessages(string $message)
    {
        $position = 0;
        $messages = [];

        while (strlen(substr($message, $position, $this->maxMessageLenght)) != 0) {
            $messages[] = substr($message, $position, $this->maxMessageLenght);
            $position += $this->maxMessageLenght;
        }
        return $messages;
    }

    protected function write(array $record): void
    {
        $messages = $this->splitMessages($record['formatted']);
        foreach ($messages as $message) {
            sleep(1);
            parent::send($message);
        }
    }
}
