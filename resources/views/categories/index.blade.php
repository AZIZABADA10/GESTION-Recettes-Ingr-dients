@include('layouts.header')
<a href="{{route('categories.create')}}">Ajouter Categorie</a>
@forelse ($categories as $categorie)
     <p>{{$categorie->titre}} 
  
     <span><a href="{{route('categories.edit',$categorie->id)}}">Edit</a></span></p>
     <span><a href="{{route('categories.show',$categorie->id)}}">show</a></span>   
          <form action="{{route('categories.destroy',$categorie->id)}}" method="POST" >
               @csrf
               @method('DELETE')
               <button type="submit">Suppremer</button>
          </form>
@empty
     <p>auccune categoré</p>
@endforelse