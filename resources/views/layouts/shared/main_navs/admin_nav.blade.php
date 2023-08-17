<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa fa-rocket nav-icon"></i>
            <p>
                Manage Request
                <i class="fas fa-angle-left right"></i>
                    <livewire:admin-panel.badge.manage-request-badge />
            </p>
        </a>
        <ul style="margin-left: 1rem" class="nav nav-treeview">
            <li class="nav-item">
                <a href="admin-technical-request" class="nav-link">
                    <i class="far fa fa-wrench nav-icon"></i>
                    <p>Technical Request
                        <livewire:admin-panel.badge.technical-request-badge />
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="admin-support-request" class="nav-link">
                    <i class="far fa fa-life-ring nav-icon"></i>
                    <p>Support Request
                        <livewire:admin-panel.badge.support-request-badge />
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="admin-borrow-request" class="nav-link">
                    <i class="far fas fa-cart-arrow-down nav-icon"></i>
                    <p>Borrowed Request
                        <livewire:admin-panel.badge.borrow-request-badge />
                    </p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="admin-work-ticket" class="nav-link">
            <i class="nav-icon fas fa-ticket-alt"></i>
            <p>Manage Work Tickets</p>
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
                <a href="admin-equipment" class="nav-link">
                    <i class="far fa fa-wrench nav-icon"></i>
                    <p>Services</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="inventory-equipment" class="nav-link">
                    <i class="far fas fa-toolbox nav-icon"></i>
                    <p>Inventory Equipment</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa fa-user nav-icon"></i>
            <p>
                Manage Users
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul style="margin-left: 1rem" class="nav nav-treeview">
            <li class="nav-item">
                <a href="admin-client-table" class="nav-link">
                    <i class="far fa fa-paper-plane nav-icon"></i>
                    <p>Client</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="admin-admin-table" class="nav-link">
                    <i class="far fa fa-server nav-icon"></i>
                    <p>Admin</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="admin-personnel-table" class="nav-link">
                    <i class="far fas fa-inbox nav-icon"></i>
                    <p>Personnel</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fas fa-tasks nav-icon"></i>
            <p>
                Manage Records
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul style="margin-left: 1rem" class="nav nav-treeview">
            <li class="nav-item">
                <a href="inventory-report" class="nav-link">
                    <i class="far fas fa-list nav-icon"></i>
                    <p>Inventory Report</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="accomplishment-report" class="nav-link">
                    <i class="far fa fa-check nav-icon"></i>
                    <p>Accomplishments Report</p>
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
                <a href="service-type" class="nav-link">
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