public function testDetalhesFilme(): void {
  global $pasePorView;
  global $id;
  
  $pasePorView = false;
  
  $pc = new FilmesController();
  
  $id = 3;
  try {
    $resul = $pc->detalhes(3);
  } catch(Exception $e) {
    $this->assertTrue(false, $e->getMessage());
  }
  
  $id = 1;
  try {
    $resul = $pc->detalhes(1);
  } catch(Exception $e) {
    $this->assertTrue(false, $e->getMessage());
  }
  
  $this->assertTrue($pasePorView, "Parece que você não está chamando a função view");
  
  $this->assertTrue(is_string($resul), "Você está retornando o resultado da função view? Verifique também se está passando o nome da view corretamente.");
  
  
}