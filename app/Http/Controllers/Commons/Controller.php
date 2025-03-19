<?php

namespace App\Http\Controllers\Commons;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Soft\Starter\Supports\Transformable;
use Soft\Starter\Supports\Validable;
use Soft\Starter\Exceptions\SoftException;
use Soft\Starter\Constant;

/**
 * @template S
 * @template T
 * @extends ViewController<S>
 * @implements Transformable<T>
 */
abstract class Controller extends ViewController implements Transformable, Validable
{
     /**
     * @var string
     */
    public const ERROR_CREATING = 'messages.An error occurred while creating';

    /**
     * @var string
     */
    public const ERROR_UPDATING = 'messages.An error occurred while updating';

    /**
     * @var string
     */
    protected $created = '';

    /**
     * @var string
     */
    protected $updated = '';
    
    /**
     * @param S $service
     */
    public function __construct($service)
    {
        parent::__construct($service);
        
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), $this->rules());
            $validator->validate();

            $form = $validator->validated();
            $transform = $this->converted($form, $request);

            $result = $this->service->save($transform);
            return $this->created([
                'id' => $result->getId(),
            ], strval(__($this->created)));
        } catch (Exception $e) {
            return $this->exception($e, __(self::ERROR_CREATING));
        }
    }

    /**
     * @param Request $request
     * @param int|string $id
     * @return JsonResponse
     */
    public function update(Request $request, int|string $id): JsonResponse
    {
        try {
            if (!is_numeric($id) || empty($id)) {
                throw new SoftException(__(self::ERROR_UPDATING), [
                    'General' => [
                        strval(__(Constant::IS_NUMERIC)),
                    ],
                ]);
            }

            $validator = Validator::make($request->all(), $this->rules());
            $validator->validate();

            $form = $validator->validated();
            $transform = $this->converted($form, $request);
            $transform->setId(intval($id));

            $this->service->save($transform);

            return $this->message(strval(__($this->updated)));
        } catch (Exception $e) {
            return $this->exception($e, __(self::ERROR_UPDATING));
        }
    }
}