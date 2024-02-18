<?php

use Livewire\Attributes\{Layout, Title};
use Livewire\Volt\Component;
use App\Models\Product;
use App\Models\Brand;
use Livewire\WithPagination;

new

#[Layout('livewire.layouts.guest')]

#[Title('Shop')]

class extends Component {

  use WithPagination;

  public function with(): array
  {
    return [
      'products' => Product::latest()->paginate(9),
      'brands' => Brand::all(),
    ];
  }

}

?>

<main>

<livewire:guest.header/>

<!-- Start Content -->
<div class="container py-5">
  <div class="row">
      <div class="col-lg-3">
          <h1 class="h2 pb-4">Brand Category</h1>
          <div class="accordion accordion-flush" id="accordionFlushExample">
            @foreach ($brands as $brand)
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-heading{{ $brand->id }}">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $brand->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $brand->id }}">
                    {{ $brand->name }}
                  </button>
                </h2>
                <div id="flush-collapse{{ $brand->id }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $brand->id }}" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    @foreach ($brand->categories as $category)
                      <a class="text-decoration-none d-flex" href="#">{{ $category->name }}</a>
                    @endforeach
                  </div>
                </div>
              </div>
            @endforeach
          </div>
      </div>

      <div class="col-lg-9">
          <div class="row">
              <div class="col-md-6">
                  <ul class="list-inline shop-top-menu pb-3 pt-1">
                      <li class="list-inline-item">
                          <a class="h3 text-dark text-decoration-none mr-3" href="#">All</a>
                      </li>
                      <li class="list-inline-item">
                          <a class="h3 text-dark text-decoration-none mr-3" href="#">Men's</a>
                      </li>
                      <li class="list-inline-item">
                          <a class="h3 text-dark text-decoration-none" href="#">Women's</a>
                      </li>
                  </ul>
              </div>
              <div class="col-md-6 pb-4">
                  <div class="d-flex">
                      <select class="form-control">
                          <option>Featured</option>
                          <option>A to Z</option>
                          <option>Item</option>
                      </select>
                  </div>
              </div>
          </div>
          <div class="row">
            @foreach($products as $product)
              <div class="col-md-4">
                  <div class="card mb-4 product-wap rounded-0 h-100">
                      <div class="card rounded-0">
                          <img class="card-img rounded-0 img-fluid" src="{{ asset('storage/app/'.$product->image) }}">
                          <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                              <ul class="list-unstyled">
                                  <li><a class="btn btn-success text-white mt-2" href="{{ url('product/'.$product->id) }}"><i class="far fa-eye"></i></a></li>
                              </ul>
                          </div>
                      </div>
                      <div class="card-body">
                          <h1 class="h3 text-decoration-none">{{ $product->name }}</h1>
                          <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                              <li class="pt-2">
                                  <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                  <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                  <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                  <span class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                  <span class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                              </li>
                          </ul>
                          <ul class="list-unstyled d-flex justify-content-center mb-1">
                              <li>
                                  <i class="text-warning fa fa-star"></i>
                                  <i class="text-warning fa fa-star"></i>
                                  <i class="text-warning fa fa-star"></i>
                                  <i class="text-muted fa fa-star"></i>
                                  <i class="text-muted fa fa-star"></i>
                              </li>
                          </ul>
                          <p class="text-center mb-0">Price $ {{ $product->sale_price }}</p>
                      </div>
                  </div>
              </div>
             @endforeach
          </div>
          <div div="row">
            {{ $products->links() }}
          </div>
      </div>
  </div>
</div>
<!-- End Content -->

