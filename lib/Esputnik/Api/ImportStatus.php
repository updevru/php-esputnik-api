<?php

namespace Esputnik\Api;

class ImportStatus extends AbstractApi
{
    public function getStatus($sessionId)
    {
        return $this->get('importstatus/'.rawurlencode($sessionId));
    }
}
