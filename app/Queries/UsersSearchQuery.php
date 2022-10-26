<?php

namespace App\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UsersSearchQuery implements Query
{
    public function search($filters = []): Builder
    {
        $query = User::query()->oldest('id');

        if (!empty($filters['role'])) {
            $query->whereHas('roles',function ($role) use ($filters) {
                $role->where('id', $filters['role']);
            });
        }

        return $query;
    }
}