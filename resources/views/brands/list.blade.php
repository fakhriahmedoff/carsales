@extends('layout.master')

@section('title','Brands')
@section('add_new',route('admin.brands.create'))
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
                        [
                            'label' => 'Actions', // Optional
                            'class' => Itstructure\GridView\Columns\ActionColumn::class, // Required
                            'actionTypes' => [ // Required
                            'edit' => function ($data) {
                                return route('admin.brands.edit', $data['id']);
                            },
                            [
                                'class' => Itstructure\GridView\Actions\Delete::class, // Required
                                'url' => function ($data) { // Optional
                                    return route('admin.brands.destroy', $data['id']);
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
