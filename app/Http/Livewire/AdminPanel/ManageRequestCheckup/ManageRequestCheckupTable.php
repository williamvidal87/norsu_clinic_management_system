<?php

namespace App\Http\Livewire\AdminPanel\ManageRequestCheckup;

use App\Models\RequestCheckup;
use Livewire\Component;

class ManageRequestCheckupTable extends Component
{
    public $data=[];
    protected $listeners = [
        'refresh_request_checkup_table' =>  '$refresh',
        'DeleteData'
    ];

    public function render()
    {
        $this->emit('EmitTable');
        $RequestCheckupData3 = RequestCheckup::distinct()->select('patient_id')->get();
        foreach ($RequestCheckupData3 as $key => $requestcheckupdata) {
            $RequestCheckupData2 = RequestCheckup::where('patient_id',$requestcheckupdata['patient_id'])->latest('id')->first();
        $this->data[$key]=$RequestCheckupData2;
        }
        return view('livewire.admin-panel.manage-request-checkup.manage-request-checkup-table',[
            'RequestCheckupData' => $this->data
            ])->with('getStatus','getUser');
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
