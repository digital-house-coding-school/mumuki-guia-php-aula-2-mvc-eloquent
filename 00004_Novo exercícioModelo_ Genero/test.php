public function testGenero(): void {
			$genero = new Genero();
			
			$this->assertTrue($genero->getTable() === "generos", "A tabela de gêneros deve se chamar 'generos'");
			
			$this->assertTrue($genero->getPrimaryKey() === "id", "A primary Key (PK) da tabela 'generos' de se chamar 'id'"); 
			
			$this->assertTrue($genero->getTimestamps() === false, "É necessário declarar que a tabela gêneros não tem timestamps");
			
			$this->assertTrue(is_array($genero->getGuarded()), "O atributo guarded deve ser um array");
			
			$this->assertTrue($genero->getGuarded() === [], "O array guarded deve ser vazio para que todas as colunas da tabela sejam escrevíveis");
		  }