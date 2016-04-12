<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \TypiCMS\Modules\Menus\Http\Controllers\MenulinksAdminController as MenulinkAdminController;
use \TypiCMS\Modules\Menus\Models\Menu as Menu;
use \TypiCMS\Modules\Menus\Http\Requests\MenulinkFormRequest as MenulinkFormRequest;

use App\Http\Requests;

class CustomMenulinksAdminController extends MenulinkAdminController
{
    
    public function create(Menu $menu)
    {
        $model = $this->repository->getModel();
        
        return view('menus::admin.menulink-create')
            ->with(compact('model', 'menu'));
    }
    
    public function store(Menu $menu, MenulinkFormRequest $request)
    {        
        $data = $request->all();
        $data['parent_id'] = $data['parent_id'] ?: null;
        $data['page_id'] = $data['page_id'] ?: null;
        $data['position'] = $data['position'] ?: 0;
        $model = $this->repository->create($data);

        return $this->redirect($request, $model);
    }
    
}
