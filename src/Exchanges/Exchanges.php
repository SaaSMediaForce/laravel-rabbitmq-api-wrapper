<?php
declare(strict_types=1);

namespace Secvisio\LaravelRabbitmqApiWrapper\Exchanges;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Secvisio\LaravelRabbitmqApiWrapper\RequestQuery;
use Secvisio\LaravelRabbitmqApiWrapper\Traits\RabbitmqApiRequest;

class Exchanges
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
        return $this->request('GET', 'exchanges', []);
    }

    /**
     * @param string $onVhost
     * @return object|array|string
     * @throws ConnectionException
     */
    public function exchanges(string $onVhost): object|array|string
    {
        return $this->request('GET', 'exchanges/'.$onVhost, []);
    }

    /**
     * @param string $onVhost
     * @return object|array|string
     * @throws ConnectionException
     */
    public function sourceBindings(string $onVhost, string $name): object|array|string
    {
        return $this->request('GET', 'exchanges/'.$onVhost.'/'.$name.'/bindings/source', []);
    }

    /**
     * @param string $onVhost
     * @param string $name
     * @return object|array|string
     * @throws ConnectionException
     */
    public function destinationBindings(string $onVhost, string $name): object|array|string
    {
        return $this->request('GET', 'exchanges/'.$onVhost.'/'.$name.'/bindings/destination', []);
    }
}

/**
 * X    X    X          /api/exchanges/vhost/name    An individual exchange. To PUT an exchange, you will need a body looking something like this:
 *                          {"type":"direct","auto_delete":false,"durable":true,"internal":false,"arguments":{}}
 *                          The type key is mandatory; other keys are optional.
 *                          When DELETEing an exchange you can add the query string parameter if-unused=true. This prevents the delete from succeeding if the exchange is bound to a queue or as a source to another exchange.
 *
 *              X       /api/exchanges/vhost/name/publish    Publish a message to a given exchange. You will need a body looking something like:
     *                      {"properties":{},"routing_key":"my key","payload":"my body","payload_encoding":"string"}
     *                      All keys are mandatory. The payload_encoding key should be either "string" (in which case the payload will be taken to be the UTF-8 encoding of the payload field) or "base64" (in which case the payload field is taken to be base64 encoded).
     *                      If the message is published successfully, the response will look like:
     *                      {"routed": true}
     *                      routed will be true if the message was sent to at least one queue.
     *                      Please note that the HTTP API is not ideal for high performance publishing; the need to create a new TCP connection for each message published can limit message throughput compared to AMQP or other protocols using long-lived connections.
 */
