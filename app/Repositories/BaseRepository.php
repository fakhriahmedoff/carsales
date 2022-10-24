<?php
declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BaseRepository
{
    public function __construct(private Model $model)
    {
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function getById(int $id, $relations = []): ?Model
    {
        return $this->model->with($relations)->findOrFail($id);
    }

    public function getPaginated(int $paginate)
    {
        return $this->model->paginate($paginate);
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
