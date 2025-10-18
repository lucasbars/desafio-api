<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class MunicipioService
{
  protected MunicipioProviderInterface $provider;
  protected MunicipioProviderInterface $fallbackProvider;

  public function __construct()
  {
    $providerName = env('MUNICIPIOS_PROVIDER', 'brasilapi');

    // Provider principal
    $this->provider = match ($providerName) {
      'ibge' => new IbgeProvider(),
      default => new BrasilApiProvider(),
    };

    // Provider de fallback
    $this->fallbackProvider = match ($providerName) {
      'ibge' => new BrasilApiProvider(),
      default => new IbgeProvider(),
    };
  }

  public function listarMunicipios(string $uf): array
  {
    try {
      $municipios = $this->getFromProvider($this->provider, $uf);

      if (empty($municipios)) {
        $municipios = $this->getFromProvider($this->fallbackProvider, $uf);
      }

      return $municipios;
    } catch (Exception $e) {
      return [
        'error' => 'Não foi possível buscar os municípios. Tente novamente mais tarde.',
        'details' => $e->getMessage()
      ];
    }
  }

  private function getFromProvider(MunicipioProviderInterface $provider, string $uf): array
  {
    try {
      return $provider->getMunicipios($uf);
    } catch (Exception $e) {
      throw new Exception("Falha no provider " . get_class($provider) . ": " . $e->getMessage());
    }
  }
}
