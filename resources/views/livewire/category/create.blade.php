<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;

new

#[Title('Create Category')]

class extends Component {

  public $brand_id;
  public $name;

  function save () {

    $this->validate([
      'brand_id' => 'required',
      'name' => 'required',
    ]);

    Category::create([
      'brand_id' => $this->brand_id,
      'name' => Str::title($this->name),
      'slug' => Str::slug($this->name, '-'),
    ]);

    $this->reset();

    session()->flash('success', 'Category has been created');

    $this->dispatch('reload');
  }

  public function with(): array
    {
        return [
            'brands' => Brand::all(),
        ];
    }
}

?>

<div class="container">
    <div class="row">
        <div class="col-md">
          <h4 class="text-center">Create Category</h4>
            <div class="card border-0 p-3 mb-5 shadow-sm">
                <div class="card-body">
                    <form wire:submit="save">
                      <div class="mb-3">
                        <label for="brand_id" class="form-label">Select Brand</label>
                          <select wire:model="brand_id" class="form-select" aria-label="Default select example" id="brand_id">
                            <option selected>Select One</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                          </select>
                          @error('brand_id')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Category Name</label>
                            <input type="text" wire:model="name" class="form-control" id="title">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-25 float-end">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md">
          <h4 class="text-center">Category List</h4>

          <livewire:category.category/>

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
