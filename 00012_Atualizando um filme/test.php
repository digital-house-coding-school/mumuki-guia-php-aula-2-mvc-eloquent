public function testUpdate(): void {
		global $pasePorRedirect;
		global $request;
		global $pasePorSave;
		
		$request = new Request();
		
		$this->assertTrue(method_exists("FilmesController",'update'),"Falta o método update na FilmesController");
		
		$r = new ReflectionMethod("FilmesController", "update");
		$params = $r->getParameters();
		
		$this->assertTrue(count($params) === 2, "O método update deve receber dois parâmetros");
		
		$this->assertTrue($params[0]->getType() !== null && $params[0]->getType()->getName() === "Request", "O primeiro parãmetro recebido pelo método deve ser do tipo Request");
		
		$pasePorRedirect = false;
		
		$pc = new PeliculasController();
		
		$request->title = "O Rei Leão";
		$request->rating = 9.2;
		$request->awards = 5;
		$request->secret = 1;
		
		try {
		  $resul = $pc->actualizar($request, 1);
		} catch(Exception $e) {
		  $this->assertTrue(false, $e->getMessage());
		}
		
		$request->title = "Wall-e";
		$request->rating = 8.1;
		$request->awards = 4;
		$request->secret = 2;
		
		try {
		  $resul = $pc->actualizar($request, 2);
		} catch(Exception $e) {
		  $this->assertTrue(false, $e->getMessage());
		}
		
		$this->assertTrue($pasePorSave, "Mmm... parece que não está armazenando nada.");
		
		$this->assertTrue($pasePorRedirect, "Lembre de chamar a função redirect");
		
		$this->assertTrue(is_string($resul), "Você está retornando o resultado da função redirect?");
	  }