<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;

new

#[Title('Dashboard')]

class extends Component {
  //

}

?>

<div>
    <style>
        #menu1 {
            background-color: #0a58ca;
        }
        #menu1 a:hover {
            background-color: #090;
        }
        #menu1 a {
            color: #fff;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary border-0 shadow-sm" style="height: 200px;">
                    <div class="card-header">
                        <h5 class="card-title text-white text-center">Product Dashboard</h5>
                    </div>
                    <div class="btn-group-vertical w-100" role="group" aria-label="Button group with nested dropdown">
                        <a href="{{ url('brand-create') }}" class="btn btn-primary" wire:navigate>Create Brand</a>
                        <a href="{{ url('category-create') }}" class="btn btn-primary" wire:navigate>Create Category</a>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Product
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1" id="menu1">
                              <li><a class="dropdown-item" href="{{ url('product-create') }}" wire:navigate>Create</a></li>
                              <li><a class="dropdown-item" href="{{ url('product-show') }}" wire:navigate>Show</a></li>
                            </ul>
                        </div>
                        <a href="{{ url('post') }}" class="btn btn-primary" wire:navigate>Post Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
