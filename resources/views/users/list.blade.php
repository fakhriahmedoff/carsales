@extends('layout.master')

@section('title','Users')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">

                {!! grid_view([
                    'dataProvider' => $dataProvider,
                    'useFilters' => true,
                    'columnFields' => [
                        'id',
                        'name',
                        'email',
                        ['label' => 'roles',
                        'value' => function($row){
                            return $row->roles->first()->name;
                        },
                         'filter' => [
                            'class' => Itstructure\GridView\Filters\DropdownFilter::class,
                            'name' => 'role',
                            'data' => ['key' => 'value', 'key' => 'value'] // Array keys are for html <option> tag values, array values are for titles.
                        ]
                        ],
                        'created_at'
                    ]
                ]) !!}

            </div>
    </section>

@endsection
