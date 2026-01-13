@include('partials.entete') 
     
        <!-- Hero Start -->
         <div class="container-xl py-0 bg-dark hero-header mb-0">
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
                @elseif(Session::has('danger'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('danger') }}
                    </div>
                @endif
                <div class="container py-2">
                    <div class="row align-items-center">
                        
                        <div class="col-lg-6 col-12 text-center text-lg-end overflow-hidden">
                            <h5 class=" text-white ff-secondary" style="font-weight: bold;">Restaurant-traiteur</h5>
                            <!--<p style="font-size: 12px;">
                                Nous ne vendons pas seulement de la nourriture, nous vendons de l'animation urbaine, de l'inclusion sociale et de la modernité technologique.
                            </p>-->
                            <img class="img-fluid" src="assets/img/hero.png" width="200" alt="O'Food">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->
      
        <!-- Service Start -->
        <div class="container-xxl py-2">
            <div class="container">
                <div class="row g-2 g-sm-3 g-xl-4">
                    <div class="col-lg-3 col-3 col-sm-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item rounded pt-1">
                            <div class="p-2 text-center">
                                <i class="fa fa-2x fa-user-tie text-primary mb-0"></i>
                                <!--<p>Maîtres cuisiniers</p>-->
                                <!--<p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 col-sm-3 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item rounded pt-1">
                            <div class="p-2 text-center">
                                <i class="fa fa-2x fa-utensils text-primary mb-0"></i>
                               <!-- <p>Nourriture de qualité</p>-->
                                <!--<p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 col-sm-3 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="service-item rounded pt-1">
                            <div class="p-2 text-center">
                                <i class="fa fa-2x fa-cart-plus text-primary mb-0"></i>
                                <!--<p>Commande en ligne</p>-->
                               <!-- <p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>-->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-3 col-sm-3 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="service-item rounded pt-1">
                            <div class="p-2 text-center">
                                <i class="fa fa-2x fa-headset text-primary mb-0"></i>
                                <!--<p>Service 24h/24 et 7j/7</p>-->
                                <!--<p>Diam elitr kasd sed at elitr sed ipsum justo dolor sed clita amet diam</p>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->

        <!-- Menu Start -->
        <div class="container-xxl py-3" id="menu">
            <!-- Menu Nos Plats-->
             @if(count($plats) > 0)
                <div class="container mb-4">
                    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                        <h5 class="section-title ff-secondary text-center text-primary fw-bold">Nos Plats</h5>
                        <!--<h1 class="mb-2">Nos articles</h1>-->
                    </div>
                    <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane fade show p-0 active">
                                <div class="row  g-2 g-sm-3 g-xl-4">                                
                                    @foreach($plats as $plat)
                                    <div class="col-lg-4 col-4">
                                        <div class="card profile-card w-100">
                                            <div class="card-body text-center">
                                                <a href="{{route('menu.show',['id'=>$plat->id]) }}" class="justify-content-center">
                                                    <img src="{{asset('storage/'.$plat->image)}}" width="80" alt="{{$plat->nom}}" class="rounded-circle profile-img mb-3">
                                                </a>
                                                <a href="{{route('menu.show',['id'=>$plat->id]) }}" style="color: #030b51;" class="card-title">
                                                    <b class="card-title mb-0">{{$plat->nom}}</b>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- Menu Food-->
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
                    <h1 class="mb-2">Nos articles</h1>
                </div>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row  g-2 g-sm-3 g-xl-4">                                
                                @foreach($menus as $menu)
                                <div class="col-lg-3 col-4">
                                    <div class="card profile-card w-100">
                                        <div class="card-body text-center">
                                            <a href="{{route('menu.show',['id'=>$menu->id]) }}" class="justify-content-center">
                                                <img src="{{asset('storage/'.$menu->image)}}" width="80" alt="{{$menu->nom}}" class="rounded-circle profile-img mb-3">
                                            </a>
                                            <a href="{{route('menu.show',['id'=>$menu->id]) }}" style="color: #030b51;" class="card-title">
                                                <b class="card-title mb-0">{{$menu->nom}}</b>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Menu End -->

        @include('partials.footer')