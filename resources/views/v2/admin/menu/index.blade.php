@extends('core::v2.admin.master')

@section('title', __('menu::menu.index.page_title'))

@section('breadcrumbs')
<div class="title_left">
  <div class="page-title-box">
    <div class="page-title-right">
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('menu.admin.menu.index') }}">{{ __('menu::menu.index.page_title') }}</a></li>
      </ol>
    </div>
  </div>
</div>
@endsection

@section('search')
<div class="title_right">
  <div class="col-md-5 col-sm-5 form-group pull-right top_search">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
      </span>
    </div>
  </div>
</div>
@endsection

@section('content')

<div class="row" style="display: block;">
  <div class="clearfix"></div>
  <div class="col-md-12 col-sm-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Menu list</h2>
        <div class="clearfix text-right">
          <x-button-create url="{{ route('menu.admin.menu.create') }}" />
          <x-button-reload url="{{ route('menu.admin.menu.index') }}" />
        </div>
        <span>
        </span>
      </div>

      <div class="x_content">

        <div class="table-responsive">
          <table class="table table-striped jambo_table bulk_action">
            <thead>
              <tr class="headings">
                <th>
                  <input type="checkbox" id="check-all" class="flat">
                </th>
                <th>{{ __('menu::menu.name') }}</th>
                <th>{{ __('menu::menu.slug') }}</th>
                <th>{{ __('acl::profile.created_at') }}</th>
                <th>@translatableHeader</th>
                <th></th>

                <!-- <th class="bulk-actions" colspan="7">
                  <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                </th> -->
              </tr>
            </thead>

            <tbody>
              @foreach($items as $key => $item)
              <tr class="{{ $key % 2 == 0 ? 'even' : 'odd' }} pointer">
                <td class="a-center ">
                  <input type="checkbox" class="flat" name="table_records">
                </td>
                <td><a href="{{ route('menu.admin.menu.edit', $item->id) }}">{{ $item->name }}</a></td>
                <td>
                  <code>{<span>!!</span> \FrontendMenu::render('{{ $item->slug }}') !!}</code>
                </td>
                <td>{{ $item->created_at }}</td>
                <td>
                  @translatableStatus(['editUrl' => route('menu.admin.menu.edit', $item->id)])
                </td>
                <td class="text-right">
                  @admincan('menu.admin.menu.edit')
                  <x-button-edit url="{{ route('menu.admin.menu.edit', $item->id) }}" title="Edit profile" icon="fa fa-pencil-square-o" />
                  @endadmincan

                  @admincan('menu.admin.menu.destroy')
                  <x-button-delete url="{{ route('menu.admin.menu.destroy', $item->id) }}" />
                  @endadmincan
                </td>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@stop