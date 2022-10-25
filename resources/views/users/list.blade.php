@extends('layout.master')

@section('title','Users')
@section('add_new',route('admin.users.create'))
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
                            return $row->roles?->first()?->name;
                        },
                         'filter' => [
                            'class' => Itstructure\GridView\Filters\DropdownFilter::class,
                            'name' => 'role',
                            'data' => ['key' => 'value', 'key' => 'value'] // Array keys are for html <option> tag values, array values are for titles.
                        ]
                        ],
                        'created_at',
                        [
                            'label' => 'Actions', // Optional
                            'class' => Itstructure\GridView\Columns\ActionColumn::class, // Required
                            'actionTypes' => [ // Required
                            'edit' => function ($data) {
                                return route('admin.users.edit', $data['id']);
                            },
                            [
                                'class' => Itstructure\GridView\Actions\Delete::class, // Required
                                'url' => function ($data) { // Optional
                                    return route('admin.users.destroy', $data['id']);
                                },
                                'htmlAttributes' => [ // Optional
                                    'style' => 'color: yellow; font-size: 16px;',
                                    'onclick' => 'return window.confirm("Are you sure you want to delete?");'
                                ]
                            ]
                          ]
                        ]
                    ],
                ]) !!}

            </div>
    </section>

@endsection
