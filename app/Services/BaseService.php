<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class BaseService
{
    public function __construct(private Model $model)
    {
    }

    public function create(array $payload): ?Model
    {
        return $this->model->create($payload);
    }

    public function update(int $id, array $payload): Model|bool|null
    {
        return $this->model->findOrFail($id)->update($payload);
    }

    public function updateOrCreate(Model $model, array $payload): Model|bool|null
    {
        return $this->model::updateOrCreate(
            ['id' => $model->id],
            $payload
        );
    }

    public function delete(int $id): ?bool
    {
        return $this->model->findOrFail($id)->delete();
    }


}
