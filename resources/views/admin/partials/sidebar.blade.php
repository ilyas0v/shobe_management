<div class="main-sidebar" tabindex="1" style="overflow: hidden; outline: none;">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Management</a>
        </div>
        <div class="sidebar-user">
            <div class="sidebar-user-picture">
                <img alt="image" src="{{asset('dist/img/avatar/avatar-1.jpeg')}}">
            </div>
            <div class="sidebar-user-details">
                <div class="user-name">{{Auth::user()->name}}</div>
                <div class="user-role">
                    Administrator
                </div>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="active">
                <a href="{{route('admin.main')}}"><i class="ion ion-speedometer"></i><span>Dashboard</span></a>
            </li>

            <li class="menu-header">Components</li>

            <li>
                <a href="{{route('reports.index')}}"><i class="ion ion-ios-albums-outline"></i><span>{{__('content.reports')}}</span></a>
            </li>

            <li>
                <a href="#" class="has-dropdown"><i class="ion ion-ios-albums-outline"></i><span>{{__('content.departments')}}</span></a>
                <ul class="menu-dropdown">
                    <li><a href="{{route('department.index')}}"><i class="ion ion-ios-circle-outline"></i> All departments</a></li>
                    <li><a href="{{route('department.create')}}"><i class="ion ion-ios-circle-outline"></i> Add department</a></li>
                </ul>
            </li>

            <li>
                <a href="#" class="has-dropdown"><i class="ion ion-ios-albums-outline"></i><span>{{__('content.employee')}}</span></a>
                <ul class="menu-dropdown">
                    <li><a href="{{route('employee.index')}}"><i class="ion ion-ios-circle-outline"></i> All employee</a></li>
                    <li><a href="{{route('employee.create')}}"><i class="ion ion-ios-circle-outline"></i> Add employee</a></li>
                </ul>
            </li>

            <li>
                <a href="#" class="has-dropdown"><i class="ion ion-ios-albums-outline"></i><span>{{__('content.rooms')}}</span></a>
                <ul class="menu-dropdown">
                    <li><a href="{{route('room.index')}}"><i class="ion ion-ios-circle-outline"></i> All rooms</a></li>
                    <li><a href="{{route('room.create')}}"><i class="ion ion-ios-circle-outline"></i> Add room</a></li>
                </ul>
            </li>

            <li>
                <a href="#" class="has-dropdown"><i class="ion ion-ios-albums-outline"></i><span>{{__('content.equipment')}}</span></a>
                <ul class="menu-dropdown">
                    <li><a href="{{route('equipment.index')}}"><i class="ion ion-ios-circle-outline"></i> All equipment</a></li>
                    <li><a href="{{route('equipment.create')}}"><i class="ion ion-ios-circle-outline"></i> Add equipment</a></li>
                </ul>
            </li>

            <li>
                <a href="#" class="has-dropdown"><i class="ion ion-ios-albums-outline"></i><span>{{__('content.tasks')}}</span></a>
                <ul class="menu-dropdown">
                    <li><a href="{{route('task.index')}}"><i class="ion ion-ios-circle-outline"></i> All task</a></li>
                    <li><a href="{{route('task.create')}}"><i class="ion ion-ios-circle-outline"></i> Add task</a></li>
                </ul>
            </li>

            <li>
                <a href="{{route('act.index')}}"><i class="ion ion-ios-albums-outline"></i><span>{{__('content.acts')}}</span></a>
            </li>

        </ul>
    </aside>
</div>