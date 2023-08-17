<?php

namespace App\Http\Livewire\AdminPanel\ManageRequestCheckup;

use App\Models\RequestCheckup;
use Livewire\Component;

class HistoryView extends Component
{
    public $patient_id;
    protected $listeners = [
        'historyviewdata'
    ];
    
    public function historyviewdata($patient_id)
    {
        $this->patient_id=$patient_id;
        // dd($patient_id);
    }
    public function render()
    {
        return view('livewire.admin-panel.manage-request-checkup.history-view',[
            'RequestCheckupData' => RequestCheckup::where('patient_id',$this->patient_id)->orderBy('id', 'DESC')->get()
            ])->with('getStatus','getUser');
    }
    
    public function closeHistory()
    {
        $this->emit('closehistoryviewModal');
    }
}
