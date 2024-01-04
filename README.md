# API REST
> Status: Concluído

> Documentação: [API_REST](https://documenter.getpostman.com/view/32073946/2s9YsFDtnU)

## Sobre
API REST de registro de usuários de uma empresa. Os verbos http disponíveis nessa API são, GET, POST, PUT e DELETE. Essa API fornece 2 dados dos funcionários cadastrados em uma empresa fictícia. Esses dados são, nome e cargo que são retornados do servidor ao cliente no formado JSON. OS status http utilizados nessa aplicação foram, status 200, 201, 204, 400, 404 e 501.



## Request
<table>
  <tr>
    <th>Verbos</th><th>Rotas</th><th>Request</th>
  </tr>
  <tr>
    <td>GET</td>
    <td>http://localhost/users</td>
    <td>Listar todos os usuários</td>
  </tr>
  <tr>
    <td>GET</td>
    <td>http://localhost/users/{id}</td>
    <td>Fazer a busca específica do usuário</td>
  </tr>
  <tr>
    <td>POST</td>
    <td>http://localhost/users</td>
    <td>Cadastrar um novo usuáio</td>
  </tr>
  <tr>
    <td>PUT</td>
    <td>http://localhost/users/{id}</td>
    <td>Atualizar os dados do usuário</td>
  </tr>
  <tr>
    <td>DELETE</td>
    <td>http://localhost/users/{id}</td>
    <td>Deletar o usuário</td>
  </tr>
</table>

- GET: O GET retorna um JSON com a lista de usuários castrados, com nome e cargo desse funcionário. 
- POST: Com o POST é possível cadastrar um novo funcionário. 
- PUT: O PUT você pode atualizar os dados já cadastrados do usuário. 
- DELETE: E com o DELETE é possível deletar o cadastro do usuário.
