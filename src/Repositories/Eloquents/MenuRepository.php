<?php

namespace Dnsoft\Menu\Repositories\Eloquents;

use Dnsoft\Core\Repositories\BaseRepository;
use Dnsoft\Menu\Repositories\MenuRepositoryInterface;

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
