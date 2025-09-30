<?php
declare(strict_types=1);

namespace SaasMediaForce\LaravelRabbitmqApiWrapper\Queues;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use SaasMediaForce\LaravelRabbitmqApiWrapper\Traits\RabbitmqApiRequest;

class Queues
{
    /**
     * TODO: add these methods * PUT|DELETE /api/queues/vhost/name * DELETE /api/queues/vhost/name/contents * POST /api/queues/vhost/name/actions * POST /api/queues/vhost/name/get
     */

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
        protected bool           $fullResponse = false
    )
    {
    }

    /**
     * @param bool $detailed
     * @return object|array|string
     * @throws ConnectionException
     */
    public function all(bool $detailed = false): object|array|string
    {
        return $this->request('GET', 'queues', []);
    }

    /**
     * @param bool $detailed
     * @return object|array|string
     * @throws ConnectionException
     */
    public function allDetailed(bool $detailed = false): object|array|string
    {
        return $this->request('GET', 'queues/detailed', []);
    }

    /**
     * @param string $onVhost
     * @param array $parameter
     * @return object|array|string
     * @throws ConnectionException
     */
    public function queues(string $onVhost, array $parameter = []): object|array|string
    {
        return $this->request('GET', 'queues/' . $onVhost, $parameter);
    }

    /**
     * @param string $onVhost
     * @param string $queue
     * @param array $parameter
     * @return object|array|string
     * @throws ConnectionException
     */
    public function queue(string $onVhost, string $queue, array $parameter = []): object|array|string
    {
        return $this->request('GET', 'queues/' . $onVhost . '/' . $queue, $parameter);
    }

    /**
     * @param string $onVhost
     * @param string $queue
     * @param array $parameter
     * @return object|array|string
     * @throws ConnectionException
     */
    public function bindings(string $onVhost, string $queue, array $parameter = []): object|array|string
    {
        return $this->request('GET', 'queues/' . $onVhost . '/' . $queue . '/bindings', $parameter);
    }
}
