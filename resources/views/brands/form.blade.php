@extends('layout.master')

@section('title','Users')
@section('add_new',route('admin.brands.create'))

@php
$route = $edit ? route('admin.brands.update',$brand->id) : route('admin.brands.store');
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
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                </div>
            </div>
    </section>

@endsection
