<div class="dd" id="menuNestable"></div>
<hr>
<a href="{{ route('menu.admin.menu-item.create', ['menu_id' => $item->id]) }}" class="btn btn-outline-primary">
    <i class="fas fa-plus"></i>
    {{ __('menu::menu.menu_item.create.page_title') }}
</a>

@push('scripts')
    <script>
        var menuItems = @json($menuItems);
        var menuId = '{{ $item->id }}';
    </script>
    <script src="{{ asset('vendor/dnsoft/admin/assets/libs/nestable2/jquery.nestable.min.js') }}"></script>
    <script src="{{ asset('vendor/dnsoft/admin/assets/libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('vendor/menu/admin/js/builder.js') }}"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/dnsoft/admin/assets/libs/nestable2/jquery.nestable.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dnsoft/admin/assets/libs/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/menu/admin/css/builder.css') }}">
@endpush
