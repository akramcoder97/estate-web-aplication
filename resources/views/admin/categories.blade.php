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

  <!-- cards style -->
  <style>
      img {
          /* max-width: 100%;
          height: auto;
          vertical-align: top; */
          height: 200px;
          width: 200px;
      }
      .mb-1 {
          margin-bottom: 0.25rem!important;
      }
      .h5, h5 {
          font-size: 1.25rem;
      }
      a {
      text-decoration:none;    
      }
      .team-style07 {
          background: #fff;
          text-align: center;
          padding: 18px !important;
          box-shadow: 0px 10px 30px 0px rgba(26, 29, 72, 0.07);
          border-radius: 15px;
          transition: all .3s ease-in-out;
          margin: 0px auto !important;
      }

      .team-style07:hover {
          background: #606060
      }

      .team-style07:hover h3 a,
      .team-style07:hover p {
          color: #fff
      }

      .team-style07 .team-thumb {
          position: relative;
          height: 200px;
          width: 200px;
          margin: 0px auto !important;
          margin-bottom: 50px !important;
        }

      .team-style07 .team-thumb .team-social {
          position: absolute;
          bottom: 0;
          left: 0;
          right: 0
      }

      .team-style07 .team-thumb .team-social .styled-icons li:nth-child(1) {
          position: absolute;
          opacity: 0;
          left: 0;
          right: 0;
          bottom: -70px;
          transition: all .3s ease-in-out
      }

     
      .team-style07:hover .team-thumb .team-social .styled-icons li:nth-child(1) {
          position: absolute;
          left: 0;
          right: 0;
          bottom: -50px;
          opacity: 1;
          transition: all .5s ease-in-out 0s
      }

      .team-style07 .team-thumb .team-social .styled-icons li a {
          background: rgba(97, 133, 242, 0.31);
          color: #fff;
          height: 40px;
          widtH: 190px;
          line-height: 40px;
          border: none;
          font-size: 16px;
          transition: all .3s ease-in-out
      }
      .mb-1-9, .my-1-9 {
          margin-bottom: 1.9rem;
      }

      .styled-icons a {
          border: 2px solid transparent;
          color: #333;
          display: inline-block;
          font-size: 16px;
          height: 36px;
          line-height: 2;
          margin-right: 4px;
          position: relative;
          text-align: center;
          text-decoration: none;
          width: 190px;
          transition: all .2s ease;
          border-radius: 70%
      }

      .styled-icons li {
          display: inline-block;
          margin-bottom: 5px;
          margin-top: 0;
          padding-left: 0 !important
      }
      .title-small-screen{
        display: none;
      }
      
      ul, li, a{
        text-decoration:none; 
      }
    /* small screens */
    @media (max-width: 576px) {
      .team-thumb{
            margin-bottom: 20px !important;
      }
        .team-style07 .team-thumb .team-social .styled-icons li:nth-child(1) {
          display: none;
      }
      .title-small-screen{
        display: block;
      }
    }
    
  </style>
  <!-- Main Sidebar Container -->

    @include('admin.sidebar')

  <!-- Content Wrapper. Contains page content --> 
  <div class="content-wrapper">
    <h1 class="m-2">Toutes les categories</h1>
    <div class="container">
      <div class="row mt-n1-9">
        @foreach($data as $item)
          <div class="col-md-6 col-xl-3 mt-1-9 wow mt-4 fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
            <div id="category-{{$item->id}}" class="team-style07">
              <div class="team-thumb mb-1-9">
                  <div class="thumb"><img src="assets/img/{{$item->image}}" class="rounded-circle" alt="categoryImage"></div>
                  <div class="team-social">
                      <ul class="styled-icons">
                          <li><a class="styled-icons-item" href="{{ route('admin-estates-list', ['category_id' => $item->id]) }}">Aficher les immobiliers <i class="fa-solid fa-caret-down"></i></a></li>
                      </ul>
                  </div>
              </div>
                <a class="styled-icons-item title-small-screen text-dark mb-3" href="{{ route('admin-estates-list', ['category_id' => $item->id]) }}">Aficher les immobiliers <i class="fa-solid fa-caret-down"></i></a>
                <h3 class="h5 mb-2"><a href="#!">
                  {{$item->name}}<span class="ml-1">
                      ( {{ $item->estates_count }} )
                  </span></a>
                </h3>
                <button class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></button>
                <button type="button" class="btn btn-danger delete-button" data-toggle="modal" data-id="{{$item->id}}" data-target="#deleteModal"><i class="fa-solid fa-trash-can"></i></button>
            </div>
          </div>
        @endforeach
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


