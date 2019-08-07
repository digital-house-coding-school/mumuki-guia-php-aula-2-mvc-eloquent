public function testFiltroEOrdem(): void {
		global $pasePorView;
		
		$pasePorView = false;
		
		$pc = new FilmesController();
		
		try {
		$resul = $pc->bonsFilmes();
		} catch(Exception $e) {
		$this->assertTrue(false, $e->getMessage());
		}
		
		$this->assertTrue($pasePorView, "Você deve chamar a função view.");
		
		$this->assertTrue(is_string($resul), "Verifique se seu código está retornando o resultado da função view. Verifique também o nome da view que está retornando e o nome da variável que está passando a ela.");
	}