

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
                            <hr/>
                        </div>

                            <form id="editResource" method="post" class="form-horizontal" action="{{ route('components.update', $resource->id) }}" enctype="multipart/form-data">
                                
                                @if(in_array($resource->site_image_role_id, [11, 12, 13, 14, 15, 16, 17, 18, 19, 20]))
                                    <textarea id="editor_textarea" name="details" class="form-control">{{ $resource->image_details }}</textarea>
                                @else
                                    <textarea id="html_editor_textarea" name="details">{{ $resource->image_details }}</textarea>
                                @endif
                                <!-- <textarea id="html_editor_textarea" name="details">{{ $resource->image_details }}</textarea> -->


                                <div class="form-group">
                                    <label for="editLink">Edit Link</label>
                                    <input type="text" name="link" class="form-control" id="editLink" aria-describedby="linkHelp" placeholder="Enter link" value="{{ $resource->link ?? '' }}">
                                    <small id="linkHelp" class="form-text text-muted">Edit link of resource</small>
                                </div>

                                <div class="form-group">
                                    <label>Actual Image</label><br/>
                                    @if(empty($resource->image_ref)) <p class="mb-2 text-danger">No Image</p> @else <img class="img-responsive crud" src="{{ asset($resource->image_ref) }}" id="actualImage"> @endif
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="editImage" name="image">
                                        <label class="custom-file-label" for="editImage">Change Image</label>
                                    </div>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @csrf
                                <input type="submit" class="btn btn-warning" value="Edit" id="save_res">
                            </form>
                        
                    </div>
                </div>
            </div>  
        </div>


<script src="{{ asset('dist/js/pages/website.js') }}"></script>
@endsection('content')