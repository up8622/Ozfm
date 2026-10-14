<?php

$punSat = function (string $kljuc, int $podrazumevano): int {
    $vrednost = filter_var(env($kljuc), FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 0, 'max_range' => 24],
    ]);

    return $vrednost === false ? $podrazumevano : $vrednost;
};

$otvara = $punSat('ORDINACIJA_OTVARA', 7);
$zatvara = $punSat('ORDINACIJA_ZATVARA', 24);

if ($otvara >= $zatvara) {
    $otvara = 7;
    $zatvara = 24;
}

return [

    'otvara' => $otvara,

    'zatvara' => $zatvara,

    'vremenska_zona' => env('ORDINACIJA_VREMENSKA_ZONA', 'Europe/Belgrade'),

];
