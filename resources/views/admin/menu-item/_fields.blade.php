
<div class="row">
    <div class="col-12 col-lg-9">
        <div class="form-horizontal">
            @input(['name' => 'label', 'label' => __('menu::menu-item.label')])

            @select([
                'name' => 'menu_builder_class',
                'label' => __('menu::menu-item.menu_builder_class'),
                'options' => module_menu__get_config_builder_type(),
            ])
            <div class="menu-builder-wrap-category" style="display: none">
                @select([
                    'name' => 'type_category',
                    'label' => __('Category'),
                    'options' => get_catalog_category_parent_options(),
                ])
            </div>
            <div class="menu-builder-wrap-page" style="display: none">
                @select([
                    'name' => 'type_page',
                    'label' => __('Page'),
                    'options' => module_menu__get_all_pages(),
                ])
            </div>
            <div class="menu-builder-wrap-url" style="display: none">
                @input(['name' => 'type_url', 'label' => __('URL')])
            </div>
            @select(['name' => 'parent_id', 'label' => __('menu::menu-item.parent'), 'options' => module_menu__get_menu_item_parent_options($menu->id)])
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
            @checkbox(['name' => 'is_active', 'label' => '' , 'placeholder' => __('menu::menu.is_active')])
            @mediafile(['name' => 'image', 'label' => __('menu::menu-item.image'), 'conversion' => ''])
        </div>
    </div>
    <div class="col-12 col-lg-3">
        @translatable(['checkKey' => 'label'])
    </div>
</div>

@push('scripts')
    <script src="{{ asset('vendor/menu/admin/js/builditem.js') }}"></script>
@endpush
