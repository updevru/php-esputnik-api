<?php

namespace Esputnik\Api;

class Groups extends AbstractApi
{
    /**
     * Поиск группы
     *
     * @param $name
     * @param array $parameters
     * @return \Psr\Http\Message\StreamInterface
     */
    public function search($name, $parameters = [])
    {
        return $this->get('groups/', ['name' => $name], $parameters);
    }

    /**
     * Показать все группы
     *
     * @param array $parameters
     * @return \Psr\Http\Message\StreamInterface
     */
    public function all($parameters = [])
    {
        return $this->get('groups/', [], $parameters);
    }
}
