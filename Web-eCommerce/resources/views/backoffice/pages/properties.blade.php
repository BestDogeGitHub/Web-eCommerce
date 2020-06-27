@extends('backoffice.layouts.layout_dash')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="ion ion-settings ml-2 mr-2"></i>Administration Tools - Manage Properties</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Properties</li>
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
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3 class="title_sec">Addresses</h3>

                  <p>Manage Addresses</p>
                </div>
                <div class="icon">
                  <i class="ion ion-folder"></i>
                </div>
                <a href="{{ route('addresses.index') }}" class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3 class="title_sec">Attributes</h3>

                  <p>Manage Attributes</p>
                </div>
                <div class="icon">
                  <i class="ion ion-folder"></i>
                </div>
                <a href="{{ route('attributes.index') }}" class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3 class="title_sec">Attribute Values</h3>

                  <p>Manage Attributes values</p>
                </div>
                <div class="icon">
                  <i class="ion ion-folder"></i>
                </div>
                <a href="{{ route('values.index') }}" class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3 class="title_sec">Carriers</h3>

                  <p>Manage Carriers</p>
                </div>
                <div class="icon">
                  <i class="ion ion-folder"></i>
                </div>
                <a href="{{ route('carriers.index') }}" class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3 class="title_sec">Credit Cards</h3>

                  <p>Manage Credit Cards</p>
                </div>
                <div class="icon">
                  <i class="ion ion-folder"></i>
                </div>
                <a href="{{ route('creditCards.index') }}" class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3 class="title_sec">Delivery Statuses</h3>

                  <p>Manage Delivery Statuses</p>
                </div>
                <div class="icon">
                  <i class="ion ion-folder"></i>
                </div>
                <a href="{{ route('carriers.index') }}" class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3 class="title_sec">Payment Methods</h3>

                  <p>Manage Payment Methods</p>
                </div>
                <div class="icon">
                  <i class="ion ion-folder"></i>
                </div>
                <a href="{{ route('paymentMethods.index') }}" class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3 class="title_sec">Iva Categories</h3>

                  <p>Manage Iva Categories</p>
                </div>
                <div class="icon">
                  <i class="ion ion-folder"></i>
                </div>
                <a href="{{ route('ivaCategories.index') }}" class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3 class="title_sec">Nations</h3>

                  <p>Manage Nations</p>
                </div>
                <div class="icon">
                  <i class="ion ion-folder"></i>
                </div>
                <a href="{{ route('nations.index') }}" class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3 class="title_sec">Producers</h3>

                  <p>Manage Producers</p>
                </div>
                <div class="icon">
                  <i class="ion ion-folder"></i>
                </div>
                <a href="{{ route('producers.index') }}" class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            @endhasanyrole
        




          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script src="{{ asset('dist/js/pages/home.js') }}"></script>
  @endsection('content')