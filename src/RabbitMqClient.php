<?php
declare(strict_types=1);

namespace SaasMediaForce\LaravelRabbitmqApiWrapper;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use SaasMediaForce\LaravelRabbitmqApiWrapper\Bindings\Bindings;
use SaasMediaForce\LaravelRabbitmqApiWrapper\Channels\Channels;
use SaasMediaForce\LaravelRabbitmqApiWrapper\Connections\Connections;
use SaasMediaForce\LaravelRabbitmqApiWrapper\Consumers\Consumers;
use SaasMediaForce\LaravelRabbitmqApiWrapper\Exchanges\Exchanges;
use SaasMediaForce\LaravelRabbitmqApiWrapper\Health\Health;
use SaasMediaForce\LaravelRabbitmqApiWrapper\Nodes\Nodes;
use SaasMediaForce\LaravelRabbitmqApiWrapper\Permissions\Permissions;
use SaasMediaForce\LaravelRabbitmqApiWrapper\Queues\Queues;
use SaasMediaForce\LaravelRabbitmqApiWrapper\Servers\Servers;
use SaasMediaForce\LaravelRabbitmqApiWrapper\Users\Users;
use SaasMediaForce\LaravelRabbitmqApiWrapper\Vhosts\Vhosts;

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
