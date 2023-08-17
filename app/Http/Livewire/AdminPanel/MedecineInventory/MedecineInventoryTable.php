<?php

namespace App\Http\Livewire\AdminPanel\MedecineInventory;

use App\Models\MedecineInventory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MedecineInventoryTable extends Component
{
    protected $listeners = [
        'refresh_medecineinventory_table' =>  '$refresh',
        'DeleteData'
    ];

    public function render()
    {
        $this->emit('EmitTable');
        return view('livewire.admin-panel.medecine-inventory.medecine-inventory-table',[
            'MedecineInventoryData' => MedecineInventory::all()
            ])->with('getStatus');
    }

    public function editMedecineInventory($medecineinventoryID)
    {
        $this->emit('openmedecineinventoryModal');
        $this->emit('medecineinventoryData',$medecineinventoryID);
    }

    public function createMedecineInventory()
    {
        $this->emit('openmedecineinventoryModal');
    }

    public function deleteConfirmMedecineInventory($medecineinventoryID)
    {
        $this->emit('deleteconfirm',$medecineinventoryID);
    }
    public function DeleteData($medecineinventoryID)
    {
        MedecineInventory::destroy($medecineinventoryID);
        $this->emit('EmitTable');
        $this->emit('alert_delete');
    }
}
