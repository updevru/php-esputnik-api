<?php

namespace Esputnik\Model;

use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;

class ParametrizedRecipient
{
    private $contactId;
    private $email;
    private $jsonParam;
    private $locator;

    /**
     * ParametrizedRecipient constructor.
     * @param Contact        $contact
     * @param string         $email
     * @param MessageParam[] $params
     * @param string         $locator
     */
    public function __construct(Contact $contact, $email, array $params, $locator)
    {
        $serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy()))
            ->build();

        $this->jsonParam = $serializer->serialize($params, 'json');

        $this->contactId = $contact->getId();
        $this->email = $email;
        $this->locator = $locator;
    }

    /**
     * @return int
     */
    public function getContactId()
    {
        return $this->contactId;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed|string
     */
    public function getJsonParam()
    {
        return $this->jsonParam;
    }

    /**
     * @return string
     */
    public function getLocator()
    {
        return $this->locator;
    }
}
