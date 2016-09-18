<?php

namespace Esputnik\Api;

class Sms extends AbstractApi
{
    /**
     * Вывести все sms сообщения
     *
     * @param array $parameters
     * @return \Psr\Http\Message\StreamInterface
     */
    public function all($parameters = [])
    {
        return $this->get('messages/sms', [], $parameters);
    }


    /**
     * Search sms messages by part of name or tag.
     *
     * @param $query
     * @param array $parameters
     * @return \Psr\Http\Message\StreamInterface
     */
    public function search($query, $parameters = [])
    {
        return $this->get('messages/sms', ['search' => $query], $parameters);
    }
}
