<?php
declare(strict_types=1);

namespace Secvisio\LaravelRabbitmqApiWrapper\Nodes;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Secvisio\LaravelRabbitmqApiWrapper\RequestQuery;
use Secvisio\LaravelRabbitmqApiWrapper\Traits\RabbitmqApiRequest;

class Nodes
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
        return $this->request('GET', 'nodes', []);
    }

    /**
     * @param string $onNode
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function node(string $onNode): object|array|string
    {
        return $this->request('GET', 'nodes/'.$onNode, []);
    }

    /**
     * @param string $onNode
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function nodeMemory(string $onNode): object|array|string
    {
        return $this->request('GET', 'nodes/'.$onNode.'/memory', []);
    }
}
