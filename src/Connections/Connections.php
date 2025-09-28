<?php
declare(strict_types=1);

namespace Secvisio\LaravelRabbitmqApiWrapper\Connections;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Secvisio\LaravelRabbitmqApiWrapper\RequestQuery;
use Secvisio\LaravelRabbitmqApiWrapper\Traits\RabbitmqApiRequest;

class Connections
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
        return $this->request('GET', 'connections', []);
    }

    /**
     * @param string $connectionName
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function connection(string $connectionName): object|array|string
    {
        return $this->request('GET', 'connections/'.$connectionName, []);
    }

    /**
     * @param string $connectionName
     * @param array $parameter
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function deleteConnection(string $connectionName, array $parameter = []): object|array|string
    {
        if(empty($parameter)) {
            $parameter['X-Reason'] = 'No reason for deleting provided';
        }
        return $this->request('DELETE', 'connections/'.$connectionName, $parameter);
    }

    /**
     * @param string $userName
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function userConnections(string $userName): object|array|string
    {
        return $this->request('GET', 'connections/username/'.$userName, []);
    }

    /**
     * @param string $userName
     * @param array $parameter
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function deleteUserConnections(string $userName, array $parameter = []): object|array|string
    {
        if(empty($parameter)) {
            $parameter['X-Reason'] = 'No reason for deleting provided';
        }
        return $this->request('DELETE', 'connections/username/'.$userName, $parameter);
    }

    /**
     * @param string $connectionName
     * @return object|array|string
     * @throws \Illuminate\Http\Client\ConnectionException
     */
    public function channels(string $connectionName): object|array|string
    {
        return $this->request('GET', 'connections/'.$connectionName.'/channels', []);
    }

}

