<?php

if (!function_exists('module_menu__get_menu_item_parent_options'))
{
  /**
   * @param $menuId
   * @return array
   */
  function module_menu__get_menu_item_parent_options($menuId): array
  {
    $options = [];

    $categoryTreeList = \DnSoft\Menu\Models\MenuItem::whereMenuId($menuId)->withDepth()->get()->toFlatTree();
    foreach ($categoryTreeList as $item) {
      $options[] = [
        'value' => $item->id,
        'label' => trim(str_pad('', $item->depth * 3, '-')) . ' ' . $item->label,
      ];
    }

    return $options;
  }
}

if (!function_exists('module_menu__get_config_builder_type'))
{
  function module_menu__get_config_builder_type(): array
  {
    $options = [];
    $builder_type = config('menu.builder_type');
    foreach ($builder_type as $key => $item) {
      $options[] = [
        'value' => str_replace(' ', '', strtolower($key)),
        'label' => $key,
      ];
    }

    return $options;
  }
}

if (!function_exists('convert_param_save_menu_item'))
{
  function convert_param_save_menu_item($dataSave)
  {
    $builderType = config('menu.builder_type');
    $field = 'menu_builder_';
    $value = '';
    foreach ($builderType as $key => $item) {
      $key = str_replace(' ', '', strtolower($key));
      if ($dataSave[$field . $key] && $key == $dataSave['menu_builder_class']) {
        $value = $dataSave[$field . $key];
        break;
      }
    }
    return $value;
  }
}
