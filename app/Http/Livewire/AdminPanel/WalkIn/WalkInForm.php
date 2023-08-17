<?php

namespace App\Http\Livewire\AdminPanel\WalkIn;

use App\Models\MedecineInventory;
use App\Models\MedecineUse;
use App\Models\RequestCheckup;
use App\Models\User;
use Livewire\Component;

class WalkInForm extends Component
{
    public  $schedule,
            $purpose;
    public  $walkinID;
    public  $edit_data=0;


    public  $orderProducts = [];
    public  $medecine_id = [];
    public  $qty = [];
    public  $count = 0;
    public  $count2 = 0;

    public $bagerror =  [0];
    
    public $patient_id;
    public $remarks;

    protected $listeners = [
        'selectedPatient',
        'walkinData'
    ];
    
    public function selectedPatient($id){

        if($id){
            $this->patient_id = $id;
        }else{
            $this->patient_id = null;
        }
    }


    public function addProduct()
    {
        $this->orderProducts[] = ['id'=>'','medecine_id'=>'','used_id' => '','qty' => ''];
        $this->bagerror[]=[0];
    }

    public function removeProduct($index)
    {
        unset($this->orderProducts[$index]);
        $this->orderProducts = array_values($this->orderProducts);
    }

    public function render()
    {
        return view('livewire.admin-panel.walk-in.walk-in-form',[
            'select_items' => MedecineInventory::orderBy('medecine_name', 'ASC')->get(),
            'select_patient' => User::where('rule_id',2)->orderBy('name', 'ASC')->get(),
        ]);
    }
    
    public function hydrate(){
        $this->emit('select2');

    }

    public function walkinData($walkinID)
    {
        $this->walkinID=$walkinID;
        $DATA=RequestCheckup::find($this->walkinID);
        $this->purpose = $DATA['purpose'];
        $this->schedule = $DATA['schedule'];
        $this->patient_id = 2;
    }


    public function store()
    {
        date_default_timezone_set('Etc/GMT-8');
        $this->validate([
            'patient_id'  => 'required',
            'schedule'  => 'required',
            'purpose'   => 'required',
            'remarks'                           =>  'required',
            'orderProducts.*.medecine_id'       =>  'required',
            'orderProducts.*.qty'               =>  'required||max:10',
        ]);

        for ($i=0; $i < count($this->bagerror) ; $i++) {
            $this->bagerror[$i]=0;
        }
        $countadd=0;
        foreach ($this->orderProducts as $key => $value) {
            $find_total = MedecineInventory::find($value['medecine_id']);
            $this->bagerror[$countadd]=0;
            if ($find_total['qty']<$value['qty']) {
                $this->bagerror[$countadd]=1;
            }
            $countadd++;
            for ($i=0; $i < count($this->bagerror); $i++) {
                if ($this->bagerror[$i]==1) {
                    return back();
                }
            }
        }

        $data = ([
            'patient_id'                => $this->patient_id,
            'schedule'                  => $this->schedule,
            'purpose'                   => $this->purpose,
            'remarks'                   => $this->remarks,
            'walkin_date'               => date('Y-m-d H:i:s'),
        ]);
        if (date("D", strtotime($this->schedule))=="Sat") {
            if (date("H", strtotime($this->schedule))<8||date("H", strtotime($this->schedule))>17) {
                $this->addError('schedule', 'We are only open from 8 am to 5 pm');
                return back();
            }
            $this->addError('schedule', 'We don t cater Saturday and Sunday');
			return back();
        }
        if (date("D", strtotime($this->schedule))=="Sun") {
            if (date("H", strtotime($this->schedule))<8||date("H", strtotime($this->schedule))>17) {
                $this->addError('schedule', 'We are only open from 8 am to 5 pm');
                return back();
            }
            $this->addError('schedule', 'We dont cater Saturday and Sunday');
			return back();
        }
        if (date("H", strtotime($this->schedule))<8||date("H", strtotime($this->schedule))>17) {
            $this->addError('schedule', 'We are only open from 8 am to 5 pm');
            return back();
        }
        try {
            if($this->walkinID){
                $check_status=RequestCheckup::find($this->walkinID);
                if($check_status['status_id']!=1){
                    $this->emit('alert_warning');
                    $this->emit('closewalkinModal');
                    $this->emit('refresh_walkin_table');
                    $this->reset();
                    $this->resetErrorBag();
                    $this->resetValidation();
        			return back();
                }
                RequestCheckup::find($this->walkinID)->update($data);
                $this->emit('alert_update');
            }else{
                
                
                
                
                $data['status_id']=2;
                $show=RequestCheckup::create($data);
                $check_medecine_use=MedecineUse::where('used_id',$show['id'])->get();
                foreach ($check_medecine_use as $check_medecine_use_data) {
                    $has=false;
                    foreach ($this->orderProducts as $key4) {
                        if ($key4['id']==$check_medecine_use_data['id']) {
                            $has=true;
                        }
                    }
                    if ($has==false) {
                        $find_medecine_id=MedecineInventory::find($check_medecine_use_data['medecine_id']);
                        $data3['qty']=$check_medecine_use_data['qty']+$find_medecine_id['qty'];
                        MedecineInventory::find($check_medecine_use_data['medecine_id'])->update($data3);
                        MedecineUse::destroy($check_medecine_use_data['id']);
                    }
                }

                //return qty
                foreach ($this->orderProducts as $key3) {
                    if ($key3['id']) {
                        $find_medecine_use=MedecineUse::WhereIn('id',[$key3['id']])->get()->first();
                        $find_medecine=MedecineInventory::WhereIn('id',[$find_medecine_use['medecine_id']])->get()->first();
                        if ($key3['medecine_id']==$find_medecine_use['medecine_id']) {
                            $data2['qty']=($find_medecine['qty']+$find_medecine_use['qty'])-$key3['qty'];
                            MedecineInventory::find($key3['medecine_id'])->update($data2);
                            $data3['qty']=$key3['qty'];
                            MedecineUse::find($key3['id'])->update($data3);
                        } else {
                            // $data2['qty']=$find_medecine['qty']+$key3['qty'];
                            // MedecineInventory::find($find_medecine_use['medecine_id'])->update($data2);
                            // dd($find_medecine_use);

                            // $data4 = ([
                            //     'medecine_id'                   => $key3['medecine_id'],
                            //     'qty'                           => $key3['qty'],
                            // ]);
                            // MedecineUse::find($key3['id'])->update($data4);
                            // dd($key3['medecine_id']);
                        }
                    } else {
                        $find_medecine2=MedecineInventory::find($key3['medecine_id']);
                        $data2['qty']=$find_medecine2['qty']-$key3['qty'];
                        MedecineInventory::find($key3['medecine_id'])->update($data2);
                        MedecineUse::create(['used_id' => $show['id'],'medecine_id' => $key3['medecine_id'],'qty' => $key3['qty']]);
                    }
                }

                $this->emit('alert_store');
                
                
                
                
            }
        } catch (\Exception $e) {
			dd($e);
			return back();
        }

        $this->emit('closewalkinModal');
        $this->emit('refresh_walkin_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function closewalkin()
    {
        $this->emit('closewalkinModal');
        $this->emit('refresh_walkin_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
