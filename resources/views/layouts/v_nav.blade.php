<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header"></li>
        <li class="nav-header"></li>
        <li class="nav-header"></li>
        <li class="nav-header"></li>
        <li class="nav-header"></li>
        <li class="nav-header"></li>
        <li class="nav-header"></li>
        <li class="nav-header"></li>
        
        <li class="nav-item">
            <a href="/consoles" 
            class="nav-link {{ request()->is('consoles') ? 'active' : ' '}}">
            <i class="fas fa-gamepad nav-icon"></i>
            <p>Consoles</p>
            </a>    
        </li>
 
        <li class="nav-item">
            <a href="/orders" 
            class="nav-link {{ request()->is('orders') ? 'active' : ' '}}">
            <i class="fas fa-shopping-cart nav-icon"></i>
            <p>Orders</p>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="/users" 
            class="nav-link {{ request()->is('users') ? 'active' : ' '}}">
            <i class="fa fa-user nav-icon"></i>
            <p>Users</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="/logout" 
            class="nav-link">
            <i class="fa fa-power-off nav-icon"></i>
            <p>Log Out</p>
            </a>
        </li>
    </ul>
</nav>