<?php

namespace Esputnik\Api;

class Balance extends AbstractApi
{
    public function show()
    {
        return $this->get('balance/');
    }
}
