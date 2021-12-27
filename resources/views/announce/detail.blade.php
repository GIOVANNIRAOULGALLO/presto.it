<x-layout>
  <x-slot name="title">
    {{__('ui.detail')}}
  </x-slot>
  <div class="container-fluid">
    <div class="row justify-content-center text-center">
      <div class="col-12 col-md-6"> 
      </div>
    </div>
    <div class="row justify-content-center text-center  align-items-center my-5">
      <div class="col-12 col-md-6 text-center mt-5">
        <h1>{{$announce->name}}</h1>
        <p>{{$announce->description}}</p>
        <p>€ {{$announce->price}}</p>
        <p>{{__('ui.when')}}: {{$announce->created_at->format('d-m-Y')}} - <br> {{__('ui.from')}} {{$announce->user->name}}</p>
      </div>
      <div class="col-12 col-md-6">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            @foreach ($announce->announceimages as $image)
            <div class="carousel-item {{$loop->first ? 'active' : '' }}">
                <img class="img-fluid" src="{{ $image->getUrl(300, 150) }}" 
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
      </div>
    </div>
    <div class="row justify-content-center text-center">
      <div class="col-12 col-md-6">
        <div class="d-flex justify-content-between">
        @if(Auth::user()->id == $announce->user->id)
        <form action="{{route('announce.destroy',compact('announce'))}}" method="POST">
          @csrf
          @method('delete')
          <button class="btn first-color text-light" type="submit" >ELIMINA</button>
        </form>
        <a href="{{route('announce.edit',compact('announce'))}}" class="btn first-color text-light">MODIFICA</a>
        @endif
        </div>
       
      </div>
    <div class="row justify-content-center text-center">
      <div class="col-12 col-md-6">
        <a href="{{route('homepage')}}" class="btn first-color text-light my-5">HOME</a>
      </div>
    </div>
  </div>
</x-layout>