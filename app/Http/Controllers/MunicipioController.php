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

    if (isset($municipios['error'])) {
      return response()->json($municipios, 500);
    }

    return response()->json($municipios);
  }
}
