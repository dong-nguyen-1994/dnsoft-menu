<?php

namespace DnSoft\Menu\Models;

use DnSoft\Core\Traits\TreeCacheableTrait;
use DnSoft\Core\Traits\TranslatableTrait;
use DnSoft\Media\Traits\HasMediaTraitV3;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MenuItem extends Model
{
  use TreeCacheableTrait;
  use TranslatableTrait;
  use HasMediaTraitV3;

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
    $arrNeedConvert = config('menu.need_convert');
    $arrKeyNeedConvert = array_keys($arrNeedConvert);
    if (in_array($builderClass, $arrKeyNeedConvert)) {
      $realClass = $arrNeedConvert[$builderClass];
    } else {
      $realClass = $builderType[$builderClass] ?? '';
    }
    if (class_exists($realClass)) {
      $obj = $realClass::find($param);
      return $obj ? $obj->url : $this->menu_builder_id;
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
    $this->mediaAttributes['image'] = $value;
  }

  public function getImageAttribute()
  {
    return $this->getFirstMedia($this->getMediaConversion());
  }

  public function getMediaConversion()
  {
    return 'image';
  }
}
