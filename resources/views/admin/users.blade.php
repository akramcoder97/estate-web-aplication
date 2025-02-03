<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

  @include('admin.head')
<style>
    .search-bar{
    position: relative;
    }

    .search-bar .fa-search{
    position: absolute;
    top:20px;
    left: 20px;
    color: #9ca3af;
    }

    .form-input{
    height: 55px;
    text-indent: 33px;
    border-radius: 10px;
    }
    .form-input-id{
    height: 35px;
    font-size: 14px;
    text-indent: 10px !important;
    border-radius: 10px;
    }
    .form-input:focus,
    .form-input-id:focus{
    box-shadow: none;
    border: 2px solid #C4D9FF;
    }

</style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
    @include('admin.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

    @include('admin.sidebar')

</style>

    <!-- /.row -->
     <div class="content-wrapper">
     <div class="">
          <div class="col-12">
            <div class="card" style="width: 100% !important; overflow-x: auto;">
              <div class="card-header">
                <h3 class="card-title">Liste des utilisateurs</h3>
              </div>
              <div class="search search-bar">
                <i class="fa fa-search"></i>
                <input type="text" class="form-control form-input" id="find" placeholder="Rechercher categorie.." onkeyup="search()">
              </div>
              <!-- ./card-header -->
              <div class="card-body" style="overflow-x: auto;">
                <table class="table table-bordered table-hover" style="table-layout: fixed; min-width: 1650px;">
                  <thead>
                    <tr>
                      <th style="width: 100px; padding: 2px !important;">
                        <div class="search search-bar">
                          <i style="font-size: 10px; left: 8px; top: 14px;" class="fa fa-search"></i>
                          <input type="text" class="form-control form-input-id" id="findId" placeholder="Taper id.." onkeyup="searchId()">
                        </div>                        
                      </th>
                      <th>Categorie</th> 
                      <th>Type</th>
                      <th style="width: 70px;">Etage</th>
                      <th>Surface</th>
                      <th>Wilaya</th>
                      <th>Commune</th>
                      <th>City</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        </div>
</div>

 
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Attention !</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        etes vous sur de suprimmer cette categorie ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger confirm-delete">Suprimer</button>
      </div>
    </div>
  </div>
</div>
<!-- ./wrapper -->
@include('admin.scripts')

<script>
    $(document).ready(function() {
        var deleteCategory;

        // set the product ID
        $('.delete-button').click(function() {
          deleteCategory = $(this).data('id');
          $('#deleteModal').modal('show');
        });

        // confirm deletion
        $('.confirm-delete').click(function() {

          $.ajax({
            url: '/delete-category/' + deleteCategory,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE',
            },
            success: function(response) {
                $('#deleteModal').modal('hide');
                $('#category-' + deleteCategory).remove();
            },
            error: function(response) {
                alert('Erreur !');
            }
          });
        }); 
    })

    /* search bar filter */
    function search() {
      let filter = document.getElementById('find').value.toUpperCase();
      let item = document.querySelectorAll('.tr');
      let l = document.getElementsByTagName('span');

      for(var i = 0;i<=l.length;i++){
        let a=item[i].getElementsByTagName('span')[0];
        let value=a.innerHTML || a.innerText || a.textContent;

        if(value.toUpperCase().indexOf(filter) > -1) {
          item[i].style.display="";
        }
        else
        {
          item[i].style.display="none";
        }
      }
    }
    function searchId() {
      let filter = document.getElementById('findId').value.toUpperCase();
      let item = document.querySelectorAll('.tr');
      let l = document.getElementsByTagName('p');

      for(var i = 0;i<=l.length;i++){
        let a=item[i].getElementsByTagName('p')[0];
        let value=a.innerHTML || a.innerText || a.textContent;

        if(value.toUpperCase().indexOf(filter) > -1) {
          item[i].style.display="";
        }
        else
        {
          item[i].style.display="none";
        }
      }
    }
</script>


