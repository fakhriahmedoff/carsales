<?php

namespace App\Services;

use App\Http\Requests\User\UserSaveRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;

class UserService extends BaseService
{
    public function __construct(private User $model, private UserRepository $userRepository)
    {
        parent::__construct($model);
    }

    public function store(UserSaveRequest $request, User $user): Model|bool|null
    {
        $payload = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ];

        if($request->get('password'))
        {
            $payload['password'] = $request->get('password');
        }

        $user = $this->userRepository->updateOrCreate($user,$payload);

        if ($request->get('roles'))
        {
            $user->roles()->detach();

            foreach($request->get('roles') as $role)
            {
                $user->assignRole($role);
            }
        }

        return $user;
    }

    public function update(UserUpdateRequest $request, User $user): Model|bool|null
    {
        $payload = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ];

        if($request->get('password'))
        {
            $payload['password'] = $request->get('password');
        }

        if ($request->get('roles'))
        {
            $user->roles()->detach();

            foreach($request->get('roles') as $role)
            {
                $user->assignRole($role);
            }
        }

        return $this->userRepository->updateOrCreate($user,$payload);
    }


    public function delete(User $user): ?bool
    {
        return $user->delete();
    }

}