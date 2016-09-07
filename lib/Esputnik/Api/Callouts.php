<?php

namespace Esputnik\Api;

class Callouts extends AbstractApi
{
    public function sms()
    {
        return $this->get('callouts/sms/');
    }
}
