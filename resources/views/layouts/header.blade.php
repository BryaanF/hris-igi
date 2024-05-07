 <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
     <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{ route('dashboard') }}">HRIS IGI</a>
     <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse"
         data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
     </button>

     <div class="navbar-nav">
         <div class="nav-item text-nowrap d-flex ">
             <div class="dropdown text-end d-flex align-items-center me-3">
                 <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="dropdownUser1"
                     data-bs-toggle="dropdown" aria-expanded="false">
                     <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32"
                         class="rounded-circle">
                 </a>
                 <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                     <li><a class="dropdown-item" href="#">Info</a></li>

                     <li>
                         <hr class="dropdown-divider">
                     </li>
                     <li>
                         <form action="{{ route('logout') }}" method="post">
                             @csrf
                             <button class="nav-link px-3 dropdown-item text-dark" type="submit">Sign Out</button>
                         </form>
                     </li>
                 </ul>
             </div>

         </div>
     </div>
 </header>
