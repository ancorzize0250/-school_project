<?php

namespace App\Http\Controllers\Commons;


use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mantum\Starter\Constant;
use Soft\Starter\Controllers\RestController;
use Soft\Starter\Exceptions\SoftException;
/**
 * @template S
 */
abstract class ViewController extends RestController
{
    /**
     * @var S
     */
    protected $service;

    /**
     * @var string|null
     */
    protected $authorize;

     /**
     * @param S $service
     */
    public function __construct($service)
    {
        $this->service = $service;
    }

    /**
     * @param int|string $id
     * @return JsonResponse
     */
    public function detail(int|string $id): JsonResponse
    {
        try {
            if (!is_numeric($id) || empty($id)) {
                throw new SoftException(__(Constant::ERROR_GETTING), [
                    'General' => [
                        strval(__(Constant::IS_NUMERIC)),
                    ],
                ]);
            }

            $result = $this->service->findById(intval($id));
            if (is_null($result)) {
                throw new SoftException(__(Constant::ERROR_GETTING), [
                    'General' => [
                        strval(__(Constant::NOT_FOUND)),
                    ],
                ]);
            }

            return $this->ok($result);
        } catch (Exception $e) {
            return $this->exception($e);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        try {
            $format = $request->input('format');
            $active = $request->boolean('active', true);

            $collection = $format !== 'select'
                ? $this->service->findAll($active)
                : $this->service->select();

            $result = $collection
                ->map(fn ($transform) => $transform->toArray())
                ->all();

            return $this->ok($result);
        } catch (Exception $e) {
            return $this->exception($e);
        }
    }

}