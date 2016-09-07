<?php

namespace Esputnik\Model;

class Field
{
    private $id;
    private $value;

    /**
     * Field constructor.
     * @param $id
     * @param $value
     */
    public function __construct($id, $value)
    {
        $this->id = $id;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
