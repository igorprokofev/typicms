<?php

namespace App;

use \TypiCMS\Modules\Menus\Models\Menu as Menu;
use \TypiCMS\Modules\Menus\Models\Menulink as Menulink;

class CustomMenulink extends Menulink
{
    
    public static function parentList(Menu $menu, Menulink $model = null)
    {   
        if ($model) {            
            $parents = Menulink::where('id','<>',$model->id)->where('menu_id','=',$model->menu_id)->get();            
            $list = [];
            foreach ($parents as $parent) {
                if (!self::isChild($model, $parent)) {
                    $list[] = $parent;
                }
            }
        }
        else {
            return $parents = Menulink::where('menu_id','=',$menu->id)->get();
        }
        return $list;
    }
    
    public static function getParentListSelectOptions(Menu $menu, Menulink $model = null)
    {
        $parents = self::parentList($menu, $model);
        $data = [''=>''];
        foreach ($parents as $parent) {            
            $data[$parent->id] = $parent->title;
        }       
        return $data;        
    }
    
    public static function isChild(Menulink $menulink, Menulink $parent) 
    {        
        $isChild = false; 
        $p = $parent;
        if ($parent) {            
            do {
                if ($parent && $parent->parent_id == $menulink->id)
                    $isChild = true;                
                $parent = Menulink::find($parent->parent_id);                               
                
            } while ($parent && $parent->parent_id);            
        }        
        return $isChild;
    }
    
}
