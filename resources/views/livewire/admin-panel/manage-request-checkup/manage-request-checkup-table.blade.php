<div>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="col-md-12 col-sm-12 ">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Manage Checkup Request</h3>
                    </div>
                </div>
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Request No.</th>
                                                <th>College Department</th>
                                                <th>School ID</th>
                                                <th>Name</th>
                                                <th>Schedule</th>
                                                <th>Purpose</th>
                                                <th>Status</th>
                                                <th class="notexport">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($RequestCheckupData as $data)
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <td>{{ $data->getUser->getDeptID->department_name }}</td>
                                                    <td>{{ $data->getUser->id_number }}</td>
                                                    <td>{{ $data->getUser->name }}</td>
                                                    <td>{{ date("Y-m-d h:i A", strtotime($data->schedule)) }}</td>
                                                    <td>{{ $data->purpose }}</td>
                                                    <td style="<?php
                                                    if($data->getStatus->id==2){
                                                        echo "color:green";
                                                    }
                                                    if($data->getStatus->id==5){
                                                        echo "color:red";
                                                    }
                                                    ?>">{{ $data->getStatus->status_name }}</td>
                                                    <td>
                                                        <button  class="py-0 btn btn-sm btn-secondary" wire:click="editRequestCheckup({{$data->id}})"><i class="fa fa-eye"></i>View</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    <!-- CREATE EDIT MODAL -->
    <div wire.ignore.self class="modal fade" id="requestcheckupModal" role="dialog" aria-labelledby="requestcheckupModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <livewire:admin-panel.manage-request-checkup.manage-request-check-view />
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    

    <!-- View history -->
    <div wire.ignore.self class="modal fade" id="historyviewModal" role="dialog" aria-labelledby="historyviewModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%) !important;box-shadow: 0 0 500px 500px rgb(22, 22, 22, 0.185)">
            <div class="modal-content">
                <livewire:admin-panel.manage-request-checkup.history-view />
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>

@section('custom_script')
    @include('layouts.scripts.manage-request-checkup-scripts');
@endsection
