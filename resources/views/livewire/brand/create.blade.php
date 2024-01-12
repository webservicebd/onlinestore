<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use App\Models\Brand;
use Illuminate\Support\Str;

new

#[Title('Create Brand')]

class extends Component {

  public $name;

  function save () {

    $this->validate([
      'name' => 'required',
    ]);

    Brand::create([
      'user_id' => Auth::user()->id,
      'name' => Str::of($this->name)->upper(),
      'slug' => Str::slug($this->name, '-'),
    ]);

    $this->reset();

    session()->flash('success', 'Brand has been created');

    $this->dispatch('reload');
  }

}

?>

<div class="container">
    <div class="row">
        <div class="col-md">
          <h4 class="text-center">Create Brand</h4>
            <div class="card border-0 p-3 mb-5 shadow-sm">
                <div class="card-body">
                    <form wire:submit="save">
                        <div class="mb-3">
                            <label for="title" class="form-label">Brand Name</label>
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
          <h4 class="text-center">Brand List</h4>

          <livewire:brand.brand/>

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
