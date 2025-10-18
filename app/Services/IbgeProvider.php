<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IbgeProvider implements MunicipioProviderInterface
{
  public function getMunicipios(string $uf): array
  {
    $uf = strtolower($uf);
    $response = Http::timeout(10)->get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$uf}/municipios");
    $response->throw();

    return collect($response->json())->map(function ($item) {
      return [
        'name' => $item['nome'],
        'ibge_code' => $item['id'],
      ];
    })->toArray();
  }
}
