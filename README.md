# API REST - relatório dos funcionário
> Status: em desenvolvimento

> Documentação:

## Sobre
Demostrativo de dados dos funcionário, como, nome, cargo, salário e status de presença. Um relatório completo sobre a grade de funcionário, possibilitando cadastro, listagem, alteração e exclusão de dados dos funcionários. Todos esses recursos ficrá disponível ao final do projeto.



## Request
<table>
  <tr>
    <th>Verbos</th><th>Rotas</th><th>Request</th>
  </tr>
  <tr>
    <td>GET</td>
    <td>http://localhost/list_users</td>
    <td>Lista todos os funcionários</td>
  </tr>
  <tr>
    <td>GET</td>
    <td>http://localhost/get_users_id/{id}</td>
    <td>Exibe funcionário específico</td>
  </tr>
  <tr>
    <td>POST</td>
    <td>http://localhost/register_users</td>
    <td>Cadastra novo Funcionário</td>
  </tr>
  <tr>
    <td>PUT</td>
    <td>http://localhost/update_user</td>
    <td>Atualiza os dados do Funcionário</td>
  </tr>
  <tr>
    <td>DELETE</td>
    <td>http://localhost/delete_users/{id}</td>
    <td>Deleta Funcionário</td>
  </tr>
</table>

## Modelagem de Dados

 <img style="height:400px" src="https://github.com/GabryelSilvah/API_REST/assets/139282381/20789a25-e2a3-4d14-9663-ad9c10b4919d">


