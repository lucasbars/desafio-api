<?php

namespace App\Services;

interface MunicipioProviderInterface
{
  public function getMunicipios(string $uf): array;
}
