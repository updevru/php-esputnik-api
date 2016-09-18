<?php

namespace Esputnik\Api;

class Callouts extends AbstractApi
{
    /**
     * Получить статистику sms-рассылок.
     *
     * @param array $parameters
     * @return \Psr\Http\Message\StreamInterface
     */
    public function sms($parameters = [])
    {
        return $this->get('callouts/sms/', [], $parameters);
    }
}
