<?php

namespace Secvisio\LaravelRabbitmqApiWrapper\Traits;

use Illuminate\Http\Client\ConnectionException;
use Secvisio\LaravelRabbitmqApiWrapper\RequestQuery;

trait RabbitmqApiRequest
{
    /**
     * @param string $requestType
     * @param string $uri
     * @param array $parameter
     * @return object|array|string
     * @throws ConnectionException
     */
    public function request(string $requestType, string $uri, array $parameter = []): object|array|string
    {
        return new RequestQuery($requestType, $this->http, $uri, $parameter, $this->fullResponse);
    }
}
