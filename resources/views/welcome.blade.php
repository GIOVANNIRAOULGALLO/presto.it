<x-layout>
    <x-slot name="title">
        Home
    </x-slot>
    <div class="container-fluid">


        <div class="row justify-content-center text-center first-color">
            <div class="col-12 justify-content-between">
                @foreach ($categories as $category)
                <a href="{{route('announce.category',['name'=>$category->name, 'id'=>$category->id])}}" class="btn second-color text-light btn-presto-category my-2 mx-1"><img class="img-card" src="/img/logocard.png" width="20" height="20" alt="">{{$category->name}}</a>
                @endforeach
            </div>
        </div>
        <div class="row justify-content-center text-center first-color">
        @if (session('access.denied.revisor.only'))
            <div class="alert alert-danger">
                Accesso consentito solo ai revisori
            </div>
            @endif
        
            @if (session('message'))
            <div class="alert alert-success my-0">
                {{ session('message') }}
            </div>
            @endif
        </div>
        <div class="row presto-musthead">
           
            <div class="col-12 col-md-6 ">
                <h1 class="text-light display-1 fw-bolder ms-5">Presto.it</h1>
            </div>
            <div class="col-12 col-md-6 text-center text-md-left">
                <p class="welcome-subtitle">{{__('ui.welcome')}}
                    <a href="{{route('announce.create')}}" class="btn first-color text-light">{{__('ui.announce-create')}}</a>
                </p>
            </div>
        </div>

        <div class="row justify-content-center text-center my-5">
            @foreach ($announces as $announce)
            <div class="col-12 col-md-4 my-1 text-center mx-auto ">
                <div class="card-welcome my-5 mx-auto">
                    <div class="">
                        <h5 class=" mt-2">{{$announce->name}}</h5>
                        <h6 class=" mb-2 text-muted mt-2">
                            {{$announce->category->name}}
                        </h6>
                        <div id="carouselExampleControls{{$announce->id}}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($announce->announceimages as $image)
                                <div class="carousel-item {{$loop->first ? 'active' : '' }}">
                                    <img class="rounded" src="{{ $image->getUrl(300, 150) }}" alt="{{ $announce->name }}">
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls{{$announce->id}}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls{{$announce->id}}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                        <p class=" mt-2 description-section">{{$announce->description}}</p>
                        <p class="">€ {{$announce->price}}</p>
                        <p class="">{{__('ui.when')}}: {{$announce->created_at->format('d-m-Y')}}<br> {{__('ui.from')}} {{$announce->user->name}}</p>
                        <a href="{{route('announce.detail',compact('announce'))}}" class="btn second-color text-light">{{__('ui.detail')}}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-layout>