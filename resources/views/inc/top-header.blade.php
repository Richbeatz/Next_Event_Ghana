



<div class="app-header header top-header">
    <div class="container-fluid">
        <div class="d-flex">
            <a class="header-brand" href="{{ route('home') }}">
               
                <img src="{{asset('theme/assets/images/brand/favicon.png')}}" class="header-brand-img mobile-logo" alt="logo">
          
            </a>
            <div class="dropdown side-nav">
                <div class="app-sidebar__toggle" data-toggle="sidebar">
                    <a class="open-toggle" href="#">
                        <svg class="header-icon mt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                    </a>
                    <a class="close-toggle" href="#">
                        <svg class="header-icon mt-1" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>
                    </a>
                </div>
            </div>
            

            <div class="d-flex order-lg-2 ml-auto">
                <a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch">
                    <svg class="header-icon search-icon" x="1008" y="1248" viewBox="0 0 24 24"  height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                        <path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                    </svg>
                </a>
                <div class="mt-1">
                    <form class="form-inline">
                        <div class="search-element">
                            <input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" tabindex="1">
                            <button class="btn btn-primary-color" type="submit">
                                <svg class="header-icon search-icon" x="1008" y="1248" viewBox="0 0 24 24"  height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                                    <path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div><!-- SEARCH -->

                <div class="dropdown header-fullscreen pl-5">
    <a class="nav-link icon full-screen-link p-0" id="fullscreen-button">
        <svg class="header-icon" x="1008" y="1248" viewBox="0 0 24 24" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
            <path d="M7,14 L5,14 L5,19 L10,19 L10,17 L7,17 L7,14 Z M5,10 L7,10 L7,7 L10,7 L10,5 L5,5 L5,10 Z M17,17 L14,17 L14,19 L19,19 L19,14 L17,14 L17,17 Z M14,5 L14,7 L17,7 L17,10 L19,10 L19,5 L14,5 Z"></path>
        </svg>
    </a>
</div>

<div class="dropdown profile-dropdown">
    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
        <span>
            <img class="rounded-circle img-fluid" 
                 src="{{ Auth::check() ? url('storage/app/profile_pictures/' . Auth::user()->profile_picture) : url('storage/app/profile_pictures/default-profile.png') }}" 
                 alt="Profile Picture" 
                 style="width: 50px; height: 50px;">
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-right animated">
        <div class="text-center">
            @if(Auth::check())
                <a href="#" class="dropdown-item text-center user pb-0 font-weight-bold">
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                </a>
                <span class="text-center user-semi-title">{{ Auth::user()->email }}</span>
            @endif
            <div class="dropdown-divider"></div>
        </div>

       <!-- Logout Form -->
<form id="logout-form" action="{{ route('logout-link') }}" method="POST" style="display: none;">
    @csrf
</form>

<!-- Logout Link -->
<a class="dropdown-item d-flex" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <svg class="header-icon mr-3" x="1008" y="1248" viewBox="0 0 24 24" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
        <path d="M0 0h24v24H0V0zm0 0h24v24H0V0z" fill="none"/>
        <path d="M6 20h12V10H6v10zm2-6h3v-3h2v3h3v2h-3v3h-2v-3H8v-2z" opacity=".3"/>
        <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM8.9 6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2H8.9V6zM18 20H6V10h12v10zm-7-1h2v-3h3v-2h-3v-3h-2v3H8v2h3z"/>
    </svg>
    <div class="mt-1">Sign Out</div>
</a>
    </div>
</div>
            </div>
        </div>
    </div>
</div>
@push('page_js')
<script type="text/javascript">

</script>
@endpush

