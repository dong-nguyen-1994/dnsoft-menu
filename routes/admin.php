<?php

use DnSoft\Menu\Http\Controllers\Admin\MenuController;
use DnSoft\Menu\Http\Controllers\Admin\MenuItemController;

Route::prefix('menu')->group(function () {
//    Route::get('', [MenuController::class, 'index']);

    Route::prefix('')->group(function () {
        Route::get('', [MenuController::class, 'index'])
            ->name('menu.admin.menu.index')
            ->middleware('admin.can:menu.admin.menu.index');

        Route::get('create', [MenuController::class, 'create'])
            ->name('menu.admin.menu.create')
            ->middleware('admin.can:menu.admin.menu.create');

        Route::post('/', [MenuController::class, 'store'])
            ->name('menu.admin.menu.store')
            ->middleware('admin.can:menu.admin.menu.create');

        Route::get('{id}/edit', [MenuController::class, 'edit'])
            ->name('menu.admin.menu.edit')
            ->middleware('admin.can:menu.admin.menu.edit');

        Route::put('{id}', [MenuController::class, 'update'])
            ->name('menu.admin.menu.update')
            ->middleware('admin.can:menu.admin.menu.edit');

        Route::delete('{id}', [MenuController::class, 'destroy'])
            ->name('menu.admin.menu.destroy')
            ->middleware('admin.can:menu.admin.menu.destroy');
    });

    Route::prefix('menu-item')->middleware('admin.can:menu.admin.menu.edit')->group(function () {
        Route::get('create', [MenuItemController::class, 'create'])
            ->name('menu.admin.menu-item.create');

        Route::post('/', [MenuItemController::class, 'store'])
            ->name('menu.admin.menu-item.store');

        Route::get('{id}/edit', [MenuItemController::class, 'edit'])
            ->name('menu.admin.menu-item.edit');

        Route::put('{id}', [MenuItemController::class, 'update'])
            ->name('menu.admin.menu-item.update');

        Route::delete('{id}', [MenuItemController::class, 'destroy'])
            ->name('menu.admin.menu-item.destroy');

        Route::post('update-tree', [MenuItemController::class, 'updateTree'])
            ->name('menu.admin.menu-item.update-tree');

        Route::get('{id}/move-up', [MenuItemController::class, 'moveUp'])
            ->name('menu.admin.menu-item.move-up')
            ->middleware('admin.can:menu.admin.menu-item.edit');

        Route::get('{id}/move-down', [MenuItemController::class, 'moveDown'])
            ->name('menu.admin.menu-item.move-down')
            ->middleware('admin.can:menu.admin.menu-item.edit');
    });
});
