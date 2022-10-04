   @include('layout.header')
<title>GeoHomes | Affiliate</title>

<!-- Google tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-203737296-1">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-203737296-1');
</script>
<!-- end of google analytics code -->
</head>

<body>


    <!-- Header -->
      @include('layout.navbar')
    </header>
 <!--? Hero Start -->
        <div class="slider-area2 section-bg2" data-background="assets/img/materials/affiliate.jpg">
            <div class="slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2">
                                <h2>Affiliate</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->
        <section class="contact-section">
            <div class="container">
                <div class="row">
                     <!-- it gives feedback messages -->
                                      @if($message = Session::get('success'))
                                      <div class="alert">
                                        <p style="color:#0EA10F; font-weight: bold;">{{$message}}</p>
                                      </div>
                                      @endif

                                      @if($message = Session::get('first'))
                                      <div class="alert">
                                        <p style="color:red;font-weight: bold;">{{$message}}</p>
                                      </div>
                                      @endif
                                      <!-- feedback message ends here -->

                    <div class="col-12">
                    <h2 class="contact-title mt-0 p-0" style="color:#0EA15F">Please Fill The Form.</h2>
                    </div>
                     
                    <div class="col-lg-6">
                <form class="form-contact contact_form" action="{{route('affiliate')}}" method="post" novalidate="novalidate">
                            <div class="row">
                                <div class="col-sm-6 col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name">
                                        <span class="text-danger">{{$errors->first('name') }}</span>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-12 ">
                                    <div class="form-group">
                                        <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email">
                                        <span class="text-danger">{{$errors->first('email') }}</span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6  col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control" name="phone" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'phone'" placeholder="Mobile Line">
                                        <span class="text-danger">{{$errors->first('phone') }}</span>
                                    </div>
                                </div>
                                 
                            <div class="form-group mt-3 col-lg-12 col-sm-6">
                                <button type="submit" class="button button-contactForm boxed-btn" style="background:#0EA15F !important; color: black !important; border: none !important;">Submit</button>
                            </div>
                        </div>
                        </form>
                    </div>
                        <div class="col-sm-6 col-lg-6 col-md-6">
                        <div class="singel-details-img mt-0">
                            <img src="assets/img/materials/careers-banner.jpg" class="img-responsive img-fluid w-100" alt="">
                        </div>
                    </div>
                    </div>
                </div>
          </section>
        <!-- Contact form End -->
    <!-- Affiliate End -->
    
     @include('layout.footer')
</body>
</html>