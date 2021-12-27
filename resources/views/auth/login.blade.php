<x-layout>
    <x-slot name="title">Login</x-slot>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-12 col-md-6">
                <h1 class="text-first-color my-5">Login</h1>
            </div>
        </div>
        <div class="row justify-content-center text-center mb-5">
            <div class="col-12 col-md-6">
                <form method="POST" action="{{route('login')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control input-border" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control input-border" id="exampleInputPassword1" name="password">
                    </div>
                    <button type="submit" class="btn first-color text-light">Login</button>
                </form>
                <p class="my-2">{{__('ui.messageRegister')}} <a href="{{route('register')}}" class="text-first-color">{{__('ui.register')}}</a></p>
            </div>
        </div>
    </div>
</x-layout>