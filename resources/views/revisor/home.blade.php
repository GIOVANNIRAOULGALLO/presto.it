<x-layout>
    <x-slot name="title">
        Revisor Home
    </x-slot>
    @if ($announce)
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-12 text-center">
                    <h1 class="my-3 text-first-color">Revisor Home</h1>
                </div>
                <hr class="divider">
            </div>
            <div class="row my-3 ">
                <div class="col-12 text-start my-4">
                    <h5>Annuncio inviato da :</h5>
                    {{ $announce->user->name }}<br>
                    Email: {{ $announce->user->email }}
                </div>
                <hr class="divider">
            </div>
            <div class="row my-3">
                <div class=" col-12 text-start">
                    <h5>Titolo</h5>
                    <p>{{ $announce->name }}</p>
                </div>
                <hr class="divider">
            </div>
            <div class="row my-3">
                <div class=" col-12 text-start">
                    <h5>Descrizione</h5>
                    <p>{{ $announce->description }}</p>
                </div>
                <hr class="divider">
            </div>
            <div class="row my-3">
                <h1>Immagini</h1>
                @foreach ($announce->announceimages as $image)
                <div class="col-12 col-md-6 my-2 text-end">
                <img class="rounded" src="{{ $image->getUrl(300, 150) }}" 
                            alt="{{ $announce->name }}"> 
                </div>
                <div class="col-12 col-md-6 text-start">
                    Adult:{{$image->adult}}<br>
                    spoof:{{$image->spoof}}<br>
                    medical:{{$image->medical}}<br>
                    violence:{{$image->violence}}<br>
                    racy:{{$image->racy}}<br>
                    <b>labels</b><br>
                    <ul>
                        @if($image->labels)
                            @foreach($image->labels as $label)
                                <li>{{$label}}</li>
                            @endforeach
                        @endif
                    </ul>      
                      
                
                </div>
                @endforeach
            </div>
            <div class="row justify-content-between my-3">
                <div class="col-12 col-md-6 text-start">
                    <form method="POST" action="{{ route('revisor.accept', $announce->id) }}">
                        @csrf
                        <button type="submit" class="btn second-color text-light">Accetta</button>
                    </form>
                </div>
                <div class="col-12 col-md-6 text-end">
                    <form method="POST" action="{{ route('revisor.reject', $announce->id) }}">
                        @csrf
                        <button type="submit" class="btn third-color text-light">Rifiuta</button>
                    </form>
                </div>
            </div>
        </div>
    @else
    <div class="container vh-100">
        <h3 class="text-center">Non ci sono annunci da controllare</h3>
    </div>
        @endif

</x-layout>
