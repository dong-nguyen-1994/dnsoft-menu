<?php

namespace DnSoft\Menu;

use DnSoft\Acl\Facades\Permission;
use DnSoft\Core\Events\CoreAdminMenuRegistered;
use DnSoft\Core\Support\BaseModuleServiceProvider;
use DnSoft\Menu\Facades\FrontendMenu;
use DnSoft\Menu\Models\Menu;
use DnSoft\Menu\Models\MenuItem;
use DnSoft\Menu\Repositories\Eloquents\MenuRepository;
use DnSoft\Menu\Repositories\Eloquents\MenuItemRepository;
use DnSoft\Menu\Repositories\MenuItemRepositoryInterface;
use DnSoft\Menu\Repositories\MenuRepositoryInterface;
use DnSoft\Menu\Services\FrontendMenuService;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Event;

class MenuServiceProvider extends BaseModuleServiceProvider
{
  public function register()
  {
    parent::register();

    $this->app->singleton('frontend-menu', FrontendMenuService::class);

    $this->mergeConfigFrom(realpath(__DIR__ . '/../config/menu.php'), 'menu');
  }

  public function getModuleNamespace(): string
  {
    return 'menu';
  }

  public function boot()
  {
    parent::boot();

    $this->app->singleton(MenuRepositoryInterface::class, function () {
      return new MenuRepository(new Menu());
    });

    $this->app->singleton(MenuItemRepositoryInterface::class, function () {
      return new MenuItemRepository(new MenuItem());
    });

    $this->registerPermissions();
    $this->registerAdminMenu();

    $this->publishes([
      __DIR__ . '/../public' => public_path('vendor/menu'),
    ], 'dnsoft-menu-asset');

    $this->publishes([
      __DIR__ . '/../config/menu.php' => config_path('menu.php'),
    ], 'dnsoft-menu-config');

    require_once __DIR__ . '/../helpers/helpers.php';

    AliasLoader::getInstance()->alias('FrontendMenu', FrontendMenu::class);
  }

  public function registerPermissions()
  {
    Permission::add('menu.admin.index', __('menu::permission.menu.index'));
    Permission::add('menu.admin.create', __('menu::permission.menu.create'));
    Permission::add('menu.admin.edit', __('menu::permission.menu.edit'));
    Permission::add('menu.admin.destroy', __('menu::permission.menu.destroy'));
  }

  public function registerAdminMenu()
  {
    Event::listen(CoreAdminMenuRegistered::class, function ($menu) {
      $menu->add('Menu', [
        'route' => 'menu.admin.menu.index',
        'parent' => $menu->system->id
      ])->nickname('menu_root')->data('order', 9)->prepend('<i class="fas fa-equals"></i>');
    });
  }
}
