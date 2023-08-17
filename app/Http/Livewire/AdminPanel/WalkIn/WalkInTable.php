<?php

namespace App\Http\Livewire\AdminPanel\WalkIn;

use App\Models\RequestCheckup;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WalkInTable extends Component
{
    protected $listeners = [
        'refresh_walkin_table' =>  '$refresh',
        'DeleteData'
    ];
    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.admin-panel.walk-in.walk-in-table',[
            'RequestCheckupData' => RequestCheckup::all()
            ])->with('getStatus');
    }

    public function editRequestCheckup($ReuestCheckupID)
    {
        $this->emit('openwalkinModal');
        $this->emit('walkinData',$ReuestCheckupID);
    }

    public function createRequestCheckup()
    {
        $this->emit('openwalkinModal');
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
