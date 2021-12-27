<x-layout>
    <x-slot name="title">
        {{__('ui.basket')}}
    </x-slot>
    @if ($announce)
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-12 text-center">
                <h1 class="text-first-color my-3"> {{__('ui.basket')}}</h1>
            </div>
            <hr class="divider">
        </div>
        <div class="row my-3 ">
            <div class="col-12 text-start my-4">
                <h5>{{__('ui.announce-from')}} :</h5>
                {{ $announce->user->name }}<br>
                Email: {{ $announce->user->email }}
            </div>
            <hr class="divider">
        </div>
        <div class="row my-3">
            <div class=" col-12 text-start">
                <h5>{{__('ui.title')}}</h5>
                <p>{{ $announce->name }}</p>
            </div>
            <hr class="divider">
        </div>
        <div class="row my-3">
            <div class=" col-12 text-start">
                <h5>{{__('ui.description')}}</h5>
                <p>{{ $announce->description }}</p>
            </div>
            <hr class="divider">
        </div>
        <div class="row my-3">
                <h5>{{__('ui.image')}}</h5>
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
                {{ $announce->body}}
            </div>
        </div>
            <div class="row justify-content-center text-center my-3">
                <div class="col-md-6">
                        <form method="POST" action="{{route('revisor.restore', $announce->id)}}">
                        @csrf
                        <button type="submit" class="btn btn-success">{{__('ui.replace')}}</button>
                        </form>
                </div>
                <div class="col-md-6">
                    <form method="POST" action="{{route('revisor.announce.destroy', compact('announce'))}}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">{{__('ui.delete')}}</button>
                    </form>
                </div>
            </div>
            
       </div>
        
    </div>
    @else
        <h3 class="text-center">{{__('ui.no-announcement')}}</h3>
    @endif
</x-layout>
