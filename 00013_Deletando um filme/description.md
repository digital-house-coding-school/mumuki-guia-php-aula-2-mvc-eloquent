**Esclarecimento: Neste exercício não é necessário que você adicione a linha `use App\Movie;`. Você pode assumir que o arquivo já está incluído**

E chegamos ao final da aula, onde finalmente iremos deletar um filme.

Para isso, você deve criar uma função chamada `delete` que receberá o seguinte formulário por DELETE para saber o **id** de qual filme deletar:

``` html
<form action = "/ movies / remove" method = "POST">
   {{csrf_field}}
   <input type="hidden" name="id" valor="{{$filme->id}}"
   <input type="hidden" name="_method" value="DELETE">
</ form>
```

Esta função `delete` deve:

> 1. Receber um parâmetro do tipo Request

> 2. Obtenha um objeto do tipo `Filme` usando o método` find` e o id recebido no objeto `Request`

> 3. Chame o método `delete`

> 4. Redirecionar o usuário para o URL **/filmes/listar** através da função `redirect`