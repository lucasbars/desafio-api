document.addEventListener("DOMContentLoaded", function () {
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
        TO: "Tocantins",
    };

    let dataTable;

    window.searchMunicipalities = async function () {
        const ufSelect = document.getElementById("ufSelect");
        const uf = ufSelect.value;
        const searchBtn = document.getElementById("searchBtn");
        const btnText = document.getElementById("btnText");
        const messageContainer = document.getElementById("messageContainer");
        const resultsContainer = document.getElementById("resultsContainer");

        if (!uf) {
            messageContainer.style.display = "none";
            resultsContainer.style.display = "none";

            // Destroi o DataTable se existir
            if (dataTable) {
                dataTable.destroy();
                dataTable = null;
            }

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
            const response = await fetch(`/api/municipios/${uf}`);
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
            showMessage(
                error.message || "Erro ao conectar com o servidor",
                "danger"
            );
            resultsContainer.style.display = "none";
        } finally {
            searchBtn.disabled = false;
            btnText.innerHTML = "Buscar Municípios";
        }
    };

    function showMessage(message, type) {
        const messageContainer = document.getElementById("messageContainer");
        const icon =
            type === "success"
                ? "check-circle-fill"
                : "exclamation-triangle-fill";

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
          <table id="municipiosTable" class="table table-striped table-hover align-middle w-100">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Município</th>
                <th>Código IBGE</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>`;

        resultsContainer.style.display = "block";

        // Destrói instância anterior se já existir
        if (dataTable) {
            dataTable.destroy();
        }

        // Inicializa o DataTables com Bootstrap 5
        dataTable = new DataTable("#municipiosTable", {
            data: municipalities.map((m, i) => ({
                index: i + 1,
                name: m.name,
                ibge_code: m.ibge_code,
            })),
            columns: [
                { data: "index" },
                { data: "name" },
                { data: "ibge_code" },
            ],
            pageLength: 10,
            responsive: true,
            ordering: false,
            language: {
                url: "//cdn.datatables.net/plug-ins/2.3.4/i18n/pt-BR.json",
            },
        });
    }

    // Inicialização quando o DOM estiver pronto
    document.addEventListener("DOMContentLoaded", function () {
        // Permitir busca com Enter
        document
            .getElementById("ufSelect")
            .addEventListener("keypress", function (e) {
                if (e.key === "Enter") {
                    searchMunicipalities();
                }
            });
    });
});
