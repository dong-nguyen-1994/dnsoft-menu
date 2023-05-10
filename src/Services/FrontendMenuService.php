<?php

namespace DnSoft\Menu\Services;

use DnSoft\Core\Utils\BuildTree;
use DnSoft\Menu\Models\Menu;
use DnSoft\Menu\Repositories\Eloquents\MenuItemRepository;
use DnSoft\Menu\Repositories\Eloquents\MenuRepository;
use DnSoft\Menu\Repositories\MenuItemRepositoryInterface;
use DnSoft\Menu\Repositories\MenuRepositoryInterface;

class FrontendMenuService
{
  /**
   * @var MenuRepositoryInterface|MenuRepository
   */
  private $menuRepository;

  /**
   * @var MenuItemRepositoryInterface|MenuItemRepository
   */
  private $menuItemRepository;

  public function __construct(
    MenuRepositoryInterface $menuRepository,
    MenuItemRepositoryInterface $menuItemRepository
  ) {
    $this->menuRepository = $menuRepository;
    $this->menuItemRepository = $menuItemRepository;
  }

  public function render($menuId, $view = null)
  {
    if (is_numeric($menuId)) {
      $menu = $this->menuRepository->find($menuId);
    } elseif (is_string($menuId)) {
      $menu = $this->menuRepository->findBySlug($menuId);
    } elseif ($menuId instanceof Menu) {
      $menu = $menuId;
    }

    if (empty($menu)) {
      return view('menu::menu-render.not-found')->with([
        'menuId' => $menuId,
      ]);
    }

    $menuItems = $this->menuItemRepository->getTree($menu->id);

    $menuItems = BuildTree::buildMenuTree($menuItems);

    if (!$view || !view()->exists($view)) {
      if (!$view || !view()->exists($view = "menu::menu-render.{$view}")) {
        $view = 'menu::menu-render.default';
      }
    }

    return view($view)->with([
      'menuItems' => $menuItems,
      'level' => 1
    ]);
  }
}
