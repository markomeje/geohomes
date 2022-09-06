@include('updatelayout.header')
<title>
 Geohomes | Registered Users
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
  <div class="container">
   <!-- it gives feedback messages -->
   @if($message = Session::get('success'))
   <div class="alert">
    <p style="color:#0EA10F;">{{$message}}</p>
   </div>
   @endif

   @if($message = Session::get('error'))
   <div class="alert">
    <p style="color:red;">{{$message}}</p>
   </div>
   @endif
  </div>
  <!-- feedback message ends here -->
  @foreach($user as $row)
  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="margin-right:100px !important;" >
   <div class="card mt-4 mb-4 ml-4 " style="width:20rem; max-height:26rem; ">
    <ul class="list-group list-group-flush">
     <li class="list-group-item"> {{$row->email}}</li>
     <li class="list-group-item">Assigned Role: {{$row->role}}</li>
     <li class="list-group-item">Created : {{ Carbon\Carbon::parse($row->created_at)->diffForHumans() }}</li>
     <h6 class="m-3 list-group-item">Assign Action</h6>
     <div class=" d-flex justify-content-around mb-4">

      <!-- This code handles granting of Access to user -->
      @if($row->update==1)
      <a href="{{route('updateDeny', $row->id)}}" onclick="event.preventDefault();document.getElementById('updateDeny-{{$row->id}}').submit()">Update<i style="color:green;" class="cursor-pointer p-1 fas fa-check"></i></a>

      <form style="display: none;" id="{{'updateDeny-'.$row->id}}" method="post" action="{{route('updateDeny', $row->id)}}">

      </form>
      @else
      <a href="{{route('updateAllow', $row->id)}}" onclick="event.preventDefault();document.getElementById('updateAccess-{{$row->id}}').submit()">Update<i style="color:grey;" class="cursor-pointer p-1 fas fa-check"></i></a>

      <form style="display: none;" id="{{'updateAccess-'.$row->id}}" method="post" action="{{route('updateAllow', $row->id)}}">

      </form>
      @endif

      @if($row->view==1)
      <a href="{{route('viewDeny', $row->id)}}" onclick="event.preventDefault();document.getElementById('viewDeny-{{$row->id}}').submit()">View<i style="color:green;" class="cursor-pointer p-1 fas fa-check"></i></a>

      <form style="display: none;" id="{{'viewDeny-'.$row->id}}" method="post" action="{{route('viewDeny', $row->id)}}">

      </form>
      @else
      <a href="{{route('viewAllow', $row->id)}}" onclick="event.preventDefault();document.getElementById('viewAccess-{{$row->id}}').submit()">Delete<i style="color:grey;" class="cursor-pointer p-1 fas fa-check"></i></a>

      <form style="display: none;" id="{{'viewAccess-'.$row->id}}" method="post" action="{{route('viewAllow', $row->id)}}">

      </form>
      @endif
     </div>
     <div class=" d-flex justify-content-around mb-4">
      @if($row->create==1)
      <a href="{{route('createDeny', $row->id)}}" onclick="event.preventDefault();document.getElementById('createDeny-{{$row->id}}').submit()">Create<i style="color:green;" class="cursor-pointer p-1 fas fa-check"></i></a>

      <form style="display: none;" id="{{'createDeny-'.$row->id}}" method="post" action="{{route('createDeny', $row->id)}}">

      </form>
      @else
      <a href="{{route('createAllow', $row->id)}}" onclick="event.preventDefault();document.getElementById('createAccess-{{$row->id}}').submit()">Create<i style="color:grey;" class="cursor-pointer p-1 fas fa-check"></i></a>

      <form style="display: none;" id="{{'createAccess-'.$row->id}}" method="post" action="{{route('createAllow', $row->id)}}">

      </form>
      @endif

      @if($row->delete==1)
      <a href="{{route('deleteDeny', $row->id)}}" onclick="event.preventDefault();document.getElementById('deleteDeny-{{$row->id}}').submit()">Delete<i style="color:green;" class="cursor-pointer p-1 fas fa-check"></i></a>

      <form style="display: none;" id="{{'deleteDeny-'.$row->id}}" method="post" action="{{route('deleteDeny', $row->id)}}">

      </form>
      @else
      <a href="{{route('deleteAllow', $row->id)}}" onclick="event.preventDefault();document.getElementById('deleteAccess-{{$row->id}}').submit()">Delete<i style="color:grey;" class="cursor-pointer p-1 fas fa-check"></i></a>

      <form style="display: none;" id="{{'deleteAccess-'.$row->id}}" method="post" action="{{route('deleteAllow', $row->id)}}">

      </form>
      @endif
      <!-- The end of user Access granting -->
     </div>
     <p class="m-3 list-group-item"></p>
     <div class="card-footer d-flex justify-content-between" style="padding:15px;">
      <a class=" btn btn-success" href="" name="{{$row->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="fas fa-edit" ></i></a>
      <a  class=" btn btn-danger"   data-bs-toggle="modal" data-bs-target="#staticBackdrop" href="deleteuser/{{$row->id}}"><i class="fas fa-trash"></i></a> 
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
   <form class="form-contact contact_form" action="deleteuser/{{$row->id}}" method="POST" enctype="multipart/form-data" novalidate="novalidate">
    <input type="hidden" name="id" value="{{$row->id}}">
    <div class="modal-body">
     <p>The User will be deleted completely. Do you wish to proceed?</p>
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