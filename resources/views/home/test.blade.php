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
            1: {
                name: "Smartphone Pro X",
                price: "899,99 €",
                img: "https://images.unsplash.com/photo-1598327105666-5b89351aff97?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80",
                description: "Le Smartphone Pro X redéfinit l'expérience mobile avec son écran OLED de 6.7 pouces offrant des couleurs vibrantes et des noirs profonds. Equipé d'un processeur octa-core dernier cri et de 12Go de RAM, il offre des performances fluides pour toutes vos applications.",
                stock: "En stock (15 unités)",
                rating: "4.7/5",
                specs: {
                    "Écran": "6.7 pouces OLED",
                    "Processeur": "Octa-core 3.2GHz",
                    "RAM": "12 Go",
                    "Stockage": "256 Go",
                    "Caméra": "Triple 108MP + 12MP + 8MP",
                    "Batterie": "5000 mAh",
                    "OS": "Android 13"
                }
            },
            2: {
                name: "Casque Audio Sans Fil",
                price: "249,99 €",
                img: "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80",
                description: "Profitez d'une expérience audio immersive avec ces casques sans fil équipés d'une réduction de bruit active de dernière génération. Ils bloquent jusqu'à 95% des bruits ambiants pour vous permettre de vous concentrer sur votre musique.",
                stock: "En stock (8 unités)",
                rating: "4.5/5",
                specs: {
                    "Autonomie": "30 heures",
                    "Charge rapide": "15 min = 5h d'écoute",
                    "Réduction de bruit": "Active",
                    "Connectivité": "Bluetooth 5.2",
                    "Poids": "265 g",
                    "Microphone": "Intégré avec réduction de bruit"
                }
            },
            3: {
                name: "Montre Connectée Sport",
                price: "329,99 €",
                img: "https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80",
                description: "Cette montre connectée est le compagnon idéal pour vos activités sportives. Elle intègre un GPS précis pour suivre vos parcours de course, vélo ou randonnée. Le monitoring cardiaque 24h/24 vous permet de suivre votre fréquence cardiaque en temps réel.",
                stock: "Stock faible (3 unités)",
                rating: "4.8/5",
                specs: {
                    "Écran": "AMOLED 1.4 pouces",
                    "Autonomie": "7 jours",
                    "GPS": "Intégré",
                    "Résistance à l'eau": "5 ATM (50m)",
                    "Capteurs": "Cardiaque, SpO2, Accéléromètre",
                    "Notifications": "Appels, messages, apps"
                }
            },
            4: {
                name: "Tablette Graphique",
                price: "459,99 €",
                img: "https://images.unsplash.com/photo-1593640408182-31c70c8268f5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80",
                description: "Cette tablette graphique professionnelle offre un écran de 10 pouces avec une résolution 4K pour un travail de précision. Le stylet sans batterie offre 8192 niveaux de pression pour un contrôle artistique exceptionnel.",
                stock: "En stock (12 unités)",
                rating: "4.6/5",
                specs: {
                    "Écran": "10 pouces 4K",
                    "Stylet": "8192 niveaux de pression",
                    "Connectivité": "USB-C, Bluetooth",
                    "Compatibilité": "Windows, Mac, Android",
                    "Couleurs": "98% Adobe RGB",
                    "Angle de vision": "178°"
                }
            },
            5: {
                name: "Enceinte Bluetooth Portable",
                price: "129,99 €",
                img: "https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80",
                description: "Cette enceinte Bluetooth portable offre un son stéréo puissant et riche malgré sa taille compacte. Avec une autonomie de 20 heures, elle est parfaite pour les voyages, pique-niques ou fêtes en extérieur.",
                stock: "En stock (25 unités)",
                rating: "4.4/5",
                specs: {
                    "Puissance": "20W stéréo",
                    "Autonomie": "20 heures",
                    "Résistance": "IPX7 (étanche)",
                    "Bluetooth": "Version 5.0",
                    "Poids": "680 g",
                    "Entrées": "USB-C, Aux-in"
                }
            },
            6: {
                name: "Console de Jeux Portable",
                price: "399,99 €",
                img: "https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80",
                description: "Cette console de jeux portable révolutionne le gaming nomade avec son écran OLED 7 pouces offrant des couleurs vibrantes et un temps de réponse ultra-rapide. Son processeur surpuissant permet de jouer aux jeux AAA les plus récents.",
                stock: "Stock faible (2 unités)",
                rating: "4.9/5",
                specs: {
                    "Écran": "7 pouces OLED 120Hz",
                    "Processeur": "CPU Zen 2, GPU RDNA 2",
                    "RAM": "16 Go LPDDR5",
                    "Stockage": "512 Go SSD",
                    "Autonomie": "4-8 heures",
                    "Connectivité": "Wi-Fi 6, Bluetooth 5.1"
                }
            }
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
                        document.getElementById('modal-rating').innerHTML = `<i class="bi bi-star-fill text-warning"></i> ${product.rating}`;
                        
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