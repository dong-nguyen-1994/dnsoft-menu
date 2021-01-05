@extends('core::admin.master')

@section('content-header')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">{{ __('menu::menu.edit.breadcrumb') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('menu::menu.edit.index') }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ __('menu::menu.edit.page_title') }}</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <form role="form" method="POST" action="{{ route('menu.admin.menu.update', $item->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('menu::menu.edit.page_title') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @include('menu::admin.menu._field')
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ __('core::button.save') }}</button>
                            <button class="btn btn-secondary" name="continue" value="1" type="submit">{{ __('core::button.save_and_edit') }}</button>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('menu::menu.menu_item.index.page_title') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            @include('menu::admin.menu.builder')
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </form>
    </div>
@stop
