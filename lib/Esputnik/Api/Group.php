<?php

namespace Esputnik\Api;

class Group extends AbstractApi
{
    /**
     * Поиск всех контактов в группе.
     *
     * @param $id
     * @param $parameters
     * @return \Psr\Http\Message\StreamInterface
     */
    public function contacts($id, $parameters = [])
    {
        return $this->get('group/'.rawurlencode($id).'/contacts', [], $parameters);
    }
}
