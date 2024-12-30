<style>
  /* General styles for the sidebar */
  .app-sidebar {
      /* Your existing styles */
  }

  /* Styles for the bottom navigation */
  .bottom-nav {
      display: none; /* Hide by default */
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background-color: black; /* Change background color to blue */
      box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      
  }

  .bottom-menu {
      display: flex;
      justify-content: space-around;
      padding: 10px 0;
  }

  .bottom-menu li {
      list-style: none;
  }

  .bottom-menu a {
      text-align: center;
      color: #fff; /* Change icon color to white */
      text-decoration: none;
  }

  /* Highlight active link */
  .bottom-menu a.active {
    background-color: blue; /* Highlight active button in blue */
    border-radius: 1px; /* Add some border radius */
    padding: 10px 15px; /* Increase padding for larger clickable area */
}

  /* Media query for mobile devices */
  @media (max-width: 768px) {
      .app-sidebar {
          display: none; /* Hide sidebar on mobile */
      }

      .bottom-nav {
          display: block; /* Show bottom navigation on mobile */
          margin-top: 20px;
      }

      .bottom-menu a {
          font-size: 16px; /* Adjust font size for mobile */
      }

      .bottom-menu i {
          font-size: 24px; /* Adjust icon size for mobile */
      }
  }

  /* Optional: Add hover effects for desktop */
  @media (min-width: 769px) {
      .bottom-menu a:hover {
          color: #007bff; /* Change color on hover */
      }
  }
</style>




<div class="app-sidebar app-sidebar2">
    <div class="app-sidebar__logo">
        <a class="header-brand" href="{{ route('home') }}">
            <h4 class="header-brand-img desktop-lgo">Next Event Ghana</h4>
            <img src="{{ asset('theme/assets/images/brand/favicon.png') }}" class="header-brand-img mobile-logo" alt="Dashtic logo">
        </a>
    </div>
</div>

<aside class="app-sidebar app-sidebar3">
    <div class="app-sidebar__user">
        <div class="dropdown user-pro-body text-center">
        <div class="user-pic">
    <img class="rounded-circle img-fluid" 
         src="{{ Auth::check() ? url('storage/app/profile_pictures/' . Auth::user()->profile_picture) : url('storage/app/profile_pictures/default-profile.png') }}" 
         alt="Profile Picture" 
         style="width: 70px; height: 70px;">
</div>
@if(Auth::check())
    <div class="user-info">
        <h5 class="mb-1 font-weight-bold">{{ Auth::user()->username }}</h5>
    </div>
@endif
        </div>
    </div>
    <ul class="side-menu">
        <li class="slide">
            <a class="side-menu__item" href="{{ route('home') }}">
                <i class="fa fa-home fs-25 mr-2"></i>
                <span class="side-menu__label">Home</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{ url('create_event') }}">
                <span class="mdi mdi-calendar-plus fs-25 mr-2"></span>
                <span class="side-menu__label">Add Event</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{ url('upcoming_events') }}">
                <span class="mdi mdi-format-list-checks fs-25 mr-2"></span>
                <span class="side-menu__label">Events</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{ url('posts') }}">
                <span class="mdi mdi-clipboard-plus fs-25 mr-2"></span>
                <span class="side-menu__label">My Posts</span>
            </a>
        </li>
        @if(Auth::check() && Auth::user()->role_id == 1)
    <li class="slide">
        <a class="side-menu__item" href="{{ url('admin') }}">
            <i class="mdi mdi-account-key fs-25 ml-2"></i>
            <span class="side-menu__label">Admin</span>
            <i class="mdi mdi-chevron-down fs-25 ml-2"></i> <!-- Dropdown indicator -->  
        </a>
    </li>
@endif
        <li class="slide">
            <a class="side-menu__item" href="{{ url('profile') }}">
                <span class="mdi mdi-account-circle fs-25 mr-2"></span>
                <span class="side-menu__label">Profile</span>
            </a>
        </li>
    </ul>
</aside>

