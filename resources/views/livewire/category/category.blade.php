<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\Category;
use App\Models\Brand;
use Livewire\WithPagination;

new

#[Title('Category')]

class extends Component {

    use WithPagination;

    public $id;
    public $brand_id;
    public $name;

    public function edit ($id)
    {
        $rowid = Category::findOrFail($id);
        $this->id = $rowid->id;
        $this->name = $rowid->name;
        $this->brand_id = $rowid->brand_id;
    }

    public function update () {

        $this->validate([
          'brand_id' => 'required',
          'name' => 'required',
        ]);

        Category::where('id', $this->id)
        ->update([
          'brand_id' => $this->brand_id,
          'name' => Str::title($this->name),
          'slug' => Str::slug($this->name, '-'),
        ]);

        session()->flash('success', 'Updated successfully');
    }

    public function delete ($id) {
      Category::destroy($id);
    }

    #[On('reload')]

    public function with(): array
    {
        return [
            'categories' => Category::latest()->paginate(1),
            'brands' => Brand::all(),
        ];
    }
}

?>

<div class="card border-0 p-3 mb-5 shadow-sm">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                  <th scope="col">Index</th>
                  <th scope="col">Brand Name</th>
                  <th scope="col">Category</th>
                  <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->brand->name }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" wire:click='edit({{ $category->id }})' data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-link float-start">
                            <i class="fas fa-pen-square" style="font-size: 40px;"></i>
                        </button>

                        <button type="button" wire:click="delete({{ $category->id }})"
                            wire:confirm="Are you sure you want to delete this brand?"
                            class="btn btn-link btn-inline">
                            <i class="fas fa-trash" style="font-size: 40px;"></i>
                        </button>
                    </td>
                </tr>
              @endforeach
            </tbody>
        </table>

        {{ $categories->links() }}
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit="update">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="brand_id" class="form-label">Select Brand</label>
                          <select wire:model="brand_id" class="form-select" aria-label="Default select example" id="brand_id">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                          </select>
                          @error('brand_id')
                              <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Category name</label>
                            <input type="text" wire:model="name" class="form-control" id="title">
                        </div>
                        @if(session('success'))
                            <h6 class="alert alert-success text-center">{{ session('success') }}</h6>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
