<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Title;

new

#[Title('Dashboard')]

class extends Component {

}

?>

<div>
    <style>
        #menu1 .dropdown-menu {
            background-color: #0a58ca;
        }
        #menu1 .dropdown-menu a:hover {
            background-color: #090;
        }
        #menu1 .dropdown-menu a {
            color:antiquewhite;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary border-0 shadow-sm" style="height: 200px;">
                    <div class="card-header">
                        <h5 class="card-title text-white text-center">Post Dashboard</h5>
                    </div>
                    <div class="btn-group-vertical w-100" role="group" aria-label="Button group with nested dropdown">
                        <a href="{{ url('post') }}" class="btn btn-primary" wire:navigate>Post Dashboard</a>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1" id="menu1">
                            <li><a class="dropdown-item" href="#">Dropdown link Dropdown link</a></li>
                            <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
