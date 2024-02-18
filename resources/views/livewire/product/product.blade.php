<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

new

#[Title('Product Dashboard')]

class extends Component {

  use WithPagination;
  use WithFileUploads;

  public $id;
  public $brands;
  public $brandId = null;
  public $categories = [];
  public $categoryId;
  public $name;
  public $unit;
  public $buy_price;
  public $sale_price;
  public $discount;
  public $qty;
  public $oldImage;
  public $image;
  public $video;
  public $oldVideo;
  public $descript;

  public function showData ($id)
  {
    $product = Product::findOrFail($id);

    $this->id = $product->id;
    $this->name = $product->name;
    $this->unit = $product->unit;
    $this->buy_price = $product->buy_price;
    $this->sale_price = $product->sale_price;
    $this->discount = $product->discount;
    $this->qty = $product->qty;
    $this->descript = $product->descript;
    $this->brands = Brand::all();
  }

  public function updatedBrandId($val)
  {
    $this->categories = Category::where('brand_id', $val)->get();
  }

  public function updateData () {

    $this->validate([
      'brandId' => 'required',
      'categoryId' => 'required',
    ]);

    Product::where('id', $this->id)->update([
      'brand_id' => $this->brandId,
      'category_id' => $this->categoryId,
      'name' => Str::title($this->name),
      'slug' => Str::slug($this->name, '-'),
      'code' => rand(1, 99999),
      'unit' => $this->unit,
      'buy_price' => $this->buy_price,
      'sale_price' => $this->sale_price,
      'discount' => $this->discount,
      'qty' => $this->qty,
      'descript' => $this->descript,
    ]);

    session()->flash('success', 'Updated successfully');

  }

  public function showFile ($id)
  {
    $this->reset();

    $product = Product::find($id);
    $this->id = $product->id;
    $this->oldImage = $product->image;
    $this->oldVideo = $product->video;
  }

  public function updateFile () {

    $this->validate([
      'image' => 'nullable|max:500|mimes:jpg,png',
      'video' => 'nullable|mimes:mp4',
    ]);

    if ($this->image) {
      unlink('storage/app/'.$this->oldImage);
      $photo = $this->image->store('public/product');
    }else{
      $photo = $this->oldImage;
    }

    if ($this->video) {
      unlink('storage/app/'.$this->oldVideo);
      $videoFile = $this->video->store('public/product');
    }else{
      $videoFile = $this->oldVideo;
    }

    Product::where('id', $this->id)->update([
      'image' => $photo,
      'video' => $videoFile,
    ]);

    $this->reset();

    session()->flash('success', 'Updated successfully');

  }

  public function delete (Product $product) {
    unlink('storage/app/'.$product->image);
    unlink('storage/app/'.$product->video);
    Product::destroy($product->id);
  }

  public function with(): array
  {
    return [
      'products' => Product::latest()->paginate(1),
    ];
  }

}

?>

