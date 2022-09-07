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
      <a href="{{route('viewAllow', $row->id)}}" onclick="event.preventDefault();document.getElementById('viewAccess-{{$row->id}}').submit()">View<i style="color:grey;" class="cursor-pointer p-1 fas fa-check"></i></a>

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