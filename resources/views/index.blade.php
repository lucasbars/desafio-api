<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta de Municípios</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- datatables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


  <style>
    body {
      background: linear-gradient(135deg, #e3f2fd 0%, #e8eaf6 50%, #f3e5f5 100%);
      min-height: 100vh;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    .main-container {
      padding: 2rem 0;
    }

    .header-section {
      text-align: center;
      margin-bottom: 3rem;
    }

    .header-icon {
      font-size: 3rem;
      color: #4f46e5;
      margin-bottom: 1rem;
    }

    .card-custom {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .btn-search {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      padding: 0.75rem 2rem;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-search:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-search:disabled {
      background: #6c757d;
      transform: none;
    }

    .alert-custom {
      border-left: 4px solid;
      border-radius: 0.5rem;
    }

    .badge-count {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      padding: 0.5rem 1rem;
      border-radius: 2rem;
    }

    .table-hover tbody tr {
      transition: all 0.2s ease;
    }

    .table-hover tbody tr:hover {
      background-color: #e8eaf6;
      transform: scale(1.01);
    }

    .spinner-custom {
      width: 1.5rem;
      height: 1.5rem;
      border: 3px solid rgba(255, 255, 255, 0.3);
      border-top-color: white;
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }

    .empty-state {
      text-align: center;
      padding: 4rem 2rem;
    }

    .empty-state i {
      font-size: 4rem;
      color: #9ca3af;
      margin-bottom: 1rem;
    }

    select.form-select {
      border: 2px solid #dee2e6;
      padding: 0.75rem 1rem;
      font-size: 1rem;
    }

    select.form-select:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
    }
  </style>
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

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const states = {
      AC: "Acre",
      AL: "Alagoas",
      AP: "Amapá",
      AM: "Amazonas",
      BA: "Bahia",
      CE: "Ceará",
      DF: "Distrito Federal",
      ES: "Espírito Santo",
      GO: "Goiás",
      MA: "Maranhão",
      MT: "Mato Grosso",
      MS: "Mato Grosso do Sul",
      MG: "Minas Gerais",
      PA: "Pará",
      PB: "Paraíba",
      PR: "Paraná",
      PE: "Pernambuco",
      PI: "Piauí",
      RJ: "Rio de Janeiro",
      RN: "Rio Grande do Norte",
      RS: "Rio Grande do Sul",
      RO: "Rondônia",
      RR: "Roraima",
      SC: "Santa Catarina",
      SP: "São Paulo",
      SE: "Sergipe",
      TO: "Tocantins"
    };

    let dataTable; // variável global para controle do DataTables

    async function searchMunicipalities() {
      const ufSelect = document.getElementById("ufSelect");
      const uf = ufSelect.value;
      const searchBtn = document.getElementById("searchBtn");
      const btnText = document.getElementById("btnText");
      const messageContainer = document.getElementById("messageContainer");
      const resultsContainer = document.getElementById("resultsContainer");

      if (!uf) {
        showMessage("Por favor, selecione uma UF", "danger");
        return;
      }

      // Limpar mensagens e resultados
      messageContainer.style.display = "none";
      resultsContainer.style.display = "none";

      // Loading
      searchBtn.disabled = true;
      btnText.innerHTML =
        '<span class="spinner-custom d-inline-block me-2"></span>Buscando...';

      try {
        const response = await fetch(`http://localhost:8000/api/municipios/${uf}`);
        const data = await response.json();

        if (Array.isArray(data)) {
          displayResults(data, uf);
          showMessage(
            `Encontrados ${data.length} municípios em ${states[uf]}`,
            "success"
          );
        } else if (data.error) {
          throw new Error(data.error);
        } else {
          throw new Error("Erro ao buscar municípios");
        }
      } catch (error) {
        showMessage(error.message || "Erro ao conectar com o servidor", "danger");
        resultsContainer.style.display = "none";
      } finally {
        searchBtn.disabled = false;
        btnText.innerHTML = "Buscar Municípios";
      }
    }

    function showMessage(message, type) {
      const messageContainer = document.getElementById("messageContainer");
      const icon =
        type === "success" ? "check-circle-fill" : "exclamation-triangle-fill";

      messageContainer.innerHTML = `
      <div class="alert alert-${type} alert-custom mt-3 mb-0" role="alert">
        <i class="bi bi-${icon} me-2"></i>
        <strong>${type === "success" ? "Sucesso!" : "Erro"}</strong>
        <p class="mb-0 mt-1">${message}</p>
      </div>
    `;
      messageContainer.style.display = "block";
    }

    function displayResults(municipalities, uf) {
      const resultsContainer = document.getElementById("resultsContainer");

      if (municipalities.length === 0) {
        resultsContainer.innerHTML = `
        <div class="card card-custom">
          <div class="card-body">
            <div class="empty-state">
              <i class="bi bi-geo-alt"></i>
              <h3 class="fw-semibold text-secondary mb-2">Nenhum município encontrado</h3>
              <p class="text-muted">Tente novamente com outra UF</p>
            </div>
          </div>
        </div>
      `;
        return;
      }

      // Monta a tabela com estrutura esperada pelo DataTables
      resultsContainer.innerHTML = `
      <div class="card card-custom">
        <div class="card-body p-4">
          <div class="d-flex align-items-center mb-4">
            <i class="bi bi-database-fill text-primary fs-4 me-2"></i>
            <h2 class="mb-0 fw-bold">Municípios de ${states[uf]}</h2>
            <span class="badge badge-count text-white ms-auto">
              ${municipalities.length} total
            </span>
          </div>

          <div class="table-responsive">
            <table id="municipiosTable" class="display table table-hover align-middle w-100">
              <thead>
                <tr class="border-bottom border-2">
                  <th>#</th>
                  <th>Município</th>
                  <th>Código IBGE</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    `;

      resultsContainer.style.display = "block";

      // Destrói instância anterior se já existir
      if (dataTable) {
        dataTable.destroy();
      }

      // Inicializa o DataTables
      dataTable = $("#municipiosTable").DataTable({
        data: municipalities.map((m, i) => ({
          index: i + 1,
          name: m.name,
          ibge_code: m.ibge_code
        })),
        columns: [{
            data: "index"
          },
          {
            data: "name"
          },
          {
            data: "ibge_code"
          }
        ],
        pageLength: 10,
        responsive: true,
        language: {
          url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
        }
      });
    }

    // Permitir busca com Enter
    document
      .getElementById("ufSelect")
      .addEventListener("keypress", function(e) {
        if (e.key === "Enter") {
          searchMunicipalities();
        }
      });
  </script>
</body>

</html>