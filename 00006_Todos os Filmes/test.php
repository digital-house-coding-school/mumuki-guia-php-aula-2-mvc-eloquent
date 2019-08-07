public function testListarFilmes(): void {
  global $pasePorView;
  
  $pasePorView = false;

  $pc = new FilmesController();
  
  try {
    $resul = $pc->listar();
  } catch(Exception $e) {
    $this->assertTrue(false, $e->getMessage());
  }
  
  $this->assertTrue($pasePorView, "Parece que você não está chamando a função view");
  
  $this->assertTrue(is_string($resul), "Verifique se você está retornando a resultado da funcion view. Verifique também o nome da view que você está retornando.");
  
}