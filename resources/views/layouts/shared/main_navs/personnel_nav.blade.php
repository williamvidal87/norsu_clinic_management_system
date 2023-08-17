<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    
    <li class="nav-item">
        <a href="personnel-work-ticket" class="nav-link">
            <i class="nav-icon fas fa-ticket-alt"></i>
            <p>Work Tickets</p>
                    <livewire:admin-panel.badge.work-ticket-approve-badge />
                    <livewire:admin-panel.badge.work-ticket-ongoing-badge />
        </a>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fas fa-tools nav-icon"></i>
            <p>
                Inventory & Services
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul style="margin-left: 1rem" class="nav nav-treeview">
            <li class="nav-item">
                <a href="personnel-equipment" class="nav-link">
                    <i class="far fa fa-wrench nav-icon"></i>
                    <p>Services</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="personnel-inventory-equipment" class="nav-link">
                    <i class="far fas fa-toolbox nav-icon"></i>
                    <p>Inventory Equipment</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon far fa-plus-square"></i>
            <p>Extras<i class="fas fa-angle-left right"></i></p>
        </a>
        <ul style="margin-left: 1rem" class="nav nav-treeview">
            <li class="nav-item">
                <a href="personnel-service-type" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Service Type</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="activity-logs" class="nav-link">
            <i class="nav-icon fas fa-history"></i>
            <p>Activity Logs</p>
        </a>
    </li>
</ul>