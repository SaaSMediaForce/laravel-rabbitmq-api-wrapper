<?php
declare(strict_types=1);

namespace SaasMediaForce\LaravelRabbitmqApiWrapper\Servers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use SaasMediaForce\LaravelRabbitmqApiWrapper\Traits\RabbitmqApiRequest;

class Servers
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
     * @throws ConnectionException
     */
    public function overview(): object|array|string
    {
        return $this->request('GET', 'overview', []);
    }

    /**
     * @return object|array|string
     * @throws ConnectionException
     */
    public function clusterName(): object|array|string
    {
        return $this->request('GET', 'cluster-name', []);
    }

    /**
     * @return object|array|string
     * @throws ConnectionException
     */
    public function extensions(): object|array|string
    {
        return $this->request('GET', 'extensions', []);
    }

    /**
     * @return object|array|string
     * @throws ConnectionException
     */
    public function whoami(): object|array|string
    {
        return $this->request('GET', 'whoami', []);
    }

}

