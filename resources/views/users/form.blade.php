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
                            {!! FormField::text('name',['value' => $user?->name]) !!}
                        </div>
                        <div class="form-group">
                            {!! FormField::text('email',['value' => $user?->email]) !!}
                        </div>
                        <div class="form-group">
                            {!! FormField::text('password',['placeholder' => 'leave empty if you dont want update password']) !!}
                        </div>

                        <div class="form-group">
                            {!! FormField::multiSelect('roles', $roles,['value' => $user->roles()->pluck('id')]) !!}
                        </div>

                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                </div>
            </div>
    </section>

@endsection