<!-- Start Brands -->
<section class="bg-light py-5">
  <div class="container my-4">
      <div class="row text-center py-3">
          <div class="col-lg-6 m-auto">
              <h1 class="h1">Our Brands</h1>
              <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  Lorem ipsum dolor sit amet.
              </p>
          </div>
          <div class="col-lg-9 m-auto tempaltemo-carousel">
              <div class="row d-flex flex-row">
                  <!--Controls-->
                  <div class="col-1 align-self-center">
                      <a class="h1" href="#multi-item-example" role="button" data-bs-slide="prev">
                          <i class="text-light fas fa-chevron-left"></i>
                      </a>
                  </div>
                  <!--End Controls-->

                  <!--Carousel Wrapper-->
                  <div class="col">
                      <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="multi-item-example" data-bs-ride="carousel">
                          <!--Slides-->
                          <div class="carousel-inner product-links-wap" role="listbox">

                              <!--First slide-->
                              <div class="carousel-item active">
                                  <div class="row">
                                      <div class="col-3 p-md-5">
                                          <a href="#"><img class="img-fluid brand-img" src="{{ asset('public') }}/assets/img/brand_01.png" alt="Brand Logo"></a>
                                      </div>
                                      <div class="col-3 p-md-5">
                                          <a href="#"><img class="img-fluid brand-img" src="{{ asset('public') }}/assets/img/brand_02.png" alt="Brand Logo"></a>
                                      </div>
                                      <div class="col-3 p-md-5">
                                          <a href="#"><img class="img-fluid brand-img" src="{{ asset('public') }}/assets/img/brand_03.png" alt="Brand Logo"></a>
                                      </div>
                                      <div class="col-3 p-md-5">
                                          <a href="#"><img class="img-fluid brand-img" src="{{ asset('public') }}/assets/img/brand_04.png" alt="Brand Logo"></a>
                                      </div>
                                  </div>
                              </div>
                              <!--End First slide-->

                              <!--Second slide-->
                              <div class="carousel-item">
                                  <div class="row">
                                      <div class="col-3 p-md-5">
                                          <a href="#"><img class="img-fluid brand-img" src="{{ asset('public') }}/assets/img/brand_01.png" alt="Brand Logo"></a>
                                      </div>
                                      <div class="col-3 p-md-5">
                                          <a href="#"><img class="img-fluid brand-img" src="{{ asset('public') }}/assets/img/brand_02.png" alt="Brand Logo"></a>
                                      </div>
                                      <div class="col-3 p-md-5">
                                          <a href="#"><img class="img-fluid brand-img" src="{{ asset('public') }}/assets/img/brand_03.png" alt="Brand Logo"></a>
                                      </div>
                                      <div class="col-3 p-md-5">
                                          <a href="#"><img class="img-fluid brand-img" src="{{ asset('public') }}/assets/img/brand_04.png" alt="Brand Logo"></a>
                                      </div>
                                  </div>
                              </div>
                              <!--End Second slide-->

                              <!--Third slide-->
                              <div class="carousel-item">
                                  <div class="row">
                                      <div class="col-3 p-md-5">
                                          <a href="#"><img class="img-fluid brand-img" src="{{ asset('public') }}/assets/img/brand_01.png" alt="Brand Logo"></a>
                                      </div>
                                      <div class="col-3 p-md-5">
                                          <a href="#"><img class="img-fluid brand-img" src="{{ asset('public') }}/assets/img/brand_02.png" alt="Brand Logo"></a>
                                      </div>
                                      <div class="col-3 p-md-5">
                                          <a href="#"><img class="img-fluid brand-img" src="{{ asset('public') }}/assets/img/brand_03.png" alt="Brand Logo"></a>
                                      </div>
                                      <div class="col-3 p-md-5">
                                          <a href="#"><img class="img-fluid brand-img" src="{{ asset('public') }}/assets/img/brand_04.png" alt="Brand Logo"></a>
                                      </div>
                                  </div>
                              </div>
                              <!--End Third slide-->

                          </div>
                          <!--End Slides-->
                      </div>
                  </div>
                  <!--End Carousel Wrapper-->

                  <!--Controls-->
                  <div class="col-1 align-self-center">
                      <a class="h1" href="#multi-item-example" role="button" data-bs-slide="next">
                          <i class="text-light fas fa-chevron-right"></i>
                      </a>
                  </div>
                  <!--End Controls-->
              </div>
          </div>
      </div>
  </div>
</section>
<!--End Brands-->

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
                      <input type="text" class="form-control bg-dark border-light text-white" id="subscribeEmail" placeholder="Email address">
                      <div class="input-group-text btn-success text-light">Subscribe</div>
                  </div>
              </div>
              </div>
          </div>
      </div>

  </footer>
  <!-- End Footer -->

</main>
