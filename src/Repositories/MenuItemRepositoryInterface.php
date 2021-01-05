<?php

namespace Dnsoft\Menu\Repositories;

use Dnsoft\Core\Repositories\BaseRepositoryInterface;

interface MenuItemRepositoryInterface extends BaseRepositoryInterface
{
    public function getTree($menuId, $columns = ['*']);

    public function updateTree(array $data);
}
