<?php

namespace Esputnik\Api;

use Esputnik\Exception\MissingArgumentException;
use Esputnik\Model\Contact as ContactModel;
use Esputnik\Model\Group as GroupModel;
use Esputnik\Model\MessageParam;
use Esputnik\Model\ParametrizedRecipient;

class Message extends AbstractApi
{
    /**
     * Отправка рассылки по заранее созданному сообщению. Сообщение может дополнительно параметризироваться.
     * @param int             $id
     * @param ContactModel    $contact
     * @param boolean         $isEmail
     * @param MessageParam[]  $params
     * @param string          $fromName
     * @param array|null      $recipients
     * @param GroupModel|null $group
     * @return string
     */
    public function send(
        $id,
        ContactModel $contact,
        $isEmail,
        array $params,
        $fromName,
        array $recipients = null,
        GroupModel $group = null
    ) {
    
        $queryParams = [
            'contactId' => $contact->getId(),
            'email' => (bool) $isEmail,
            'params' => $params,
            'fromName' => $fromName,
        ];

        if ($group) {
            $queryParams['groupId'] = $group->getId();
        }

        if ($recipients) {
            $queryParams['recipients'] = $recipients;
        }

        return $this->post('message/'.rawurlencode($id).'/send', $queryParams);
    }

    /**
     * Отправка подготовленного сообщения одному или многим контактам.
     * Сообщение может параметризироваться для каждого контакта отдельно.
     *
     * @param int                     $id
     * @param ParametrizedRecipient[] $recipients
     * @param boolean                 $isEmail
     * @param string                  $fromName
     * @return string
     */
    public function smartSend($id, array $recipients, $isEmail, $fromName)
    {
        $queryParams = [
            'recipients' => $recipients,
            'email' => (bool) $isEmail,
            'fromName' => $fromName
        ];

        return $this->post('message/'.rawurlencode($id).'/smartsend', $queryParams);
    }

    public function email($from, $subject, $htmlText, $plainText, array $emails, array $tags)
    {
        $queryParams = [
            'from' => $from,
            'subject' => $subject,
            'htmlText' => $htmlText,
            'plainText' => $plainText,
            'emails' => $emails,
            'tags' => $tags,
        ];

        return $this->post('message/email/', $queryParams);
    }

    public function emailStatus($ids)
    {
        return $this->get('message/email/status/', [
            'ids' => join(',', $ids)
        ]);
    }

    public function sms($from, $text, array $tags, array $phoneNumbers = null, $groupId = null)
    {
        $queryParams = [
            'from' => $from,
            'text' => $text,
        ];
        if (!$phoneNumbers and !$groupId) {
            throw new MissingArgumentException(['phoneNumbers', 'groupId']);
        }

        if ($phoneNumbers) {
            $queryParams['phoneNumbers'] = $phoneNumbers;
        }
        if ($groupId) {
            $queryParams['groupId'] = $groupId;
        }

        return $this->post('message/sms/', $queryParams);
    }

    public function smsStatus($ids)
    {
        return $this->get('message/sms/status/', [
            'ids' => join(',', $ids)
        ]);
    }
}
