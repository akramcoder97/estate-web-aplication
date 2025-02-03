<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />

  @include('admin.head')
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

    <!-- /.row -->
     <div class="content-wrapper">
        <div class="">
          <div class="col-12">
            <div class="card" style="width: 100% !important; overflow-x: auto;">
              <div class="card-header">
                <h3 class="card-title">Liste des immobiliers</h3>
              </div>
              <!-- ./card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover" style="">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Categorie</th>
                      <th>Type</th>
                      <th>Etage</th>
                      <th>Pieces</th>
                      <th>Surface</th>
                      <th>Specification</th>
                      <th>Prix</th>
                      <th>Wilaya</th>
                      <th>Commune</th>
                      <th>City</th>
                      <th>Telephone de propriétaire</th>
                      <th>Date de depose</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $item)
                      <tr data-widget="expandable-table" aria-expanded="false">
                        <td>{{$item->id}}</td>
                        <td>{{$item->category->name}}</td>
                        <td>{{$item->type}}</td>
                        <td>{{$item->floor}}</td>
                        <td>{{$item->pieces}}</td>
                        <td>{{$item->surface}} M²</td>
                        <td>{{$item->specification}}</td>
                        <td>{{$item->price}} {{$item->price_unit}}</td>
                        <td>{{$item->state}}</td>
                        <td>{{$item->town}}</td>
                        <td>{{$item->city}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->created_at}}</td>
                      </tr>
                      <tr class="expandable-body">
                        <td colspan="12" style="width: 100% !important !important;">
                        @foreach($item->images_array as $image)
                          <img src="{{ asset('assets/img/' . $image) }}" alt="{{ $image }}" style="max-width: 240px; max-height:280px; margin: 10px;">
                        @endforeach
                        </td>
                      </tr> <!--  -->
                    @endforeach
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
    
</script>


