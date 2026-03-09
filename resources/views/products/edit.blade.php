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

    <div class="container mb-5">
        <div class="row">
            <div class="d-flex justify-content-end p-0 mt-2">
                <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
            </div>

            <div class="card p-0 mt-2">
                <div class="card-header bg-dark text-white">
                    <h4>Edit Product</h4>
                </div>
                <div class="card-body">
              <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')   {{-- ← WITHOUT THIS LINE PUT WILL NEVER WORK --}} 
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ old('name', $product->name) }}" type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name">
                    @error('name')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                    @if (!empty($product->image))
                        <img class="rounded mt-3" src="{{ asset('uploads/products/'.$product->image) }}" width="150">
                    @endif
                </div>

                <div class="mb-3">
                    <label for="sku" class="form-label">SKU</label>
                    <input value="{{ old('sku', $product->sku) }}" type="text" class="form-control @error('sku') is-invalid @enderror" id="sku" name="sku" placeholder="SKU">
                    @error('sku')
                        <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input value="{{old('price',$product->price)}}" type="text" class="form-control @error('price') is-invalid @enderror"id="price" name="price" placeholder="price">
                      @error('sku') 
                    <p class="invalid-feedback">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="Active" @selected($product->status == 'Active')>Active</option>
                        <option value="Inactive" @selected($product->status == 'Inactive')>Inactive</option>
                    </select>
                </div>

                <button class="btn btn-dark">Update</button>
                </form>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>