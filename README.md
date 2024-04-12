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
    <td>Listar todos os usuários</td>
  </tr>
  <tr>
    <td>GET</td>
    <td>http://localhost/get_users_id/{id}</td>
    <td>Fazer a busca específica do usuário</td>
  </tr>
  <tr>
    <td>POST</td>
    <td>http://localhost/register_users</td>
    <td>Cadastrar um novo usuário</td>
  </tr>
  <tr>
    <td>PUT</td>
    <td>http://localhost/update_user</td>
    <td>Atualizar os dados do usuário</td>
  </tr>
  <tr>
    <td>DELETE</td>
    <td>http://localhost/delete_users/{id}</td>
    <td>Deletar o usuário</td>
  </tr>
</table>

- GET: O GET retorna um JSON com a lista de usuários castrados, com nome e cargo desse funcionário. 
- POST: Com o POST é possível cadastrar um novo funcionário. 
- PUT: O PUT você pode atualizar os dados já cadastrados do usuário. 
- DELETE: E com o DELETE é possível deletar o cadastro do usuário.
