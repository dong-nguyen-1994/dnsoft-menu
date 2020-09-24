<?php

namespace Dnsoft\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = 'menu__menu_items';

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
}
