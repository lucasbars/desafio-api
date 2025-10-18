<?php

namespace App\Http\Controllers;

use App\Services\MunicipioService;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
  protected MunicipioService $service;

  public function __construct(MunicipioService $service)
  {
    $this->service = $service;
  }

  public function listar(Request $request, string $uf)
  {
    $municipios = $this->service->listarMunicipios($uf);
    return response()->json($municipios);
  }
}
