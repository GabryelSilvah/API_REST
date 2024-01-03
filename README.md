# API REST
> Status: em desenvolvimento

> Documentação: [API_REST](https://documenter.getpostman.com/view/32073946/2s9YsFDtnU)

## Sobre
Esse é um projeto de API REST que está sendo desenvolvida em PHP puro. Os verbos http que estão sendo implementados é o GET, POST e DELETE. Com o método GET a API realiza uma conexão com o banco de dados e retorna em formato JSON dados de funcionários registrados. Já com o método POST é possível cadastrar um novo funcionário.

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
