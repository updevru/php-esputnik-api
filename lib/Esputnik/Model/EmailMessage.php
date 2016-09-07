<?php

namespace Esputnik\Model;

class EmailMessage
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $from;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $htmlText;

    /**
     * @var string[]
     */
    private $tags = [];

    /**
     * EmailMessage constructor.
     * @param string $name
     * @param string $from
     * @param string $subject
     * @param string $htmlText
     * @param string[] $tags
     */
    public function __construct($name, $from, $subject, $htmlText, array $tags = [])
    {
        $this->name = $name;
        $this->from = $from;
        $this->subject = $subject;
        $this->htmlText = $htmlText;
        $this->tags = $tags;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return string[]
     */
    public function getHtmlText()
    {
        return $this->htmlText;
    }

    /**
     * @return string[]
     */
    public function getTags()
    {
        return $this->tags;
    }
}
