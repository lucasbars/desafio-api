# 🧩 Desafio Técnico - API de Municípios (Laravel)

API desenvolvida em **Laravel** para listar municípios de uma determinada UF, com integração a provedores públicos de dados (BrasilAPI e IBGE), uso de cache, fallback automático e testes automatizados.

---

## 🚀 Funcionalidades

- Endpoint para listar municípios de uma UF.
- Integração com as APIs:
  - [BrasilAPI](https://brasilapi.com.br/api/ibge/municipios/v1/{UF})
  - [IBGE](https://servicodados.ibge.gov.br/api/v1/localidades/estados/{UF}/municipios)
- Seleção dinâmica do provider via variável de ambiente `.env`.
- Fallback automático em caso de falha no provider principal.
- Cache dos resultados por 60 minutos.
- Testes unitários e de integração com PHPUnit.
- Tratamento de exceções personalizadas.

---

## ⚙️ Requisitos

- PHP >= 8.1  
- Composer  
- Laravel >= 10.x  
- Extensão `curl` habilitada  

---

## 🏗️ Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/api-municipios.git
   cd api-municipios

2. Instale as dependências:
   ```bash
   composer install

 3. Defina o provider desejado em .env:
   ```bash
   MUNICIPIOS_PROVIDER=brasilapi

4. Inicie o servidor local:
  ```bash
   php artisan serve
