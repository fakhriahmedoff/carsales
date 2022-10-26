<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helpers\DataProvider;
use App\Http\Requests\User\UserSaveRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Queries\UsersSearchQuery;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
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

    public function index(Request $request): Application|Factory|View
    {
        $query        = new UsersSearchQuery();
        $dataProvider = new DataProvider($query->search($request->filters));
        $roles = $this->roleRepository->getAll()->pluck('name', 'id');

        return view('users.list', [
            'dataProvider' => $dataProvider,
            'roles'        => $roles
        ]);
    }

    public function create(): Application|Factory|View
    {
        $edit  = false;
        $roles = $this->roleRepository->getAll()->pluck('name', 'id')->toArray();


        return view('users.form')->with(['edit' => $edit, 'roles' => $roles]);
    }

    public function store(UserSaveRequest $request): RedirectResponse
    {
        try {
            $this->userService->store($request, new User());

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

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        try {
            $this->userService->update($request, $user);

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
