<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface EloquentInterface
{
    public function create(array $attributes): Model;
    public function find(int $id): ?Model;
    public function update(array $attributes, $id);
    public function destroy(int $id);
}
