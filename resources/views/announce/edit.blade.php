<x-layout>
    <x-slot name="title">Modifica di {{__('ui.insert')}}</x-slot>
    <div class="container">
        <div class="row justify-content-center text-center my-4">   
            <div class="col-12 col-md-6">
                <h1>{{__('ui.insert')}}</h1>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-12 col-md-5">
                <form method="POST" action="{{route('announce.update',compact('announce'))}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name ="uniqueSecret" value ="{{$uniqueSecret}}">
                    <div class="mb-3">
                        <label for="announceInputName" class="form-label">{{__('ui.name')}}</label>
                        <input type="text" class="form-control" id="announceInputName" aria-describedby="emailHelp" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputTextArea" class="form-label">{{__('ui.description')}}</label><br>
                        <textarea name="description" id="exampleInputTextArea" class="text-area-measure"></textarea>
                    </div>
                    <div class="mb-3">
                        <div class="form-group row">
                            <label for="images" class="col-12 col-form-label text-md-left">{{__('ui.image')}}</label>
                        </div>
                        <div class="col-12">
                        <div class="dropzone" id="drophere"></div>
                        @error('images')
                        <span class="invalid-feedback" role="alert"> <strong>{{$message}}</strong>
                        </span>                            
                        @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPrice" class="form-label">{{__('ui.price')}}</label>
                        <input type="number" class="form-control" id="exampleInputPrice" aria-describedby="emailHelp" name="price">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">{{__('ui.category')}}</label><br>
                        <select name="category_id" id="">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{{__('ui.put')}}</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>