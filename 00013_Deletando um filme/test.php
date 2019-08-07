public function testDelete(): void {
		global $pasePorRedirect;
		global $request;
		global $pasePorDelete;
		global $id;
		
		$request = new Request();
		
		$this->assertTrue(method_exists("FilmesController",'delete'),"Falta o método delete na classe FilmesController");
		
		$r = new ReflectionMethod("FilmesController", "delete");
		$params = $r->getParameters();
		
		$this->assertTrue(count($params) === 1, "O método delete deve receber um parâmetro.");
		
		$this->assertTrue($params[0]->getType() !== null && $params[0]->getType()->getName() === "Request", "O parâmetro recebido pelo delete deve ser do tipo request");
		
		$pasePorRedirect = false;
		
		$pc = new FilmesController();
		
		$request->id = 2;
		$id = 2;
		
		try {
		  $resul = $pc->delete($request);
		} catch(Exception $e) {
		  $this->assertTrue(false, $e->getMessage());
		}
		
		$request->id = 3;
		$id = 3;
		
		try {
		  $resul = $pc->delete($request);
		} catch(Exception $e) {
		  $this->assertTrue(false, $e->getMessage());
		}
		
		$this->assertTrue($pasePorDelete, "Mmm...parece que você não está deletando nada.");
		
		$this->assertTrue($pasePorRedirect, "Você deveria chamar a função redirect!");
		
		$this->assertTrue(is_string($resul), "Verifique se você está retornando o resultado da função redirect.");
		
	}