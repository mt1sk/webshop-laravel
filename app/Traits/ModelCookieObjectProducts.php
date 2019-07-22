<?php
/**
 * Created by PhpStorm.
 * User: mt1sk
 * Date: 22.07.19
 * Time: 18:26
 */

namespace App\Traits;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

trait ModelCookieObjectProducts
{
    private static $instance;

    public static function currentObject()
    {
        if (isset(self::$instance)) {
            return self::$instance;
        }
        $object_name = strtolower(class_basename(self::class));
        $cookie_object = self::find(Cookie::get($object_name.'_id'));
        $user = Auth::user();
        if (empty($user) || empty($user->{$object_name})) {
            if (!empty($user) && !empty($cookie_object)) {
                /*
                 * если нету пользовательской корзины и при этом до авторизиции он заполнял корзину
                 * то привяжем её к пользователю
                 */
                $cookie_object->user_id = $user->id;
                $cookie_object->save();
            }
            $object = $cookie_object;
        } elseif (!empty($cookie_object) && empty($cookie_object->user_id)) {
            if ($cookie_object->products->isEmpty()) {
                /* если корзина с кук пуста то не нужно удалять пользовательскую */
                self::destroy($cookie_object->id);
                $object = $user->{$object_name};
            } else {
                /*
                 * если есть пользовательская корзина и при этом до авторизиции он заполнял новую(без пользователя)
                 * то новая будет приорететна и перезапишит старую
                 */
                self::destroy($user->{$object_name}->id);
                $cookie_object->user_id = $user->id;
                $cookie_object->save();

                $object = $cookie_object;
            }
        } else {
            $object = $user->{$object_name};
        }

        if (empty($object)) {
            $object = new self();
            if (!empty($user)) {
                $object->user_id = $user->id;
            }
            $object->save();
        }
        self::$instance = $object;
        return $object;
    }

    /* for testing .. ((*/
    public static function unsetInstance() {
        self::$instance = null;
    }
}