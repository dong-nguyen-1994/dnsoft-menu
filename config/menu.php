<?php

return [
  'builder_type' => [
    'CMS Category' => \Module\Cms\Models\Category::class,
    'Page' => \Module\Cms\Models\Page::class,
    'URL' => 'URL',
  ],
  'view' => 'menu::v1.admin.menu-item._fields',
  'need_convert' => [
    'Cmscategory' => \Module\Cms\Models\Category::class
  ],
];
