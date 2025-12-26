@include('partials.entete')
    <!-- Reservation Start -->
        <div class="container-xl py-2 bg-dark hero-header mb-1">
                <div class="container text-center my-2 pt-2 pb-1">
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
                        <div class="card profile-card w-100">
                            <div class="card-body text-center">
                                <a type="button" class="justify-content-center" style="color: #030b51;" data-bs-toggle="modal" data-bs-target="#productModal" 
                                        data-product-id="{{ $art->id }}" data-product-name="{{ $art->nom }}" data-product-price="{{ number_format($art->prix, 2, ',', ' ') }}"
                                        data-product-img="{{ asset('storage/'.$art->image) }}" data-product-description="{{ $art->description }}">
                                    <img src="{{asset('storage/'.$art->image)}}" width="80" alt="User Profile" class="rounded-circle profile-img mb-3">
                                </a>
                                <a type="button" class="" style="color: #030b51;" data-bs-toggle="modal" data-bs-target="#productModal" 
                                        data-product-id="{{ $art->id }}" data-product-name="{{ $art->nom }}" data-product-price="{{ number_format($art->prix, 2, ',', ' ') }}"
                                        data-product-img="{{ asset('storage/'.$art->image) }}" data-product-description="{{ $art->description }}">
                                    <b class="card-title mb-0" style="color: #030b51;">{{$art->nom}}</b>
                                </a>
                                <!-- Detail Button -->
                                <a type="button" class="btn btn-view" style="color: #f1b40aff;" data-bs-toggle="modal" data-bs-target="#productModal" 
                                        data-product-id="{{ $art->id }}" data-product-name="{{ $art->nom }}" data-product-price="{{ number_format($art->prix, 2, ',', ' ') }}"
                                        data-product-img="{{ asset('storage/'.$art->image) }}" data-product-description="{{ $art->description }}">
                                    <i class="fa fa-eye" style="color: #f1b40aff;"></i>
                                </a>
                               
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                    <h5 class="text-center">Plat  Indisponible</h5>
                @endif
            </div>
        </div>

        <!-- Modal Bootstrap -->
        <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="productModalLabel">Détails du produit</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <!-- Image du produit -->
                                <div class="col-md-6">
                                    <img id="modal-product-img" src="" class="modal-product-img" alt="Image produit">
                                    <div class="text-center">
                                        <span id="modal-stock" class="badge bg-success mb-2"></span>
                                    </div>
                                    <div class="text-center mb-2">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-half text-warning"></i>
                                        <small class="text-muted">(4.5)</small>
                                    </div>
                                </div>
                                
                                <!-- Détails du produit -->
                                <div class="col-md-6">
                                    <!-- Nom Article -->
                                    <h3 id="modal-product-name" class="fw-bold mb-2"></h3>

                                    <!-- Description Article -->
                                    <h5 class="mt-4"><i class="bi bi-card-text"></i> Description</h5>
                                    <p id="modal-product-description" class="text-muted"></p>

                                    <!-- Prix et Ajouter au panier -->                                    
                                    <div class="">
                                        <form action="{{route('panier.store')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" id="modal-product-id-input">
                                                @if(!empty($art->prix2))
                                                <b>Veuiilez choisir un model :</b>
                                                
                                                    <p class="mb-0"><b><input type="radio" class="form-check-input" name="model" value="3000">&nbsp;</b>PM ({{number_format($art->prix)}} FCFA)</p>
                                                    <p class="mb-0"><b><input type="radio" class="form-check-input" name="model" value="4000">&nbsp;</b>Moyen ({{number_format($art->prix2)}} FCFA)</p>
                                                    <p class="mb-0"><b><input type="radio" class="form-check-input" name="model" value="5000">&nbsp;</b>GM ({{number_format($art->prix3)}} FCFA)</p>
                                                @else
                                                    <h4 id="modal-product-price" class="text-primary mb-3"></h4>
                                                @endif
                                                
                                            <div class="d-grid gap-2 d-md-flex mt-4">
                                                <button class="btn btn-primary flex-fill">
                                                    <i class="bi bi-cart-plus"></i> Ajouter au panier
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
                       
                
            


            <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- JavaScript simple pour gérer les données des produits -->
        <script>
            // Données des produits (simplifiées)
            const productsData = {
                @foreach($articles as $art)
                            {{$art->id}}: {
                                name: "{{ $art->nom }}",
                                price: "{{ number_format($art->prix, 2, ',', ' ') }} F CFA",
                                img: "{{ asset('storage/'.$art->image) }}",
                                description: "{{ $art->description }}",
                                stock: "Disponible",
                            },
                @endforeach
            };

            
            // Quand la modal s'ouvre, on remplit les informations du produit
        document.addEventListener('DOMContentLoaded', function() {
            // Ajouter un écouteur d'événement sur chaque bouton "Voir"
            const viewButtons = document.querySelectorAll('[data-bs-target="#productModal"]');
            
            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const product = productsData[productId];
                    
                    if (product) {
                        // Mettre à jour les informations dans la modal
                        document.getElementById('modal-product-name').textContent = product.name;
                        document.getElementById('modal-product-price').textContent = product.price;
                        document.getElementById('modal-product-img').src = product.img;
                        document.getElementById('modal-product-img').alt = product.name;
                        document.getElementById('modal-product-description').textContent = product.description;
                        document.getElementById('modal-stock').textContent = product.stock;
                        
                        // // Recuperer le id du produit
                        document.getElementById('modal-product-id-input').value = productId;

                        // Mettre à jour le titre de la modal
                        document.getElementById('productModalLabel').textContent = product.name;
                        
                        // Mettre à jour les spécifications
                        const specsContainer = document.getElementById('modal-product-specs');
                        specsContainer.innerHTML = '';
                        
                        // Ajouter chaque spécification
                        for (const [key, value] of Object.entries(product.specs)) {
                            const specItem = document.createElement('div');
                            specItem.className = 'spec-item';
                            specItem.innerHTML = `
                                <div class="d-flex justify-content-between">
                                    <span class="spec-label">${key}</span>
                                    <span class="spec-value">${value}</span>
                                </div>
                            `;
                            specsContainer.appendChild(specItem);
                        }
                        
                        // Changer la couleur du badge de stock
                        const stockBadge = document.getElementById('modal-stock');
                        if (product.stock.includes('Stock faible')) {
                            stockBadge.className = 'badge bg-warning text-dark mb-2';
                        } else {
                            stockBadge.className = 'badge bg-success mb-2';
                        }
                    }
                });
            });
        });
    </script>
        <!-- Reservation Start -->
@include('partials.footer')