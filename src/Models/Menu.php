<?php

namespace Dnsoft\Menu\Models;

use Dnsoft\Core\Traits\CacheableTrait;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use CacheableTrait;

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
