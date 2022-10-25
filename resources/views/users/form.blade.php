@extends('layout.master')

@section('title','Users')
@section('add_new',route('admin.users.create'))

@php
$route = $edit ? route('admin.users.update',$user->id) : route('admin.users.store');
$method = $edit ? 'PUT' : 'POST';
@endphp

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="card col-4 card-primary card-outline">
                <div class="card-body">
                    <form method="POST" action="{{$route}}">
                        @csrf
                        @method($method)

                        <div class="form-group">
                            {!! FormField::text('name',['value' => isset($user) ? $user->name: '']) !!}
                        </div>
                        <div class="form-group">
                            {!! FormField::text('email',['value' => isset($user) ? $user->email : '']) !!}
                        </div>
                        <div class="form-group">
                            {!! FormField::text('password',['type' => 'password','required' => !isset($user),'placeholder' => 'leave empty if you dont want update password']) !!}
                        </div>

                        <div class="form-group">
                            {!! FormField::multiSelect('roles', $roles,['value' => isset($user) ? $user->roles()->pluck('id') : '']) !!}
                        </div>

                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                </div>
            </div>
    </section>

@endsection
