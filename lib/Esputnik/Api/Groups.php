<?php

namespace Esputnik\Api;

class Groups extends AbstractApi
{
    public function search($name)
    {
        return $this->get('groups/', [
            'name' => $name,
        ]);
    }

    public function all()
    {
        return $this->get('groups/');
    }
}
