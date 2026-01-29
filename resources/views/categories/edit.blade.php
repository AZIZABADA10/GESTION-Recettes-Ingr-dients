@include('layouts.header')
<form action="{{route('categories.update',$categorie->id)}}" method="post" >
    @csrf
    @method('PUT')
    <label for="titre">Titre:</label>
    <input type="text" value="{{$categorie->titre}}" name="titre">
    <input type="submit" value="Modifier">
</form>