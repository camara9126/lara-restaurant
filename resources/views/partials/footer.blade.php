
        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-2 mt-2 wow fadeIn" data-wow-delay="0.1s"              <div class="container py-2">
                <div class="row g-5">
                    <div class="col-6 col-lg-6 col-md-6">
                        <h4 class="section-title text-primary  mb-1">Zones</h4>
                        <a class="btn btn-link" href="">Ville</a>
                        <a class="btn btn-link" href="">Pikine</a>
                        <a class="btn btn-link" href="">Nord</a>
                        <a class="btn btn-link" href="">Darou</a>
                        <a class="btn btn-link" href="">Sor</a>
                    </div>
                    <div class="col-6 col-lg-6 col-md-6">
                        <h4 class="section-title text-primary mb-1">Contact</h4>
                        <p class=""><i class="fa fa-map-marker-alt"></i> &nbsp; St-Louis, SENEGAL</p>
                        <p class=""><i class="fa fa-phone-alt"></i> &nbsp; 78-547-08-38</p>
                        <p class=""><i class="fa fa-envelope"></i> &nbsp; contact@ofood.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <!--<a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>-->
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-12 col-lg-12 col-md-12">
                        <h4 class="section-title text-primary mb-1">Horaires</h4>
                        <p><b class="text-light">Lundi-Samedi</b></p>
                        <p>09h - 21h</p>
                        <b class="text-light">Dimanche</b>
                        <p>10h - 20h</p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="/">O'Food sn</a>, Tous Droit Reserve. 							
							Designed By <a class="border-bottom" href="https://www.bcmgroupe.com" target="_blank">BCM Groupe Saint-Louis</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>



    <!-- Service-Worker JS File -->
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/service-worker.js')
            .then(function(registration) {
                console.log('Service Worker enregistré avec le scope : ', registration.scope);
            })
            .catch(function(error) {
                console.log('Échec de l\'enregistrement du Service Worker : ', error);
            });
        }
    </script>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>