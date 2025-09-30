<?php
declare(strict_types=1);

namespace SaasMediaForce\LaravelRabbitmqApiWrapper\Users;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use SaasMediaForce\LaravelRabbitmqApiWrapper\Traits\RabbitmqApiRequest;

class Users
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
     */
    public function all(): object|array|string
    {
        return $this->request('GET', 'users', []);
    }

    /**
     * @return object|array|string
     */
    public function usersWithoutPermission(): object|array|string
    {
        return $this->request('GET', 'users/without-permissions', []);
    }

    /**
     * @param string $name
     * @return object|array|string
     */
    public function user(string $name): object|array|string
    {
        return $this->request('GET', 'users/'.$name, []);
    }

    /**
     * @param string $name
     * @return object|array|string
     */
    public function userPermissions(string $name): object|array|string
    {
        return $this->request('GET', 'users/'.$name.'/permissions', []);
    }

    /**
     * @param string $name
     * @return object|array|string
     */
    public function userTopicPermissions(string $name): object|array|string
    {
        return $this->request('GET', 'users/'.$name.'/topic-permissions', []);
    }

    /**
     * @return object|array|string
     */
    public function usersLimits(): object|array|string
    {
        return $this->request('GET', 'user-limits', []);
    }

    /**
     * @param string $name
     * @return object|array|string
     */
    public function userLimits(string $name): object|array|string
    {
        return $this->request('GET', 'user-limits/'.$name, []);
    }
}

/**
 *                  X    /api/users/bulk-delete    Bulk deletes a list of users. Request body must contain the list:
 *                          {"users" : ["user1", "user2", "user3"]}
 * X    X    X          /api/users/name    An individual user. To PUT a user, you will need a body looking something like this:
 *                          {"password":"secret","tags":"administrator"}
 *                              or:
 *                          {"password_hash":"2lmoth8l4H0DViLaK9Fxi6l9ds8=", "tags":["administrator"]}
 *                          The tags key is mandatory. Either password or password_hash can be set. If neither are set the user will not be able to log in with a password, but other mechanisms like client certificates may be used. Setting password_hash to "" will ensure the user cannot use a password to log in. tags is a comma-separated list of tags for the user. Currently recognised tags are administrator, monitoring and management. password_hash must be generated using the algorithm described here. You may also specify the hash function being used by adding the hashing_algorithm key to the body. Currently recognised algorithms are rabbit_password_hashing_sha256, rabbit_password_hashing_sha512, and rabbit_password_hashing_md5.
 * X    X               /api/user-limits/user/name    Set or delete per-user limit for user. The name URL path element refers to the name of the limit (max-connections, max-channels). Limits are set using a JSON document in the body:
 *                          {"value": 100}
 *                          . Example request:
 *                          curl -4u 'guest:guest' -H 'content-type:application/json' -X PUT localhost:15672/api/user-limits/guest/max-connections -d '{"value": 50}'
 */
