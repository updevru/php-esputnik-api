<?php

namespace Esputnik\Api;

class Contacts extends AbstractApi
{
    public function all()
    {
        return $this->get('contacts/');
    }

    public function update(array $contacts)
    {
        return $this->post('contacts/', $contacts);
    }

    public function getEmail(array $ids)
    {
        return $this->get('contacts/email', [
            'emails' => implode(',', $ids)
        ]);
    }
}
