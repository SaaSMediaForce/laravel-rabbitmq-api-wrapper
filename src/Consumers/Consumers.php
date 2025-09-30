<?php
declare(strict_types=1);

namespace Secvisio\LaravelRabbitmqApiWrapper\Consumers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Secvisio\LaravelRabbitmqApiWrapper\RequestQuery;
use Secvisio\LaravelRabbitmqApiWrapper\Traits\RabbitmqApiRequest;

class Consumers
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
        return $this->request('GET', 'consumers', []);
    }

    /**
     * @param string $vhost
     * @return object|array|string
     * @throws ConnectionException
     */
    public function consumers(string $vhost): object|array|string
    {
        return $this->request('GET', 'consumers/'.$vhost, []);
    }
}
