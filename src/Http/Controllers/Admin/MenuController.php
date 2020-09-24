<?php

namespace Dnsoft\Menu\Http\Controllers\Admin;

use Dnsoft\Menu\Http\Requests\MenuRequest;
use Dnsoft\Menu\Models\Menu;

use Dnsoft\Menu\Repositories\MenuItemRepositoryInterface;
use Dnsoft\Menu\Repositories\MenuRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MenuController extends Controller
{
    /**
     * @var MenuRepositoryInterface
     */
    private $menuRepository;
    /**
     * @var MenuItemRepositoryInterface
     */
    private $menuItemRepository;

    public function __construct(MenuRepositoryInterface $menuRepository, MenuItemRepositoryInterface $menuItemRepository)
    {
        $this->menuRepository = $menuRepository;
        $this->menuItemRepository = $menuItemRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = $this->menuRepository->paginate($request->input('max', 20));

        return view('menu::admin.menu.index', compact('items'));
    }

    public function create()
    {
//        \AdminMenu::activeMenu('menu_root');
        $item = null;
        return view('menu::admin.menu.create', compact('item'));
    }

    public function store(MenuRequest $request)
    {
        $item = $this->menuRepository->create($request->all());

        if ($request->input('continue')) {
            return redirect()
                ->route('menu.admin.menu.edit', $item->id)
                ->with('success', __('menu::message.notification.created'));
        }

        return redirect()
            ->route('menu.admin.menu.index')
            ->with('success', __('menu::message.notification.created'));
    }

    public function edit($id)
    {
//        \AdminMenu::activeMenu('menu_root');

        $item = $this->menuRepository->find($id);

//        $menuItems = $this->menuItemRepository->getTree($item->id, ['id', 'parent_id', 'label']);

        return view('menu::admin.menu.edit', compact('item'));
    }

    public function update(MenuRequest $request, $id)
    {
        $item = $this->menuRepository->updateById($request->all(), $id);

        if ($request->input('continue')) {
            return redirect()
                ->route('menu.admin.menu.edit', $item->id)
                ->with('success', __('menu::message.notification.updated'));
        }

        return redirect()
            ->route('menu.admin.menu.index')
            ->with('success', __('menu::message.notification.updated'));
    }

    public function destroy($id, Request $request)
    {
        $this->menuRepository->delete($id);

        if ($request->wantsJson()) {
            Session::flash('success', __('menu::message.notification.deleted'));
            return response()->json([
                'success' => true,
            ]);
        }

        return redirect()
            ->route('menu.admin.menu.index')
            ->with('success', __('menu::message.notification.deleted'));
    }
}
