<?php
declare(strict_types=1);

namespace Secvisio\LaravelRabbitmqApiWrapper\Bindings;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Secvisio\LaravelRabbitmqApiWrapper\RequestQuery;
use Secvisio\LaravelRabbitmqApiWrapper\Traits\RabbitmqApiRequest;

class Bindings
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
        return $this->request('GET', 'bindings', []);
    }

    /**
     * @param string $vhost
     * @param array $parameter
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function bindings(string $vhost, array $parameter): object|array|string
    {
        return $this->request('GET', 'bindings/'.$vhost, $parameter);
    }
}

/**
 * X                /api/bindings    A list of all bindings.
 * X                /api/bindings/vhost    A list of all bindings in a given virtual host.
 * X            X    /api/bindings/vhost/e/exchange/q/queue
 * A list of all bindings between an exchange and a queue. Remember, an exchange and a queue can be bound together many times!
 *
 * To create a new binding, POST to this URI. Request body should be a JSON object optionally containing two fields, routing_key (a string) and arguments (a map of optional arguments):
 *
 * {"routing_key":"my_routing_key", "arguments":{"x-arg": "value"}}
 * All keys are optional. The response will contain a Location header telling you the URI of your new binding.
 * X        X        /api/bindings/vhost/e/exchange/q/queue/props    An individual binding between an exchange and a queue. The props part of the URI is a "name" for the binding composed of its routing key and a hash of its arguments. props is the field named "properties_key" from a bindings listing response.
 * X            X    /api/bindings/vhost/e/source/e/destination
 * A list of all bindings between two exchanges, similar to the list of all bindings between an exchange and a queue, above.
 *
 *
 * To create a new binding, POST to this URI. Request body should be a JSON object optionally containing two fields, routing_key (a string) and arguments (a map of optional arguments):
 *
 * {"routing_key":"my_routing_key", "arguments":{"x-arg": "value"}}
 * All keys are optional. The response will contain a Location header telling you the URI of your new binding.
 * X        X        /api/bindings/vhost/e/source/e/destination/props    An individual binding between two exchanges. Similar to the individual binding between an exchange and a queue, above.
 */
