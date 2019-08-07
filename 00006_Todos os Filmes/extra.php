$pasePorView = false;

function view($route, $vac = []) {
  global $pasePorView;
  
  $pasePorView = true;
  
  if ($route == "listarFilmes") {
    if (count($vac) !== 1) {
      throw new Exception('Você deve passar uma variável (e somente uma) para a view');
    }
    
    $peliculas = array_shift($vac);
    
    if (!is_array($peliculas) || count($peliculas) != 3 || $peliculas[0] instanceof Filme == false || $peliculas[1] instanceof Filme == false || $peliculas[2] instanceof Filme == false || $peliculas[0]->title != "Toy Story" || $peliculas[1]->title != "Buscando a Nemo" || $peliculas[2]->title != "Cars") {
      
      throw new Exception("Você está enviando a lista de filmes?");
    }
    
  } else {
    throw new Exception("O arquivo da view deve se chamar listarFilmes.blade.php");
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
}