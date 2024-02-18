<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;


new

#[Title('Create Product')]

class extends Component {

  use WithFileUploads;

  public $brands;
  #[Validate('required', message: 'Brand is required.')]
  public $brandId;
  public $categories = [];
  #[Validate('required', message: 'Category is required.')]
  public $categoryId;
  #[Validate('required')]
  public $name;
  #[Validate('required')]
  public $unit;
  #[Validate('required')]
  public $buy_price;
  #[Validate('required')]
  public $sale_price;
  public $discount;
  #[Validate('required')]
  public $qty;
  #[Validate('max:500|mimes:jpg,png')]
  public $image;
  #[Validate('nullable|mimes:mp4')]
  public $video;
  public $descript;

  function save () {

    $this->validate();

    Product::create([
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
      'image' => $this->image->store('public/product'),
      'video' => $this->video->store('public/product'),
      'descript' => $this->descript,
    ]);

    $this->reset('name', 'unit', 'buy_price', 'sale_price', 'discount', 'qty', 'image', 'video', 'descript');

    session()->flash('success', 'Product has been created');
  }

  public function mount(){
    $this->brands = Brand::all();
  }

  public function updatedBrandId($val)
  {
    $this->categories = Category::where('brand_id', $val)->get();
  }

}

?>

<div class="container">
  <div class="row">
    <div class="col">
      <h4 class="float-start">Create Product</h4>
      <a href="{{ url('product-show') }}" class="btn btn-success mb-2 float-end" wire:navigate>Show Product <i class="fas fa-plus"></i></a>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card border-0 p-3 mb-5 shadow-sm">
        <div class="card-body">
          <form wire:submit="save" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6 mb-3">
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
              <div class="col-md-6 mb-3">
                <label for="category" class="form-label">Select Category</label>
                <select wire:model.live="categoryId" class="form-select" aria-label="Default select example" id="category">
                  <option selected>Select One</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('categoryId')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="title" class="form-label">Product Name</label>
                <input type="text" wire:model="name" class="form-control" id="title">
                @error('name')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6 mb-3">
                <label for="unit" class="form-label">Unit</label>
                <select wire:model="unit" class="form-select" id="unit">
                  <option selected>Select One</option>
                  <option value="Piece">Piece</option>
                  <option value="KG">KG</option>
                </select>
                @error('unit')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="buy_price" class="form-label">Buy Price</label>
                <input type="number" wire:model="buy_price" class="form-control" id="buy_price">
                @error('buy_price')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label for="sale_price" class="form-label">Sale Price</label>
                <input type="number" wire:model="sale_price" class="form-control" id="sale_price">
                @error('sale_price')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label for="discount" class="form-label">Discount %</label>
                <input type="number" wire:model="discount" class="form-control" id="discount">
                @error('discount')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-3 mb-3">
                <label for="qty" class="form-label">Quantity</label>
                <input type="number" wire:model="qty" class="form-control" id="qty">
                @error('qty')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="file" class="form-label">Image</label>
                <input type="file" wire:model="image" class="form-control" id="file">
                @error('image')
                  <span class="text-danger">{{ $message }}</span>
                @enderror

                @if ($image)
                  <img src="{{ $image->temporaryUrl() }}" class="rounded" style="width:100px; height:120px">
                @endif
              </div>
              <div class="col-md-6 mb-3">
                <label for="file" class="form-label">Video</label>
                <input type="file" wire:model="video" class="form-control" id="file">
                @error('video')
                  <span class="text-danger">{{ $message }}</span>
                @enderror

                @if ($video)
                  <iframe src="{{ $video->temporaryUrl() }}" class="w-100"></iframe>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="descript" class="form-label">Description</label>
                <input type="text" wire:model="descript" class="form-control" id="descript">
                @error('descript')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6 mb-3">
                <button type="submit" class="btn btn-primary w-50 float-end mt-4" id="submit">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @if(session('success'))
    @script
      <script>
        swal("{{ session('success') }}");
      </script>
    @endscript
  @endif
</div>
