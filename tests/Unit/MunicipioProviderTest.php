<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\BrasilApiProvider;

class MunicipioProviderTest extends TestCase
{
  public function testBrasilApiProvider()
  {
    $provider = new BrasilApiProvider();
    $municipios = $provider->getMunicipios('RS');

    $this->assertIsArray($municipios);
    $this->assertArrayHasKey('name', $municipios[0]);
    $this->assertArrayHasKey('ibge_code', $municipios[0]);
  }
}
