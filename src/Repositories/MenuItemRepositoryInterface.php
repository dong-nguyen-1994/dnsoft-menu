<?php

namespace DnSoft\Menu\Repositories;

use DnSoft\Core\Repositories\BaseRepositoryInterface;

interface MenuItemRepositoryInterface extends BaseRepositoryInterface
{
    public function getTree($menuId, $columns = ['*']);

    public function updateTree(array $data);
}
