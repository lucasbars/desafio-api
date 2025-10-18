<?php

namespace App\Services;

class MunicipioService
{
  protected MunicipioProviderInterface $provider;

  public function __construct()
  {
    $provider = env('MUNICIPIOS_PROVIDER', 'brasilapi');

    $this->provider = match ($provider) {
      'ibge' => new IbgeProvider(),
      default => new BrasilApiProvider(),
    };
  }

  public function listarMunicipios(string $uf): array
  {
    return $this->provider->getMunicipios($uf);
  }
}
