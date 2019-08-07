**Esclarecimento: Neste exercício não é necessário que você adicione a linha `use App\Filme;`. Você pode assumir que o arquivo já está incluído**

Chegou a hora de inserir um filme!

Para isso, você deve criar uma função chamada `store` que receberá o seguinte formulário por POST para adicionar um filme:

``` html
<form action="/filmes/store" method="POST">
   {{csrf_field}}
   <input type="text" name="title">
   <input type="text" name="rating">
   <input type="text" name="awards">
</form>
```

Esta função de armazenamento deve:

> 1. Receber um parâmetro do tipo `Request`

> 2. Criar um novo objeto do tipo `Filme`

> 3. Atribir os atributos ao objeto `Filme` baseado nos dados da `Request`. Felizmente, o banco de dados tem os mesmos nomes de coluna que os campos `<input>` no formulário

> 4. Chame o método save

> 5. Redirecione o usuário para a URL **/filmes/listar** através da função `redirect`