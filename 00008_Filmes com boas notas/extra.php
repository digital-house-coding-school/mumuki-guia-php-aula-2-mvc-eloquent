$pasePorView = false;

$id = null;

function view($route, $vac = []) {
  global $pasePorView;
  global $id;
  
  $pasePorView = true;
  
  if ($route == "bonsFilmes") {
    if (count($vac) !== 1) {
      throw new Exception('Você deve passar uma variável (e somente uma) para a view');
    }
    
    $consulta = array_shift($vac);
    
    if ($consulta instanceof Consulta == false) {
      
      throw new Exception("Você está utilizando uma consulta do Eloquent?");
    }
    
    if ($consulta->table != "filmes") {
      throw new Exception("Você está fazendo uma consulta a tabela de filmes?");
    }
    
    $wheres = $consulta->where;
    
    if (count($wheres) != 1) {
      throw new Exception("Você deve usar o método where (e somente uma vez)");
    }
    
    if($wheres[0][0] != "rating") {
      throw new Exception("Você deve fazer um filtro na coluna rating.");
    }
    
    if($wheres[0][1] != ">") {
      throw new Exception("Você deve fazer um filtro comparando com o operador maior");
    }
    
    if($wheres[0][2] != "8") {
      throw new Exception("Você deve fazer um filtro verificando ratings maiores que 8");
    }
    
    if (!$consulta->get) {
      throw new Exception("Não se esqueção de finalisar chamando o método get!!!");
    }
    
  } else {
    throw new Exception("O arquivo da view deve se chamar bonsFilmes.blade.php");
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
    $consulta = new Consulta("movies");
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
	}

	public function orderBy($col, $order = "ASC") {
		$this->order[] = [$col, $order];
	}

	public function get() {
		$this->get = true;
		return $this;
	}
}