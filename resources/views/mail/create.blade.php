<x-layout>
    <x-slot name="title">{{__('ui.work')}}</x-slot>
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-12 col-md-6">
                <h1>{{__('ui.work')}}</h1>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-12 col-md-6">
                <form method="POST" action="{{route('mail.send')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputTextArea" class="form-label">{{__('ui.message')}}</label><br>
                        <textarea name="message" id="exampleInputTextArea" class="text-area-measure"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">{{__('ui.submit')}}</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>