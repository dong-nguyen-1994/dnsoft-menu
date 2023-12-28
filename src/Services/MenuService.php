<?php

namespace DnSoft\Menu\Services;

use DnSoft\Core\Utils\BuildTree;
use DnSoft\Menu\Exceptions\MenuException;
use DnSoft\Menu\Models\Menu;
use DnSoft\Menu\Repositories\MenuItemRepositoryInterface;

class MenuService
{
  /**
   * Get tree menu of menu items
   * @param string $key
   * @return array
   * @throws MenuException
   */
  public function getMenuItemByKey($key)
  {
    $menu = Menu::whereSlug($key)->first();
    if (!$menu) {
      throw new MenuException("The menu key $key does not exist");
    }
    $menuItems = app(MenuItemRepositoryInterface::class)->getTree($menu->id);
    return BuildTree::buildMenuTree($menuItems);
  }
}
