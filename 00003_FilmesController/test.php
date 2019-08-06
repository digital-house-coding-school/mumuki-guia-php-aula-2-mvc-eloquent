public function testPeliculaListado(): void {
		global $pasePorView;
		
		$pasePorView = false;

		$pc = new FilmesController();
		
		$this->assertTrue(method_exists($pc, 'listar'), "Falta o método <em>listar</em> dentro de FilmesController");
		
		$resul = $pc->listar();
		
		$this->assertTrue($pasePorView, "Você não utilizou a função view");
		
		$this->assertTrue($resul === "listarFilmes", "O método <em>listar</em> deve redirecionar para a view listarFilmes. Esqueceu um return? Se não, verifique o nome da view retornada");
	}

	public function testPeliculasDetalle(): void {
		global $pasePorView;
		
		$pasePorView = false;

		$pc = new FilmesController();
		
		$this->assertTrue(method_exists($pc, 'detalhes'), "Falta o método <em>detalhes</em> dentro de FilmesController");
		
		$r = new ReflectionMethod("FilmesController", "detalhes");
		$params = $r->getParameters();
		
		$this->assertTrue(count($params) === 1, "O método detalhes deve receber um parâmetro");
		
		try {
			$resul = $pc->detalhes(3);
		} catch (Exception $e) {
			$this->assertTrue(false, "O método <em>detalhes</em> deveria passar para a view uma (e somente uma) variável");
		}
		
		$this->assertTrue($pasePorView, "Parece que você não utilizou a função <em>view</em>");
		
		$this->assertTrue($resul === "detalhesFilme3", "El método detalle debería redirigir a la vista detallePelicula y tiene que tener compartido el id que llega como parámetro. No olvides además de que deberías haber utilizado el return");
	}