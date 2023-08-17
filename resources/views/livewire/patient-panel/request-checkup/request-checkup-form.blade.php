<div>
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Request Checkup Form</h4>
        <button type="button" class="close" wire:click="closerequestcheckup"><span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
		<form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
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
		</form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click="closerequestcheckup">Close</button>
        @if($this->requestcheckupID)
            <button type="button" class="btn btn-primary" wire:click.prevent="store">Save</button>
        @else
            <button type="button" class="btn btn-primary" wire:click.prevent="store">Submit</button>
        @endif
    </div>
</div>
