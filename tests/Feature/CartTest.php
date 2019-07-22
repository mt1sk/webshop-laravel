<?php

namespace Tests\Feature;

use App\Order;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartTest extends TestCase
{

    /**
     * A basic feature test example.
     * @dataProvider checkoutData
     * @return void
     */
    public function testCheckout($name, $email, $isValid, $errors = [])
    {
        $data = [
            'name'      => $name,
            'email'     => $email,
        ];
        $last_order = new Order();
        $last_order->url = uniqid();
        $last_order->name = 'unit_test';
        $last_order->email = 'unit_test@unit.test';
        $last_order->save();
        $response = $this->post(route('cart_page'), $data);
        $this->assertEquals($isValid, Order::orderByDesc('id')->first()->id != $last_order->id);
        if (!empty($errors)) {
            $response->assertSessionHasErrors($errors);
        }

        /*$response->assertStatus(200);*/
    }

    public function checkoutData()
    {
        return [
            ['bro1', 'bro@email.com', true],
            ['bro2', 'broemail.com', false, ['email']],
        ];
    }
}
