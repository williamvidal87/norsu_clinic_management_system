<?php

namespace App\Http\Livewire\AdminPanel\ManageRequestCheckup;

use App\Models\MedecineInventory;
use App\Models\MedecineUse;
use App\Models\RequestCheckup;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ManageRequestCheckView extends Component
{
    public  $id_number,
            $department_name,
            $name,
            $schedule,
            $purpose,
            $remarks;
    public  $requestcheckupID;
    public  $status_id;
    public  $edit_data=0;


    public  $orderProducts = [];
    public  $medecine_id = [];
    public  $qty = [];
    public  $count = 0;
    public  $count2 = 0;

    public $bagerror =  [0];
    
    public $patient_id;

    protected $listeners = [
        'requestcheckupData'
    ];


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
        return view('livewire.admin-panel.manage-request-checkup.manage-request-check-view',[
            'select_items' => MedecineInventory::orderBy('medecine_name', 'ASC')->get(),
        ]);
    }

    public function requestcheckupData($requestcheckupID)
    {
        for ($i=count($this->orderProducts); $i >=0 ; $i--) {
            unset($this->orderProducts[$i]);
            $this->orderProducts = array_values($this->orderProducts);
        }
        $this->requestcheckupID=$requestcheckupID;
        $DATA=RequestCheckup::find($this->requestcheckupID);
        $this->department_name = $DATA->getUser->getDeptID->department_name;
        $this->id_number = $DATA->getUser->id_number;
        $this->name = $DATA->getUser->name;
        $this->purpose = $DATA['purpose'];
        $this->schedule = $DATA['schedule'];
        $this->status_id = $DATA['status_id'];
        $this->remarks = $DATA['remarks'];
        $this->patient_id = $DATA['patient_id'];
        $tools = MedecineUse::all()->where('used_id', $this->requestcheckupID);
        $this->count=0;
        foreach ($tools as $tool){
            $this->orderProducts[$this->count] = ['id'=>$tool->id,'used_id'=>$tool->used_id,'medecine_id' => $tool->medecine_id,'qty' => $tool->qty];
            $this->bagerror[$this->count]=[0];
            $this->count++;
        }
    }


    public function closerequestcheckup()
    {
        for ($i=count($this->orderProducts); $i >=0 ; $i--) {
            unset($this->orderProducts[$i]);
            $this->orderProducts = array_values($this->orderProducts);
        }
        $this->emit('closerequestcheckupModal');
        $this->emit('refresh_request_checkup_table');
        $this->edit_data=0;
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function store()
    {
            $this->validate([
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

        try {
            if($this->requestcheckupID){
                $check_status=RequestCheckup::find($this->requestcheckupID);
                // if($check_status['status_id']!=1){
                //     $this->emit('alert_warning');
                //     $this->emit('closerequestcheckupModal');
                //     $this->emit('refresh_request_checkup_table');
                //     $this->reset();
                //     $this->resetErrorBag();
                //     $this->resetValidation();
        		// 	return back();
                // }
                $data['status_id']=2;
                $data['remarks']=$this->remarks;
                RequestCheckup::find($this->requestcheckupID)->update($data);
                $check_medecine_use=MedecineUse::where('used_id',$this->requestcheckupID)->get();
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
                        MedecineUse::create(['used_id' => $this->requestcheckupID,'medecine_id' => $key3['medecine_id'],'qty' => $key3['qty']]);
                    }
                }

                $this->emit('alert_update');
            }else{
            }
        } catch (\Exception $e) {
			dd($e);
			return back();
        }

        $this->emit('closerequestcheckupModal');
        $this->emit('refresh_request_checkup_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function decline()
    {
            $this->validate([
                'remarks'                           =>  'required',
            ]);

        try {
            if($this->requestcheckupID){
                $check_status=RequestCheckup::find($this->requestcheckupID);
                // if($check_status['status_id']!=1){
                //     $this->emit('alert_warning');
                //     $this->emit('closerequestcheckupModal');
                //     $this->emit('refresh_request_checkup_table');
                //     $this->reset();
                //     $this->resetErrorBag();
                //     $this->resetValidation();
        		// 	return back();
                // }
                $data['status_id']=5;
                $data['remarks']=$this->remarks;
                RequestCheckup::find($this->requestcheckupID)->update($data);
                
                $this->emit('alert_update');
            }else{
            }
        } catch (\Exception $e) {
			dd($e);
			return back();
        }

        $this->emit('closerequestcheckupModal');
        $this->emit('refresh_request_checkup_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
    
    
    public function history()
    {
        
        $this->emit('openhistoryviewModal');
        $this->emit('historyviewdata',$this->patient_id);
    }
}
