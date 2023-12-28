@extends('core::admin.master')

@section('meta_title', __('menu::menu.index.page_title'))

@section('breadcrumbs')
<div class="row">
  <div class="col-12">
    <div class="page-title-box">
      <div class="page-title-right">
        <ol class="breadcrumb m-0">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
          <li class="breadcrumb-item active"><a href="{{ route('menu.admin.menu.index') }}">{{ __('menu::menu.index.page_title') }}</a></li>
        </ol>
      </div>
      <h4 class="page-title">{{ __('menu::menu.index.page_title') }}</h4>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="card-box">
      <div class="mb-2">
        <form>
          <div class="row">
            <div class="col-2 form-inline">
              <a id="demo-btn-addrow" class="btn btn-primary" href="{{ route('menu.admin.menu.create') }}"><i class="mdi mdi-plus-circle mr-2"></i> Add New Menu</a>
            </div>
            <div class="col-4">
              <input id="demo-input-search2" type="text" placeholder="Search" class="form-control" autocomplete="off" name="keyword" value="{{ request('keyword') }}">
            </div>
            <div class="col-2">
              <input type="submit" value="Search" class="btn btn-secondary">
            </div>
          </div>
        </form>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-centered table-striped table-bordered mb-0 toggle-circle">
          <thead>
            <tr>
              <th>ID</th>
              <th>{{ __('menu::menu.name') }}</th>
              <th>{{ __('menu::menu.slug') }}</th>
              <th>{{ __('acl::role.created_at') }}</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
            <tr>
              <td><a href="{{ route('menu.admin.menu.edit', $item->id) }}">{{ $item->id }}</a></td>
              <td><a href="{{ route('menu.admin.menu.edit', $item->id) }}">{{ $item->name }}</a></td>
              <td>
                <code>{<span>!!</span> \FrontendMenu::render('{{ $item->slug }}') !!}</code>
              </td>
              <td>{{ $item->created_at }}</td>
              {{-- <td><span class="tag tag-success">Approved</span></td>--}}
              <td class="text-right">
                @admincan('menu.admin.menu.edit')
                <a href="{{ route('menu.admin.menu.edit', $item->id) }}" class="btn btn-info-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid" title="{{ trans('slider::slider-item.builder') }}">
                  <i class="fas fa-pencil-alt" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></i>
                </a>
                @endadmincan

                @admincan('menu.admin.menu.destroy')
                <x-button-delete-v1 url="{{ route('menu.admin.menu.destroy', $item->id) }}"></x-button-delete-v1>
                @endadmincan
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <div class="float-right">
          {{ $items->links() }}
        </div>
      </div>
    </div>
    <!-- /.card -->
  </div>
</div>
@stop