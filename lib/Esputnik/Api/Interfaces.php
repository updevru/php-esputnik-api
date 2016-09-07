<?php

namespace Esputnik\Api;

class Interfaces extends AbstractApi
{
    public function all()
    {
        return $this->get('interfaces/sms');
    }
}
