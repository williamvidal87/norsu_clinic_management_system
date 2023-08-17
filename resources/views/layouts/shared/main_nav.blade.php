
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li>
                    <a href="/dashboard"><i class="fa fa-dashboard"></i>Dashboard</a>
                  </li>
                  @if(Auth::user()->rule_id==2)
                    <li>
                        <a href="/request-checkup-table"><i class="fa fa-stethoscope"></i>Request Checkup</a>
                    </li>
                  @endif
                  @if(Auth::user()->rule_id==1)
                    <li>
                        <a href="/manage-checkup-request-table"><i class="fa fa-stethoscope"></i>Manage Checkup Request</a>
                    </li>
                    <li>
                        <a href="/walk-in-table"><i class="fa fa-wheelchair"></i>Walk In</a>
                    </li>
                    <li>
                        <a href="/medicine-inventory-table"><i class="fa fa-medkit"></i>Medicine Inventory</a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
