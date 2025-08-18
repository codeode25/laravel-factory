<?php

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use function Pest\Laravel\postJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class)->group('feature', 'api');

it('can process stripe payment', function () {
    $this->actingAs(User::factory()->create());

    $response = $this->postJson('/api/checkout/pay', [
        'gateway' => 'stripe',
        'amount'   => 100,
    ]);

    $response->assertStatus(200)
             ->assertJson([
                 'status'  => 'success',
                 'message' => 'Charged 100 via Stripe',
             ]);
});

it('can process paypal payment', function () {
    $this->actingAs(User::factory()->create());

    $response = $this->postJson('/api/checkout/pay', [
        'gateway' => 'paypal',
        'amount'   => 50,
    ]);

    $response->assertStatus(200)
             ->assertJson([
                 'status'  => 'success',
                 'message' => 'Charged 50 via PayPal',
             ]);
});

it('can process cash on delivery', function () {
    $this->actingAs(User::factory()->create());

    $response = $this->postJson('/api/checkout/pay', [
        'gateway' => 'cod',
        'amount'   => 75,
    ]);

    $response->assertStatus(200)
             ->assertJson([
                 'status'  => 'success',
                 'message' => 'Payment of 75 will be collected on delivery',
             ]);
});

it('rejects invalid provider', function () {
    $this->actingAs(User::factory()->create());

    $response = $this->postJson('/api/checkout/pay', [
        'gateway' => 'bitcoin',
        'amount'   => 100,
    ]);

    $response->assertStatus(422); // validation error
});
