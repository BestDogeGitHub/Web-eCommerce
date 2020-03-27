

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
                    <li class="breadcrumb-item active">Manage Website</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>






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

                    @csrf
					<input type="submit" class="btn btn-warning" value="Edit" id="save_res">
				</form>
            
        </div>
    </div>



<script src="{{ asset('dist/js/pages/website.js') }}"></script>
@endsection('content')