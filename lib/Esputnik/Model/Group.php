<?php

namespace Esputnik\Model;

use Esputnik\Exception\InvalidModelException;

class Group
{
    const GROUP_TYPE_STATIC = 'Static';
    const GROUP_TYPE_DYNAMIC = 'Dynamic';
    const GROUP_TYPE_COMBINED = 'Combined';
    private $id;
    private $name;
    private $type;
    private $types = [
        self::GROUP_TYPE_STATIC,
        self::GROUP_TYPE_DYNAMIC,
        self::GROUP_TYPE_COMBINED,
    ];

    /**
     * Group constructor.
     * @param $type
     * @param $name
     * @throws InvalidModelException
     */
    public function __construct($type, $name)
    {
        $this->name = $name;
        $this->type = $type;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
}
