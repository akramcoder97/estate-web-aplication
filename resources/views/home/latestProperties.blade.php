<div class="row mx-4">
    @foreach($estate as $item)
        <div class="carousel-item-b col-md-4">
        <a href="{{route('estate-detail',['id' => $item->id])}}" class="text-light">
        <div class="card-box-a card-shadow">
            <div class="img-box-a">
            @php
                $images = explode(',', $item->images);
            @endphp
            @if(count($images) > 0) <!-- to load only the first image -->
                <img src="{{ asset('assets/img/' . $images[0]) }}" alt="" class="img-a img-fluid" style="height:350px;">
            @endif
            </div>
            <div class="card-overlay">
            <div class="card-overlay-a-content">
                <div class="card-header-a">
                <h2 class="card-title-a">
                    {{$item->name}} 
                </h2>
                </div>
                <div class="card-body-a">
                <div class="price-box d-flex">
                    <span class="price-a">{{ $item->price }} {{$item->price_unit}}</span>
                </div>
                <span class="ion-ios-arrow-forward"></span> Voir les Details
                </div>
                
                <div class="card-footer-a">
                <ul class="card-info d-flex justify-content-around">
                    @if (in_array($item->category_id, [22,23,24]))
                    <li>
                    <h4 class="card-info-title">Surface</h4>
                    <span>{{$item->surface}} m
                        <sup>2</sup>
                    </span>
                    </li>
                    @else
                    <li>
                    <h4 class="card-info-title">Surface</h4>
                    <span>{{$item->surface}} m
                        <sup>2</sup>
                    </span>
                    </li>
                    <li>
                    <h4 class="card-info-title">Pieces</h4>
                    <span>{{$item->pieces}}</span>
                    </li>
                    <li>
                    <h4 class="card-info-title">Etage</h4>
                    <span>4</span>
                    </li>
                    <li>
                    <h4 class="card-info-title">Garages</h4>
                    <span>1</span>
                    </li>
                    @endif
                </ul>
                </div>
            </div>
            </div>
        </div>
        <div class="caption mt-3 ml-2">
            <h5>{{$item->type}} {{$item->category->name}} à {{$item->state}},<br> {{$item->town}}</h5>
            <div class="mt-3 mb-5">
            <span class="text-dark"><i class="fa-solid fa-calendar"></i> Ajouté le: {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</span>
            </div>
        </div>
        </a>
        </div>
    @endforeach
</div>