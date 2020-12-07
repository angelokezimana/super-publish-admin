@extends('templates.default')

@section('content')
<ol class="breadcrumb">
    <li><a href="#">
            <em class="fa fa-home"></em>
        </a></li>
    <li class="active">Categories Deleted</li>
</ol>
    
<div class=" ">
    <p class="h1 text-center">Liste des categories supprimées</p>   
    @if (session('success'))
        <div class="alert alert-success"><i class="fa fa-check"></i> {{ session('success') }}</div>
    @endif
</div>

     <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0"> 
        <thead class="thead-warning ">
          <tr>
           
            <th >Numero</th>
            <th > nom </th>
            <th >Enregistrer par </th>
            <th >Date d'enregistrement</th>            
            <th >Action</th>          
          </tr>
        </thead>
        <tbody>
        <?php  $i=1 ?>
            @foreach($categories as $categorie)           
            <tr>
                <td><?= $i ?></td>
                <td>{{$categorie->namecategory}}</td>
                <td>{{$categorie->username}}</td>
                <td>{{$categorie->created_at}}</td>
                <td>                 
                   
                    <form action="categories/restore/{{$categorie->id}}"  method="post">                                         
                                     @csrf                                   
                                    <button type="submit" onclick="return confirm('voulez-vous restaurer cette categorie ?')" class="btn btn-danger  btn-xs" title="Delete"><i class="fa  fa-edit"></i>Restaurer</button>
                                </form>                     
                </td>
            </tr>
            <?php $i++ ?>
            @endforeach
        </tbody>
     
      </table>
        
    </div>



@endsection


