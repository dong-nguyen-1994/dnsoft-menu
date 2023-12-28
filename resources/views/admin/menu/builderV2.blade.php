<table class="table table-centered table-striped table-bordered mb-0 toggle-circle">
    <thead>
    <tr>
        <th>{{ __('ID') }}</th>
        <th>{{ __('menu::menu-item.label') }}</th>
{{--        <th>{{ __('menu::menu-item.description') }}</th>--}}
{{--        <th>{{ __('menu::menu-item.is_active') }}</th>--}}
{{--        <th>{{ __('menu::menu-item.created_at') }}</th>--}}
{{--        <th>@translatableHeader</th>--}}
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($menuItems as $itemMenu)
        <tr>
            <td>{{ $itemMenu->id }}</td>
            <td>
                <a href="{{ route('menu.admin.menu-item.edit', $itemMenu->id) }}">
                    {{ trim(str_pad('', $itemMenu->depth * 3, '-')) }}
                    {{ $itemMenu->label }}
                </a>
                <a href="#" target="_blank" title="{{ __('core::button.view') }}">
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </td>
{{--            <td>{{ $item->description }}</td>--}}
{{--            <td>--}}
{{--                @if($item->is_active)--}}
{{--                    <i class="fas fa-check text-success"></i>--}}
{{--                @endif--}}
{{--            </td>--}}
{{--            <td>{{ $item->created_at }}</td>--}}
{{--            <td>--}}
{{--                @translatableStatus(['editUrl' => route('menu.admin.menu-item.edit', $item->id)])--}}
{{--            </td>--}}
            <td class="text-right">
                @admincan('menu.admin.menu-item.create')
                <a href="{{ route('menu.admin.menu-item.create', ['menu_id' => $item->id, 'parent_id' => $itemMenu->id]) }}" class="btn btn-primary-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
                    <i class="fas fa-plus" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></i>
                </a>
                @endadmincan

                @admincan('menu.admin.menu-item.edit')
                <a href="{{ route('menu.admin.menu-item.move-up', $itemMenu->id) }}" class="btn btn-info-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
                    <i class="fas fa-chevron-up" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></i>
                </a>
                @endadmincan

                @admincan('menu.admin.menu-item.edit')
                <a href="{{ route('menu.admin.menu-item.move-down', $itemMenu->id) }}" class="btn btn-info-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
                    <i class="fas fa-chevron-down" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></i>
                </a>
                @endadmincan

                @admincan('menu.admin.menu-item.edit')
                <a href="{{ route('menu.admin.menu-item.edit', $itemMenu->id) }}" class="btn btn-success-soft btn-sm mr-1" style="background-color: rgb(211 250 255); color: #0fac04; width: 32px;border-color: rgb(167 255 247); border: 1px solid">
                    <i class="fas fa-pencil-alt" style="font-size: 15px; margin-left: -5px; margin-top: 5px"></i>
                </a>
                @endadmincan

                @admincan('menu.admin.menu-item.destroy')
                <x-button-delete-v1 url="{{ route('menu.admin.menu-item.destroy', $itemMenu->id) }}"/>
                @endadmincan
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<hr>
<a href="{{ route('menu.admin.menu-item.create', ['menu_id' => $item->id]) }}" class="btn btn-outline-primary">
    <i class="fas fa-plus"></i>
    {{ __('menu::menu.menu_item.create.page_title') }}
</a>
