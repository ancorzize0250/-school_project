<?php

namespace App\Transforms\Commons;

trait Active
{
    /**
     * @var bool
     */
    private bool $active;

    /**
     * @param bool $active
     * @return void
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }
}