<div>
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Walk In Form</h4>
        <button type="button" class="close" wire:click="closewalkin"><span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
		<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
			
            
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="patient_id">Patient</label>
                
				<div class="col-md-6 col-sm-6 ">
                    <select class="form-control" id="patient_id" wire:model="patient_id" required style="width: auto">
                        <option value="0">Select a Patient</option>
                        @foreach($select_patient as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                        @endforeach
                    </select>
                    @error('patient_id') <span class="error" style="color: red">{{ $message }}</span> @enderror
                </div>
            </div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align" for="schedule">Set Schedule
				</label>
				<div class="col-md-6 col-sm-6 ">
				    <input type="datetime-local" id="schedule" wire:model="schedule" required="required" class="form-control">
                    @error('schedule') <span class="error" style="color: red">{{ $message }}</span> @enderror
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align" for="purpose">Purpose
				</label>
				<div class="col-md-6 col-sm-6 ">
					<textarea class="form-control" wire:model="purpose" rows="3" required id="purpose"></textarea>
                    @error('purpose') <span class="error" style="color: red">{{ $message }}</span> @enderror
				</div>
			</div>
			<div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align" for="remarks">Remarks
				</label>
				<div class="col-md-6 col-sm-6 ">
					<textarea class="form-control" wire:model="remarks" rows="3" required id="remarks"></textarea>
                    @error('remarks') <span class="error" style="color: red">{{ $message }}</span> @enderror
				</div>
			</div>
			
		</form>
		
		
		
		
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
				                            <input type="number" id="qty" name="orderProducts[{{$index}}][qty]" wire:model="orderProducts.{{$index}}.qty" required class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                            @error('orderProducts'.'.'.$index.'.'.'qty') <span style="color: red">Required</span> @enderror
                                            @if($bagerror[$index]==1)
                                                <span style="color: red">Selected quantity is greater than stock on hand</span>
                                            @endif
                                        </td>
                                        <td>
                                            
                                                <button wire:click.prevent="removeProduct({{$index}})" class="py-0 btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i>Delete</button>
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- end sample --}}
                        </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-primary" wire:click.prevent="addProduct">+ Add Medicine</button>
                                </div>
                            </div>
		
		
		
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click="closewalkin">Close</button>
        @if($this->walkinID)
            <button type="button" class="btn btn-primary" wire:click.prevent="store">Save</button>
        @else
            <button type="button" class="btn btn-primary" wire:click.prevent="store">Submit</button>
        @endif
    </div>
</div>
