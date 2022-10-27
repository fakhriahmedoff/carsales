<?php

namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;

class BrandRepository extends BaseRepository
{
    public function __construct(private Brand $model)
    {
        parent::__construct($model);
    }


}