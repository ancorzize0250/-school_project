<?php
namespace App\Services;

use App\Models\User as Model;
use App\Transforms\User as Transform;
use Soft\Starter\Supports\Service;
use Illuminate\Support\Collection;

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
        $s = $this->userRepository->save($transform);
        return $this->transform($s);
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(?bool $active = null): Collection
    {
        return $this->userRepository->findAll()
            ->map(fn ($model) => $this->transform($model));
    }


    /**
     * {@inheritdoc}
     */
    public function select(): Collection
    {
        return $this->userRepository->findAll()
            ->map(fn ($model) => $this->transform($model)->toSelect());
    }

    /**
     * {@inheritdoc}
     */
    public function findById(int|string $id): ?Transform
    {
        $model = $this->userRepository->findById($id);
        if (!is_null($model)) {
            return $this->transform($model);
        }
        return null;
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