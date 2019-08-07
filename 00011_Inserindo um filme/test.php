public function testInsert(): void {
		global $pasePorRedirect;
		global $request;
		global $pasePorSave;
		
		$request = new Request();
		
		$this->assertTrue(method_exists("FilmesController",'store'),"Falta o método store dentro de FilmesController");
		
		$r = new ReflectionMethod("FilmesController", "store");
		$params = $r->getParameters();
		
		$this->assertTrue(count($params) === 1, "O método store deve receber um único parâmetro");
		
		$this->assertTrue($params[0]->getType() !== null && $params[0]->getType()->getName() === "Request", "O parâmetro recebido pelo método store deve ser do tipo Request");
		
		$pasePorRedirect = false;
		
		$pc = new FilmesController();
		
		$request->title = "O Rei Leão";
		$request->rating = 9.2;
		$request->awards = 5;
		
		try {
		$resul = $pc->store($request);
		} catch(Exception $e) {
		$this->assertTrue(false, $e->getMessage());
		}
		
		$request->title = "Wall-e";
		$request->rating = 8.1;
		$request->awards = 4;
		
		try {
		$resul = $pc->store($request);
		} catch(Exception $e) {
		$this->assertTrue(false, $e->getMessage());
		}
		
		$this->assertTrue($pasePorSave, "Mmm...parece que não está armazenando nada");
		
		$this->assertTrue($pasePorRedirect, "Você deve chamar a função redirect");
		
		$this->assertTrue(is_string($resul), "Verifique se você está retornando o resultado da function redirect?");
	
	}