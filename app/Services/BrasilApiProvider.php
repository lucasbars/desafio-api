<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BrasilApiProvider implements MunicipioProviderInterface
{
  public function getMunicipios(string $uf): array
  {
    $response = Http::timeout(10)->get("https://brasilapi.com.br/api/ibge/municipios/v1/{$uf}");
    $response->throw();

    return collect($response->json())->map(function ($item) {
      return [
        'name' => $item['nome'],
        'ibge_code' => $item['codigo_ibge'],
      ];
    })->toArray();
  }
}
