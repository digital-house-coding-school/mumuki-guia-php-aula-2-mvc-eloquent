public function testRutas(): void {
		$rutasGet = Route::$routesGet;
		
		$this->assertTrue(count($rutasGet) == 3, "Deveria haver três rotas por GET");
	  
		$rutasGet = Route::$routesGet;
		
		$ruta = null;
		
		foreach ($rutasGet as $rutas) {
		  if ($rutas["route"] == "generos" || $rutas["route"] == "/generos") {
			$ruta = $rutas;
		  }
		}
	  
		$this->assertTrue($ruta !== NULL, "Falta a rota  /generos");
		
		$this->assertTrue(is_string($ruta["action"]), "O segundo parâmetro da rota deve ser uma string");
		
		$this->assertTrue($ruta["action"] === "GenerosController@listar", "A rota /generos deve direcionar ao GenerosController para o método listar");
	  
		$rutasGet = Route::$routesGet;
		
		$ruta = null;
		
		foreach ($rutasGet as $rutas) {
		  if ($rutas["route"] == "filmes" || $rutas["route"] == "/filmes") {
			$ruta = $rutas;
		  }
		}
	  
		$this->assertTrue($ruta !== NULL, "Falta a rota /filmes");
		
		$this->assertTrue(is_string($ruta["action"]), "O segundo parâmetro da rota deve ser uma string");
		
		$this->assertTrue($ruta["action"] === "FilmesController@listar", "A rota /filmes deve direcionar a FilmesController para o método listar");
	  
		$rutasGet = Route::$routesGet;
		
		$ruta = null;
		
		foreach ($rutasGet as $rutas) {
		  $nombreRuta = $rutas["route"];
		  
		  $primerCaracter = substr($nombreRuta, 0, 1);
		
		  if ($primerCaracter == "/") {
			$nombreRuta = substr($nombreRuta, 1);
		  }
		  
		  $partes = explode("/", $nombreRuta);
		  
		  if (count($partes) == 2 && $partes[0] === "filmes")
		  {
			if (preg_match("/{[a-zA-Z]+}/", $partes[1]) === 1) {
			  $ruta = $rutas;
			}
		  }
		}
		
		$this->assertTrue($ruta !== NULL, "Falta a rota /filmes/ID . Observe que o parâmetro da rota deve ir entre chaves (ie: /filmes/{id})");
		
		$this->assertTrue(is_string($ruta["action"]), "O segundo parâmetro da rota /filmes/ID deveria ser uma string");
		
		$this->assertTrue($ruta["action"] === "FilmesController@detalhe", "A rota /filmes/ID deveria direcionar ao FilmesController para o método detalhe");
	}