<?php

namespace Dnsoft\Menu\Repositories\Eloquents;

use Dnsoft\Core\Repositories\BaseRepository;
use Dnsoft\Core\Repositories\NestedRepositoryTrait;
use Dnsoft\Menu\Repositories\MenuItemRepositoryInterface;

class MenuItemRepository extends BaseRepository implements MenuItemRepositoryInterface
{
    use NestedRepositoryTrait;

    public function getInTree()
    {
        return $this->model->withDepth()->defaultOrder()->get();
    }

    public function getTree($menuId, $columns = ['*'])
    {
        $columns = array_merge($columns, [
            'parent_id',
            '_lft',
            '_rgt'
        ]);

        return $this->model
            ->where('menu_id', $menuId)
            ->defaultOrder()
            ->get($columns)
            ->toTree();
    }

    public function updateTree(array $data)
    {
        $lastNode = null;
        $lastRoot = null;
        foreach ($data as $item) {
            $model = $this->updateById([
                'parent_id' => $item['parent_id'] ?? null
            ], $item['id']);

            if ($lastRoot && empty($item['parent_id'])) {
                $model->afterNode($lastRoot)->save();
            }

            if ($lastNode && $model->parent_id && $lastNode->parent_id == $model->parent_id) {
                $model->afterNode($lastNode)->save();
            }

            $lastNode = $model;
            if (empty($item['parent_id'])) {
                $lastRoot = $model;
            }
        }
    }
}
