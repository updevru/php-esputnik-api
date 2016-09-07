<?php

namespace Esputnik\Api;

class Sms extends AbstractApi
{
    public function all()
    {
        return $this->get('messages/sms');
    }

    public function search($query)
    {
        return $this->get('messages/sms', ['search' => $query]);
    }
}