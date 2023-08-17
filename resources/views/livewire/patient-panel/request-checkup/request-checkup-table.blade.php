<div>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="col-md-12 col-sm-12 ">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Request Checkup</h3>
                    </div>
                </div>
                <button type="button" class="btn btn-primary"  wire:click="createRequestCheckup"><i class="fa fa-plus-circle"></i> Request Checkup</button>
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Request No.</th>
                                                <th>Schedule</th>
                                                <th>Purpose</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($RequestCheckupData as $data)
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <td>{{ date("Y-m-d h:i A", strtotime($data->schedule)) }}</td>
                                                    <td>{{ $data->purpose }}</td>
                                                    <td style="<?php
                                                    if($data->getStatus->id==2){
                                                        echo "color:green";
                                                    }
                                                    ?>">{{ $data->getStatus->status_name }}</td>
                                                    <td>
                                                        @if($data->getStatus->id==1)
                                                            <button  class="py-0 btn btn-sm btn-info" wire:click="editRequestCheckup({{$data->id}})"><i class="fa fa-edit"></i>Edit</button> |
                                                            <button  class="py-0 btn btn-sm btn-danger" wire:click="deleteConfirmRequestCheckup({{$data->id}})"><i class="fa fa-trash"></i>Delete</button>
                                                        @endif
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
        <div class="modal-dialog">
            <div class="modal-content">
                <livewire:patient-panel.request-checkup.request-checkup-form />
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>

@section('custom_script')
    @include('layouts.scripts.request-checkup-scripts');
@endsection
