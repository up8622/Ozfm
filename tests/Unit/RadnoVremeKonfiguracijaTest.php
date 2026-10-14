<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RadnoVremeKonfiguracijaTest extends TestCase
{
    protected function tearDown(): void
    {
        $this->postavi(null, null);

        parent::tearDown();
    }

    private function postavi(?string $otvara, ?string $zatvara): array
    {
        foreach (['ORDINACIJA_OTVARA' => $otvara, 'ORDINACIJA_ZATVARA' => $zatvara] as $kljuc => $vrednost) {
            if ($vrednost === null) {
                unset($_ENV[$kljuc], $_SERVER[$kljuc]);
                putenv($kljuc);
            } else {
                $_ENV[$kljuc] = $_SERVER[$kljuc] = $vrednost;
                putenv("$kljuc=$vrednost");
            }
        }

        return require config_path('ordinacija.php');
    }

    #[Test]
    public function podrazumevano_radno_vreme_je_od_7_do_24()
    {
        $konfiguracija = $this->postavi(null, null);

        $this->assertSame(7, $konfiguracija['otvara']);
        $this->assertSame(24, $konfiguracija['zatvara']);
    }

    #[Test]
    public function cita_pune_sate_iz_env()
    {
        $konfiguracija = $this->postavi('9', '23');

        $this->assertSame(9, $konfiguracija['otvara']);
        $this->assertSame(23, $konfiguracija['zatvara']);
    }

    public static function neispravneVrednosti(): array
    {
        return [
            'otvara nije pun sat' => ['9.5', '17', 7, 17],
            'otvara nije broj' => ['devet', '17', 7, 17],
            'zatvara van opsega' => ['9', '25', 9, 24],
            'otvara negativan sat' => ['-1', '17', 7, 17],
            'zatvara sa minutima' => ['9', '17:30', 9, 24],
            'otvara posle zatvaranja' => ['18', '9', 7, 24],
            'otvara i zatvara u isto vreme' => ['9', '9', 7, 24],
        ];
    }

    #[Test]
    #[DataProvider('neispravneVrednosti')]
    public function neispravna_vrednost_se_zamenjuje_podrazumevanom(string $otvara, string $zatvara, int $ocekivanoOtvara, int $ocekivanoZatvara)
    {
        $konfiguracija = $this->postavi($otvara, $zatvara);

        $this->assertSame($ocekivanoOtvara, $konfiguracija['otvara']);
        $this->assertSame($ocekivanoZatvara, $konfiguracija['zatvara']);
    }
}
