<div>
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Medicine Inventory</h4>
        <button type="button" class="close" wire:click="closemedecineinventory"><span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
		<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

            <div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align" for="medecine_name">Medicine Name
				</label>
				<div class="col-md-6 col-sm-6 ">
				    <input type="text" id="medecine_name" wire:model="medecine_name" required="required" class="form-control">
                    @error('medecine_name') <span class="error" style="color: red">{{ $message }}</span> @enderror
				</div>
			</div>
            <div class="item form-group">
				<label class="col-form-label col-md-3 col-sm-3 label-align" for="qty">Qty
				</label>
				<div class="col-md-6 col-sm-6 ">
				    <input type="number" id="qty" wire:model="qty" required="required" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    @error('qty') <span class="error" style="color: red">{{ $message }}</span> @enderror
				</div>
			</div>

		</form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click="closemedecineinventory">Close</button>
        @if($this->medecineinventoryID)
            <button type="button" class="btn btn-primary" wire:click.prevent="store">Save</button>
        @else
            <button type="button" class="btn btn-primary" wire:click.prevent="store">Submit</button>
        @endif
    </div>
</div>
