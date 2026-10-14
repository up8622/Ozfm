<?php

namespace Tests\Feature;

use App\Models\Pacijent;
use App\Models\Terapeut;
use App\Models\Termin;
use App\Models\Usluga;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ZakazivanjeTerminaTest extends TestCase
{
    use RefreshDatabase;

    private Pacijent $pacijent;
    private Pacijent $drugiPacijent;
    private Terapeut $terapeut;
    private Terapeut $drugiTerapeut;
    private Usluga $usluga;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pacijent = Pacijent::factory()->create();
        $this->drugiPacijent = Pacijent::factory()->create();
        $this->terapeut = Terapeut::factory()->create();
        $this->drugiTerapeut = Terapeut::factory()->create();
        $this->usluga = Usluga::factory()->create();
    }

    private function zakazi(Pacijent $pacijent, Terapeut $terapeut, string $vreme)
    {
        return $this->withSession(['pacijent_id' => $pacijent->id])
            ->post(route('pacijent.termini.store'), [
                'vreme' => $vreme,
                'terapeut_id' => $terapeut->id,
                'usluga_id' => $this->usluga->id,
            ]);
    }

    #[Test]
    public function pacijent_moze_da_zakaze_slobodan_termin()
    {
        $this->zakazi($this->pacijent, $this->terapeut, '2026-11-02T10:00')
            ->assertRedirect(route('pacijent.termini'))
            ->assertSessionHas('success');

        $this->assertDatabaseCount('termin', 1);
    }

    #[Test]
    public function drugi_pacijent_ne_moze_kod_istog_terapeuta_u_isto_vreme()
    {
        $this->zakazi($this->pacijent, $this->terapeut, '2026-11-02T10:00');

        $this->zakazi($this->drugiPacijent, $this->terapeut, '2026-11-02T10:00')
            ->assertSessionHasErrors('vreme');

        $this->assertDatabaseCount('termin', 1);
    }

    #[Test]
    public function drugi_pacijent_ne_moze_kod_istog_terapeuta_dok_tretman_traje()
    {
        $this->zakazi($this->pacijent, $this->terapeut, '2026-11-02T10:00');

        $this->zakazi($this->drugiPacijent, $this->terapeut, '2026-11-02T10:59')
            ->assertSessionHasErrors('vreme');
        $this->zakazi($this->drugiPacijent, $this->terapeut, '2026-11-02T09:01')
            ->assertSessionHasErrors('vreme');

        $this->assertDatabaseCount('termin', 1);
    }

    #[Test]
    public function terapeut_moze_da_ima_termine_jedan_za_drugim()
    {
        $this->zakazi($this->pacijent, $this->terapeut, '2026-11-02T10:00');

        $this->zakazi($this->drugiPacijent, $this->terapeut, '2026-11-02T11:00')
            ->assertSessionHasNoErrors();
        $this->zakazi($this->drugiPacijent, $this->terapeut, '2026-11-02T09:00')
            ->assertSessionHasNoErrors();

        $this->assertDatabaseCount('termin', 3);
    }

    #[Test]
    public function pacijent_ne_moze_da_ima_dva_termina_u_isto_vreme_kod_razlicitih_terapeuta()
    {
        $this->zakazi($this->pacijent, $this->terapeut, '2026-11-02T10:00');

        $this->zakazi($this->pacijent, $this->drugiTerapeut, '2026-11-02T10:30')
            ->assertSessionHasErrors('vreme');

        $this->assertDatabaseCount('termin', 1);
    }

    #[Test]
    public function razliciti_pacijenti_mogu_u_isto_vreme_kod_razlicitih_terapeuta()
    {
        $this->zakazi($this->pacijent, $this->terapeut, '2026-11-02T10:00');

        $this->zakazi($this->drugiPacijent, $this->drugiTerapeut, '2026-11-02T10:00')
            ->assertSessionHasNoErrors();

        $this->assertDatabaseCount('termin', 2);
    }

    #[Test]
    public function obrisan_termin_oslobadja_vreme()
    {
        $this->zakazi($this->pacijent, $this->terapeut, '2026-11-02T10:00');
        Termin::first()->delete();

        $this->zakazi($this->drugiPacijent, $this->terapeut, '2026-11-02T10:00')
            ->assertSessionHasNoErrors();

        $this->assertDatabaseCount('termin', 1);
    }
}
