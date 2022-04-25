<?php

namespace App\Constant;

class StreetType{
    const RUE = 1;
    const CHEMIN = 2;
    const IMPASSE = 3;
    const BOULEVARD = 4;

    const STREETTYPES = [
        self::RUE => "Rue",
        self::CHEMIN => "Chemin",
        self::IMPASSE => "Impasse",
        self::BOULEVARD => "Boulevard",
    ];
}