<?php

namespace App\Http\Livewire\PatientPanel\RequestCheckup;

use App\Models\RequestCheckup;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RequestCheckupTable extends Component
{
    protected $listeners = [
        'refresh_request_checkup_table' =>  '$refresh',
        'DeleteData'
    ];
    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.patient-panel.request-checkup.request-checkup-table',[
            'RequestCheckupData' => RequestCheckup::where('patient_id',Auth::user()->id)->get()
            ])->with('getStatus');
    }

    public function editRequestCheckup($ReuestCheckupID)
    {
        $this->emit('openrequestcheckupModal');
        $this->emit('requestcheckupData',$ReuestCheckupID);
    }

    public function createRequestCheckup()
    {
        $this->emit('openrequestcheckupModal');
    }

    public function deleteConfirmRequestCheckup($ReuestCheckupID)
    {
        $this->emit('deleteconfirm',$ReuestCheckupID);
    }
    public function DeleteData($ReuestCheckupID)
    {
        RequestCheckup::destroy($ReuestCheckupID);
        $this->emit('EmitTable');
        $this->emit('alert_delete');
    }
}
