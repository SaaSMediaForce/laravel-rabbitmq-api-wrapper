<?php
declare(strict_types=1);

namespace Secvisio\LaravelRabbitmqApiWrapper;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Secvisio\LaravelRabbitmqApiWrapper\Bindings\Bindings;
use Secvisio\LaravelRabbitmqApiWrapper\Channels\Channels;
use Secvisio\LaravelRabbitmqApiWrapper\Connections\Connections;
use Secvisio\LaravelRabbitmqApiWrapper\Consumers\Consumers;
use Secvisio\LaravelRabbitmqApiWrapper\Exchanges\Exchanges;
use Secvisio\LaravelRabbitmqApiWrapper\Health\Health;
use Secvisio\LaravelRabbitmqApiWrapper\Nodes\Nodes;
use Secvisio\LaravelRabbitmqApiWrapper\Permissions\Permissions;
use Secvisio\LaravelRabbitmqApiWrapper\Queues\Queues;
use Secvisio\LaravelRabbitmqApiWrapper\Servers\Servers;
use Secvisio\LaravelRabbitmqApiWrapper\Users\Users;
use Secvisio\LaravelRabbitmqApiWrapper\Vhosts\Vhosts;

class RabbitMqClient
{
    /**
     * @var Factory|PendingRequest
     */
    protected Factory|PendingRequest $http;

    /**
     *
     */
    public function __construct()
    {
        $baseUri = 'http://'.config('rabbitmq-api-wrapper.rabbitmq_host').':'.config('rabbitmq-api-wrapper.rabbitmq_port').'/api/';
        $apiUser = config('rabbitmq-api-wrapper.rabbitmq_user');
        $apiPassword = config('rabbitmq-api-wrapper.rabbitmq_password');

        $this->http = Http::withBasicAuth($apiUser, $apiPassword)->baseUrl($baseUri);
    }

    /**
     * @return Vhosts
     */
    public function vhosts(): Vhosts
    {
        return new Vhosts($this->http);
    }

    /**
     * @return Queues
     */
    public function queues(): Queues
    {
        return new Queues($this->http);
    }

    /**
     * @return Nodes
     */
    public function nodes(): Nodes
    {
        return new Nodes($this->http);
    }

    /**
     * @return Consumers
     */
    public function consumers(): Consumers
    {
        return new Consumers($this->http);
    }

    /**
     * @return Exchanges
     */
    public function exchanges(): Exchanges
    {
        return new Exchanges($this->http);
    }

    /**
     * @return Bindings
     */
    public function bindings(): Bindings
    {
        return new Bindings($this->http);
    }

    /**
     * @return Users
     */
    public function users(): Users
    {
        return new Users($this->http);
    }

    /**
     * @return Servers
     */
    public function servers(): Servers
    {
        return new Servers($this->http);
    }

    /**
     * @return Health
     */
    public function health(): Health
    {
        return new Health($this->http);
    }

    /**
     * @return Connections
     */
    public function connections(): Connections
    {
        return new Connections($this->http);
    }

    /**
     * @return Channels
     */
    public function channels(): Channels
    {
        return new Channels($this->http);
    }

    /**
     * @return Permissions
     */
    public function permissions(): Permissions
    {
        return new Permissions($this->http);
    }
}
