<?php

namespace Dnsoft\Menu\Repositories;

use Dnsoft\Core\Repositories\BaseRepositoryInterface;

interface MenuRepositoryInterface extends BaseRepositoryInterface
{
    public function findBySlug($slug, $columns = ['*']);
}
