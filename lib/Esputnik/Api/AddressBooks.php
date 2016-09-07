<?php

namespace Esputnik\Api;

class AddressBooks extends AbstractApi
{
    /**
     * Получить список каталогов.
     * Каталог содержит списки дополнительных полей для контактов, которые доступны в вашей организации.
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function all()
    {
        return $this->get('addressbooks/');
    }
}
