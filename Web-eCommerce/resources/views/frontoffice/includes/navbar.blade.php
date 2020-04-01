
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="{{ asset('/') }}">Music Store</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
          <!-- SEARCH FORM -->
          <form class="form-inline ml-3" action=" {{ route('search_product_types') }} " method="POST">
            @csrf
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar search_input" name="search" type="search" placeholder="Search products" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </form>
	        <ul class="navbar-nav ml-auto">
            <!-- <li class="nav-item active"><a href="/" class="nav-link">Home</a></li> -->
            <li class="nav-item">
              
            </li>
	          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
                
                <a class="dropdown-item" href="{{ route('shop') }}">Shop</a>
                
                <a class="dropdown-item" href="{{ route('categories_par', 1) }}">Cataglog</a>
                
                @auth
                <a class="dropdown-item" href="{{ route('wishlist.index') }}">Wishlist <span class="badge badge-info right bg-primary" id="nav_wish_link">{{ Auth::user()->productInWishlist->count() }}</span></a> 
                @else
                <a class="dropdown-item" href="{{ route('wishlist.index') }}">Wishlist <span class="badge badge-info right bg-primary" id="nav_wish_link">
                  @if(Session::has('wishlist'))
                    {{ count(Session::get('wishlist')) }}
                  @else
                    0
                  @endif
                </span></a>
                @endauth

                <a class="dropdown-item" href="{{ route('cart') }}">Cart</a> 
                
                @can('checkout')
                <a class="dropdown-item" href="{{ route('checkout') }}">Checkout</a>
                @endcan
              	
              </div>
            </li>
            
            <li class="nav-item"><a class="nav-link" href="{{ route('orders') }}">Orders</a></li>
	          <!-- <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li> -->
	          <!-- <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li> -->
            <!-- Authentication Links -->
                          @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    
                                </div>
                            </li>
                            
                            
                        @endguest
                        <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
            @auth
	          <li class="nav-item cta cta-colored"><a href="{{ route('cart') }}" class="nav-link"><span class="icon-shopping_cart"></span>[<span id="nav_cart_link">{{ Auth::user()->productsInCart->count()}}</span>]</a></li>
                @hasanyrole('Administrator|Shipment Representative|Inventory Representative')
                  <li class="nav-item cta cta-colored cta_backoffice">
                      <a class="nav-link" href="{{ route('dashboard') }}" target="_blank"><span class="fa fa-wrench mr-2"></span>BackOffice</a>
                  </li>
                @else
                @endhasanyrole
            @endauth
            
	        </ul>

	      </div>
	    </div>
	  </nav>
	<!-- END nav -->