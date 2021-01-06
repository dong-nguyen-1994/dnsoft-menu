<div class="card-body">
    @input(['name' => 'name', 'label' => __('menu::menu.name')])
    @slug(['name' => 'slug', 'label' => __('menu::menu.slug'), 'field_slug' => 'name'])
    @checkbox(['name' => 'is_active', 'label' => '' , 'placeholder' => __('menu::menu.is_active')])
</div>
