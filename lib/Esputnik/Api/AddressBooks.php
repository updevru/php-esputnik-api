<?php

namespace Esputnik\Api;

class AddressBooks extends AbstractApi
{
    public function all()
    {
        return $this->get('addressbooks/');
    }
}
