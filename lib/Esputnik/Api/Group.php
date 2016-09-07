<?php

namespace Esputnik\Api;

class Group extends AbstractApi
{
    public function contacts($id)
    {
        return $this->get('group/'.rawurlencode($id).'/contacts');
    }
}
