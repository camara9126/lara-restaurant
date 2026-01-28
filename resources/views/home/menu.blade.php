@include('partials.entete')
        <!-- mHero Start -->
        <div class="container-xxl py-2 bg-dark hero-header mb-0">
                <div class="container text-center my-2 pt-2 pb-2">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Nos Menus</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Menu</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Hero End -->


        <!-- Menu Start -->
        <div class="container-xxl py-3" id="menu">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
                    <!--<h1 class="mb-2">Nos articles</h1>-->
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
                                                <img src="{{asset('storage/'.$menu->image)}}" width="80" alt="User Profile" class="rounded-circle profile-img mb-3">
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