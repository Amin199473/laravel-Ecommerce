<!-- Footer -->
<footer class="text-center text-lg-start text-white mt-5 bg-dark">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
        <!-- Section: Links -->
        <section class="">
            <!--Grid row-->
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold">
                        Company name
                    </h6>
                    <p style="color: white !important">
                        Here you can use rows and columns to organize your footer
                        content. Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit.
                    </p>
                </div>
                <!-- Grid column -->

                <hr class="w-100 clearfix d-md-none" />

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Useful links</h6>
                    <p>
                        <a href="{{ route('welcome') }}" class="text-white">Home</a>
                    </p>
                    <p>
                        <a href="{{ route('products.index') }}" class="text-white">Shop</a>
                    </p>
                    <p>
                        <a href="{{ route('allPosts') }}" class="text-white">Blog</a>
                    </p>
                    <p>
                        <a href="{{ route('aboutUs') }}" class="text-white">About Us</a>
                    </p>
                    <p>
                        <a href="{{ route('contactUs') }}" class="text-white">Contant Us</a>
                    </p>
                </div>
                <!-- Grid column -->

                <hr class="w-100 clearfix d-md-none" />

                <!-- Grid column -->
                <hr class="w-100 clearfix d-md-none" />

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                    <p style="color: white !important"><i class="fas fa-home mr-3"></i> {{ $setting->address }}</p>
                    <p style="color: white !important"><i class="fas fa-envelope"></i> {{ $setting->email }}</p>
                    <p style="color: white !important"><i class="fas fa-phone mr-3"></i> {{ $setting->phone }}</p>
                    <p style="color: white !important"><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Follow us</h6>

                    <!-- Facebook -->
                    <a href="{{ $setting->whatsapp }}" class="btn btn-primary btn-floating m-1" style="background-color: #3b5998" href="#!" role="button"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>

                    <!-- Twitter -->
                    <a href="{{ $setting->tweeter }}" class="btn btn-primary btn-floating m-1" style="background-color: #55acee" href="#!" role="button"><i class="fab fa-twitter"></i></a>

                    <!-- YouTube -->
                    <a href="{{ $setting->youTube }}" class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39" href="#!" role="button"><i class="fa fa-youtube" aria-hidden="true"></i></a>

                    <!-- Instagram -->
                    <a href="{{ $setting->instagram }}" class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac" href="#!" role="button"><i class="fab fa-instagram"></i></a>

                    <!-- telegram -->
                    <a href="{{ $setting->telegram }}" class="btn btn-primary btn-floating m-1" style="background-color: #0082ca" href="#!" role="button"><i class="fa fa-telegram" aria-hidden="true"></i></a>
                </div>
            </div>
            <!--Grid row-->
        </section>
        <!-- Section: Links -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © {{ Carbon\Carbon::now()->format('Y') }} Copyright:
        <a class="text-white">{{ $setting->copy_right }}</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
