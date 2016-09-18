<?php

namespace Esputnik\Api;

class Contacts extends AbstractApi
{
    /**
     * Поиск контактов.
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function all()
    {
        return $this->get('contacts/');
    }

    public function search($query, $parameters = [])
    {
        return $this->get('contacts/', $query = [], $parameters);
    }

    /**
     * @param array $contacts
     * @return \Psr\Http\Message\StreamInterface
     */
    public function update(array $contacts)
    {
        return $this->post('contacts/', $contacts);
    }

    /**
     * Получить email по идентификатору контакта
     *
     * @param array $ids
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getEmail(array $ids)
    {
        return $this->get('contacts/email', [
            'emails' => implode(',', $ids)
        ]);
    }
}
