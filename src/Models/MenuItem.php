<?php

namespace DnSoft\Menu\Models;

use DnSoft\Core\Traits\TreeCacheableTrait;
use DnSoft\Core\Traits\TranslatableTrait;
use DnSoft\Media\Traits\HasMediaTraitV2;
// use DnSoft\Media\Traits\HasMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MenuItem extends Model
{
  use TreeCacheableTrait;
  use TranslatableTrait;
  // use HasMediaTrait;
  use HasMediaTraitV2;

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
    'menu_builder_id',
    'parent_id',
    'is_active',
    'image',
    'url',
  ];

  protected $casts = [
    'is_active' => 'boolean',
  ];

  public function menu()
  {
    return $this->belongsTo(Menu::class);
  }

  public function getUrlAttribute()
  {
    $builderType = config('menu.builder_type');
    $builderClass = Str::ucfirst($this->menu_builder_class);
    $param = $this->menu_builder_id;
    $realClass = $builderType[$builderClass] ?? '';
    if (class_exists($realClass)) {
      $obj = $realClass::find($param);
      return $obj->url;
    }
    return $this->menu_builder_id;
  }

  public function toArray(): array
  {
    $arr = parent::toArray();
    $arr['label'] = $this->label;

    return $arr;
  }

  public function setImageAttribute($value)
  {
    static::saved(function ($model) use ($value) {
      $model->syncMedia($value, 'image');
    });
  }

  public function getImageAttribute()
  {
    return $this->getFirstMedia();
  }

  public function getImageName()
  {
    return 'image';
  }
}
