<?php

namespace DnSoft\Menu\Models;

use DnSoft\Core\Traits\CacheableTrait;
use DnSoft\Core\Traits\TranslatableTrait;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  use CacheableTrait;
  use TranslatableTrait;

  public $translatable = [
    'name',
  ];

  protected $table = 'menu__menus';

  protected $fillable = [
    'name',
    'slug',
    'is_active',
  ];

  protected $casts = [
    'is_active' => 'boolean',
  ];

  public function items()
  {
    return $this->hasMany(MenuItem::class);
  }
}
