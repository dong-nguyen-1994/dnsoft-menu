<?php

use DnSoft\Menu\Http\Controllers\Api\MenuController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
  Route::get('menu/{key}', [MenuController::class, 'getMenuItem'])->name('menu.api.menu.get-list');
});
