   @include('layout.header')
<title>GeoHomes | Real Estate</title>

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

      <main>
        <!--? Hero Start -->
        <div class="slider-area2 section-bg2" data-background="assets/img/hero/hero6.png">
            <div class="slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2">
                                <h2>Real Estates</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->
        <!-- Product-detals-header Start -->
                     
        <div class="categories-area section-padding40">
            <div class="container">
                <div class="row">
                  @if(empty($estate))
                      <div class="alert alert-warning col-lg-12 text-center">
                        <strong>No Content Available Yet.</strong>
                      </div>
                     @else
                      @foreach($estate as $row)
                         <div class="col-xl-8 col-lg-9 col-md-12">
                        <div class="about-caption mb-70">
                            <div class="section-tittle mb-10">
                                <h2>{{$row->title}}</h2>
                            </div>
                            <p>{{$row->titledescription}}</p>
                        </div>
                    </div>
                         <div class="col-sm-12 col-xl-6 col-lg-6 col-md-6">
                        <div class="singel-details-img mt-0">
                            <img src="{{asset('assets/upload/estate_images/'.$row->first_image) }}" alt=""  class="img-responsive img-fluid w-100 img-thumbnail">
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6 col-lg-6 col-md-6">
                        <div class="about-caption mt-40">
                             <span style="color: #0EA15F">01.</span>
                                    <hp style="color: black">{{$row->first_description}}</p>
                                     
                            </div>
                    </div>
                    <div class="col-sm-12 col-xl-6 col-lg-6 col-md-6">
                        <div class="about-caption mt-40">
                             <span style="color: #0EA15F">02.</span>
                                    <p style="color: black">{{$row->second_description}}</p>
                                      
                            </div>
                    </div>

                     <div class="col-sm-12 col-xl-6 col-lg-6 col-md-6">
                        <div class="singel-details-img mt-20">
                            <img src="{{asset('assets/upload/estate_images/'.$row->second_image) }}" alt=""  class="img-responsive img-fluid w-100 img-thumbnail">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12 col-xl-6 col-lg-6 col-md-6">
                        <div class="singel-details-img mt-20">
                            <img src="{{asset('assets/upload/estate_images/'.$row->third_image) }}" alt=""  class="img-responsive img-fluid w-100 img-thumbnail">
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-xl-6 col-lg-6 col-md-6">
                        <div class="about-caption  mt-40 mb-10">
                                <span style="color: #0EA15F">03.</span>
                                    <p style="color: black">{{$row->third_description}}</p>
                          
                         </div>
                         <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-4 ">
                           <a href="{{route('book-inspection')}}" class="btn hero-btn mt-20" style="background:#0EA15F;" >Booking</a>
                        </div>
                         <div class="col-sm-12 col-md-6 col-lg-4 ">
                           <a href="{{route('cis-form')}}" class="btn hero-btn mt-20" style="background:#0EA15F;" >CIS Form</a>
                        </div>
                         <div class="col-sm-12 col-md-6 col-lg-4 ">
                           <a href="{{route('application-form')}}" class="btn hero-btn mt-20" style="background:#0EA15F;" >Application</a>
                        </div>
                    </div>
                    <div class="row">
                         <div class="col-sm-12 col-md-6 col-lg-4 ">
                           <a href="{{route('property-form')}}" class="btn hero-btn mt-20" style="background:#0EA15F;" >Property Search</a>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-4 ">
                           <a  href="{{route('site-form')}}" class="btn hero-btn mt-20" style="background:#0EA15F;" >Book Site Inspection</a>
                        </div>
                    </div>
                       
                         <!--  Dropdown real Estate form
                                <div class="dropdown mt-0 mb-80">
                              <button class="dropbtn">Real Estate</button>
                            <div class="dropdown-content">
                            <a href="{{route('book-inspection')}}">Booking</a>
                            <a href="{{route('cis-form')}}">CIS Form</a>
                            <a href="{{route('site-form')}}">Book Site Inspection</a>
                            <a href="{{route('application-form')}}">Application</a>
                            <a href="{{route('property-form')}}">Property Search</a>
                          </div>
                        </div>
                         Dropdown real Estate form ends here-->
                      </div>
                         <div class="col-lg-12 mt-40">
                        <nav class="blog-pagination justify-content-center d-flex">
                                <ul class="pagination">
                                    <li class="page-item">
                                        
                                    {{ $estate->links('vendor.pagination.default') }}
                                    
                                   </li>
                                </ul>
                            </nav>
                           
                        </div>
                           @endforeach
                         @endif
                    </div>
                     
                </div>
                                
                </div>
                </div>
    <!-- Estates Detail End -->

     @include('layout.footer')
</body>
</html>