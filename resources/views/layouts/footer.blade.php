 <section id="footer" class="d-flex mt-auto justify-content-center">
     <div class="row bg-dark text-white text-center pb-2 pt-5 w-100">
         <div class="col-lg-4 part-1">
             <h1 class="font-weight-bold">Zuans Post's</h1>
         </div>
         @auth
         <div class="col-lg-4 part-2">
             <div class="d-inline d-flex justify-content-center">
                 <a class="nav-link text-white  nav-size font-weight-bold" href="{{ route('home') }}">Info</a>

                 <a class="nav-link text-white nav-size font-weight-bold" href="{{ route('dashboard.postSett') }}">Post</a>

                 <a class="nav-link text-white nav-size font-weight-bold" href="{{ route('dashboard.addPost') }}">Add Post</a>

                 <a class="nav-link text-white nav-size font-weight-bold" href="{{ route('dashboard.yourPost') }}">Your Post</a>
             </div>
         </div>
         @endauth
         @guest
         <div class="col-lg-4 part-2">
             <h3 class="font-weight-bold">Welcome</h3>
             <h3 class="font-weight-bold">To</h3>
             <h3 class="font-weight-bold">Auth Page</h3>
         </div>
         @endguest
         <div class="col-lg-4 part-3">
             <h5 class="font-weight-bold mt-4">Made With <i style="color: rgb(245, 13, 82);" class="fas fa-heart"></i> By Zuans</h1>
                 <h5>2020</h5>
                 <br>
                 <h5>Illustrations By <a href="https://www.freepik.com/" target="_blank">freepik</a></h5>
         </div>
     </div>
 </section>