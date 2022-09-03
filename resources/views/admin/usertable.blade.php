@include('updatelayout.header')
 <title>
   Geohomes | Dashboard
  </title>
  @include('updatelayout.navbar')
   <div class="container-fluid py-4">
      <div class="row">
        <h6 class="d-flex mb-4 mt-4">List Of Available Users</h6>
  
  @if(empty($user))
   <div class="alert alert-warning col-lg-12 text-center">
   <strong>Sorry, The table is Empty.</strong>
  </div>
   @else

@foreach($user as $row)
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
  <div class="card mt-4 mb-4 ml-4 " style="width:24rem; max-height:25rem ;">
    <ul class="list-group list-group-flush">
      <li class="list-group-item"> {{$row->email}}</li>
      <li class="list-group-item">Assigned Role: {{$row->role}}</li>
      <li class="list-group-item">Created : {{ Carbon\Carbon::parse($row->created_at)->diffForHumans() }}</li>
       <h6 class="m-3 list-group-item">Assign Action</h6>
       <div class=" d-flex justify-content-around">
        @if($row->update==1)
        <a  href="">Update<i style="color:green;" class="cursor-pointer p-1 fas fa-check"></i></a>
        @else
        <a  href="">Update<i style="color:grey;" class="cursor-pointer p-1 fas fa-check"></i></a>
        @endif
        
         @if($row->view==1)
        <a  href="">View<i style="color:green;" class="cursor-pointer p-1 fas fa-check"></i></a>
        @else
        <a  href="">view<i style="color:grey;" class="cursor-pointer p-1 fas fa-check"></i></a>
        @endif
        
         @if($row->create==1)
        <a  href="">create<i style="color:green;" class="cursor-pointer p-1 fas fa-check"></i></a>
        @else
        <a  href="">create<i style="color:grey;" class="cursor-pointer p-1 fas fa-check"></i></a>
        @endif
        
         @if($row->delete==1)
        <a  href="">Delete<i style="color:green;" class="cursor-pointer p-1 fas fa-check"></i></a>
        @else
        <a  href="">Delete<i style="color:grey;" class="cursor-pointer p-1 fas fa-check"></i></a>
        @endif
        
      </div>
      <p class="m-3 list-group-item"></p>
      <div class="card-footer d-flex justify-content-between">
       <a class=" btn btn-success" href="" name="{{$row->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="fas fa-edit" ></i></a>
       <a  class=" btn btn-danger"   data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fas fa-trash" href="viewuser/{{$row->id}}"></i></a> 
      </div>
    </ul>
  </div>
</div>
   @endforeach
  @endif
    </div>
      </div>

     

       <!-- Delete Modal -->
@foreach($user as $row)
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-contact contact_form" action="viewuser/{{$row->id}}" method="POST" enctype="multipart/form-data" novalidate="novalidate">
      <div class="modal-body">
        <p>The Data will be deleted completely. Do you wish to proceed?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" class="btn btn-warning" >Yes</button>
      </div>
    </form>
    </div>
  </div>
</div>
 @endforeach

<!-- Update user modal  -->
  @foreach($user as $row)
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{route('updateuser')}}">
                    <div class="mb-3">
                      <label for="recipient-email" class="col-form-label">Email:</label>
                      <input type="email" name="email" class="form-control" required="" placeholder="user@email.com">
                    </div>
                     <div class="mb-3">
                     <label for="role" class="col-form-label">User Role:</label>
                    <select name="role" id="role"  class="form-control" required="">
                      <option class="mt-4 mb-3" value="manager">manager</option>
                      <option class="mb-3" value="admin">admin</option>
                    </select>
                  </div>
                     <div class="mb-3">
                      <label for="recipient-password" class="col-form-label">Password:</label>
                      <input type="password" name="password" class="form-control" required="" placeholder="***********">
                    </div>
                     <input type="hidden" value="{{$row->id}}" name="id">
                     <div class="modal-footer d-flex justify-content-between">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  
                  <button type="submit" class="btn btn-info" style=" color: white;">Update</button>
                </div>
                  </form>
                </div>
              

              </div>
            </div>
          </div>
          @endforeach

       @include('updatelayout.footer')
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../admin/assets/js/soft-ui-dashboard.min.js?v=1.0.5"></script>
</body>

</html>