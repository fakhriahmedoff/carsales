<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Helpers\DataProvider;
use App\Http\Requests\User\UserSaveRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\Brand;
use App\Models\User;
use App\Repositories\BrandRepository;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\Factory;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function __construct(
        private BrandRepository $brandRepository,
    ) {
    }

    public function index(Request $request): Application|Factory|View
    {
        $dataProvider = new DataProvider(Brand::query());

        return view('brands.list', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function create(): Application|Factory|View
    {
        $edit  = false;

        return view('brands.form')->with(['edit' => $edit]);
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
