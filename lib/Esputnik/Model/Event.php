<?php

namespace Esputnik\Model;

class Event
{
    /**
     * Идентификатор-ключ типа события. Если в системе нет типа события с таким ключем, то он создается
     * @var string
     */
    private $eventTypeKey;

    /**
     * Идентификатор события. Может совпадать с идентификтором или email-ом контакта.
     * Повторные события определенного типа с одинаковым идентификатором будут проигнорированы
     *
     * @var string
     */
    private $keyValue;

    /**
     * @var EventParam[]
     */
    private $params;

    /**
     * Event constructor.
     * @param string       $eventTypeKey
     * @param string       $keyValue
     * @param EventParam[] $params
     */
    public function __construct($eventTypeKey, $keyValue, array $params)
    {
        $this->eventTypeKey = $eventTypeKey;
        $this->keyValue = $keyValue;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getEventTypeKey()
    {
        return $this->eventTypeKey;
    }

    /**
     * @return string
     */
    public function getKeyValue()
    {
        return $this->keyValue;
    }

    /**
     * @return EventParam[]
     */
    public function getParams()
    {
        return $this->params;
    }
}
