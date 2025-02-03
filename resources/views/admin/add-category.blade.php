<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ajouter categorie</title>
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

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="row">
        @if(session()->has('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{session()->get('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    <!-- left column -->
        <div class="col-md-10 mt-5 mx-auto" style="">
            <!-- general form elements -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">ajouter une nouvelle categorie</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('storeCategory')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="nom">titre de la categorie</label>
                    <input type="text" class="form-control" id="nom" name="name" placeholder="titre">
                  </div>
                  <div class="form-group">
                    <label for="image">image</label>
                    <input type="file" class="form-control" id="image" name="image">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        </div>
</div>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('admin.scripts')<!-- SweetAlert2 -->

</body>
</html>
