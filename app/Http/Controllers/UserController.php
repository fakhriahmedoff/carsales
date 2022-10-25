<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\User\UserSaveRequest;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
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

    public function create(): Application|Factory|View
    {
        $edit  = false;
        $roles = $this->roleRepository->getAll()->pluck('name', 'id')->toArray();


        return view('users.form')->with(['edit' => $edit, 'roles' => $roles]);
    }

    public function store(UserSaveRequest $request)
    {
        try {
            $this->userService->updateOrCreate($request, new User());

            return redirect()->route('admin.users.index')->withSuccess('Action done Successfully');
        } catch (\RuntimeException $exception) {
            return redirect()->back()->withErrors(['msg' => $exception->getMessage()]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user): Application|Factory|View
    {
        $edit  = true;
        $roles = $this->roleRepository->getAll()->pluck('name', 'id')->toArray();

        return view('users.form')
            ->with([
                'edit' => $edit,
                'user' => $user,
                'roles' => $roles
            ]);
    }

    public function update(UserSaveRequest $request, User $user): RedirectResponse
    {
        try {
            $this->userService->updateOrCreate($request, $user);

            return redirect()->route('admin.users.index')->withSuccess('Action done Successfully');
        } catch (\RuntimeException $exception) {
            return redirect()->back()->withErrors('result', $exception->getMessage());
        }
    }

    public function destroy(User $user): RedirectResponse
    {
        try {
            $this->userService->delete($user);

            return redirect()->route('admin.users.index')->withSuccess('Action done Successfully');
        } catch (\RuntimeException $exception) {
            return redirect()->back()->withErrors('result', $exception->getMessage());
        }
    }
}
