<?php

namespace Dnsoft\Menu\Models;

use Dnsoft\Core\Support\Traits\TreeCacheableTrait;
use Dnsoft\Core\Traits\TranslatableTrait;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use TreeCacheableTrait;
    use TranslatableTrait;

    protected $table = 'menu__menu_items';

    public $translatable = [
        'label',
    ];

    protected $menuBuilder;

    protected $fillable = [
        'menu_id',
        'label',
        'icon',
        'class',
        'target',
        'menu_builder_class',
        'menu_builder_args',
        'parent_id',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function getUrl()
    {
        if ($this->getMenuBuilder()) {
            return $this->getMenuBuilder()->getFrontendUrl();
        }

        return null;
    }

    public function getMenuBuilder()
    {
        if (!$this->menuBuilder && class_exists($this->menu_builder_class)) {
            $this->menuBuilder = app($this->menu_builder_class)->setArgs($this->menu_builder_args);
        }

        return $this->menuBuilder;
    }
}
