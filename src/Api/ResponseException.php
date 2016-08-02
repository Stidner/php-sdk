<?php
/**
 * Copyright 2016 Stidner Complete AB.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace Stidner\Api;

/**
 * Class ResponseException.
 */
class ResponseException extends \Exception {
    /**
     * @var string[]
     */
    private $messages = [];

    /**
     * ResponseException constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     * @param array $messages
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null, $messages = []) {
        parent::__construct($message, $code, $previous);

        $this->messages = $messages;
    }

    /**
     * @return array
     */
    public function getMessages() {
        return $this->messages;
    }

    /**
     * @param array $messages
     *
     * @return $this
     */
    public function setMessages($messages) {
        $this->messages = $messages;

        return $this;
    }
}
