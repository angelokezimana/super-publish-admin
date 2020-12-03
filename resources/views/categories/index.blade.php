@extends('templates.default')
@section('content')



<ol class="breadcrumb">
    <li><a href="#">
            <em class="fa fa-home"></em>
        </a></li>
    <li class="active">Provinces</li>
</ol>
    
  <div class="card-header row add-element-box bg-transparent">

    <div class=" alert-box success  bg_width "> 
          @if (Session::has('flash_message'))
          <h4 class="text-center  breadcrumb  bg_width"> 
            {{ Session::get('flash_message') }}  </h4>
           @endif
    </div> 
    

      <form method="post">
      <fieldset>
      <h3 class="text-white  breadcrumb mb-0">Operations  

         <a href="#formulaire" id="register"data-toggle="modal" data-target="#formulaire" class="add-element-item btn btn-primary" data-toggle="tooltip" data-placement="right" title="Enregistrer une categorie">
        <i class="fa fa-plus"></i>Ajouter une categorie
        </a>     
        
      </h3>
       
        </fieldset>
        </form>  
    </div>
   
     <div class="table-responsive">  
      <!-- <table class="table align-items-center table-sm table-dark table-flush" id="#dataTables-example" > -->
    <table  data-toggle="table" data-url=""  data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true"
                       data-sort-name="name" data-sort-order="desc" >
        <thead class="thead-warning ">
          <tr>
           
            <th >Numero</th>
            <th > nom </th> 
            <th >Date d'enregistrement</th> 
            <th >Action</th>          
          </tr>
        </thead>
        <tbody>
        <?php  $i=1 ?>
            @foreach($categories as $categorie)           
            <tr>
                <td><?= $i ?></td>
                <td>{{$categorie->nom}}</td>
                <td>{{$categorie->created_at}}</td>

                <td>                 
                   
                    <form action="categories/destroy/{{$categorie->id}}"  method="post">                 
                    <a href="categories/edit/{{$categorie->id}}" class="btn btn-primary" title="Editer"><i class="fa fa-edit"></i></a>                        
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


    <!-- Debut  formulaire reservation-->
    <div class="modal fade" id="formulaire">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Enregistrement  de la categorie</h4>           
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body row">
          <form action="{{url('categories')}}"  method="POST" enctype="multipart/form-data" id="formregister"> 
                  @csrf
                  
                  <div class="col col-lg-6">
                  <label class="alert alert-danger" id="erreur" style="width: 100%;display: none;"></label>
                      <div class="form-group  @if($errors->get('name')) has-error @endif">
                        <label class="form-control-label" for="name">name</label>
                        <input type="text" class="form-control form-control-alternative" placeholder="name" name="name" size="30">
                        <!-- @if($errors->get('name'))
                           @foreach($errors->get('name') as $message) -->
                              <small><small>
                            <!-- @endforeach
                        @endif -->
                      </div>
                    </div>
                    <!-- <div class="g-recaptcha" 
                     data-sitekey="6LeuNQITAAAAAPGRU7dkrCPIrrR64WPvzMc7pn6Z">
                    </div> -->
                <div class="col-lg-10">
                <button class="btn btn-primary" type="submit" >Save</button>
                <button class="btn btn-default" type="reset">Reset</button>       
                </div>
                       
              </form>
          </div>
        </div>
      </div>
    </div>
<!-- </div> -->


  <script>
  function hello() {
  // var pseudo=$("#noms").val();
  // var motdepasse=$("#motdepasse").val();
  //  $.post({
  //   url:'connect.php',
  //   data:{pseudo:pseudo,motdepasse:motdepasse},
  //   success:function (dt) {
  //     var ver=dt.split('#');
  //     if (ver[1]=='erreur') {
  //       $("#erreur").css('display','block');
  //       $("#erreur").html(ver[0]);
  //     }else{
  //       window.open('TableauDeBord.php','_self');
  //     }
  //   }
  //  });
 }
 $(function(){
 
 $('#register').click(function() {
     $('#formulaire').modal();
 });
 $(document).on('submit', '#formRegister', function(e) {  
     e.preventDefault();
      
     $('input+small').text('');
     $('input').parent().removeClass('has-error');
      
     $.ajax({
         method: $(this).attr('method'),
         url: $(this).attr('action'),
         data: $(this).serialize(),
         dataType: "json"
     })
     .done(function(data) {
         $('.alert-success').removeClass('hidden');
         $('#formulaire').modal('hide');
     })
     .fail(function(data) {
         $.each(data.responseJSON, function (key, value) {
             var input = '#formRegister input[nom=' + key + ']';
             $(input + '+small').text(value);
             $(input).parent().addClass('has-error');
         });
     });
 });
})
</script>
   







        @endsection()