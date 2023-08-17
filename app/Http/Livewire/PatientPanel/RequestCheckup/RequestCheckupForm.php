<?php

namespace App\Http\Livewire\PatientPanel\RequestCheckup;

use App\Models\RequestCheckup;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RequestCheckupForm extends Component
{
    public  $schedule,
            $purpose;
    public  $requestcheckupID;

    protected $listeners = [
        'requestcheckupData'
    ];

    public function render()
    {
        return view('livewire.patient-panel.request-checkup.request-checkup-form');
    }

    public function requestcheckupData($requestcheckupID)
    {
        $this->requestcheckupID=$requestcheckupID;
        $DATA=RequestCheckup::find($this->requestcheckupID);
        $this->purpose = $DATA['purpose'];
        $this->schedule = $DATA['schedule'];
    }


    public function store()
    {
        $this->validate([
            'schedule'  => 'required',
            'purpose'   => 'required',
        ]);

        $data = ([
            'schedule'                  => $this->schedule,
            'purpose'                   => $this->purpose,
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
            if($this->requestcheckupID){
                $check_status=RequestCheckup::find($this->requestcheckupID);
                if($check_status['status_id']!=1){
                    $this->emit('alert_warning');
                    $this->emit('closerequestcheckupModal');
                    $this->emit('refresh_request_checkup_table');
                    $this->reset();
                    $this->resetErrorBag();
                    $this->resetValidation();
        			return back();
                }
                RequestCheckup::find($this->requestcheckupID)->update($data);
                $this->emit('alert_update');
            }else{
                $data['patient_id']=Auth::user()->id;
                $data['status_id']=1;
                RequestCheckup::create($data);
                $this->emit('alert_store');
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

    public function closerequestcheckup()
    {
        $this->emit('closerequestcheckupModal');
        $this->emit('refresh_request_checkup_table');
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
