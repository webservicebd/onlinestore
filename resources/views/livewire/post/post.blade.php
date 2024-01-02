<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\Post;

new

#[Title('Post Dashboard')]

class extends Component {

    use WithPagination;

    public $id;
    public $title;
    public $body;

    public function edit ($id)
    {
        $rowid = Post::findOrFail($id);
        $this->id = $rowid->id;
        $this->title = $rowid->title;
        $this->body = $rowid->body;
    }

    public function update () {
        Post::where('id', $this->id)
        ->update([
            'title' => $this->title,
            'body' => $this->body
        ]);

        session()->flash('success', 'Updated successfully');
        // reset form
        // $this->reset('title', 'body', 'id');
    }

    public function delete (Post $post) {
        unlink('public/storage/'.$post->image);
        $post->delete($post->id);
    }

    public function with(): array
    {
        return [
            'posts' => Post::latest()->paginate(1),
        ];
    }

}

?>

<div class="container">
    <div class="row">
        <div class="col-md">
            <a href="{{ url('post-create') }}" wire:navigate class="btn btn-success mb-2">Add Post <i class="fas fa-plus"></i></a>
            <div class="card border-0 p-3 mb-5 shadow-sm">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Index</th>
                            <th scope="col">Title</th>
                            <th scope="col">Body</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <th scope="row">{{ $post->id }}</th>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->body }}</td>
                                <td><img src="{{ asset('public/storage/'.$post->image) }}" alt="" style="width: 100px; height:100px;"></td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" wire:click='edit({{ $post->id }})' data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-link float-start">
                                        <i class="fas fa-pen-square" style="font-size: 40px;"></i>
                                    </button>

                                    <button type="button" wire:click="delete({{ $post }})"
                                        wire:confirm="Are you sure you want to delete this post?"
                                        class="btn btn-link btn-inline">
                                        <i class="fas fa-trash" style="font-size: 40px;"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit="update">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Post</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" wire:model="title" class="form-control" id="title">
                        </div>
                        <div class="mb-3">
                            <label for="body" class="form-label">Body</label>
                            <textarea rows="3" wire:model="body" class="form-control" id="body"></textarea>
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
