@include('layouts.header')
<form action="{{route('categories.store')}}" method="post" >
    @csrf
    <label for="titre">Titre:</label>
    <input type="text" name="titre">
    <input type="submit" value="Ajouter">
</form>