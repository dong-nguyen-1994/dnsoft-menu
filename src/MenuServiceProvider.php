<?php

namespace Dnsoft\Menu;

use Dnsoft\Acl\Facades\Permission;
use Dnsoft\Core\Support\BaseModuleServiceProvider;
use Dnsoft\Menu\Models\Menu;
use Dnsoft\Menu\Models\MenuItem;
use Dnsoft\Menu\Repositories\Eloquents\MenuRepository;
use Dnsoft\Menu\Repositories\Eloquents\MenuItemRepository;
use Dnsoft\Menu\Repositories\MenuItemRepositoryInterface;
use Dnsoft\Menu\Repositories\MenuRepositoryInterface;

class MenuServiceProvider extends BaseModuleServiceProvider
{

    public function getModuleNamespace()
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
    }

    public function registerPermissions()
    {
        Permission::add('menu.admin.index', __('menu::permission.menu.index'));
        Permission::add('menu.admin.create', __('menu::permission.menu.create'));
        Permission::add('menu.admin.edit', __('menu::permission.menu.edit'));
        Permission::add('menu.admin.destroy', __('menu::permission.menu.destroy'));
    }
}
