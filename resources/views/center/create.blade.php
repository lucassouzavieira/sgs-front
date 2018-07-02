@extends('adminlte::page')

@section('title', trans('general.center'))

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3>{{ trans('general.new') }} - {{trans('general.center')}}</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="{{ route('center.store') }}">
            <div class="box-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">{{ trans('general.name') }}</label>
                    <input class="form-control" name="name" placeholder="{{ trans('general.name') }}" type="text" min="5"
                           required>
                </div>
                <div class="form-group">
                    <label for="description">{{ trans('general.description') }}</label>
                    <input class="form-control" name="description" placeholder="{{ trans('general.description') }}"
                           required type="text" min="5">
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">{{ trans('general.save') }}</button>
            </div>
        </form>
    </div>
@stop