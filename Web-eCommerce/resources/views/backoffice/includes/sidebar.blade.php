<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <span class="brand-text font-weight-light">BackOffice | MusicStore.net</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('images/backoffice/user_circle-l.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->username }}</a>
          
        </div>
        
      </div>
      <div class="card text-center">
                <div class="card-footer text-muted">
                    @foreach(Auth::user()->roles as $role)
                      {{ $role->name }} <br/>
                    @endforeach
                </div>
        </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item"></li>
          
          @hasanyrole('Administrator')

            <li class="nav-header text-uppercase"><i class="nav-icon fa fa-wrench card-icon"></i>Administration Tools</li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <p>
                  Accounts
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('users.index')}}" class="nav-link">
                    <i class="fa fa-users nav-icon"></i>
                    <p>Users</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <p>
                  Properties
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('addresses.index')}}" class="nav-link">
                    <i class="fa fa-map-pin nav-icon"></i>
                    <p>Addresses</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('attributes.index')}}" class="nav-link">
                    <i class="fa fa-list-alt nav-icon"></i>
                    <p>Attributes</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('values.index')}}" class="nav-link">
                    <i class="far fa-plus-square nav-icon"></i>
                    <p>Attribute values</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('carriers.index')}}" class="nav-link">
                    <i class="fa fa-truck nav-icon"></i>
                    <p>Carriers</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('creditCards.index')}}" class="nav-link">
                    <i class="fa fa-credit-card nav-icon"></i>
                    <p>Credit Cards</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('deliveryStatuses.index')}}" class="nav-link">
                    <i class="fa fa-archive nav-icon"></i>
                    <p>Delivery Statuses</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('paymentMethods.index')}}" class="nav-link">
                    <i class="fa fa-tag nav-icon"></i>
                    <p>Payment Methods</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('ivaCategories.index')}}" class="nav-link">
                    <i class="fa fa-th nav-icon"></i>
                    <p>Iva Categories</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('nations.index')}}" class="nav-link">
                    <i class="ion ion-android-globe nav-icon"></i>
                    <p>Nations</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('producers.index')}}" class="nav-link">
                    <i class="fa fa-registered nav-icon"></i>
                    <p>Producers</p>
                  </a>
                </li>
              </ul>
            </li>
          @endhasanyrole

          @hasanyrole('Inventory Representative|Administrator')
            <li class="nav-header text-uppercase"><i class="nav-icon fa fa-archive card-icon"></i>Inventory Management</li>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <p>
                  Catalog
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                @can('manageProducts')
                <li class="nav-item">
                  <a href="{{route('products.index')}}" class="nav-link">
                    <i class="fa fa-barcode nav-icon"></i>
                    <p>Products</p>
                  </a>
                </li>
                @endcan

                @can('manageProductTypes')
                <li class="nav-item">
                  <a href="{{route('productTypes.index')}}" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    <p>Proudct Types</p>
                  </a>
                </li>
                @endcan

                @can('manageProductImages')
                <li class="nav-item">
                  <a href="{{route('productImages.index')}}" class="nav-link">
                    <i class="ion ion-images nav-icon"></i>
                    <p>Product Images</p>
                  </a>
                </li>
                @endcan

                @can('manageCategories')
                <li class="nav-item">
                  <a href="{{route('categories.index')}}" class="nav-link">
                    <i class="fa fa-th nav-icon"></i>
                    <p>Categories</p>
                  </a>
                </li>
                @endcan
                
              </ul>
            </li>
          @endhasanyrole
          
          @hasanyrole('Shipment Representative|Administrator')
          <li class="nav-header text-uppercase"><i class="nav-icon fa fa-paper-plane card-icon"></i>Shipments Management</li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <p>
                  Orders
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('orders.index')}}" class="nav-link">
                    <i class="fa fa-cart-plus nav-icon"></i>
                    <p>Orders</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('shipments.index')}}" class="nav-link">
                    <i class="fa fa-paper-plane nav-icon"></i>
                    <p>Shipments</p>
                  </a>
                </li>
              </ul>
            </li>
          @endhasanyrole

          @hasanyrole('Designer|Administrator')
          <li class="nav-header text-uppercase"><i class="nav-icon far fa-image card-icon"></i>Design Management</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <p>
                Layout Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('components.index')}}" class="nav-link">
                  <i class="far fa-edit nav-icon"></i>
                  <p>Components</p>
                </a>
              </li>
            </ul>
          </li>
          @endhasanyrole
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->