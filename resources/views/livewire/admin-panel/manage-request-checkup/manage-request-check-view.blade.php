<div>
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Request Checkup Form</h4>
        <button type="button" class="close" wire:click="closerequestcheckup"><span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
    <button type="button" class="btn btn-secondary" wire:click.prevent="history">View History</button>
		<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align" for="department_name">College Department
				</label>
				<div class="col-md-6 col-sm-6 ">
				    <input type="text" id="department_name" wire:model="department_name" required="required" class="form-control" disabled>
                    @error('department_name') <span class="error" style="color: red">{{ $message }}</span> @enderror
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align" for="id_number">School ID
				</label>
				<div class="col-md-6 col-sm-6 ">
				    <input type="text" id="id_number" wire:model="id_number" required="required" class="form-control" disabled>
                    @error('id_number') <span class="error" style="color: red">{{ $message }}</span> @enderror
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name
				</label>
				<div class="col-md-6 col-sm-6 ">
				    <input type="text" id="name" wire:model="name" required="required" class="form-control" disabled>
                    @error('name') <span class="error" style="color: red">{{ $message }}</span> @enderror
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align" for="schedule">Set Schedule
				</label>
				<div class="col-md-6 col-sm-6 ">
				    <input type="datetime-local" id="schedule" wire:model="schedule" required="required" class="form-control" disabled>
                    @error('schedule') <span class="error" style="color: red">{{ $message }}</span> @enderror
				</div>
			</div>

			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align" for="purpose">Purpose
				</label>
				<div class="col-md-6 col-sm-6 ">
					<textarea class="form-control" wire:model="purpose" rows="3" required id="purpose" disabled></textarea>
                    @error('purpose') <span class="error" style="color: red">{{ $message }}</span> @enderror
				</div>
			</div>

			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align" for="remarks">Remarks
				</label>
				<div class="col-md-6 col-sm-6 ">
					<textarea class="form-control" wire:model="remarks" rows="3" required id="remarks"
                    <?php
                        if ($status_id!=1) {
                        echo "disabled";
                        }
                    ?>></textarea>
                    @error('remarks') <span class="error" style="color: red">{{ $message }}</span> @enderror
				</div>
			</div>


                      <div class="item form-group">
                          {{-- sample --}}
                            <table class="table" id="products_table">
                                <thead>
                                    <tr>
                                        <th width="50%">Medicine Name</th>
                                        <th width="20%">Qty</th>
                                        <th width="30%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderProducts as $index => $orderProduct)
                                    <tr>
                                        <td>
                                            <select name="orderProducts[{{$index}}][medecine_id]"
                                                wire:model="orderProducts.{{$index}}.medecine_id"
                                                class="form-control" required
                                                <?php
                                                    if ($this->orderProducts[$index]['id']) {
                                                    echo "disabled";
                                                    }
                                                ?>
                                                >
                                                <option value="">-- Choose Medecine --</option>
                                                @foreach ($select_items as $product)
                                                <option
                                                <?php
                                                        for ($i=0; $i < count($this->orderProducts); $i++) {
                                                            if(!empty($this->orderProducts[$i]['medecine_id'])){
                                                            if ($product->id == $this->orderProducts[$i]['medecine_id']) {
                                                                if ($this->orderProducts[$index]['medecine_id'] == $this->orderProducts[$i]['medecine_id']) {
                                                                // echo "none";
                                                                } else {
                                                                echo "disabled";
                                                                }
                                                            }
                                                            }
                                                        }
                                                    ?> value="{{ $product->id }}">{{ $product->medecine_name }}{{"      - left in stock ".$product->qty  }}<?php
                                                        for ($i=0; $i < count($this->orderProducts); $i++) {
                                                            if(!empty($this->orderProducts[$i]['medecine_id'])){
                                                            if ($product->id == $this->orderProducts[$i]['medecine_id']) {
                                                                if ($this->orderProducts[$index]['medecine_id'] == $this->orderProducts[$i]['medecine_id']) {
                                                                // echo "none";
                                                                } else {
                                                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You Already taken.";
                                                                }
                                                            }
                                                            }
                                                        }
                                                    ?></option>
                                                @endforeach
                                            </select>
                                            @error('orderProducts'.'.'.$index.'.'.'medecine_id') <span style="color: red">Required</span> @enderror
                                        </td>
                                        <td>
				                            <input type="number" id="qty" name="orderProducts[{{$index}}][qty]" wire:model="orderProducts.{{$index}}.qty" required class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                            <?php
                                                if ($status_id!=1) {
                                                echo "disabled";
                                                }
                                            ?>>
                                            @error('orderProducts'.'.'.$index.'.'.'qty') <span style="color: red">Required</span> @enderror
                                            @if($bagerror[$index]==1)
                                                <span style="color: red">Selected quantity is greater than stock on hand</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($status_id==1)
                                                <button wire:click.prevent="removeProduct({{$index}})" class="py-0 btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>Delete</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          {{-- end sample --}}
                      </div>
                            @if($status_id==1)
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-sm btn-primary" wire:click.prevent="addProduct">+ Add Medicine</button>
                                    </div>
                                </div>
                            @endif

		</form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click="closerequestcheckup">Close</button>
        @if($status_id==1)
            <button type="button" class="btn btn-danger" wire:click.prevent="decline">Decline</button>
        @endif
        @if($status_id==1)
            <button type="button" class="btn btn-success" wire:click.prevent="store">Complied</button>
        @endif
        {{-- @if($status_id!=1)
            <button type="button" class="btn btn-primary" wire:click.prevent="store">Save Changes</button>
        @endif --}}
    </div>
</div>
