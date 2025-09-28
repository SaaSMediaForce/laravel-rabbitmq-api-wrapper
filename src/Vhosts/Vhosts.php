<?php
declare(strict_types=1);

namespace Secvisio\LaravelRabbitmqApiWrapper\Vhosts;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Secvisio\LaravelRabbitmqApiWrapper\Traits\RabbitmqApiRequest;

class Vhosts
{

    use RabbitmqApiRequest;

    /**
     * TODO: add these methods * PUT|DELETE /api/vhosts/[name], * POST /api/vhosts/[name]/start/node
     */

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
        return $this->request('GET', 'vhosts', []);
    }

    /**
     * @param string $onVhost
     * @param array $parameter
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function connections(string $onVhost, array $parameter = []): object|array|string
    {
        return $this->request('GET', 'vhosts/'.$onVhost.'/connections', $parameter);
    }

    /**
     * @param string $onVhost
     * @param array $parameter
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function channels(string $onVhost, array $parameter = []): object|array|string
    {
        return $this->request('GET', 'vhosts/'.$onVhost.'/channels', $parameter);
    }

    /**
     * @param string $onVhost
     * @param array $parameter
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function vhost(string $onVhost, array $parameter = []): object|array|string
    {
        return $this->request('GET', 'vhosts/'.$onVhost, $parameter);
    }

    /**
     * @param string $onVhost
     * @param array $parameter
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function permissions(string $onVhost, array $parameter = []): object|array|string
    {
        return $this->request('GET', 'vhosts/'.$onVhost.'/permissions', $parameter);
    }

    /**
     * @param string $onVhost
     * @param array $parameter
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function topicPermissions(string $onVhost, array $parameter = []): object|array|string
    {
        return $this->request('GET', 'vhosts/'.$onVhost.'/topic-permissions', $parameter);
    }

    /**
     * @param string $newVhostName
     * @param array $parameter
     * @return object|array|string
     */
    public function add(string $newVhostName, array $parameter = []): object|array|string
    {
        return $this->request('PUT', 'vhosts/'.$newVhostName, $parameter);
    }

    /**
     * An individual virtual host. As a virtual host usually only has a name, you do not need an HTTP body when PUTing one of these. To set metadata on creation, provide a body like the following:
     * {"description":"virtual host description", "tags":"accounts,production"}
     * tags is a comma-separated list of tags. These metadata fields are optional. To enable / disable tracing, provide a body looking like:
     * {"tracing":true}
     */

    /**
     * @param string $vhost
     * @param array $parameter
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function delete(string $vhost, array $parameter = []): object|array|string
    {
        return $this->request('DELETE', 'vhosts/'.$vhost, $parameter);
    }

    /**
     * @param string $onVhost
     * @param string $node
     * @param array $parameter
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function start(string $onVhost, string $node, array $parameter = []): object|array|string
    {
        return $this->request('POST', 'vhosts/'.$onVhost, $parameter);
    }
}
