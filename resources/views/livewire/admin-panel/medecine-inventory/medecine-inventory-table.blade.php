<div>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="col-md-12 col-sm-12 ">
                <div class="page-title">
                    <div class="title_left">
                        <h3>Medicine Inventory</h3>
                    </div>
                </div>
                <button type="button" class="btn btn-primary"  wire:click="createMedecineInventory"><i class="fa fa-plus-circle"></i> Add Medicine Inventory</button>
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Medicine No.</th>
                                                <th>Medicine Name</th>
                                                <th>qty</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($MedecineInventoryData as $data)
                                                <tr>
                                                    <td>{{ 203820+$data->id }}</td>
                                                    <td>{{ $data->medecine_name }}</td>
                                                    <td>{{ $data->qty }}</td>
                                                    <td>
                                                        @if($data->qty>=1)
                                                            <span style="color:green">In Stock</span>
                                                        @endif
                                                        @if($data->qty<1)
                                                            <span style="color:red">Out of Stock</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button  class="py-0 btn btn-sm btn-info" wire:click="editMedecineInventory({{$data->id}})"><i class="fa fa-edit"></i>Edit</button> |
                                                        <button  class="py-0 btn btn-sm btn-danger" wire:click="deleteConfirmMedecineInventory({{$data->id}})"><i class="fa fa-trash"></i>Delete</button>
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
    <div wire.ignore.self class="modal fade" id="medecineinventoryModal" role="dialog" aria-labelledby="medecineinventoryModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <livewire:admin-panel.medecine-inventory.medecine-inventory-form />
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>

@section('custom_script')
    @include('layouts.scripts.medecine-inventory-scripts');
@endsection
