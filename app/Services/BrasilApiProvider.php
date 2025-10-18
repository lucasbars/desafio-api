<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BrasilApiProvider implements MunicipioProviderInterface
{
  public function getMunicipios(string $uf): array
  {
    $response = Http::get("https://brasilapi.com.br/api/ibge/municipios/v1/{$uf}");

    if ($response->failed()) return [];

    return collect($response->json())->map(function ($item) {
      return [
        'name' => $item['nome'],
        'ibge_code' => $item['codigo_ibge'],
      ];
    })->toArray();
  }
}
