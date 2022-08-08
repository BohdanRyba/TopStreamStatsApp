<?php

declare(strict_types=1);

namespace App\Contracts\Resources;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ResourceContract
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param mixed|null $id
     * @return Builder|array|Collection|Model
     */
    public function getById(mixed $id = null): Builder|array|Collection|Model;
}
