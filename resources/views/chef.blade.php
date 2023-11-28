    <!-- ***** Chefs Area Starts ***** -->
    <section class="section" id="chefs">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 text-center">
                    <div class="section-heading">
                        <h6>Our Chefs</h6>
                        <h2>We offer the best ingredients for you</h2>
                    </div>
                </div>
            </div>
           
            <div class="row">
            @foreach($chef as $chef)
                <div class="col-lg-4">
                    <div class="chef-item">
                        <div class="thumb">
                            <div class="overlay"></div>
                            
                            <img height="300" width="200" src="chef/{{$chef->image}}" alt="Chef #1">
                        </div>
                        <div class="down-content">
                            <h4>{{$chef->name}}</h4>
                            <span>{{$chef->speciality}}</span>
                        </div>
                    </div>
                </div>
                

               @endforeach
            
            </div>
        </div>
    </section>
    <!-- ***** 