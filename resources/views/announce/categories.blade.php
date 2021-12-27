<x-layout>
    <x-slot name="title">
        Categories
    </x-slot>
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-12 col-md-6">
                <h1 class="my-2 text-first-color">Categorie: {{$category->name}}</h1>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            @foreach ($announces as $announce)
            <div class="col-12 col-md-4 my-5 text-center mx-auto ">
                <div class="card-welcome my-5 mx-auto">
                    <div class="">
                        <h5 class=" mt-2">{{$announce->name}}</h5>
                        <h6 class=" mb-2 text-muted mt-2">
                            {{$announce->category->name}}
                        </h6>
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($announce->announceimages as $image)
                                <div class="carousel-item {{$loop->first ? 'active' : '' }}">
                                    <img class="rounded" src="{{ $image->getUrl(300, 150) }}" 
                                    alt="{{ $announce->name }}">                                  
                                </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                            </button>
                          </div>
                       
                        <p class=" mt-2">{{$announce->description}}</p>
                        <p class="">€ {{$announce->price}}</p>
                        <p class="">Inserito il: {{$announce->created_at->format('d-m-Y')}}<br> da {{$announce->user->name}}</p>
                        <a href="{{route('announce.detail',compact('announce'))}}" class="btn second-color text-light">{{__('ui.detail')}}</a>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="row justify-content-center text-center">
                <div class="col-md-8">
                    {{$announces->links()}}
                </div>
            </div>
        </div>
    </div>
</x-layout>