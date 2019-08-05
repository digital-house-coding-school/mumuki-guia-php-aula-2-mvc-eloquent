public function testGenerosController(): void {
  global $pasePorView;
  
  $pasePorView = false;

  $gc = new GenerosController();
  
  $this->assertTrue(method_exists($gc, 'listar'), "Falta o método listar no GenerosController");
  
  $resul = $gc->listar();
  
  $this->assertTrue($pasePorView, "Parece que você não utilizou a função view");
  
  $this->assertTrue($resul === "listarGeneros", "O método deveria redirecionar para a view listarGeneros. Esqueceu o return?");
}