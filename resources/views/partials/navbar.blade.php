<nav style="background-color:hsl(0, 83%, 7%); padding:35px;">

    @guest
        <span style="float:right;">
            <a href="{{ route('login') }}" style="color:white; margin-right:15px;">
                Login
            </a>

            <a href="{{ route('register') }}" style="color:white;">
                Register
            </a>
        </span>
    @endguest

    @auth
        <span style="float:right;">
         <div class="dropdown dropdown-end">
      <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
            @if(Auth::user()->student)
          <img
            alt="Tailwind CSS Navbar component"
            src="{{ asset('storage/' . Auth::user()->student->profile_picture ?? '') }}" />
            @endif
        </div>
      </div>
      <ul
        tabindex="-1"
        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
        <li>
          <a class="justify-between">
            {{ auth()->user()->name }}
            <span class="badge">New</span>
          </a>
        </li>
        <li><a href="{{ route('profile.upload.page') }}">Upload profile</a></li>
        <li>
            
            <form action="{{ route('logout') }}"
                  method="POST"
                  style="display:inline;">
                @csrf
        
                <button type="submit">
                    Logout
                </button>
            </form>
        </li>
      </ul>
    </div>
            <span style="color:white; margin-right:15px;">
                
            </span>

        </span>
    @endauth

</nav>