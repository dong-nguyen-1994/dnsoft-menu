
<div class="row">
    <div class="col-12 col-lg-9">
        <div class="form-horizontal">
            @select([
                'name' => 'menu_builder_class',
                'label' => __('menu::menu-item.menu_builder_class'),
                'options' => [],
                'allowClear' => true,
{{--                'default' => \Newnet\Menu\MenuBuilders\UrlMenuBuilder::class--}}
            ])

            <div class="menu-builder-wrap">
{{--                @foreach(FrontendMenuBuilder::getPanels() as $panel)--}}
{{--                    <div class="menu-item-panel" data-class-name="{{ stripslashes(get_class($panel)) }}" style="display: none;">--}}
{{--                        @includeIf($panel->getViewName())--}}
{{--                    </div>--}}
{{--                @endforeach--}}
            </div>

            @input(['name' => 'label', 'label' => __('menu::menu-item.label')])

            @select(['name' => 'parent_id', 'label' => __('menu::menu-item.parent'), 'options' =>[] ])
            @select([
                'name' => 'target',
                'label' => __('menu::menu-item.target'),
                'options' => [
                    ['value' => '_self', 'label' => __('menu::menu-item.self')],
                    ['value' => '_blank', 'label' => __('menu::menu-item.blank')],
                ],
                'allowClear' => false,
                'default' => '_self',
            ])
            @input(['name' => 'icon', 'label' => __('menu::menu-item.icon'), 'helper' => __('menu::menu-item.icon_helper')])
            @input(['name' => 'class', 'label' => __('menu::menu-item.class')])
        </div>
    </div>
    <div class="col-12 col-lg-3">
        @translatable(['checkKey' => 'label'])
    </div>
</div>

@push('scripts')
    <script src="{{ asset('vendor/menu/admin/js/builditem.js') }}"></script>
@endpush