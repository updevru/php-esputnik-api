<?php

namespace Esputnik\Api;

use Esputnik\Model\Contact as ContactModel;
use Esputnik\Model\Group;

class Contact extends AbstractApi
{
    public function add(ContactModel $contact)
    {
        return $this->post('contact/', $contact);
    }

    public function update($id, ContactModel $contact)
    {
        return $this->put('contact/'.rawurlencode($id), $contact);
    }

    public function remove($id)
    {
        return $this->delete('contact/', rawurlencode($id));
    }

    public function show($id)
    {
        return $this->get('contact/'.rawurlencode($id));
    }

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

    public function activity()
    {
        return $this->get('contactActivity/');
    }
}
