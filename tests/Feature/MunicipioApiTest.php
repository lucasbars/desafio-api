<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Cache;

class MunicipioApiTest extends TestCase
{

  /**
   * Limpa o cache antes de cada teste
   */
  protected function setUp(): void
  {
    parent::setUp();
    Cache::flush();
  }

  /**
   * Testa o fluxo completo: Controller -> Service -> Provider -> API externa
   */
  public function testApiMunicipiosReal()
  {
    $uf = 'CE';
    $response = $this->getJson("/api/municipios/{$uf}");

    $response->assertStatus(200);
    $response->assertJsonStructure([['name', 'ibge_code']]);
    $this->assertNotEmpty($response->json(), 'O array de municípios não pode estar vazio');
  }

  /**
   * Testa um estado que provavelmente não existe
   * para verificar tratamento de erro
   */
  public function testApiMunicipiosInexistente()
  {
    $uf = 'XX';
    $response = $this->getJson("/api/municipios/{$uf}");

    $response->assertStatus(500);
    $response->assertJsonStructure(['error', 'details']);
  }
}
