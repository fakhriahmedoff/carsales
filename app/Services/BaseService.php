<?php
declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class BaseService
{
    public function __construct(private Model $model)
    {
    }



}
