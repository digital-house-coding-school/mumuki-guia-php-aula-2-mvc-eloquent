public function testListarFilmes(): void {
		global $pasePorView;
		
		$pasePorView = false;

		$pc = new FilmesController();
		
		$this->assertTrue(method_exists($pc, 'listar'), "Falta o método listar dentro de FilmesController");
		
		$resul = $pc->listar();
		
		$this->assertTrue($pasePorView, "Você não utilizou a função view");
		
		$this->assertTrue($resul === "listarFilmes", "O método listar deve redirecionar para a view listarFilmes. Esqueceu um return? Se não, verifique o nome da view retornada");
	}

	public function testDetalhesFilmes(): void {
		global $pasePorView;
		
		$pasePorView = false;

		$pc = new FilmesController();
		
		$this->assertTrue(method_exists($pc, 'detalhes'), "Falta o método detalhes dentro de FilmesController");
		
		$r = new ReflectionMethod("FilmesController", "detalhes");
		$params = $r->getParameters();
		
		$this->assertTrue(count($params) === 1, "O método detalhes deve receber um parâmetro");
		
		try {
			$resul = $pc->detalhes(3);
		} catch (Exception $e) {
			$this->assertTrue(false, "O método detalhes deveria passar para a view uma (e somente uma) variável");
		}
		
		$this->assertTrue($pasePorView, "Parece que você não utilizou a função view");
		
		$this->assertTrue($resul === "detalhesFilme3", "O método detalhes deve redirecionar para a view detalhesFilme e deve passar o id como parâmetro para essa view. Não esqueça o return para retornar a view.");
	}