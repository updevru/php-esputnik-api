<?php

namespace Esputnik\Api;

class Callouts extends AbstractApi
{
    /**
     * Получить статистику sms-рассылок.
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function sms()
    {
        return $this->get('callouts/sms/');
    }
}
