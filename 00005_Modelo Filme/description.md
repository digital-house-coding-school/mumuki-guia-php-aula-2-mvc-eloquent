Para este exercício faremos em movie.php, o arquivo **model** que é consistente com a tabela **filmes** no banco de dados.

Seu trabalho neste caso é o seguinte:

> 1. Declare no model que a tabela do banco de dados é chamada **filmes**

> 2. Declare que os registros de data e hora no banco de dados serão definidos. (não é necessário escrevê-lo)

> 3. Defina que todas as colunas podem ser escritas usando o atributo `$guarded`

> 4. Declare que a chave primária é chamada **id** (não é necessário digitá-la)

> 5. Adicione um método na classe **Filme** chamado `recomendado`. Este método deve analisar se a classificação do filme é maior que 8 para retornar um booleano. Lembre-se que dentro da classe você pode escrever `$this->rating`, já que o Laravel irá gerar automaticamente os atributos da classe com base nas colunas do banco de dados.