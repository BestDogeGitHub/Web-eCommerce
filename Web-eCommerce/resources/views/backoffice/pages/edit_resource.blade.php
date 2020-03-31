

@extends('backoffice.layouts.layout_dash')

@section('content')


    



        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage <b>Website Components</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('components.index') }}">Manage Components</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>






        <div class="card">
              <div class="card-body">


                <div class="container">
                    <div class="table-wrapper table-responsive">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-12">			
                                </div>
                            </div>
                        </div>


                        

                            <form id="editResource" method="post" class="form-horizontal" action="{{ route('components.update', $resource->id) }}" enctype="multipart/form-data">
                                

                                <textarea id="html_editor_textarea" name="details">{{ $resource->image_details }}</textarea>

                                @error('details')
                                    <span class="invalid-feedback du" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="form-group">
                                    <label>Actual Image</label><br/>
                                    <img class="img-responsive crud" src="{{ asset($resource->image_ref) }}" id="actualImage">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="editImage" name="image">
                                        <label class="custom-file-label" for="editImage">Change Image</label>
                                    </div>
                                    @error('image')
                                        <span class="invalid-feedback du" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                @csrf
                                <input type="submit" class="btn btn-warning" value="Edit" id="save_res">
                            </form>
                        
                    </div>
                </div>
            </div>  
        </div>



<script src="{{ asset('dist/js/pages/website.js') }}"></script>
@endsection('content')