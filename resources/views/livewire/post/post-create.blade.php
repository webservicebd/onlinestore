<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use App\Models\Post;

new

#[Title('Create Post')]

class extends Component {

    use WithFileUploads;

    public $title, $body, $image;

    function save () {

        $this->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|max:500|mimes:jpg,pdf'
        ]);

        Post::create([
        'user_id' => Auth::user()->id,
        'title' => $this->title,
        'body' => $this->body,
        'image' => $this->image->store('post', 'public')
    ]);

    $this->reset();

    session()->flash('success', 'Post has been added');

    }

}

?>

<div class="container">
    <div class="row">
        <div class="offset-md-1 col-md-10">
            <a href="{{ url('post') }}" wire:navigate class="btn btn-success mb-2">View Post <i class="fas fa-eye"></i></a>
            <div class="card border-0 p-3 mb-5 shadow-sm">
                <div class="card-body">
                    <form wire:submit="save" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" wire:model="title" class="form-control" id="title">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label">Body</label>
                            <textarea rows="3" wire:model="body" class="form-control" id="body"></textarea>
                            @error('body')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Image</label>
                            <input type="file" wire:model="image" class="form-control" id="file">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" class="rounded float-start" style="width:100px; height:120px">
                            @endif
                            <button type="submit" class="btn btn-primary w-25 float-end">Submit</button>
                        </div>
                        @if(session('success'))
                            @script
                                <script>
                                    swal("{{ session('success') }}");
                                </script>
                            @endscript
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
