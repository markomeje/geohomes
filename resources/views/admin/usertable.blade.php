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
  
  <!--<tbody
   <table class="table align-middle mb-0 bg-white">
  <thead class="bg-light">
    <tr>
      <th>S/N</th>
      <th>Email</th>
      <th>Role</th>
      <th>Date</th>
      <th>Actions</th>
    </tr>
  </thead>>
    <tr>
      <td>
        <div class="d-flex align-items-center">
          <div class="ms-3">
            <p class="text-muted mb-0"></p>
          </div>
        </div>
      </td>
        <td>
        <div class="d-flex align-items-center">
          <div class="ms-3">
            <p class="text-muted mb-0"></p>
          </div>
        </div>
      </td>
        <td>
        <div class="d-flex align-items-center">
          <div class="ms-3">
            <p class="text-muted mb-0" style="color:green;"></p>
          </div>
        </div>
      </td>
        <td>
        <div class="d-flex align-items-center">
          <div class="ms-3">
            <p class="text-muted mb-0"></p>
          </div>
        </div>
      </td>
      <td>
        <div class="d-flex align-items-center">
          <div class="ms-3">
            <p class="text-muted mb-0" >Edit</p>
          </div>
        </div>
      </td>
    <tr>
  </tbody>
</table>-->

@foreach($user as $row)
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
  <div class="card mt-4 mb-4 ml-4 " style="width: 18rem; height:12rem;">
    <ul class="list-group list-group-flush">
      <li class="list-group-item"> {{$row->email}}</li>
      <li class="list-group-item">Role: {{$row->role}}</li>
      <li class="list-group-item">Created : {{ Carbon\Carbon::parse($row->created_at)->diffForHumans() }}</li>
      <div class="card-footer d-flex justify-content-between">
       <a class=" btn btn-success" href="" name="{{$row->id}}" ><i class="fas fa-edit" ></i></a>
       <a  class=" btn btn-danger"  data-bs-toggle="modal" data-bs-target="#staticBackdrop" ><i class="fa fa-trash" aria-hidden="true"></i></a> 
      </div>
    </ul>
  </div>
</div>
   @endforeach
  @endif
    </div>
      </div>

      @foreach($user as $row)
      <!-- Modal -->

      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form class="form-contact contact_form" action="}" method="POST" enctype="multipart/form-data" novalidate="novalidate">
            <div class="modal-body">
              <p>Do you want to delete This user?</p>
            </div>
            <div class="modal-footer d-flex justify-content-between">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
              <button type="submit" class="btn btn-warning" >Yes</button>
            </div>
          </form>
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