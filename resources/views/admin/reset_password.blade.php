
@include('adminLayout.header')
 <title>
   Geohomes | Password Reset
  </title>
<body class="">
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <p class="mb-0">Please Enter Your Email below to reset a new password.</p>

                
                @if(session('error'))
                <div class="alert alert-denger">
                <small style="color:red;">{{ session('error')}}</small>
            </div>
            @endif
               <!-- end of error messages -->
               </div>
                <div class="card-body">
               @if (session('success'))
                    <div class="col-sm-12">
                        <div class="alert  alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                <!-- <small class="text-danger">{{$errors->first('user_email') }}</small> -->
                <small class="text-danger">{{$errors->first('password') }}</small>

                  <form role="form" method="POST" action="{{route('passwordreset')}}" id="admin_form">
                    {{ csrf_field()}}
                        
                    <label>Email</label>
                    <div class="mb-3">
                      <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" name="email" required="email">
                       
                    </div>
                   <!--  <label>Password</label>
                    <div class="mb-3">
                      <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon" name="password" required="password">
                       
                    </div>
                    <label>Confirm Password</label>
                    <div class="mb-3">
                      <input type="password" class="form-control" placeholder="Confirm Password" aria-label="Password" aria-describedby="password-addon" name="password_confirmation" required="password">
                    </div> -->
                    <div class="text-center">
                      <button type="submit" class="btn w-100 mt-4 mb-0" style="background-color:#0EA10F !important; color:black;">Reset</button>
                    </div>
                  </form>
                   <div class="col-12 d-flex justify-content-center mt-4">
                  <p><u><a href="{{route('login')}}">Login?</a></u></p>
                </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('/assets/img/post/post.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  @include('adminLayout.footer');
  <script type="text/javascript">
    $('div.alert').delay(5000).slideUp(500);
  </script>
</body>

</html>