<div class="container">
  <div class="row">
    <div class="col-md">
      <h4 class="float-start">Show Product</h4>
      <a href="{{ url('product-create') }}" class="btn btn-success mb-2 float-end" wire:navigate>Add Product <i class="fas fa-plus"></i></a>
    </div>
  </div>
  <div class="row">
    <div class="col-md">
      <div class="card border-0 p-3 mb-5 shadow-sm">
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Index</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Code</th>
                <th scope="col">Buy Price</th>
                <th scope="col">Sale Price</th>
                <th scope="col">Image / Video</th>
                <th scope="col" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($products as $product)
                <tr>
                  <th scope="row">{{ $product->id }}</th>
                  <td>{{ $product->name }}</td>
                  <td>{{ $product->code }}</td>
                  <td>{{ $product->buy_price }}</td>
                  <td>{{ $product->sale_price }}</td>
                  <td class="text-center">
                    <!-- Button trigger modal -->
                    <button type="button" wire:click='showFile({{ $product->id }})' data-bs-toggle="modal" data-bs-target="#updateFileModal" class="btn btn-link float-start">
                      <i class="fas fa-image" style="font-size: 30px;"></i> <i class="fas fa-video" style="font-size: 30px;"></i> <br> Show Or Update
                    </button>
                  </td>
                  <td class="text-center">
                    <!-- Button trigger modal -->
                    <button type="button" wire:click='showData({{ $product->id }})' data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-link float-start">
                      <i class="fas fa-pen-square" style="font-size: 30px;"></i>
                    </button>
                    <button type="button" wire:click="delete({{ $product }})"
                        wire:confirm="Are you sure you want to delete this post?"
                        class="btn btn-link btn-inline">
                        <i class="fas fa-trash" style="font-size: 30px;"></i>
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          {{ $products->links() }}
        </div>
      </div>
    </div>
  </div>
  <!-- update modal -->
  <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form wire:submit="updateData">
        <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Update Product</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="brand" class="form-label">Select Brand</label>
              <select wire:model.live="brandId" class="form-select" aria-label="Default select example" id="brand">
                <option selected>Select One</option>
                @if(is_iterable($brands))
                  @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                  @endforeach
                @endif
              </select>
              @error('brandId')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="category" class="form-label">Select Category</label>
              <select wire:model="categoryId" class="form-select" aria-label="Default select example" id="category">
                <option selected>Select One</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
              </select>
              @error('categoryId')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">Product Name</label>
              <input type="text" wire:model="name" class="form-control" id="name">
            </div>
            <div class="mb-3">
              <label for="unit" class="form-label">Unit</label>
              <select wire:model="unit" class="form-select" id="unit">
                <option selected>Select One</option>
                <option value="Piece">Piece</option>
                <option value="KG">KG</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="buy_price" class="form-label">Buy Price</label>
              <input type="number" wire:model="buy_price" class="form-control" id="buy_price">
            </div>
            <div class="mb-3">
              <label for="sale_price" class="form-label">Sale Price</label>
              <input type="number" wire:model="sale_price" class="form-control" id="sale_price">
            </div>
            <div class="mb-3">
              <label for="discount" class="form-label">Discount %</label>
              <input type="number" wire:model="discount" class="form-control" id="discount">
            </div>
            <div class="mb-3">
              <label for="qty" class="form-label">Quantity</label>
              <input type="number" wire:model="qty" class="form-control" id="qty">
            </div>
            <div class="mb-3">
              <label for="descript" class="form-label">Description</label>
              <input type="text" wire:model="descript" class="form-control" id="descript">
            </div>
            @if(session('success'))
                <h6 class="alert alert-success text-center">{{ session('success') }}</h6>
            @endif
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  {{-- updateFileModal --}}
  <div wire:ignore.self class="modal fade" id="updateFileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form wire:submit="updateFile">
        <div class="modal-content">
          <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Update File</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row mb-3">
              <div class="col">
                <div class="mb-3">
                  <label for="file" class="form-label">Image</label>
                  <input type="file" wire:model="image" class="form-control" id="file">
                  @error('image')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="float-start">
                  @if ($oldImage)
                    <img src="{{ asset('storage/app/'.$this->oldImage) }}" class="rounded" style="width:100px; height:120px">
                  @endif
                </div>
                <div class="float-end">
                  @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" class="rounded" style="width:100px; height:120px">
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <label for="video" class="form-label">Video</label>
                  <input type="file" wire:model="video" class="form-control" id="video">
                  @error('video')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                @if ($video)
                  <iframe src="{{ $video->temporaryUrl() }}" class="w-100"></iframe>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col">
                @if ($oldVideo)
                  <iframe src="{{ asset('storage/app/'.$this->oldVideo) }}" class="w-100"></iframe>
                @endif
                <h6 class="">Old Video</h6>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
            @if(session('success'))
              <h6 class="alert alert-success text-center">{{ session('success') }}</h6>
            @endif
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
