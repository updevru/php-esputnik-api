<?php

namespace Esputnik\Api;

class Unsubscribe extends AbstractApi
{
    public function add(array $emails)
    {
        return $this->post('emails/unsubscribe/add', [
            'emails' => $emails,
        ]);
    }

    public function remove(array $emails)
    {
        return $this->post('emails/unsubscribe/delete', [
            'emails' => $emails,
        ]);
    }
}
