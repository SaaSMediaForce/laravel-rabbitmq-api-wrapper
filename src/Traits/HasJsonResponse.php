<?php
declare(strict_types=1);

namespace SaasMediaForce\LaravelRabbitmqApiWrapper\Traits;

use Illuminate\Http\JsonResponse;

trait HasJsonResponse
{
    const RESPONSE_SUCCESS = 'success';
    const RESPONSE_ERROR = 'error';

    /**
     * @param string $status
     * @param null $response
     * @param int $statusCode
     * @return JsonResponse
     */
    public function respond(string $status, $response = null, int $statusCode = JsonResponse::HTTP_OK): JsonResponse
    {
        $data = ['status' => $status, 'status_code' => $statusCode, 'data' => $response];

        return response()->json($data);
    }

    /**
     * @param mixed|null $response
     * @param int $statusCode
     * @return JsonResponse
     */
    public function success(mixed $response = null, int $statusCode = JsonResponse::HTTP_OK): JsonResponse
    {
        return $this->respond(self::RESPONSE_SUCCESS, $response, $statusCode);
    }

    /**
     * @param mixed $response
     * @param int $statusCode
     * @return JsonResponse
     */
    public function error(mixed $response, int $statusCode = JsonResponse::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        return $this->respond(self::RESPONSE_ERROR, $response, $statusCode);
    }
}
