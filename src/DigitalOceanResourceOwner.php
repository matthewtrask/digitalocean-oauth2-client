<?php

namespace Rocketpastsix\Oauth2\Client\Provider\DigitalOcean;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class DigitalOceanResourceOwner implements ResourceOwnerInterface
{
    protected $response;

    /**
     * @param array $response
     */
    public function __construct($response)
    {
    }

    public function getId()
    {
        // TODO: Implement getId() method.
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }
}