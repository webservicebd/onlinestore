<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;
use App\Models\Product;

new

#[Layout('livewire.layouts.guest')]

#[Title('Product')]

class extends Component {

  public $brand;
  public $category;

  public $id;
  public $name;
  public $image;
  public $video;
  public $sale_price;
  public $descript;

  public Product $product;

  public function mount(Product $product)
  {
    $this->brand = $product->brand->name;
    $this->category = $product->category->name;
    $this->id = $product->id;
    $this->name = $product->name;
    $this->image = $product->image;
    $this->video = $product->video;
    $this->sale_price = $product->sale_price;
    $this->descript = $product->descript;
  }

}

?>

<main>

  <livewire:guest.header/>

  <!-- Open Content -->
  <section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="card-img img-fluid" src="{{ asset('storage/app/'.$product->image) }}" alt="Card image cap" id="product-detail">
                </div>
                <div class="row">
                  <iframe src="{{ asset('storage/app/'.$product->video) }}" class="w-100"></iframe>
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2">{{ $name }}</h1>
                        <p class="h3 py-2">Price $ {{ $sale_price }}</p>
                        <p class="py-2">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <span class="list-inline-item text-dark">Rating 4.8 | 36 Comments</span>
                        </p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Brand :</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong>{{ $brand }}</strong></p>
                            </li>
                        </ul>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Category :</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong>{{ $category }}</strong></p>
                            </li>
                        </ul>

                        <h6>Description:</h6>
                        <p>{{ $descript }}</p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Avaliable Color :</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong>White / Black</strong></p>
                            </li>
                        </ul>

                        <h6>Specification:</h6>
                        <ul class="list-unstyled pb-3">
                            <li>Lorem ipsum dolor sit</li>
                            <li>Amet, consectetur</li>
                            <li>Adipiscing elit,set</li>
                            <li>Duis aute irure</li>
                            <li>Ut enim ad minim</li>
                            <li>Dolore magna aliqua</li>
                            <li>Excepteur sint</li>
                        </ul>

                        <form action="" method="GET">
                            <input type="hidden" name="product-title" value="Activewear">
                            <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item">Size :
                                            <input type="hidden" name="product-size" id="product-size" value="S">
                                        </li>
                                        <li class="list-inline-item"><span class="btn btn-success btn-size">S</span></li>
                                        <li class="list-inline-item"><span class="btn btn-success btn-size">M</span></li>
                                        <li class="list-inline-item"><span class="btn btn-success btn-size">L</span></li>
                                        <li class="list-inline-item"><span class="btn btn-success btn-size">XL</span></li>
                                    </ul>
                                </div>
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item text-right">
                                            Quantity
                                            <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                                        </li>
                                        <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                        <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                        <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" name="submit" value="buy">Buy</button>
                                </div>
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" name="submit" value="addtocard">Add To Cart</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Close Content -->

<!-- Start Article -->
<section class="py-5">
    <div class="container">
        <div class="row text-left p-2 pb-3">
            <h4>Related Products</h4>
        </div>

        <!--Start Carousel Wrapper-->


    </div>
</section>
<!-- End Article -->


<!-- Start Footer -->
<footer class="bg-dark" id="tempaltemo_footer">

    <div class="w-100 bg-black py-3">
        <div class="container">
            <div class="row pt-2">
                <div class="col-6">
                    <p class="text-left text-light">
                        Copyright &copy; 2021 Company Name
                        | Designed by <a rel="sponsored" href="https://templatemo.com" target="_blank">TemplateMo</a>
                    </p>
                </div>
                <div class="col-6">
                <label class="sr-only" for="subscribeEmail">Email address</label>
                <div class="input-group mb-2">
                    <input type="text" class="form-control bg-dark border-light" id="subscribeEmail" placeholder="Email address">
                    <div class="input-group-text btn-success text-light">Subscribe</div>
                </div>
            </div>
            </div>
        </div>
    </div>

</footer>
<!-- End Footer -->
</main>
