<?php
declare(strict_types=1);

namespace SaasMediaForce\LaravelRabbitmqApiWrapper\Channels;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use SaasMediaForce\LaravelRabbitmqApiWrapper\Traits\RabbitmqApiRequest;

class Channels
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
    public function all(): object|array|string
    {
        return $this->request('GET', 'channels', []);
    }

    /**
     * @param string $channelName
     * @return object|array|string
     * @throws ConnectionException
     */
    public function channel(string $channelName): object|array|string
    {
        return $this->request('GET', 'channels/'.$channelName, []);
    }

}

