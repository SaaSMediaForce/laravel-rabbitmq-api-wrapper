<?php
declare(strict_types=1);

namespace Secvisio\LaravelRabbitmqApiWrapper\Health;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Secvisio\LaravelRabbitmqApiWrapper\RequestQuery;
use Secvisio\LaravelRabbitmqApiWrapper\Traits\RabbitmqApiRequest;

class Health
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
    public function clusterHasAlarms(): object|array|string
    {
        return $this->request('GET', 'health/checks/alarms', []);
    }

    /**
     * @return object|array|string
     * @throws ConnectionException
     */
    public function serverHasAlarms(): object|array|string
    {
        return $this->request('GET', 'health/checks/local-alarms', []);
    }

    /**
     * @param int $unitCount
     * @param string $unit // Valid units: days, weeks, months, years
     * @return object|array|string
     * @throws ConnectionException
     */
    public function listenerHasExpiredCertificate(int $unitCount, string $unit): object|array|string
    {
        return $this->request('GET', 'health/checks/certificate-expiration/'.$unitCount.'/'.$unit, []);
    }

    /**
     * @param int $port
     * @return object|array|string
     * @throws ConnectionException
     */
    public function portHasActiveListener(int $port): object|array|string
    {
        return $this->request('GET', 'health/checks/port-listener/'.$port, []);
    }

    /**
     * @param string $protocol // Valid protocol names are: amqp091, amqp10, mqtt, stomp, web-mqtt, web-stomp
     * @return object|array|string
     * @throws ConnectionException
     */
    public function protocolHasActiveListener(string $protocol): object|array|string
    {
        return $this->request('GET', 'health/checks/protocol-listener/'.$protocol, []);
    }

    /**
     * @return object|array|string
     * @throws ConnectionException
     */
    public function vhostsAreRunning(): object|array|string
    {
        return $this->request('GET', 'health/checks/virtual-hosts', []);
    }

    /**
     * @return object|array|string
     * @throws ConnectionException
     */
    public function classicQueuesInSync(): object|array|string
    {
        return $this->request('GET', 'health/checks/node-is-mirror-sync-critical', []);
    }

    /**
     * @return object|array|string
     * @throws ConnectionException
     */
    public function quorumQueuesInSync(): object|array|string
    {
        return $this->request('GET', 'health/checks/node-is-mirror-sync-critical', []);
    }
}
