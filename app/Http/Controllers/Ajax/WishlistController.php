<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Product;
use App\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function __invoke(Request $request)
    {
        $product_id = $request->get('product_id');
        $action = $request->get('action', 'add');

        $json = ['success'=>1];
        $wishlist = Wishlist::currentObject();
        if (empty($product_id)) {
            return response()->json(['success'=>0, 'error_message'=>'Empty product']);
        }
        $product = Product::find($product_id);
        if (empty($product)) {
            return response()->json(['success'=>0, 'error_message'=>'Product not found']);
        }

        switch ($action) {
            case 'add': {
                $this->addItem($product_id);
                break;
            }
            case 'delete': {
                $this->deleteItem($product_id);
                break;
            }
        }

        $view = view('default.wishlist_informer', ['wishlist'=>$wishlist]);
        $json['wishlist_informer'] = $view->render();

        if ($request->get('is_wishlist_page', 0)) {
            if (count($wishlist->products) > 0) {
                $json['wishlist_items'] = view('default.wishlist_items', ['wishlist' => $wishlist])->render();
            } else {
                $json['is_wishlist_empty'] = 1;
            }
        }

        return response()->json($json)->cookie('wishlist_id', Wishlist::currentObject()->id, 60*24*365);
    }

    private function addItem($product_id)
    {
        $wishlist = Wishlist::currentObject();
        $wishlist_product = $wishlist->products()->newPivotStatement()
            ->where('wishlist_id', $wishlist->id)
            ->where('product_id', $product_id)
            ->first();

        if (empty($wishlist_product)) {
            $wishlist->products()->attach($product_id);
        }
        $wishlist->touch();
        unset($wishlist->products);
    }

    private function deleteItem($product_id)
    {
        $wishlist = Wishlist::currentObject();
        $wishlist->products()->detach($product_id);
        $wishlist->touch();
        unset($wishlist->products);
    }
}
