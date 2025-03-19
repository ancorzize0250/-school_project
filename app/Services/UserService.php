<?php
namespace App\Services;

use App\Models\User as Model;
use App\Transforms\User as Transform;
use Soft\starter\Support\Service;

/**
 * Servicio que maneja los grupos de fuentes de datos
 *
 * @author Luis Angel Cordoba
 * @implements Service<Transform>
 */
class UserService implements Service
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function save($transform): Transform
    {
        return $this->transform($this->userRepository->save($transform));
    }

    public function findAll()
    {

    }
    public function select()
    {

    }
    public function findById()
    {

    }
    /**
     * @param Model $model
     * @return Transform
     */
    private function transform(Model $model): Transform
    {
        $transform = new Transform();
        $transform->setUser($model['user']);
        $transform->setEmail($model['email']);
        $transform->setPassword($model['password']);
        return $transform;
    }

}