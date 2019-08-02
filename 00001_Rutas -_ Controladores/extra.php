$pasePorView = false;

function view($route, $vac = []) {
  global $pasePorView;
  
  $pasePorView = true;
  
  if (!is_array($vac)) {
    echo "O segundo parâmetro enviado para function view deve ser um array";exit;
  }
  
  if (count($vac) != 2) {
    echo "Você só deveria compartilhar duas variáveis com a view";exit;
  }
  
  $estaArya = false;
  $estaStark = false;
  foreach ($vac as $v) {
    if ($v === "Arya") {
      $estaArya = true;
    }
    if ($v === "Stark") {
      $estaStark = true;
    }
  }
  
  if (!$estaArya || !$estaStark) {
    echo "Você não está compartilhando o nome e o sobrenome com a view";exit;
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