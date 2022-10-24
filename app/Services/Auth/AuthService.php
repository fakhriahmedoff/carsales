<?php
declare(strict_types=1);

namespace App\Services\Auth;

use App\Http\Requests\Auth\UserLoginRequest;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;


class AuthService extends BaseService
{
    public function __construct(private User $model)
    {
        parent::__construct($this->model);
    }


}
