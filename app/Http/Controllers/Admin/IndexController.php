<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{
    public function __construct()
    {
        $menu = [
            'products'      => 'catalog',
            'categories'    => 'catalog',
            'brands'        => 'catalog',

            'coupons'       => 'orders',

            'managers'      => 'settings',
            'deliveries'    => 'settings',
            'payments'      => 'settings',
        ];
        preg_match('~^([A-z0-9]+)\..+$~', Route::currentRouteName(), $match);
        $menu_section = $menu_item = null;
        if (isset($match[1])) {
            $menu_item = $match[1];
            $menu_section = isset($menu[$menu_item]) ? $menu[$menu_item] : null;
        }
        View::share('menu_item', $menu_item);
        View::share('menu_section', $menu_section);
    }
}