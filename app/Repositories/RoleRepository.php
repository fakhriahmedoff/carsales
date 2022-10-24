<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository
{
    public function __construct(private Role $model)
    {
        parent::__construct($model);
    }

}