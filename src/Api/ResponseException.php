<?php

namespace Stidner\Api;

/**
 * Class ResponseException.
 */
class ResponseException extends \Exception
{
    /**
     * @var string[]
     */
    private $messages = [];

    public function __construct($message = '', $code = 0, \Exception $previous = null, $messages = [])
    {
        parent::__construct($message, $code, $previous);

        $this->messages = $messages;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param array $messages
     *
     * @return $this
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;

        return $this;
    }
}
