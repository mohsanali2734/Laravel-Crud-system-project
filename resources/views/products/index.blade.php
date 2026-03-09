<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crud System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

    
    <div class="bg-dark text-center text-white py-2">
        <h2>Crud System</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-end p-0 mt-2">
                <a href="products\create"class="btn btn-dark">Create</a>
            </div>
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
             @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
            <div class="card p-0 mt-2">
                <div class="card-header bg-dark text-white">
                    <h4>Product</h4>
                </div>
                <div class="card-body shadow-lg"></div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th width="100">Status</th>
                            <th width="120" class="text-center ">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($products->isNotempty())
                        @foreach ($products as $product )
                             <tr>
                            <td>{{$product->id}}</td>
                            <td>
                                @if (!empty($product->image))
                                 <img class="rounded" src="{{asset('uploads/products/'.$product->image)}}" width="50" height="50">
                                  
                                 @else
                                      <img class="rounded" src="https://placehold.co/600x700" width="50" height="50" >  
                        
                                @endif
                            </td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->sku}}</td>
                            <td>${{$product->price}}</td>
                            <td >
                            @if ($product->status == 'Active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                            @endif
                            </td>
                            <td class="text-center ">
                                <a href="{{route('products.edit',$product->id)}}"class="btn btn-dark btn-sm">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}"
                                method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                               
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">No products found</td>
                        </tr>    
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>