<style>
    /* Custom styles for the sidebar with scrollbar */
    .app-sidebar3 {
        max-height: 100vh; /* Set the maximum height of the sidebar */
        overflow-y: auto; /* Enable vertical scrolling */
    }

    /* Optional: Customize scrollbar appearance (for WebKit browsers) */
    .app-sidebar3::-webkit-scrollbar {
        width: 8px; /* Width of the scrollbar */
    }

    .app-sidebar3::-webkit-scrollbar-thumb {
        background-color: #ccc; /* Color of the scrollbar thumb */
        border-radius: 4px; /* Rounded corners for the scrollbar thumb */
    }

    .app-sidebar3::-webkit-scrollbar-track {
        background: transparent; /* Background of the scrollbar track */
    }

    /* Custom styles for dropdown menu */
    .dropdown-menu {
        background-color: white; /* Set background color to white */
        border: 1px solid #ccc; /* Optional: Add a light border for better visibility */
    }

    /* Optional: Change text color for better visibility */
    .dropdown-menu .side-menu__item {
        color: #000; /* Change text color to black or any color you prefer */
    }

    /* Optional: Change hover effect */
    .dropdown-menu .side-menu__item:hover {
        background-color: rgba(0, 0, 0, 0.1); /* Light gray background on hover */
    }
</style>

<!-- Bottom Navigation for Mobile -->
<div class="bottom-nav">
    <ul class="bottom-menu list-unstyled d-flex justify-content-around">
        <li class="text-center">
            <a href="{{ url('create_event') }}" class="{{ request()->is('create_event') ? 'active' : '' }}">
                <i class="mdi mdi-calendar-plus icon-large"></i>
                <div class="button-name">Add</div>
            </a>
        </li>
        <li class="text-center">
            <a href="{{ url('upcoming_events') }}" class="{{ request()->is('upcoming_events') ? 'active' : '' }}">
                <i class="mdi mdi-format-list-checks icon-large"></i>
                <div class="button-name">Upcoming</div>
            </a>
        </li>
        <li class="text-center">
            <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                <i class="fa fa-home icon-large"></i>
                <div class="button-name"></div>
            </a>
        </li>
        @if(Auth::check() && Auth::user()->role_id == 1)
        <li class="text-center">
            <a href="{{ route('admin') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                <i class="mdi mdi-account-key icon-large"></i>
                <div class="button-name">Admin</div>
            </a>
        </li>
        @endif
        <li class="text-center">
            <a href="{{ url('posts') }}" class="{{ request()->is('posts') ? 'active' : '' }}">
                <i class="mdi mdi-clipboard-plus icon-large"></i>
                <div class="button-name">Posts</div>
            </a>
        </li>
        <li class="text-center">
            <a href="{{ url('profile') }}" class="{{ request()->is('profile') ? 'active' : '' }}">
                <i class="mdi mdi-account-circle icon-large"></i>
                <div class="button-name">Profile</div>
            </a>
        </li>
    </ul>
   <style>
    .bottom-nav {
    background-color:rgb(0, 0, 0); /* Light background color */
    padding: -3px 0; /* Padding for the nav */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    height: 10vh;
}

.bottom-menu a {
    color: #6c757d; /* Default text color */
    text-decoration: none; /* Remove underline */
    display: flex; /* Use flexbox for alignment */
    flex-direction: column; /* Stack icon and text */
    align-items: center; /* Center items */
    padding: 1px; /* Padding around the button */
    border-radius: 10px; /* Rounded corners */
    transition: background-color 0.3s; /* Smooth background transition */
}

.bottom-menu a:hover {
    background-color: #e9ecef; /* Change background on hover */
    width: 8vw;
}

.bottom-menu a.active {
    background-color: #007bff; /* Active background color */
    color: white; /* Active text color */
   
}

.button-name {
    font-size: 10px; /* Reduced font size for button names */
    margin-top:-8px; /* Space between icon and text */
}

.icon-large {
    font-size: 5px; /* Increase icon size */
}
</style>
</div>