<?php

namespace App\Http\Requests;

use App\Models\Fxrate;
use Illuminate\Foundation\Http\FormRequest;

class InternationBankValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()

    {
        $id = $this->input('country_id'); // Replace 'id' with the actual name of your form input
        $paymentmethod = $this->input('payment_method');
        $iban = $this->input('rec_iban');

        
        
// Query the Fxrate model to find the country_code based on the id


$countryCode = $id;



$validationRules = [];


// IBAN Validation Rules
$ibanValidationRules = array(
    'ADO' => '/^AD[0-9]{22}$/',
    'AUT' => '/^AT[0-9]{18}$/',
    'BEL' => '/^BE[0-9]{14}$/',
    'HRV' => '/^HR[0-9]{19}$/',
    'CYP' => '/^CY[0-9]{10}[A-Z0-9]{16}$/',
    'EST' => '/^EE[0-9]{18}$/',
    'FIN' => '/^FI[0-9]{16}$/',
    'FRA' => '/^FR[0-9]{12}[A-Z0-9]{11}[0-9]{2}$/',
    'DEU' => '/^DE[0-9]{20}$/',
    'GRC' => '/^GR[0-9]{9}[A-Z0-9]{16}$/',
    'IRL' => '/^IE[0-9]{2}[A-Z]{4}[0-9]{14}$/',
    'ITA' => '/^IT[0-9]{2}[A-Z]{1}[0-9]{10}[A-Z0-9]{12}$/',
    'LVA' => '/^LV[0-9]{2}[A-Z]{4}[0-9]{13}$/',
    'LTU' => '/^LT[0-9]{18}$/',
    'LUX' => '/^LU[0-9]{5}[A-Z0-9]{13}$/',
    'MLT' => '/^MT[0-9]{2}[A-Z]{4}[0-9]{5}[A-Z0-9]{18}$/',
    'MCO' => '/^MC[0-9]{25}$/',
    'NLD' => '/^NL[0-9]{2}[A-Z]{4}[0-9]{10}$/',
    'PRT' => '/^PT[0-9]{23}$/',
    'SMR' => '/^SM[0-9]{2}[A-Z]{1}[0-9]{22}$/',
    'SVK' => '/^SK[0-9]{22}$/',
    'SVN' => '/^SI[0-9]{17}$/',
    'ESP' => '/^ES[0-9]{22}$/',
    'VAT' => '/^VA[0-9]{20}$/',
);

if (isset($ibanValidationRules[$countryCode])) {
    // Trim spaces from the IBAN input
    $iban = str_replace(' ', '', $iban);

    // Apply IBAN validation rule for the specified country code
    $validationRules['rec_iban'] = ['required', 'regex:' . $ibanValidationRules[$countryCode]];
}

if ($countryCode === 'ZAF') {
    // South Africa
    $validationRules['rec_ban'] = 'required|regex:/^.{8,11}/';
    $validationRules['rec_bic'] = ['required', 'regex:/^[A-Z]{4}ZA.{2}.*/'];
    $validationRules['rec_email'] = ['required'];
} elseif ($countryCode === 'USA') {
    // United States
    $validationRules['rec_ban'] = 'required|regex:/^.+/';
    $validationRules['rec_bic'] = ['required', 'regex:/^[0-9]{9}$/'];
    $validationRules['rec_bank_name'] = ['required'];
    $validationRules['rec_bank_type'] = ['required'];
    $validationRules['rec_country_subdivision'] = ['required'];
} elseif ($countryCode === 'THA') {
    // Thailand
    $validationRules['rec_ban'] = 'required';
    $validationRules['rec_bic'] = 'required|regex:/^[A-Z]{4}TH.{2}.*/';
} elseif ($countryCode === 'GBR') {
    // United Kingdom
    $validationRules['rec_iban'] = 'required|regex:/^GB[0-9]{2}[A-Z]{4}[0-9]{14}$/';
} elseif ($countryCode === 'CAN') {
    // Canada
    $validationRules['rec_ban'] = 'required|regex:/^\d{5,12}$/';
    $validationRules['rec_bic'] = 'required|regex:/^[A-Z]{4}CA.{2}.*/';
} elseif ($countryCode === 'ARE') {
    // United Arab Emirates
    $validationRules['rec_iban'] = 'required|regex:/^AE[0-9]{21}$/';
    $validationRules['rec_idc'] = ['required'];
    $validationRules['rec_country_subdivision'] = ['required'];
    $validationRules['recipient_account_uri'] = ['required'];

} elseif ($countryCode === 'AUS') {
    // Australia
    $validationRules['rec_bank_code'] = ['required'];
    $validationRules['rec_ban'] = 'required|regex:/^\d{6,9}$/';
    $validationRules['rec_bic'] = ['required', 'regex:/^[A-Z]{4}AU.{2}.*/'];
} elseif ($countryCode === 'POL') {
    // Poland
    $validationRules['rec_iban'] = 'required|regex:/^PL\d{20}$/';
} elseif ($countryCode === 'JPN') {
    // Japan
    $validationRules['rec_ban'] = 'required|regex:/^(\d{1,7})$/';
    $validationRules['rec_bic'] = 'required|regex:/^[A-Z]{4}JP.{2}.*/';
    $validationRules['rec_bank_code'] = 'required';
    $validationRules['rec_bank_type'] = 'required';
}
 elseif ($countryCode === 'CHE') {
    // Switzerland
    $validationRules['rec_iban'] = 'required|regex:/^CH[0-9]{19}[A-Za-z0-9]{2}$/';
} elseif ($countryCode === 'HKG') {
    // Hong Kong
    $validationRules['rec_ban'] = 'required|regex:/^.+/';
    $validationRules['rec_bic'] = 'required|regex:/^[0-9]{3}.*/';
} elseif ($countryCode === 'SGP') {
    // Singapore
    $validationRules['rec_ban'] = 'required|regex:/^.+/';
    $validationRules['rec_bic'] = 'required|regex:/^[A-Z]{4}SG.{2}.*/';
} elseif ($countryCode.$paymentmethod === 'INDCP') {
    // India (Cash Pick Up)
   
    $validationRules['rec_ewallet'] = 'required';
} elseif ($countryCode.$paymentmethod  === 'INDBD') {
    // India
    $validationRules['rec_bic'] = 'required|regex:/^[A-Z]{4}[0]{1}[A-Z0-9]{6}$/';
    $validationRules['rec_ban'] = 'required|regex:/^.+/';
} 


elseif ($countryCode === 'MYS') {
    // Malaysia
    $validationRules['rec_ban'] = 'required|regex:/^.+/';
    $validationRules['rec_bic'] = 'required|regex:/^[A-Z]{4}MY.{2}.*/';
} elseif ($countryCode === 'CHN') {
    // China
    $validationRules['rec_pan'] = 'required|regex:/^62.*[0-9]{16,19}$/';
    $validationRules['rec_idc'] = ['required'];
} elseif ($countryCode === 'MWI') {
    // Malawi (Telephone)
    $validationRules['recipient_account_uri'] = 'required|regex:/^265[0-9]{9}$/';
} elseif ($countryCode === 'MOZ') {
    // Mozambique (Telephone)
    $validationRules['recipient_account_uri'] = 'required|regex:/^258[0-9]{9}$/';
} elseif ($countryCode === 'PAK' &&  $paymentmethod  === 'MW') {
        // Pakistan (Telephone)
        $validationRules['recipient_account_uri'] = 'required|regex:/^92[0-9]{10}$/';
    }
    // if (!empty($this->input('rec_ban'))) {
    //     // Pakistan
    //     $validationRules['rec_ban'] = 'required|regex:/^ewallet:[a-zA-Z]+\.[a-zA-Z]+;sp=meezan$/';
    // }
 elseif ($countryCode === 'ZMB' &&  $paymentmethod  === 'MW') {
    // Zambia (Mobile Wallet)
    $validationRules['recipient_account_uri'] = 'required|regex:/^260[1-9][0-9]{8}$/';
}
elseif ($countryCode === 'ZMB' &&  $paymentmethod  === 'BD') {
    // Zambia (Mobile Wallet)
    $validationRules['rec_ban'] = 'required|regex:/^.+/';
    $validationRules['rec_bic'] = 'required|regex:/^[A-Z]{4}ZM.{2}.*/';
}



return $validationRules;

    }
}
