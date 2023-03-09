<?php

namespace DnSoft\Menu\Repositories;

use DnSoft\Core\Repositories\BaseRepositoryInterface;

interface MenuRepositoryInterface extends BaseRepositoryInterface
{
    public function findBySlug($slug, $columns = ['*']);
}
