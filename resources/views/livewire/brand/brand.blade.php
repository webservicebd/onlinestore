<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Models\Brand;
use Livewire\WithPagination;

new

#[Title('Brand')]

class extends Component {

    use WithPagination;

    public $id;
    public $name;

    public function edit ($id)
    {
        $rowid = Brand::findOrFail($id);
        $this->id = $rowid->id;
        $this->name = $rowid->name;
    }

    public function update () {
        Brand::where('id', $this->id)
        ->update([
          'name' => Str::of($this->name)->upper(),
          'slug' => Str::slug($this->name, '-'),
        ]);

        session()->flash('success', 'Updated successfully');
    }

    public function delete ($id) {
      Brand::destroy($id);
    }

    #[On('reload')]

    public function with(): array
    {
        return [
            'brands' => Brand::latest()->paginate(1),
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
                  <th scope="col">Name</th>
                  <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $brand)
                <tr>
                    <th scope="row">{{ $brand->id }}</th>
                    <td>{{ $brand->name }}</td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" wire:click='edit({{ $brand->id }})' data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-link float-start">
                            <i class="fas fa-pen-square" style="font-size: 40px;"></i>
                        </button>

                        <button type="button" wire:click="delete({{ $brand->id }})"
                            wire:confirm="Are you sure you want to delete this brand?"
                            class="btn btn-link btn-inline">
                            <i class="fas fa-trash" style="font-size: 40px;"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $brands->links() }}
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit="update">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Brand</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Brand name</label>
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
