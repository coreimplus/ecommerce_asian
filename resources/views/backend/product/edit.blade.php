@extends('backend.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <h1>Edit {{ $product->name }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-8">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Products</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">


                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Fill the form below to edit {{ $product->name }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}"
                                       placeholder="Enter name of the proudct">
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control" name="price" value="{{ $product->price }}"
                                       placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Short Description</label>
                                <textarea class="form-control" name="short_description" id="" cols="30"
                                          rows="10">{{ $product->short_description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" id="" cols="30"
                                          rows="10">{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Information</label>
                                <textarea class="form-control" name="information" id="" cols="30"
                                          rows="10">{{ $product->information }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Available Sizes</label>
                                <input type="text" class="form-control" name="sizes" value="{{ $product->sizes }}"
                                       placeholder="Enter sizes key seperated by comma (S,M,L,XL)">
                            </div>
                            <div class="form-group">
                                <label>Available Colors</label>
                                <input type="text" class="form-control" name="colors" value="{{ $product->colors }}"
                                       placeholder="Enter color key seperated by comma (Black,White,Red,Blue)">
                            </div>
                            <div class="form-group">
                                <label>Available Quantity</label>
                                <input type="number" class="form-control" name="available_quantity"
                                       value="{{ $product->available_quantity }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Primary Image (500x500)</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="image_one" type="file" class="custom-file-input"
                                               id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>

                            @if($product->image_one)
                                <div class="edit-product-image">
                                    <img src="{{ $product->image_one }}" alt="" width="500px" height="500px">
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="exampleInputFile">Image Two (500x500)</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="image_two" type="file" class="custom-file-input"
                                               id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>

                            @if($product->image_two)
                                <div class="edit-product-image">
                                    <img src="{{ $product->image_two }}" alt="" width="500px" height="500px">
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="exampleInputFile">Image Three (500x500)</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="image_three" type="file" class="custom-file-input"
                                               id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>

                            @if($product->image_three)
                                <div class="edit-product-image">
                                    <img src="{{ $product->image_three }}" alt="" width="500px" height="500px">
                                </div>
                            @endif

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update {{ $product->name }}</button>
                        </div>
                    </form>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
