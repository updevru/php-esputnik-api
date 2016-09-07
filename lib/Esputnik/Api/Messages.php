<?php

namespace Esputnik\Api;

use Esputnik\Model\EmailMessage;

class Messages extends AbstractApi
{
    public function add(EmailMessage $emailMessage)
    {
        return $this->post('messages/email/', $emailMessage);
    }

    public function all()
    {
        return $this->get('messages/email/');
    }

    public function search($searchQuery)
    {
        return $this->get('messages/email/', ['search' => $searchQuery]);
    }

    public function show($id)
    {
        return $this->get('messages/email/'.rawurlencode($id));
    }

    public function remove($id)
    {
        return $this->delete('messages/email/'.rawurlencode($id));
    }

    public function update($id, EmailMessage $emailMessage)
    {
        return $this->put('messages/email/'.rawurlencode($id), $emailMessage);
    }
}