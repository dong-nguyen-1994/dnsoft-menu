<div class="row">
  <div class="col-12 col-lg-9">
    <div class="form-horizontal">
      @input(['name' => 'label', 'label' => __('menu::menu-item.label')])

      @select([
      'name' => 'menu_builder_class',
      'label' => __('menu::menu-item.menu_builder_class'),
      'options' => module_menu__get_config_builder_type(),
      'is_label' => true
      ])
      
      @if (is_module_actived('catalog'))
      <div class="menu-builder-wrap-productcategory" style="display: none">
        @select([
        'name' => 'menu_builder_productcategory',
        'label' => __('Product Category'),
        'options' => get_catalog_category_parent_options(),
        'is_label' => true
        ])
      </div>
      @endif
      <div class="menu-builder-wrap-cmscategory" style="display: none">
        @select([
        'name' => 'menu_builder_cmscategory',
        'label' => __('Category'),
        'options' => get_cms_category_parent_options(),
        'is_label' => true
        ])
      </div>
      <div class="menu-builder-wrap-page" style="display: none">
        @select([
        'name' => 'menu_builder_page',
        'label' => __('Page'),
        'options' => module_menu__get_all_pages(),
        'is_label' => true
        ])
      </div>
      <div class="menu-builder-wrap-url" style="display: none">
        @input(['name' => 'menu_builder_url', 'label' => __('URL')])
      </div>
      @select([
        'name' => 'parent_id',
        'label' => __('Parent menu'),
        'options' => module_menu__get_menu_item_parent_options($menu->id),
        'is_label' => true
      ])
      
      @select([
      'name' => 'target',
      'label' => __('menu::menu-item.target'),
      'is_label' => true,
      'options' => [
          ['value' => '_self', 'label' => __('menu::menu-item.self')],
          ['value' => '_blank', 'label' => __('menu::menu-item.blank')],
        ],
        'allowClear' => false,
        'default' => '_self',
      ])
      @input(['name' => 'icon', 'label' => __('menu::menu-item.icon'), 'helper' => __('menu::menu-item.icon_helper')])
      @input(['name' => 'class', 'label' => __('menu::menu-item.class')])
      @checkbox(['name' => 'is_active', 'label' => '' , 'placeholder' => __('menu::menu.is_active'), 'default' => true])

    </div>
  </div>
  <div class="col-12 col-lg-3">
    @translatable(['checkKey' => 'label'])
    <hr>
    Image
    @mediaV1(['name' => 'image', 'id' => 'image-component-1', 'type' => 'image', 'show_button' => true])
  </div>
</div>

@push('scripts')
<script src="{{ asset('vendor/menu/admin/js/builditem.js') }}"></script>
@endpush