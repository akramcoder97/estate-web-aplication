
  <style>
    .title{
      font-family: Arial narrow;
      color: #393E46;
    }
  </style>
  <!--/ categories /-->
  <section class="section-news section-t4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-wrap d-flex justify-content-between">
            <div class="title-box">
              <h3 class="title">Toute Categories Des Immobiliers</h3>
            </div>
          </div>
        </div>
      </div>
      <div id="new-carousel" class="owl-carousel owl-theme">
        @foreach($data as $item)
          <div class="carousel-item-c">
          <a href="{{ route('estates-list', ['category_id' => $item->id]) }}">
            <div class="card-box-b card-shadow news-box">
              <div class="img-box-b">
                <img src="assets/img/{{$item->image}}" alt="" class="img-b img-fluid" style="height: 410px;">
              </div>
            
              <div class="card-overlay">
                <div class="card-header-b">
                  <div class="card-category-b">
                    
                  </div>
                  <div class="card-title-b">
                    <h2 class="title-2">
                    <span class="text-success">{{$item->name}} </span>
                    </h2>
                  </div>
                  <div class="card-date">
                    <span class="date-b">{{ $item->estates_count }} immobiliers</span>
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  <!--/ News End /-->











