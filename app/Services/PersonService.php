<?php
namespace App\Services;

use App\Models\Person as Model;
use App\Transforms\Person as Transform;
use Soft\Starter\Supports\Service;
use Illuminate\Support\Collection;

/**
 * Servicio que maneja personas
 *
 * @author Luis Angel Cordoba
 * @implements Service<Transform>
 */
class PersonService implements Service
{
    /**
     * @var PersonRepository
     */
    private PersonRepository $personRepository;

    /**
     * @param PersonRepository $personRepository
     */
    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function save($transform): Transform
    {
        return $this->transform($this->personRepository->save($transform));
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(?bool $active = null): Collection
    {
        return $this->personRepository->findAll()
            ->map(fn ($model) => $this->transform($model));
    }


    /**
     * {@inheritdoc}
     */
    public function select(): Collection
    {
        return $this->personRepository->findAll()
            ->map(fn ($model) => $this->transform($model)->toSelect());
    }

    /**
     * {@inheritdoc}
     */
    public function findById(int|string $id): ?Transform
    {
        $model = $this->personRepository->findById($id);
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
        $transform->setIdentification($model['Identification']);
        $transform->setNames($model['names']);
        $transform->setSurnames($model['surnames']);
        $transform->setEmail($model['email']);
        $transform->setPhone($model['phone']);
        $transform->setActive($model['active']);
        return $transform;
    }

}