$pasePorView = false;

$id = null;

function view($route, $vac = []) {
  global $pasePorView;
  global $id;
  
  $pasePorView = true;
  
  if ($route == "filmesAceitaveis") {
    if (count($vac) !== 1) {
      throw new Exception('Você deve passar uma variável (e somente uma) para a view. Verifique também o nome da view retornada e o nome da variável passada a ela.');
    }
    
    $consulta = array_shift($vac);
    
    if ($consulta instanceof Consulta == false) {
      
      throw new Exception("Você está utilizando uma consulta do Eloquent?");
    }
    
    if ($consulta->table != "filmes") {
      throw new Exception("Você está fazendo uma consulta na tabela filmes?");
    }
    
    $wheres = $consulta->where;
    
    if (count($wheres) != 2) {
      throw new Exception("Você deve usar o método where duas vezes (e não mais que isso).");
    }
    
    $filtro5 = false;
    $filtro8 = false;
    
    if($wheres[0][0] != "rating") {
      throw new Exception("A primeira condição de filtro deve ser na coluna rating.");
    }
    
    if($wheres[1][0] != "rating") {
      throw new Exception("A segunda condição de filtro deve ser na coluna rating.");
    }
    
    if($wheres[0][1] == ">" && $wheres[0][2] == "5") {
      $filtro5 = true;
    }
    
    if($wheres[1][1] == ">" && $wheres[1][2] == "5") {
      $filtro5 = true;
    }
    
    if($wheres[0][1] == "<=" && $wheres[0][2] == "8") {
      $filtro8 = true;
    }
    
    if($wheres[1][1] == "<=" && $wheres[1][2] == "8") {
      $filtro8 = true;
    }
    
    if (!$filtro5) {
      throw new Exception("Falta o filtro que busca filmes com rating maior que 5");
    }
    
    if (!$filtro8) {
      throw new Exception("Falta o filtro que busca filmes com rating menor ou igual a 8");
    }
    
    $orders = $consulta->order;
    
    if (count($orders) != 1) {
      throw new Exception("Você deve usar o método orderBy (somente uma vez).");
    }
    
    if($orders[0][0] != "title") {
      throw new Exception("Você deve ordenar pela coluna title");
    }
    
    if($orders[0][1] != "asc" && $orders[0][1] != "ASC") {
      throw new Exception("Você deve ordenar de forma crescente.");
    }
    
    if (!$consulta->get) {
      throw new Exception("Não se esqueça de chamar o método get ao final!!!");
    }
    
  } else {
    throw new Exception("O arquivo da view deve se chamar filmesAceitaveis.blade.php");
  }
  
  return $route;
}

class Route {
  public static $routesGet = [];
  public static $routesPost = [];

  public static function get($route, $action) {
    $newRoute = [
      "route" => $route,
      "action" => $action
    ];
    
    Route::$routesGet[] = $newRoute;
  }
  
  public static function post($route, $action) {
    $newRoute = [
      "route" => $route,
      "action" => $action
    ];
    
    Route::$routesPost[] = $newRoute;
  }

}

class Controller {

}

class Model {
  public function getPrimaryKey() {
    if (isset($this->primaryKey)) {
      return $this->primaryKey;
    }
    return 'id';
  }
  
  public function getTable() {
    if (isset($this->table)) {
      return $this->table;
    }
    return null;
  }
  
  public function getTimestamps() {
    if (isset($this->timestamps)) {
      return $this->timestamps;
    }
    return true;
  }
  
  public function getGuarded() {
    if (isset($this->guarded)) {
      return $this->guarded;
    }
    return null;
  }
}

class Filme extends Model {
  public $rating;
  public $title;

  public static function all() {
    $peli1 = new Filme();
    $peli1->id = 1;
    $peli1->title = "Toy Story";
    $peli1->rating = 9.5;
    
    $peli2 = new Filme();
    $peli2->id = 2;
    $peli2->title = "Buscando a Nemo";
    $peli2->rating = 8.2;
    
    $peli3 = new Filme();
    $peli3->id = 3;
    $peli3->title = "Cars";
    $peli3->rating = 7.0;
    
    return [$peli1, $peli2, $peli3];
  }
  
  public static function find($id) {
    $peliculas = Filme::all();
    return $peliculas[$id - 1];
  }
  
  public static function where($col, $operador, $value = null) {
    $consulta = new Consulta("filmes");
    $consulta->where($col, $operador, $value);
    
    return $consulta;
  }
  
  public static function orderBy($col, $order = "ASC") {
    $consulta = new Consulta("movies");
    $consulta->orderBy($col, $order);
    
    return $consulta;
  }
}

class Consulta {
  public $where = [];
  public $order = [];
  public $table;
  public $get = false;
  
  public function __construct($table) {
    $this->table = $table;
  }
  
  public function where($col, $operador, $value = null) {
    if ($value === null) {
      $value = $operador;
      $operador = "=";
    }
    
    $where = [$col, $operador, $value];
    $this->where[] = $where;
    return $this;
  }

  public function orderBy($col, $order = "ASC") {
    $this->order[] = [$col, $order];
    return $this;
  }
  
  public function get() {
    $this->get = true;
    return $this;
  }
}