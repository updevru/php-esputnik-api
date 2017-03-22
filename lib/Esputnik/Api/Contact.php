<?php

namespace Esputnik\Api;

use Esputnik\Model\Contact as ContactModel;
use Esputnik\Model\Field;
use Esputnik\Model\Group;

class Contact extends AbstractApi
{
    /**
     * Добавить контакт. Поле id будет проигнорировано.
     *
     * @param ContactModel $contact
     * @return string
     */
    public function add(ContactModel $contact)
    {
        return $this->post('contact/', $contact);
    }

    /**
     * Обновить контакт. Поле id контакта будет проигнорировано.
     *
     * @param $id
     * @param ContactModel $contact
     * @return \Psr\Http\Message\StreamInterface
     */
    public function update($id, ContactModel $contact)
    {
        return $this->put('contact/' . rawurlencode($id), $contact);
    }

    /**
     * Удалить контакт.
     *
     * @param $id
     * @return \Psr\Http\Message\StreamInterface
     */
    public function remove($id)
    {
        return $this->delete('contact/' . rawurlencode($id));
    }

    /**
     * Получить контакт.
     *
     * @param $id
     * @return \Psr\Http\Message\StreamInterface
     */
    public function show($id)
    {
        return $this->get('contact/' . rawurlencode($id));
    }

    /**
     * Подписать контакт. Используется для интеграции форм подписки.
     * Если контакт не существует - будет создан с неподтверждённым email-ом.
     * Если контакт существует - будет обновлен.
     *
     * @param ContactModel $contact
     * @param Group[] $groups
     * @param Field[] $fields
     * @param bool $dedupeOn
     * @param string $formType
     * @return \Psr\Http\Message\StreamInterface
     */
    public function subscribe(ContactModel $contact, array $groups, array $fields, $dedupeOn, $formType)
    {
        return $this->post('contact/subscribe/', [
            'contact' => $contact,
            'groups' => array_map(function (Group $group) {
                return $group->getName();
            }, $groups),
            'fields' => $fields,
            'dedupeOn' => $dedupeOn,
            'formType' => $formType,
        ]);
    }

    /**
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param null $email
     * @param null $sms
     * @param null $messageTag
     * @param null $activityStatus
     * @param array $parameters
     * @return \Psr\Http\Message\StreamInterface
     */
    public function activity(
        \DateTime $dateFrom = null,
        \DateTime $dateTo = null,
        $email = null,
        $sms = null,
        $messageTag = null,
        $activityStatus = null,
        $parameters = [])
    {
        $query = [];
        if ($dateFrom) {
            $query['dateFrom'] = $dateFrom->format('Y-m-d');
        }

        if ($dateTo) {
            $query['dateTo'] = $dateTo->format('Y-m-d');
        }

        if ($email) {
            $query['email'] = $email;
        }

        if($sms) {
            $query['sms'] = $sms;
        }

        if($messageTag) {
            $query['messageTag'] = $messageTag;
        }

        if($activityStatus) {
            $query['activityStatus'] = $activityStatus;
        }

        return $this->get('contactActivity/', $query, $parameters);
    }
}
