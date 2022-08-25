<?php

namespace Tests\Feature;

use App\Models\Tutor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TutorTest extends TestCase
{
    use RefreshDatabase;

    public function test_base_resource_exists()
    {
        $tutores = Tutor::factory(2)->create();
        $response = $this->get('api/tutores');

        $response->assertStatus(200);
    }
}
