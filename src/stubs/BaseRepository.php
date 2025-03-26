<?php

namespace App\Repositories;

use App\Repositories\Interfaces\EloquentInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentInterface
{
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model The Eloquent model instance to be used.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new model instance and store it in the database.
     *
     * @param array $attributes The data to be inserted.
     * @return Model The created model instance.
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * Find a model instance by its primary key.
     *
     * @param int $id The ID of the model instance.
     * @return Model|null The found model instance or null if not found.
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Update an existing model instance by its ID.
     *
     * @param array $attributes The data to update.
     * @param int $id The ID of the model instance.
     * @return Model|null The updated model instance or null if not found.
     */
    public function update(array $attributes, int $id): ?Model
    {
        $model = $this->model->find($id);

        if (!$model) {
            return null;
        }

        $model->update($attributes);

        return $model;
    }

    /**
     * Delete a model instance by its ID.
     *
     * @param int $id The ID of the model instance.
     * @return bool|null True if deleted, false if not deleted, or null if the model was not found.
     */
    public function destroy(int $id): ?bool
    {
        $model = $this->model->find($id);

        return $model ? $model->delete() : null;
    }
}
