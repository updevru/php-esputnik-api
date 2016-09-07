<?php

namespace Esputnik\Model;

class EventParam
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $name;

    /**
     * EventParam constructor.
     * @param string $value
     * @param string $name
     */
    public function __construct($value, $name)
    {
        $this->value = $value;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
