<h1>Web AnimalController</h1>

@if ($success)
    @foreach ($animais as $animal)
        {{ $animal->nome }} {{$animal->idade}} {{$animal->tipo}} {{$animal->raca}} {{$animal->tutor->nome}}<br>
    @endforeach
@endif

<br>
<br>

<form action="{{ route('registrarAnimais') }}" method="post">
    @csrf
    <label for="">Nome:</label><br>
    <input type="text" name="nome" id=""><br>
    <label for="">Idade:</label><br>
    <input type="number" name="idade" id=""><br>
    <label for="">Tipo:</label><br>
    <select name="tipo" id="">
        <option value="cachorro">Cachorro</option>
        <option value="gato">Gato</option>
    </select><br>

    <label for="">Raça:</label><br>
    <select name="raca" id="">
        <option value="Pinsher">Pinsher</option>
        <option value="Poodle">Poodle</option>
        <option value="Pastor Alemão">Pastor Alemão</option>
    </select><br>

    <label for="">Tutor:</label><br>
    <select name="tutor_id" id="">
        <option value="1">Hemílio</option>
        <option value="2">Francielle</option>
    </select>

    <button type="submit">Salvar</button>

</form>
