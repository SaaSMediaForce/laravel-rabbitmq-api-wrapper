<?php
declare(strict_types=1);

namespace Secvisio\LaravelRabbitmqApiWrapper\Permissions;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Secvisio\LaravelRabbitmqApiWrapper\RequestQuery;
use Secvisio\LaravelRabbitmqApiWrapper\Traits\RabbitmqApiRequest;

class Permissions
{

    use RabbitmqApiRequest;

    /**
     * @var Response
     */
    protected Response $response;

    /**
     * @var array
     */
    protected array $parameter;

    /**
     * @param PendingRequest $http
     * @param bool $fullResponse
     */
    public function __construct(
        protected PendingRequest $http,
        protected bool $fullResponse = false
    ) {}

    /**
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function all(): object|array|string
    {
        return $this->request('GET', 'permissions', []);
    }

    /**
     * @param string $onHost
     * @param string $user
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function permission(string $onHost, string $user): object|array|string
    {
        return $this->request('GET', 'permissions/'.$onHost.'/'.$user, []);
    }

    /**
     * @param string $onHost
     * @param string $user
     * @param array $parameter
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function setPermission(string $onHost, string $user, array $parameter): object|array|string
    {
        // {"exchange":"amq.topic","write":"^a","read":".*"}

        return $this->request('PUT', 'permissions/'.$onHost.'/'.$user, $parameter);
    }

    /**
     * @param string $onHost
     * @param string $user
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function deletePermission(string $onHost, string $user): object|array|string
    {
        return $this->request('DELETE', 'permissions/'.$onHost.'/'.$user, []);
    }
}

