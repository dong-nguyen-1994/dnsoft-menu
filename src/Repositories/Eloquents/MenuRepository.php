<?php

namespace DnSoft\Menu\Repositories\Eloquents;

use DnSoft\Core\Repositories\BaseRepository;
use DnSoft\Menu\Repositories\MenuRepositoryInterface;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface
{
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    public function findBySlug($slug, $columns = ['*'])
    {
        return $this->model->where('slug', $slug)->first($columns);
    }
}
