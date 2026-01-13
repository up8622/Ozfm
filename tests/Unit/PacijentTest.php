<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Pacijent;
use App\Models\Termin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PacijentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_pacijent()
    {
        $pacijentData = [
            'ime' => 'Marko',
            'prezime' => 'Marković',
            'godina_rodjenja' => 1990,
            'broj_telefona' => '+381601234567',
            'username' => 'marko.m',
            'password_hash' => bcrypt('password123'),
        ];

        $pacijent = Pacijent::create($pacijentData);

        $this->assertInstanceOf(Pacijent::class, $pacijent);
        $this->assertEquals('Marko', $pacijent->ime);
        $this->assertEquals('Marković', $pacijent->prezime);
        $this->assertEquals(1990, $pacijent->godina_rodjenja);
        $this->assertEquals('+381601234567', $pacijent->broj_telefona);
        $this->assertEquals('marko.m', $pacijent->username);
    }

    /** @test */
    public function it_has_many_termins()
    {
        $pacijent = Pacijent::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $pacijent->termins());
    }

    /** @test */
    public function it_can_have_multiple_termins()
    {
        $pacijent = Pacijent::factory()->create();
        $termin1 = Termin::factory()->create(['pacijent_id' => $pacijent->id]);
        $termin2 = Termin::factory()->create(['pacijent_id' => $pacijent->id]);

        $this->assertCount(2, $pacijent->termins);
        $this->assertTrue($pacijent->termins->contains($termin1));
        $this->assertTrue($pacijent->termins->contains($termin2));
    }
}