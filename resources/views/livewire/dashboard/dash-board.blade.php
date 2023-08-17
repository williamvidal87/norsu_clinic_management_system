<div>
        <div class="right_col" role="main">
          <!-- top tiles --><div class="row" style="display: inline-block;">
          <div class="tile_count">
            <div class="col-md-2 col-sm-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Users</span>
              <div class="count" style="width:20rem">{{ count($User) }}</div>
            </div>
            <div class="col-md-2 col-sm-4 tile_stats_count">
              <span class="count_top green"><i class="fa fa-user"></i> Admins</span>
              <div class="count green" style="width:20rem">{{ count($Admin) }}</div>
            </div>
            <div class="col-md-2 col-sm-4 tile_stats_count">
              <span class="count_top red"><i class="fa fa-user"></i> Patients</span>
              <div class="count red" style="width:20rem">{{ count($Patient) }}</div>
            </div>
            <div class="col-md-2 col-sm-4 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Pending</span>
              <div class="count" style="width:20rem">{{ count($Pending) }}</div>
            </div>
            <div class="col-md-2 col-sm-4 tile_stats_count">
              <span class="count_top green"><i class="fa fa-wheelchair"></i> Complied</span>
              <div class="count green" style="width:20rem">{{ count($Complied) }}</div>
            </div>
          </div>
        </div>
          <!-- /top tiles -->
        </div>
</div>
