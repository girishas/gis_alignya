<li class="dropdown-submenu"><a class="dropdown-item" href="{!!url('department/'.$department->id)!!}">{!!$department->department_name!!}</a>
	<ul class="dropdown-menu">
		@foreach(getSubDepartment($department->id) as $ky => $vs)
	    @if(empty(getSubDepartment($vs['id'])))
	    <li class="dropdown-item"><a href="{!!url('department/'.$vs['id'])!!}">{!! $vs['department_name']!!}</a></li>
	   	@else
	   	    <li class="dropdown-submenu"><a class="dropdown-item" href="{!!url('department/'.$vs['id'])!!}">{!!$vs['department_name']!!}</a>
            <ul class="dropdown-menu">
            	@foreach(getSubDepartment($vs['id']) as $ky => $vs)
                <li class="dropdown-item"><a href="{!!url('department/'.$vs['id'])!!}">{!!$vs['department_name']!!}</a></li>
                @endforeach
            </ul>
          </li>
	    @endif
	    @endforeach
	</ul>
</li>