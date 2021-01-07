<?php

namespace Dnsoft\Menu\Http\Controllers\Admin;

use Dnsoft\Core\Facades\MenuAdmin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Dnsoft\Menu\Http\Requests\MenuItemRequest;
use Dnsoft\Menu\Models\MenuItem;
use Dnsoft\Menu\Repositories\Eloquents\MenuItemRepository;
use Dnsoft\Menu\Repositories\Eloquents\MenuRepository;
use Dnsoft\Menu\Repositories\MenuItemRepositoryInterface;
use Dnsoft\Menu\Repositories\MenuRepositoryInterface;

class MenuItemController extends Controller
{
    /**
     * @var MenuItemRepositoryInterface|MenuItemRepository
     */
    private $menuItemRepository;

    /**
     * @var MenuRepositoryInterface|MenuRepository
     */
    private $menuRepository;

    public function __construct(
        MenuItemRepositoryInterface $menuItemRepository,
        MenuRepositoryInterface $menuRepository
    ) {
        $this->menuItemRepository = $menuItemRepository;
        $this->menuRepository = $menuRepository;
    }

    public function create(Request $request)
    {
        MenuAdmin::activeMenu('menu_root');

        $menu = $this->menuRepository->getById($request->input('menu_id'));
        $item = new MenuItem();
        $item->parent_id = $request->input('parent_id');

        return view('menu::admin.menu-item.create')->with([
            'menu' => $menu,
            'item' => $item,
        ]);
    }

    public function store(MenuItemRequest $request)
    {
        $item = $this->menuItemRepository->create($request->all());

        if ($request->input('continue')) {
            return redirect()
                ->route('menu.admin.menu-item.edit', $item->id)
                ->with('success', __('menu::menu-item.notification.created'));
        }

        return redirect()
            ->route('menu.admin.menu.edit', $item->menu_id)
            ->with('success', __('menu::menu-item.notification.created'));
    }

    public function edit($id)
    {
        MenuAdmin::activeMenu('menu_root');

        $item = $this->menuItemRepository->find($id);
        $menu = $item->menu;

        return view('menu::admin.menu-item.edit')->with([
            'menu' => $menu,
            'item' => $item,
        ]);
    }

    public function update(MenuItemRequest $request, $id)
    {
        $item = $this->menuItemRepository->updateById($request->all(), $id);

        if ($request->input('continue')) {
            return back()->with('success', __('menu::menu-item.notification.updated'));
        }

        return redirect()
            ->route('menu.admin.menu.edit', $item->menu_id)
            ->with('success', __('menu::menu-item.notification.updated'));
    }

    public function destroy($id)
    {
        $this->menuItemRepository->delete($id);

        return response()->json([
            'success' => true,
            'id'      => $id,
        ]);
    }

    public function updateTree(Request $request)
    {
        $this->menuItemRepository->updateTree($request->input('menu', []));

        return response()->json([
            'success' => true,
            'message' => __('menu::message.notification.updated'),
        ]);
    }

    public function moveUp($id)
    {
        $this->menuItemRepository->moveUp($id);
        $menuItem = $this->menuItemRepository->getById($id);
        $menu = $menuItem->menu()->first();

        return redirect()
            ->route('menu.admin.menu.edit', $menu->id)
            ->with('success', __('menu::menu-item.notification.move_up'));
    }

    public function moveDown($id)
    {
        $this->menuItemRepository->moveDown($id);
        $menuItem = $this->menuItemRepository->getById($id);
        $menu = $menuItem->menu()->first();
        return redirect()
            ->route('menu.admin.menu.edit', $menu->id)
            ->with('success', __('menu::menu-item.notification.move_down'));
    }
}
