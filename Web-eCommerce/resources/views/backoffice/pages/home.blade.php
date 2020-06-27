@extends('backoffice.layouts.layout_dash')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><img src="{{ asset('/images/logo.png') }}" class="logo_sm mr-2"/> BackOffice Dashboard<small> - MusicStore | <i class="ion ion-settings ml-2 mr-2"></i>Administration Tools</small></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Home</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->




    <span class="d-none" id="not_fadeout"></span>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        
        <h3 class="mt-3 mb-2"> <i class="ion ion-folder mr-3"></i><small>Management Section</small></h3>
        <hr/>

        <div class="row">


            @hasanyrole('Administrator')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h3 class="title_sec">Admin Tools</h3>

                    <p>Administrations Tools</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ios-locked"></i>
                  </div>
                  <a href="{{ route('users.index') }}" class="small-box-footer">Manage Accounts <i class="fas fa-arrow-circle-right"></i></a>
                  <a href="{{ route('dashboard.properties') }}" class="small-box-footer">Manage Properties <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endhasanyrole
          <!-- ./col -->
            @hasanyrole('Shipment Representative|Administrator')
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3 class="title_sec">Shipments</h3>

                  <p>Shipments Management</p>
                </div>
                <div class="icon">
                  <i class="ion ion-paper-airplane"></i>
                </div>
                <a href="{{ route('shipments.index') }}" class="small-box-footer">Manage Shipments <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            @endhasanyrole
          <!-- ./col -->
            @hasanyrole('Inventory Representative|Administrator')
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3 class="title_sec">Inventory</h3>

                  <p>Inventory Management</p>
                </div>
                <div class="icon">
                  <i class="ion ion-folder"></i>
                </div>
                <a href="{{ route('dashboard.catalog') }}" class="small-box-footer">Manage Catalog <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          
          @endhasanyrole

          @hasanyrole('Designer|Administrator')
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3 class="title_sec">Design</h3>

                  <p>Website design</p>
                </div>
                <div class="icon">
                  <i class="ion ion-images"></i>
                </div>
                <a href="{{ route('components.index') }}" class="small-box-footer">Manage Website Layout <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
          
          @endhasanyrole
        </div>
        <!-- /.row -->

        <h3 class="mt-3 mb-2"><i class="ion ion-stats-bars mr-3"></i><small>Last Week</small></h3>
        <hr/>
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="new_orders"></h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('orders.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3 id="num_products"></h3>

                <p>New Products</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-keypad"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="users_reg"></h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="in_transit"></h3>

                <p>Order in Transit</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-paperplane"></i>
              </div>
              <a href="{{ route('orders.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->




        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">







            <!-- SALES GRAPH-->


            <!-- solid sales graph -->
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-shopping-cart mr-1"></i>
                  Orders Graph
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-default btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="orders-chart" class="orders_chart"></canvas>
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->


          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

            <!-- SALES GRAPH-->


            <!-- solid sales graph -->
            <div class="card reviews-card">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-edit mr-1"></i>
                  Reviews Graph
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-default btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas class="reviews_chart" id="review-chart"></canvas>
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->






















          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script src="{{ asset('dist/js/pages/home.js') }}"></script>

  @endsection('content')