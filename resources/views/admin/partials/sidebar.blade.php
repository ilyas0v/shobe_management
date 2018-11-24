<div class="main-sidebar" tabindex="1" style="overflow: hidden; outline: none;">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Department management</a>
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
                <a href="#" class="has-dropdown"><i class="ion ion-ios-albums-outline"></i><span>Department</span></a>
                <ul class="menu-dropdown">
                    <li><a href="{{route('department.index')}}"><i class="ion ion-ios-circle-outline"></i> All departments</a></li>
                    <li><a href="{{route('department.create')}}"><i class="ion ion-ios-circle-outline"></i> Add department</a></li>
                </ul>
            </li>

            <li>
                <a href="#" class="has-dropdown"><i class="ion ion-ios-albums-outline"></i><span>Employee</span></a>
                <ul class="menu-dropdown">
                    <li><a href="{{route('employee.index')}}"><i class="ion ion-ios-circle-outline"></i> All employee</a></li>
                    <li><a href="{{route('employee.create')}}"><i class="ion ion-ios-circle-outline"></i> Add employee</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>