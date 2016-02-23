<?php

namespace Rocketpastsix\Oauth2\Client\Provider\DigitalOcean;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class DigitalOcean extends AbstractProvider
{
    use BearerAuthorizationTrait;

    /**
     * Get authorization URL for Digital Ocean
     *
     * @return string
     */
    public function getBaseAuthorizationUrl()
    {
        return 'https://cloud.digitalocean.com/v1/oauth/authorize';
    }

    /**
     * Get authorization token for Digital Ocean
     *
     * @param array $params
     *
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://cloud.digitalocean.com/v1/oauth/token';
    }

    /**
     * Get provider url to fetch user data
     *
     * @param AccessToken $token
     *
     * @return string
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return 'https://api.digitalocean.com/v2/account';
    }

    /**
     * Get the default scopes used by provider
     *
     * This should return all possible scopes returned by the provider
     *
     * @return array
     */
    protected function getDefaultScopes()
    {
        return [];
    }

    /**
     * If the status code returned is 400 or 500 series,
     * it causes an exception to be thrown.
     *
     * @param ResponseInterface $response
     * @param array|string $data
     * @throws IdentityProviderException
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        if($response->getStatusCode() >= '400') {
            throw new IdentityProviderException(
                $data['error'] ?: $response->getReasonPhrase(),
                $response->getStatusCode(),
                $response
            );
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new DigitalOceanResourceOwner($response);
    }
}