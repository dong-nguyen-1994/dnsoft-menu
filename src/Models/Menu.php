<?php

namespace Dnsoft\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu__menus';

    protected $fillable = [
        'name',
        'slug',
    ];

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }
}
