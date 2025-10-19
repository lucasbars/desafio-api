<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Consulta de Municípios</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- DataTables Bootstrap 5 CSS - versão 2.3.4 -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.min.css">

  <!-- CSS customizado via Vite -->
  @vite(['resources/css/index.css'])
</head>

<body>
  <div class="container main-container">
    <!-- Header -->
    <div class="header-section">
      <i class="bi bi-geo-alt-fill header-icon"></i>
      <h1 class="display-4 fw-bold text-dark mb-3">Consulta de Municípios</h1>
      <p class="lead text-secondary">Busque municípios brasileiros por estado (UF)</p>
    </div>

    <!-- Search Form -->
    <div class="card card-custom mb-4">
      <div class="card-body p-4">
        <div class="mb-3">
          <label for="ufSelect" class="form-label fw-semibold">Selecione o Estado (UF)</label>
          <select class="form-select" id="ufSelect">
            <option value="">Escolha uma UF...</option>
            <option value="AC">AC - Acre</option>
            <option value="AL">AL - Alagoas</option>
            <option value="AP">AP - Amapá</option>
            <option value="AM">AM - Amazonas</option>
            <option value="BA">BA - Bahia</option>
            <option value="CE">CE - Ceará</option>
            <option value="DF">DF - Distrito Federal</option>
            <option value="ES">ES - Espírito Santo</option>
            <option value="GO">GO - Goiás</option>
            <option value="MA">MA - Maranhão</option>
            <option value="MT">MT - Mato Grosso</option>
            <option value="MS">MS - Mato Grosso do Sul</option>
            <option value="MG">MG - Minas Gerais</option>
            <option value="PA">PA - Pará</option>
            <option value="PB">PB - Paraíba</option>
            <option value="PR">PR - Paraná</option>
            <option value="PE">PE - Pernambuco</option>
            <option value="PI">PI - Piauí</option>
            <option value="RJ">RJ - Rio de Janeiro</option>
            <option value="RN">RN - Rio Grande do Norte</option>
            <option value="RS">RS - Rio Grande do Sul</option>
            <option value="RO">RO - Rondônia</option>
            <option value="RR">RR - Roraima</option>
            <option value="SC">SC - Santa Catarina</option>
            <option value="SP">SP - São Paulo</option>
            <option value="SE">SE - Sergipe</option>
            <option value="TO">TO - Tocantins</option>
          </select>
        </div>

        <button class="btn btn-primary btn-search w-100" id="searchBtn" onclick="searchMunicipalities()">
          <i class="bi bi-search me-2"></i>
          <span id="btnText">Buscar Municípios</span>
        </button>

        <!-- Messages -->
        <div id="messageContainer" style="display: none;"></div>
      </div>
    </div>

    <!-- Results -->
    <div id="resultsContainer" style="display: none;"></div>

    <!-- Footer -->
    <div class="text-center mt-5 text-secondary">
      <p class="mb-1">Dados fornecidos pela Brasil API e IBGE</p>
    </div>
  </div>

  <!-- jQuery (versão 3.7.1) -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables Core - versão 2.3.4 -->
  <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>

  <!-- DataTables Bootstrap 5 - versão 2.3.4 -->
  <script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.min.js"></script>

  <!-- JavaScript customizado via Vite (carrega por último) -->
  @vite(['resources/js/index.js'])
</body>

</html>