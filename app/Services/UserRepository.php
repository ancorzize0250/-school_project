<?php

namespace App\Services;

use App\Models\User as Model;
use Facade\FlareClient\Report;
use Illuminate\Database\Eloquent\Collection;
use Soft\Starter\Support\Repository as SupportRepository;

/**
 * Manejo general de los servidores o DNS.
 *
 * @author Luis Angel Cordoba
 * @extends Repository<Model>
 */
class UserRepository extends SupportRepository
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
     * Obtiene el servidor asociado a un grupo
     *
     * @param int $sourceId
     * @return ?Model
     */
    public function findUserByIdSource(int $sourceId): ?Model
    {
        return $this->getModel()
            ->select('user.*')
            ->where('user.id', $sourceId)
            ->first();
    }
}