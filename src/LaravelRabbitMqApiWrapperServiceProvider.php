<?php
declare(strict_types=1);

namespace Secvisio\LaravelRabbitmqApiWrapper;

use Illuminate\Support\ServiceProvider;
class LaravelRabbitMqApiWrapperServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/rabbitmq-api-wrapper.php',
            'rabbitmq.api.wrapper'
        );
    }

    /**
     * Register the application's event listeners.
     */
    public function boot(): void
    {
//        /** @var QueueManager $queue */
//        $queue = $this->app['queue'];
//
//        $queue->addConnector('rabbitmq', function () {
//            return new RabbitMQConnector($this->app['events']);
//        });
    }
}
