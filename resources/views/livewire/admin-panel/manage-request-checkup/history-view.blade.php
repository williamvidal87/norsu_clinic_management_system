<div>
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Patient History</h4>
        <button type="button" class="close" wire:click="closeHistory"><span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Request No</th>
                    <th scope="col">Schedule</th>
                    <th scope="col">Purpose</th>
                    <th scope="col">Status</th>
                    <th scope="col">Remarks</th>
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
                        if($data->getStatus->id==5){
                            echo "color:red";
                        }
                        ?>">{{ $data->getStatus->status_name }}</td>
                        <td>{{ $data->remarks }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click="closeHistory">Close</button>
    </div>
</div>
