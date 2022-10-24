<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\User\UserSaveRequest;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Itstructure\GridView\DataProviders\EloquentDataProvider;

class UserController extends Controller
{
    public function __construct(
        private UserRepository $userRepository,
        private UserService $userService,
        private RoleRepository $roleRepository
    ) {
    }

    public function index(): Application|Factory|View
    {
        $dataProvider = new EloquentDataProvider(User::query());

        return view('users.list', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function create()
    {
        $edit = false;

        return view('users.form')->with(['edit' => $edit]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        $edit  = true;
        $roles = $this->roleRepository->getAll()->pluck('name','id')->toArray();

        return view('users.form')
            ->with([
                'edit'  => $edit,
                'user'  => $user,
                'roles' => $roles]);
    }

    public function update(UserSaveRequest $request, User $user)
    {
        try {
            $this->userService->updateOrCreate($request, $user);

            return redirect()->route('admin.users.index')->withSuccess('Action done Successfully');
        } catch (\RuntimeException $exception) {

            return redirect()->back()->withErrors('result', $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        //
    }
}
