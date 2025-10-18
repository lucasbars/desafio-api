<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\BrasilApiProvider;
use App\Services\IbgeProvider;
use Illuminate\Support\Facades\Cache;

class MunicipioProviderTest extends TestCase
{

  protected function setUp(): void
  {
    parent::setUp();
    Cache::flush(); // limpa cache antes de cada teste
  }
  /**
   * Testa se o BrasilApiProvider retorna array correto com API real
   */
  public function testBrasilApiProviderReal()
  {
    $provider = new BrasilApiProvider();
    $municipios = $provider->getMunicipios('RS');

    $this->assertIsArray($municipios, 'O retorno deve ser um array');
    $this->assertNotEmpty($municipios, 'O array não pode estar vazio');
    $this->assertArrayHasKey('name', $municipios[0]);
    $this->assertArrayHasKey('ibge_code', $municipios[0]);
  }

  /**
   * Testa se o IbgeProvider retorna array correto com API real
   */
  public function testIbgeProviderReal()
  {
    $provider = new IbgeProvider();
    $municipios = $provider->getMunicipios('RS');

    $this->assertIsArray($municipios, 'O retorno deve ser um array');
    $this->assertNotEmpty($municipios, 'O array não pode estar vazio');
    $this->assertArrayHasKey('name', $municipios[0]);
    $this->assertArrayHasKey('ibge_code', $municipios[0]);
  }
}
