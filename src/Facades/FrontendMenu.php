<?php

namespace Dnsoft\Menu\Facades;

use Illuminate\Support\Facades\Facade;

class FrontendMenu extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'frontend-menu';
    }
}
