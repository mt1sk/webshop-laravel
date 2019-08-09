<?php

namespace App;

use App\Traits\ModelImage;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable
{
    use ModelImage;

    public static $permissions_all = [
        'product_list'=>'Products list', 'product_view'=>'Product view', 'product_create'=>'Product create',
        'product_update'=>'Product edit', 'product_delete'=>'Product delete',

        'category_list'=>'Categories list', 'category_view'=>'Category view', 'category_create'=>'Category create',
        'category_update'=>'Category edit', 'category_delete'=>'Category delete',

        'brand_list'=>'Brands list', 'brand_view'=>'Brand view', 'brand_create'=>'Brand create',
        'brand_update'=>'Brand edit', 'brand_delete'=>'Brand delete',

        'manager_list'=>'Managers list', 'manager_view'=>'Manager view', 'manager_create'=>'Manager create',
        'manager_update'=>'Manager edit', 'manager_delete'=>'Manager delete',

        'coupon_list'=>'Coupons list', 'coupon_view'=>'Coupon view', 'coupon_create'=>'Coupon create',
        'coupon_update'=>'Coupon edit', 'coupon_delete'=>'Coupon delete',

        'payment_list'=>'Payments list', 'payment_view'=>'Payment view', 'payment_create'=>'Payment create',
        'payment_update'=>'Payment edit', 'payment_delete'=>'Payment delete',

        'delivery_list'=>'Deliveries list', 'delivery_view'=>'Delivery view', 'delivery_create'=>'Delivery create',
        'delivery_update'=>'Delivery edit', 'delivery_delete'=>'Delivery delete',
    ];

    protected static $permissions_list;

    protected $perPage = 20;

    public static function getPermissionsList()
    {
        if (!isset(self::$permissions_list)) {
            self::$permissions_list = array_keys(self::$permissions_all);
        }
        return self::$permissions_list;
    }

    public function getPermissionsAttribute($value)
    {
        return is_null($value) ? self::getPermissionsList() : explode('|', $value);
    }

    public function setPermissionsAttribute($value)
    {
        if (is_array($value)) {
            $diff = array_diff(self::getPermissionsList(), $value);
            $this->attributes['permissions'] = count($diff) > 0 ? implode('|', $value) : null;
            return;
        }
        $this->attributes['permissions'] = $value;
    }

    protected function originalDir()
    {
        return 'images/managers';
    }

    protected function fieldName()
    {
        return 'photo';
    }

    protected function getId()
    {
        return $this->id;
    }
}
