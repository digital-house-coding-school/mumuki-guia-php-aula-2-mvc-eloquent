public function testBonsFilmes(): void {
		global $pasePorView;
		
		$pasePorView = false;
		
		$pc = new FilmesController();
		
		try {
		  $resul = $pc->bonsFilmes();
		} catch(Exception $e) {
		  $this->assertTrue(false, $e->getMessage());
		}
		
		$this->assertTrue($pasePorView, "Você está chamando a função view?");
		
		$this->assertTrue(is_string($resul), "Você está retornando o resultado da função view? Verifique o nome da view que está retornando.");
	}