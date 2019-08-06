public function testFilme(): void {
			$pelicula = new Filme();
			
			$this->assertTrue($pelicula->getTable() === "filmes", "A tabela de filmes deve se chamar 'filmes'");
			
			$this->assertTrue($pelicula->getPrimaryKey() === "id", "A chave primária da tabela filmes deve se chamar 'id'"); 
			
			$this->assertTrue($pelicula->getTimestamps() === true, "É necessário declarar que a tabela de filmes tem timestamps");
			
			$this->assertTrue(is_array($pelicula->getGuarded()), "O atributo guarded deve ser um array");
			
			$this->assertTrue($pelicula->getGuarded() === [], "O atributo guarded deve ser um array vazio para que todas as colunas sejam escrevíveis.");
			
			$this->assertTrue(method_exists("Filme", "recomendado"), "Falta o método 'recomendado' na classe Filme");
			
			$pelicula->rating = 9;
			
			$this->assertTrue($pelicula->recomendado() === true, "Um filme com rating 9 deveria retornar true ao perguntar se é recomendado.");
			
			$pelicula->rating = 7.9;
			
			$this->assertTrue($pelicula->recomendado() === false, "Um filme com rating 7.9 deveria retornar false ao perguntar se é recomendado.");
		}