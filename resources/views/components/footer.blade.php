<footer class="container-fluid presto-footer sticky-bottom">
  <div class="row justify-content-center text-center">
    <div class="col-12 col-md-4 my-4">
      <h3 class="text-light">{{__('ui.contact')}}</h3>
      <p class="text-light">email: presto@ibravi.com</p>
      <p class="text-light">Tel: +39 356784048</p>
      <span class="text-light">Lingue:</span>
      <div class="d-flex flex-row justify-content-center">
        
        @include('components.locale', ['lang'=>'it', 'nation'=>'it'])
        @include('components.locale', ['lang'=>'en', 'nation'=>'gb'])
        @include('components.locale', ['lang'=>'es', 'nation'=>'es'])     
      </div>
    </div>
    <div class="col-12 col-md-4 my-4">
      <h3 class="text-light">Social</h3>
          <h6><i class="fa-brands fa-facebook icon fa-2x mx-2"></i><i class="fa-brands fa-twitter icon fa-2x mx-2"></i><i class="fa-brands fa-instagram icon fa-2x mx-2"></i></h6>
      
    </div>
    <div class="col-12 col-md-4 my-4">
   
    <h3 class="text-light">Copyright</h3>
    <p class="text-light">Hackademy 35 <i class="fa-solid fa-copyright text-light"></i></p>
    </div>
  </div>
</footer>
