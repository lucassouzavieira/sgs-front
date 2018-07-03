@extends('adminlte::page')

@section('title', trans('general.building'))

@section('content_header')
    <h3>{{trans('general.building')}}</h3>
@stop

@section('content')
    @php
        $data->columns([
            'id' => 'ID',
            'name' => trans('general.building'),
            'address' => trans('general.address'),
            '#' => trans('general.actions')
        ])->modify('#', function ($object){
            $id = $object->id;
            $edit = trans('general.edit');
            $editRoute = route('building.edit', ['id' => $id]);
            $exclude = trans('general.exclude');
            $deleteRoute = route('building.delete', ['id' => $id]);
            $update = '<a href="'.$editRoute.'" class="btn btn-sm btn-block btn-primary"><i class="fa fa-edit"></i> ' . $edit . '</a>';
            $delete = '<a href="'.$deleteRoute.'" class="btn btn-sm btn-block btn-danger"><i class="fa fa-trash"></i> ' . $exclude . '</a>';
            return $update . $delete;
        });
    @endphp
    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('building.create') }}" class="btn btn-success"><i
                        class="fa fa-plus"></i> {{ trans('general.new') }}</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {!! $data->render() !!}
        </div>
    </div>
@stop