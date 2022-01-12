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
        $indice = 0;
        $messages = [0 => ''];

        for ($i = 0; $i < strlen($message); $i++) {
            if (strlen($messages[$indice]) < $this->maxMessageLenght) {
                $messages[$indice] .= $message[$i];
            } else {
                $indice += 1;
                $messages[] .= $message[$i];
            }
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
