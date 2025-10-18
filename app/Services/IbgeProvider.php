<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IbgeProvider implements MunicipioProviderInterface
{
  public function getMunicipios(string $uf): array
  {
    $uf = strtoupper($uf);
    $response = Http::get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$uf}/municipios");

    if ($response->failed()) return [];

    return collect($response->json())->map(function ($item) {
      return [
        'name' => $item['nome'],
        'ibge_code' => $item['id'],
      ];
    })->toArray();
  }
}
