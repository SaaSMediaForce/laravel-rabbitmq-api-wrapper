<?php
declare(strict_types=1);

namespace Secvisio\LaravelRabbitmqApiWrapper;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use Secvisio\LaravelRabbitmqApiWrapper\Traits\HasJsonResponse;

class RequestQuery
{
    use HasJsonResponse;

    /**
     * @var mixed
     */
    protected mixed $result = null;

    /**
     * @param string $requestType
     * @param PendingRequest $http
     * @param string $apiUri
     * @param array $parameter
     * @param bool $fullResponse
     */
    public function __construct(
        protected string $requestType = 'GET',
        protected PendingRequest $http,
        protected string $apiUri,
        protected array $parameter,
        protected bool $fullResponse = false
    ) {}

    /**
     * @param int|null $page
     * @param int|null $pageSize
     * @return mixed
     * @throws ConnectionException
     */
    public function paginate(int $page = null, int $pageSize = null): mixed
    {
        $page ??= config('rabbitmq.pagination.page', 1);
        $pageSize ??= config('rabbitmq.pagination.page_size', 50);

        $this->parameter['page'] = $page;
        $this->parameter['page_size'] = $pageSize;

        $response = match ($this->requestType) {
            'GET'    => $this->http->get($this->apiUri, $this->parameter),
            'POST'   => $this->http->post($this->apiUri, $this->parameter),
            'PUT'    => $this->http->put($this->apiUri, $this->parameter),
            'DELETE' => $this->http->delete($this->apiUri, $this->parameter),
            default  => throw new InvalidArgumentException("Unsupported request type: {$this->requestType}"),
        };

        if ($response->failed()) {

            if($response->status() === 503) {
                return $this->success(['status' => false], $response->status())->getData();
            }

            $message = 'Failed to retrieve '.$this->apiUri. ' with message: '.$response->reason();

            Log::error($message);

            return $this->error([
                'message' => $message,
                'parameter' => $this->parameter,
            ], $response->status());
        }

        $this->result = json_decode($response->getBody()->getContents());

        if (isset($this->result->status)) {
            $this->result->status = ($this->result->status === 'ok');
        }

        return $this->success($this->result, $response->status())->getData();
    }

    /**
     * @return mixed
     * @throws ConnectionException
     */
    public function toJson(): mixed
    {
        return $this->paginate();
    }

    /**
     * @return array
     * @throws ConnectionException
     */
    public function toArray(): array
    {
        return json_decode(json_encode($this->paginate()), true);
    }
}
