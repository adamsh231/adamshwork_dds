<!-- ***** Welcome Area Start ***** -->
<section class="welcome-area">
    <div class="welcome-slides owl-carousel">

        <?php for ($i = 0; $i < 3; $i++) { ?>
            <!-- Single Welcome Slide -->
            <div class="single-welcome-slide">
                <!-- Background Curve -->
                <div class="background-curve">
                    <img src="<?php echo base_url() ?>uza/img/core-img/curve-1.png" alt="">
                </div>

                <!-- Welcome Content -->
                <div class="welcome-content h-100">
                    <div class="container h-100">
                        <div class="row h-100 align-items-center">
                            <!-- Welcome Text -->
                            <div class="col-12 col-md-6">
                                <div class="welcome-text">
                                    <h2 data-animation="fadeInUp" data-delay="100ms">Lindungi Anak Anda Dari Resiko <span>Stunting</span></h2>
                                    <h5 data-animation="fadeInUp" data-delay="400ms">Sebuah aplikasi yang digunakan untuk memonitor pertumbuhan anak anda</h5>
                                    <a href="<?php echo base_url() ?>index.php/DDS/index/login" class="btn uza-btn btn-2" data-animation="fadeInUp" data-delay="700ms">Login</a>
                                </div>
                            </div>
                            <!-- Welcome Thumbnail -->
                            <div class="col-12 col-md-6">
                                <div class="welcome-thumbnail">
                                    <img src="<?php echo base_url() ?>uza/img/bg-img/1x.png" alt="" data-animation="slideInRight" data-delay="400ms">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</section>
<!-- ***** Welcome Area End ***** -->

<!-- ***** About Us Area Start ***** -->
<section class="uza-about-us-area">
    <div class="container">
        <div class="row align-items-center">

            <!-- About Thumbnail -->
            <div class="col-12 col-md-6">
                <div class="about-us-thumbnail mb-80">
                    <img src="<?php echo base_url() ?>uza/img/bg-img/2x.png" alt="">
                    <!-- Video Area -->
                    <div class="uza-video-area hi-icon-effect-8">
                        <a href="https://www.youtube.com/watch?v=8TPbuXm1Jro" class="hi-icon video-play-btn"><i class="fa fa-play" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>

            <!-- About Us Content -->
            <div class="col-12 col-md-6">
                <div class="about-us-content mb-80">
                    <h2>Apa itu stunting??</h2>
                    <p>Stunting (kerdil) adalah kondisi dimana anak bulan memiliki  tinggi badan yang kurang jika dibandingkan dengan anak seusianya. Stunting merupakan pertanda telah terjadi kekurangan gizi kronik (waktu lama) yang berpengaruh buruk terhadap pertumbuhan dan perkembangan anak.</p>
                    <p>
                        Akibatnya dari stunting ada 2 bagian
                        <br>
                        1. Jangka Panjang
                        <br>
                        2. Jangka Pendek
                        <br>
                        Mari simak videonya.
                    </p>
                    <!-- <a href="#" class="btn uza-btn btn-2 mt-4">Start Exploring</a> -->
                </div>
            </div>
        </div>
    </div>


    <!-- LOKASI  -->
    <div class="container">
        <div class="row align-items-center">

            <div class="about-us-content mb-80">
                <h3>Lokasi</h3>

                <hr />
                <div id="address"></div>
                <div id="koordinat"></div>
            </div>
        </div>
    </div>

    <!-- About Background Pattern -->
    <div class="about-bg-pattern">
        <img src="<?php echo base_url() ?>uza/img/core-img/curve-2.png" alt="">
    </div>
</section>
<!-- ***** About Us Area End ***** -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    var x = document.getElementById("koordinat");

    if (screen.width < 1020) {
        getLokasi("mobile", "mobile");
    } else {
        geolocation();
    }

    function getLokasi(xx, xy) {
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/DDS_Json/lokasi",
            method: "POST",
            data: {
                x: xx,
                y: xy
            },
            success: function(data) {
                $('#address').html(data);
            }
        })
    }

    function geolocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude;
        getLokasi(position.coords.latitude, position.coords.longitude);
    }

    function showError(error) {
        getLokasi("block", "block");
        switch (error.code) {
            case error.PERMISSION_DENIED:
                x.innerHTML = "User denied the request for Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                x.innerHTML = "Location information is unavailable."
                break;
            case error.TIMEOUT:
                x.innerHTML = "The request to get user location timed out."
                break;
            case error.UNKNOWN_ERROR:
                x.innerHTML = "An unknown error occurred."
                break;
        }
    }
</script>