<x-layout>
    <x-slot name="title">Registrati</x-slot>
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-12 col-md-6">
                <h1 class="text-first-color my-2">{{__('ui.register')}}</h1>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-12 col-md-6">
                <form method="POST" action="{{route('register')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">{{__('ui.name')}}</label>
                        <input type="text" class="form-control input-border" id="exampleInputName" aria-describedby="emailHelp" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputSurname" class="form-label">{{__('ui.surname')}}</label>
                        <input type="text" class="form-control input-border" id="exampleInputSurname" aria-describedby="emailHelp" name="surname">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control input-border" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control input-border" id="exampleInputPassword1" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPasswordConfirm" class="form-label">{{__('ui.confirmation')}} Password</label>
                        <input type="password" class="form-control input-border" id="exampleInputPasswordConfirm" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn first-color text-light my-2">{{__('ui.register')}}</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>