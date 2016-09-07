<?php

namespace Esputnik\Api;

class Balance extends AbstractApi
{
    /**
     * Получить баланс организации.
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function show()
    {
        return $this->get('balance/');
    }
}
