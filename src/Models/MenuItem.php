<?php

namespace Dnsoft\Menu\Models;

use Dnsoft\Core\Traits\TreeCacheableTrait;
use Dnsoft\Core\Traits\TranslatableTrait;
use Dnsoft\Media\Traits\HasMediaTrait;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use TreeCacheableTrait;
    use TranslatableTrait;
    use HasMediaTrait;

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
        return $this->getFirstMedia('image');
    }
}
