<?php

namespace App\Services;

use App\Models\Person as Model;
use Facade\FlareClient\Report;
use Illuminate\Database\Eloquent\Collection;
use Soft\Starter\Supports\Repository as SupportRepository;

/**
 * Manejo general de las personas
 *
 * @author Luis Angel Cordoba
 * @extends Repository<Model>
 */
class PersonRepository extends SupportRepository
{
    public function __construct()
    {
        parent::__construct(new Model());
    }

    /**
     * Obtiene todos los registros
     *
     * @return Collection<int,Model>
     */
    public function findAll(): Collection
    {
        return $this->getModel()
            ->get();
    }

    /**
     * Obtiene la persona de acuerdo a su id
     *
     * @param int $sourceId
     * @return ?Model
     */
    public function findUserByIdSource(int $sourceId): ?Model
    {
        return $this->getModel()
            ->select('persons.*')
            ->where('persons.id', $sourceId)
            ->first();
    }
}