public function testFiltroDuplo(): void {
	global $pasePorView;
	
	$pasePorView = false;
	
	$pc = new FilmesController();
	
	try {
	  $resul = $pc->filmesAceitaveis();
	} catch(Exception $e) {
	  $this->assertTrue(false, $e->getMessage());
	}
	
	$this->assertTrue($pasePorView, "Parece que você não está chamando a function view.");
	
	$this->assertTrue(is_string($resul), "Você está retornando o resultado da function view? Verifique também o nome da view retornada e o nome da variável a ela passada.");
}