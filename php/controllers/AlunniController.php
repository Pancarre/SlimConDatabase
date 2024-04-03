<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunniController
{
  public function index(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM alunni");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function FoundId(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $id = $args['parameter'];
    $result = $mysqli_connection->query("SELECT * FROM alunni WHERE id = $id");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function AddAlunno(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    
    $body = $request->getBody()->getContents();
    $parsedBody = json_decode($body,true);

    $nome = $parsedBody['nome'];
    $cognome = $parsedBody['cognome'];

    $result = $mysqli_connection->query("INSERT INTO alunni (nome,cognome) VALUES ('$nome','$cognome')");

    $response ->getBody()->write("alunno creato con successo");
    return $response -> withHeader('Content-Type','application/json')->withStatus(202);

  }

  public function ApdateAlunno(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    
    $body = $request->getBody()->getContents();
    $parsedBody = json_decode($body,true);

    $nome = $parsedBody['nome'];
    $cognome = $parsedBody['cognome'];
    $id = $args['parameter'];
    $result = $mysqli_connection->query("UPDATE alunni SET  nome = '$nome', cognome = '$cognome' WHERE id = '$id' ");

    $response ->getBody()->write("alunno aggiornato con successo");
    return $response -> withHeader('Content-Type','application/json')->withStatus(204);

  }

  public function DeleteAlunno(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    
    $id = $args['parameter'];
    $result = $mysqli_connection->query("DELETE FROM alunni WHERE id = '$id' ");

    $response ->getBody()->write("alunno rimosso con successo");
    return $response -> withHeader('Content-Type','application/json')->withStatus(204);

  }

}
