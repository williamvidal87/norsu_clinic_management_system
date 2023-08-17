<?php

namespace App\Http\Livewire\AdminPanel\MedecineInventory;

use App\Models\MedecineInventory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MedecineInventoryForm extends Component
{
    public  $medecine_name,
            $qty;
    public  $medecineinventoryID;

    protected $listeners = [
        'medecineinventoryData'
    ];

    public function render()
    {
        return view('livewire.admin-panel.medecine-inventory.medecine-inventory-form');
    }

    public function medecineinventoryData($medecineinventoryID)
    {
        $this->medecineinventoryID=$medecineinventoryID;
        $DATA=MedecineInventory::find($this->medecineinventoryID);
        $this->qty = $DATA['qty'];
        $this->medecine_name = $DATA['medecine_name'];
    }


    public function store()
    {
        $this->validate([
            'medecine_name'      => 'required',
            'qty'               => 'required',
        ]);

        $data = ([
            'medecine_name'                 => $this->medecine_name,
            'qty'                           => $this->qty,
        ]);

        try {
            if($this->medecineinventoryID){
                $check_status=MedecineInventory::find($this->medecineinventoryID);
                MedecineInventory::find($this->medecineinventoryID)->update($data);
                $this->emit('alert_update');
            }else{
                MedecineInventory::create($data);
                $this->emit('alert_store');
            }
        } catch (\Exception $e) {
			dd($e);
			return back();
        }

        $this->emit('closemedecineinventoryModal');
        $this->emit('refresh_medecineinventory_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function closemedecineinventory()
    {
        $this->emit('closemedecineinventoryModal');
        $this->emit('refresh_medecineinventory_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
