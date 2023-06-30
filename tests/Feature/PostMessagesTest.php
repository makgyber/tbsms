<?php

use App\Models\User;
use function Pest\Laravel\{actingAs};

it('saves sms messages', function () {
    $user = User::factory()->create();

    actingAs($user)->get('/api/user')
        ->assertStatus(200);
});
