<?php

namespace Esputnik\Api;

use Esputnik\Model\EmailMessage;

class Messages extends AbstractApi
{
    /**
     * @param EmailMessage $emailMessage
     * @return \Psr\Http\Message\StreamInterface
     */
    public function add(EmailMessage $emailMessage)
    {
        return $this->post('messages/email/', $emailMessage);
    }

    /**
     * @param array $parameters
     * @return \Psr\Http\Message\StreamInterface
     */
    public function all($parameters = [])
    {
        return $this->get('messages/email/', [], $parameters);
    }

    /**
     * @param $searchQuery
     * @param array $parameters
     * @return \Psr\Http\Message\StreamInterface
     */
    public function search($searchQuery, $parameters = [])
    {
        return $this->get('messages/email/', ['search' => $searchQuery], $parameters);
    }

    /**
     * Get email message.
     *
     * @param $id
     * @return \Psr\Http\Message\StreamInterface
     */
    public function show($id)
    {
        return $this->get('messages/email/'.rawurlencode($id));
    }

    /**
     * Delete email message.
     *
     * @param $id
     * @return \Psr\Http\Message\StreamInterface
     */
    public function remove($id)
    {
        return $this->delete('messages/email/'.rawurlencode($id));
    }

    /**
     * Update email message.
     *
     * @param $id
     * @param EmailMessage $emailMessage
     * @return \Psr\Http\Message\StreamInterface
     */
    public function update($id, EmailMessage $emailMessage)
    {
        return $this->put('messages/email/'.rawurlencode($id), $emailMessage);
    }
}
