<?php

namespace DnSoft\Menu\Http\Controllers\Api;

use DnSoft\Menu\Services\MenuService;
use Illuminate\Routing\Controller;
use DnSoft\Menu\Http\Resources\MenuResource;

class MenuController extends Controller
{
  /** @var MenuService */
  protected $menuService;

  public function __construct(MenuService $menuService)
  {
    $this->menuService = $menuService;    
  }

  public function getMenuItem($key)
  {
    return [
      'data' => $this->menuService->getMenuItemByKey($key)
    ];
  }
}
