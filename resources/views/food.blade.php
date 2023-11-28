<section class="section" id="menu">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-heading">
                        <h6>Our Menu</h6>
                        <h2>Our selection of cakes with quality taste</h2>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-item-carousel">
            <div class="col-lg-12">
                <div class="owl-menu-item owl-carousel">

                @foreach ($food as $food)

                <div class="item">
                        <div style="background-image: url('/food/{{$food->image}}');" class='card'>
                            <div class="price">
                            <form action="{{ route('user.cart') }}" method="GET">
                            @csrf
                         <input type="hidden" name="food_id" value="{{ $food->id }}">
                         <button  class="fa fa-shopping-cart toggle-on-hover" aria-hidden="true">
                         
                         </button>
                                </form>
                            
                           <h6>Lkr. {{ $food->attributes->max('price') }}</h6></div>
                            <div class='info'>
                              <h1 class='title'>{{$food->foodtitle}}</h1>
                              <p class='description'>{{$food->description}}</p>
                              <div class="main-text-button">
                                  <div class="scroll-to-section"><a href="#reservation">Make Reservation <i class="fa fa-angle-down"></i></a></div>
                              </div>
                            </div>
                        </div>
                      
                    </div>
           
                    @endforeach
                   
               

                </div>
            </div>
        </div>
    </section>