@include('partials.entete')
    <!-- Reservation Start -->
        <div class="container-xxl py-2 bg-dark hero-header mb-1">
                <div class="container text-center my-5 pt-5 pb-1">
                    <h1 class="display-3 text-white mb-0 animated slideInDown">
                        Menu
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Menu</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @elseif(Session::has('danger'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('danger') }}
                </div>
            @endif
        <div class="container wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-2 g-sm-3 g-xl-4">
                @if($articles->count() > 0)
                @foreach($articles as $art)
                <div class="col-md-6 col-4 mb-0 wow fadeInUp" data-wow-delay="0.1s">
                    <!--<div class="card">-->
                        <div class="card profile-card w-100">
                            <div class="card-body text-center">
                                <a href="{{route('article.show',['id'=>$art->id]) }}" class="justify-content-center">
                                    <img src="{{asset('storage/'.$art->image)}}" width="80" alt="User Profile" class="rounded-circle profile-img mb-3">
                                </a>
                                <a href="{{route('article.show',['id'=>$art->id]) }}" style="color: #030b51;" class="card-title">
                                    <b class="card-title mb-0">{{$art->nom}}</b>
                                </a>
                                <!--<p class="card-text text-muted mb-3">Web Developer</p>-->
                                <!--<div class="social-icons mb-4">
                                    <a href="#" class="me-2"><i class="bi bi-facebook"></i></a>
                                    <a href="#"><i class="bi bi-instagram"></i></a>
                                </div>-->
                            </div>
                        </div>
                    <!--</div>-->
                </div>
                @endforeach
                @else
                    <h5 class="text-center">Plat  Indisponible</h5>
                @endif
            </div>
        </div>


        <!-- Reservation Start -->
@include('partials.footer')