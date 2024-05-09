# API REST - relatório dos funcionário
> Status: em desenvolvimento

> Documentação:

## Sobre
Sistema ERP para gestão empresarial de pequenas empresa. O sistema em sua fase completa, entrega funcionalidades de gestão de estoque, recursos humanos, finanças, compras e dashboard de estatísticas.



## Endpoint do controle de estoque
<table>
  <tr>
    <th>Verbos</th><th>Rotas</th><th>Request</th>
  </tr>
  <tr>
    <td>GET</td>
    <td>http://localhost:8007/api_funcionarios/list_products</td>
    <td>Listar produtos</td>
  </tr>
  <tr>
    <td>GET</td>
    <td>http://localhost:8007/api_funcionarios/details_products/{id_produto}</td>
    <td>Exibir detalhes do produto</td>
  </tr>
  <tr>
    <td>POST</td>
    <td>http://localhost:8007/api_funcionarios/register_products</td>
    <td>Cadastrar novo produto</td>
  </tr>
  <tr>
    <td>PUT</td>
    <td>http://localhost:8007/api_funcionarios/update_product</td>
    <td>Atualizar informações do produto</td>
  </tr>
  <tr>
    <td>DELETE</td>
    <td>http://localhost:8007/api_funcionarios/delete_products/{id_produto}</td>
    <td>Deletar produto</td>
  </tr>
</table>

## Modelagem de Dados - Modelo Lógico

 <img style="height:400px" src="https://github.com/GabryelSilvah/API_REST/assets/139282381/07b8651e-a9c1-41e8-893f-afa6c52b0422">

 ## View
 <img style="height:400px" src="https://github.com/GabryelSilvah/API_REST/assets/139282381/a316dbfe-02f5-4a9f-ad1b-f66e649f88a6">
  <img style="height:400px" src="https://github.com/GabryelSilvah/API_REST/assets/139282381/341739b3-5a7e-406f-a8b4-742246b2f07b">


