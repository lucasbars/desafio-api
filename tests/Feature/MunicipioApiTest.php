<?php

namespace Tests\Feature;

use Tests\TestCase;

class MunicipioApiTest extends TestCase
{
  public function testApiMunicipios()
  {
    $response = $this->getJson('/api/municipios/RS');

    $response->assertStatus(200);
    $response->assertJsonStructure([
      ['name', 'ibge_code']
    ]);
  }
}
