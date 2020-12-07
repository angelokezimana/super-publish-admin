@extends('templates.default')
@section('content')



<ol class="breadcrumb">
    <li><a href="#">
            <em class="fa fa-home"></em>
        </a></li>
    <li class="active">Categories</li>
</ol>
    
  <div class="card-header row add-element-box bg-transparent">

          @if (Session::has('success'))
            <div class="alert alert-success"> 
                    {{ Session::get('success') }}
            </div> 
           @endif

      <form method="post">
      <fieldset>
      <h3 class="text-white  breadcrumb mb-0"> 

         <a href='#' data-toggle="modal" data-target="#formulaire" class="btn-sm btn-primary btn-add-category" data-toggle="tooltip" data-placement="right" title="Enregistrer une categorie">
        <i class="fa fa-plus"></i>Ajouter une categorie
        </a>     
        
      </h3>
       
        </fieldset>
        </form>  
    </div>
   
   
    <div class="h1 text-center">Liste des Categories</div>
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
                   
                    <form action="categories/destroy/{{$categorie->id}}"  method="post">                 
                    <a href="" class="btn btn-primary btn-edit-category" title="Editer" data-toggle="modal"
                    data-target="#formulaire" data-id="{{$categorie->id}}"  data-namecategory="{{$categorie->namecategory}}" ><i class="fa fa-edit"></i></a>                        
                                     @csrf                                   
                                    <button type="submit" onclick="return confirm('voulez-vous supprimer cette categorie ?')" class="btn btn-danger  btn-xs" title="Delete"><i class="fa  fa-trash-o"></i></button>
                                </form>                     
                </td>
            </tr>
            <?php $i++ ?>
            @endforeach
        </tbody>
     
      </table>
        
    </div>


    @include('categories.modals.modal')


  <script>

  // $(function(){
 
  // $('#btn-add-category').click(function() {
  //    $('#formulaire').modal();
  // });
//  $(document).on('submit', '#formRegister', function(e) {  
//      e.preventDefault();
      
//      $('input+.alert-danger').text('');
//      $('input').parent().removeClass('has-error');
      
//      $.ajax({
//          method: $(this).attr('method'),
//          url: $(this).attr('action'),
//          data: $(this).serialize(),
//          dataType: "json"
//      })
//      .done(function(data) {
//          $('.alert-success').removeClass('hidden');
//          $('#formulaire').modal('hide');
//      })
//      .fail(function(data) {
//          $.each(data.responseJSON, function (key, value) {
//              var input = '#formRegister input[name=' + key + ']';
//              $(input + 'small').text(value);
//              $(input).parent().addClass('has-error');
//          });
//      });
//  });
// })
// </script>
   
   @endsection    
        @section('scripts')
<script src="{{ asset('js/Category.js') }}"></script>

@endsection