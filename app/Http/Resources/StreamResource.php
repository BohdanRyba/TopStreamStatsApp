<?php

declare(strict_types=1);
declare(strict_types=1);

namespace App\Http\Resources;

use App\Contracts\Resources\ResourceContract;
use App\Models\Stream;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class StreamResource implements ResourceContract
{
    public function __construct(private Stream $model)
    {
    }

    /**
     * @inheritdoc
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * @inheritdoc
     */
    public function getByID(mixed $id = null): Builder|array|Collection|Model
    {
        return $this->model::query()->find($id);
    }

}
