<?php

namespace App\Http\Resources;

use App\Models\School;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public $preserveKeys = true;
    public function toArray($request)
    {
       
        return [
            
            'reg_number'=> $this->whenHas('reg_number'),
            'student_name'=> $this->student_name,
            'amountpaid'=>  $this->amount,
            'currency'=> $this->currency_value,
            'class' => $this->class,
            'year'=> $this->year,
            'purpose' => $this->purpose,
            'term' => $this->term,
            'date_of_payment' => $this->created_at->format('Y-m-d H:i:s'),
            'customer_phone_number'=> $this->customer_phone_number,
            'semester'=> $this->semester,
            'payment_status'=> $this->payment_status,
            'depositor_name'=> $this->depositor_name,
            'reference_number'=> $this->rrn,
        ];
    }
}
