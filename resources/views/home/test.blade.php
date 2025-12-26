<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal de visualisation de produit</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
            padding-bottom: 40px;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #6f42c1 0%, #0d6efd 100%);
            color: white;
            padding: 40px 0;
            border-radius: 10px;
            margin-bottom: 40px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .product-card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            height: 100%;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .product-img {
            height: 200px;
            object-fit: cover;
            border-bottom: 1px solid #eee;
        }
        
        .product-title {
            font-weight: 600;
            color: #2c3e50;
            height: 50px;
            overflow: hidden;
        }
        
        .product-price {
            color: #6f42c1;
            font-weight: 700;
            font-size: 1.3rem;
        }
        
        .product-description {
            color: #666;
            height: 70px;
            overflow: hidden;
        }
        
        .badge-stock {
            font-size: 0.8rem;
            padding: 5px 10px;
        }
        
        .modal-product-img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .spec-item {
            border-bottom: 1px dashed #eee;
            padding: 10px 0;
        }
        
        .spec-label {
            font-weight: 600;
            color: #333;
        }
        
        .spec-value {
            color: #666;
        }
        
        .footer-note {
            text-align: center;
            color: #666;
            font-style: italic;
            margin-top: 40px;
        }
        
        .btn-view {
            background: linear-gradient(135deg, #6f42c1 0%, #0d6efd 100%);
            border: none;
            color: white;
            font-weight: 600;
        }
        
        .btn-view:hover {
            background: linear-gradient(135deg, #5a34a1 0%, #0a58ca 100%);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- En-tête -->
        <header class="hero-section text-center">
            <h1 class="display-4 fw-bold">
                <i class="bi bi-shop"></i> Boutique en ligne
            </h1>
            <p class="lead">Cliquez sur "Voir" pour afficher les détails d'un produit</p>
        </header>
        
        <!-- Liste des produits -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="products-container">
            <!-- Produit 1 -->
             @foreach($products as $product)
            <div class="col">
                <div class="card product-card h-100">
                    <img src="{{ $product->image_url }}" 
                         class="card-img-top product-img" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title product-title">{{ $product->name }}</h5>
                        <p class="product-price">{{ number_format($product->price, 2, ',', ' ') }} €</p>
                        <p class="card-text product-description">
                            {{ Str::limit($product->description, 100) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-success badge-stock">
                                <i class="bi bi-check-circle"></i> En stock (15)
                            </span>
                            <span class="text-muted"><i class="bi bi-star-fill text-warning"></i> 4.7/5</span>
                        </div>
                        
                        <button class="btn btn-view w-100" data-bs-toggle="modal" data-bs-target="#productModal" 
                                data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}" data-product-price="{{ number_format($product->price, 2, ',', ' ') }}"
                                data-product-img="{{ $product->image_url }}">
                            <i class="bi bi-eye"></i> Voir les détails
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
          
        </div>
        
        <!-- Note de pied de page -->
        <p class="footer-note">
            Cliquez sur n'importe quel bouton "Voir" pour ouvrir la modal avec les détails complets du produit.
        </p>
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
                                <div class="mt-3 text-center">
                                    <span id="modal-stock" class="badge bg-success mb-2"></span>
                                    <span id="modal-rating" class="text-muted"></span>
                                </div>
                            </div>
                            
                            <!-- Détails du produit -->
                            <div class="col-md-6">
                                <h3 id="modal-product-name" class="fw-bold mb-2"></h3>
                                <h4 id="modal-product-price" class="text-primary mb-3"></h4>
                                
                                <h5 class="mt-4"><i class="bi bi-card-text"></i> Description</h5>
                                <p id="modal-product-description" class="text-muted"></p>
                                
                                <h5 class="mt-4"><i class="bi bi-list-check"></i> Spécifications</h5>
                                <div id="modal-product-specs" class="mb-3">
                                    <!-- Les spécifications seront insérées ici par JavaScript -->
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex mt-4">
                                    <button class="btn btn-primary btn-lg flex-fill">
                                        <i class="bi bi-cart-plus"></i> Ajouter au panier
                                    </button>
                                    <button class="btn btn-outline-primary btn-lg flex-fill">
                                        <i class="bi bi-heart"></i> Ajouter aux favoris
                                    </button>
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
</body>
</html>