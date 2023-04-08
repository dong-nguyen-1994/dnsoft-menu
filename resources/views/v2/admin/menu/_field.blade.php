<div class="col-md-8 col-sm-8">
  @input(['name' => 'name', 'label' => __('menu::menu.name'), 'needStyle' => true])
  @slug(['name' => 'slug', 'label' => __('menu::menu.slug'), 'field_slug' => 'name', 'needStyle' => true])
  @checkbox(['name' => 'is_active', 'label' => '' , 'placeholder' => __('menu::menu.is_active'), 'needStyle' => true])
</div>

<div class="col-md-4 col-sm-4 mt-3">
<div class="alert alert-info" role="alert">
  @translatableAlert
</div>
  @translatable

  <hr>
  <x-button-save-edit/>
</div>