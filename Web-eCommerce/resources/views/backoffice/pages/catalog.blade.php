@extends('backoffice.layouts.layout_dash')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="ion ion-settings ml-2 mr-2"></i>Administration Tools - Manage Catalog</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Catalog</li>
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
              <div class="small-box bg-success">
                <div class="inner">
                  <h3 class="title_sec">Products</h3>

                  <p>Manage Products</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-keypad"></i>
                </div>
                <a href="{{ route('products.index') }}" class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3 class="title_sec">Product Types</h3>

                  <p>Manage Product Types</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-keypad"></i>
                </div>
                <a href="{{ route('productTypes.index') }}" class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3 class="title_sec">Product Images</h3>

                  <p>Manage Product Images</p>
                </div>
                <div class="icon">
                  <i class="ion ion-images"></i>
                </div>
                <a href="{{ route('productImages.index') }}" class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3 class="title_sec">Categories</h3>

                  <p>Manage Categories</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-keypad"></i>
                </div>
                <a href="{{ route('categories.index') }}" class="small-box-footer">Go to <i class="fas fa-arrow-circle-right"></i></a>
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