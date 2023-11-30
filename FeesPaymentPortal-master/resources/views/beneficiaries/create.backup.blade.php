@extends('shared.main')
@section('content')
    <!DOCTYPE html>
    <html>

    <head>
        <title>Create Beneficiary</title>
        <!-- Include Bootstrap CSS and jQuery from CDNs -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>

    <body>

        <body>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Fill in the Form Below To Create Beneficiary</h3>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('beneficiary.store') }}" id="myForm">
                                    @csrf
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="countrySelect">Select Country:</label>
                                            <select id="countrySelect" class="form-control"
                                                onchange="updatePaymentMethods()" name="country_id" required>
                                                <option value="ZAF" {{ old('country_id') == 'ZAF' ? 'selected' : '' }}>
                                                    South Africa
                                                </option>
                                                <option value="USA" {{ old('country_id') == 'USA' ? 'selected' : '' }}>
                                                    United States
                                                </option>
                                                <option value="THA" {{ old('country_id') == 'THA' ? 'selected' : '' }}>
                                                    Thailand
                                                </option>
                                                <option value="GBR" {{ old('country_id') == 'GBR' ? 'selected' : '' }}>
                                                    United Kingdom
                                                </option>
                                                <option value="CAN" {{ old('country_id') == 'CAN' ? 'selected' : '' }}>
                                                    Canada
                                                </option>
                                                <option value="ARE" {{ old('country_id') == 'ARE' ? 'selected' : '' }}>
                                                    United Arab Emirates
                                                </option>
                                                <option value="AUS" {{ old('country_id') == 'AUS' ? 'selected' : '' }}>
                                                    Australia
                                                </option>
                                                <option value="POL" {{ old('country_id') == 'POL' ? 'selected' : '' }}>
                                                    Poland
                                                </option>
                                                <option value="JPN" {{ old('country_id') == 'JPN' ? 'selected' : '' }}>
                                                    Japan
                                                </option>
                                                <option value="CHE" {{ old('country_id') == 'CHE' ? 'selected' : '' }}>
                                                    Switzerland
                                                </option>
                                                <option value="HKG" {{ old('country_id') == 'HKG' ? 'selected' : '' }}>
                                                    Hong Kong
                                                </option>
                                                <option value="SGP" {{ old('country_id') == 'SGP' ? 'selected' : '' }}>
                                                    Singapore
                                                </option>
                                                <option value="IND" {{ old('country_id') == 'IND' ? 'selected' : '' }}>
                                                    India
                                                </option>
                                                <option value="MYS" {{ old('country_id') == 'MYS' ? 'selected' : '' }}>
                                                    Malaysia
                                                </option>
                                                <option value="CHN" {{ old('country_id') == 'CHN' ? 'selected' : '' }}>
                                                    China
                                                </option>
                                                <option value="MWI" {{ old('country_id') == 'MWI' ? 'selected' : '' }}>
                                                    Malawi
                                                </option>
                                                <option value="MOZ" {{ old('country_id') == 'MOZ' ? 'selected' : '' }}>
                                                    Mozambique
                                                </option>
                                                <option value="PAK" {{ old('country_id') == 'PAK' ? 'selected' : '' }}>
                                                    Pakistan
                                                </option>
                                                <option value="ZMB" {{ old('country_id') == 'ZMB' ? 'selected' : '' }}>
                                                    Zambia
                                                </option>
                                                <option value="ADO" {{ old('country_id') == 'ADO' ? 'selected' : '' }}>
                                                    Andorra
                                                </option>
                                                <option value="AUT" {{ old('country_id') == 'AUT' ? 'selected' : '' }}>
                                                    Austria
                                                </option>
                                                <option value="BEL" {{ old('country_id') == 'BEL' ? 'selected' : '' }}>
                                                    Belgium
                                                </option>
                                                <option value="HRV" {{ old('country_id') == 'HRV' ? 'selected' : '' }}>
                                                    Croatia
                                                </option>
                                                <option value="CYP" {{ old('country_id') == 'CYP' ? 'selected' : '' }}>
                                                    Cyprus
                                                </option>
                                                <option value="EST" {{ old('country_id') == 'EST' ? 'selected' : '' }}>
                                                    Estonia
                                                </option>
                                                <option value="FIN" {{ old('country_id') == 'FIN' ? 'selected' : '' }}>
                                                    Finland
                                                </option>
                                                <option value="FRA" {{ old('country_id') == 'FRA' ? 'selected' : '' }}>
                                                    France
                                                </option>
                                                <option value="DEU" {{ old('country_id') == 'DEU' ? 'selected' : '' }}>
                                                    Germany
                                                </option>
                                                <option value="GRC" {{ old('country_id') == 'GRC' ? 'selected' : '' }}>
                                                    Greece
                                                </option>
                                                <option value="IRL" {{ old('country_id') == 'IRL' ? 'selected' : '' }}>
                                                    Ireland
                                                </option>
                                                <option value="ITA" {{ old('country_id') == 'ITA' ? 'selected' : '' }}>
                                                    Italy
                                                </option>
                                                <option value="LVA" {{ old('country_id') == 'LVA' ? 'selected' : '' }}>
                                                    Latvia
                                                </option>
                                                <option value="LTU" {{ old('country_id') == 'LTU' ? 'selected' : '' }}>
                                                    Lithuania
                                                </option>
                                                <option value="LUX" {{ old('country_id') == 'LUX' ? 'selected' : '' }}>
                                                    Luxembourg
                                                </option>
                                                <option value="MLT" {{ old('country_id') == 'MLT' ? 'selected' : '' }}>
                                                    Malta
                                                </option>
                                                <option value="MCO" {{ old('country_id') == 'MCO' ? 'selected' : '' }}>
                                                    Monaco
                                                </option>
                                                <option value="NLD" {{ old('country_id') == 'NLD' ? 'selected' : '' }}>
                                                    Netherlands
                                                </option>
                                                <option value="PRT" {{ old('country_id') == 'PRT' ? 'selected' : '' }}>
                                                    Portugal
                                                </option>
                                                <option value="SMR" {{ old('country_id') == 'SMR' ? 'selected' : '' }}>
                                                    San Marino
                                                </option>
                                                <option value="SVK" {{ old('country_id') == 'SVK' ? 'selected' : '' }}>
                                                    Slovakia
                                                </option>
                                                <option value="SVN" {{ old('country_id') == 'SVN' ? 'selected' : '' }}>
                                                    Slovenia
                                                </option>
                                                <option value="ESP" {{ old('country_id') == 'ESP' ? 'selected' : '' }}>
                                                    Spain
                                                </option>
                                                <option value="VAT" {{ old('country_id') == 'VAT' ? 'selected' : '' }}>
                                                    Vatican City
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="paymentMethodSelect">Select Payment Method:</label>
                                            <select id="paymentMethodSelect" class="form-control" name="payment_method"
                                                onchange="updateFormFields()">
                                                <!-- The payment options will be dynamically inserted here -->
                                            </select>
                                        </div>
                                        <div class="form-group" class="label" id="currencyDisplay" name="currency">
                                            <!-- Currency information will be dynamically inserted here -->
                                        </div>
                                        <div class="form-group">
                                            <label for="customer_id">{{ __('Select Sender') }}</label>
                                            <select id="customer_id"
                                                class="form-control @error('customer_id') is-invalid @enderror"
                                                name="customer_id" required>
                                                <option disabled value="">Please select a sender</option>
                                                <!-- This is the unselectable option -->
                                                @foreach ($senders as $sender)
                                                    <option value="{{ $sender->id }}"
                                                        {{ $sender->id == old('customer_id') ? 'selected' : '' }}>
                                                        {{ $sender->first_name }} {{ $sender->surname }}
                                                        {{ $sender->id_number }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                       
                                        <div class="form-group">
                                            <label
                                                for="payer_payee_relationship">{{ __('Select Payer-Payee Relationship') }}</label>
                                            <select id="payer_payee_relationship"
                                                class="form-control @error('payer_payee_relationship') is-invalid @enderror"
                                                name="payer_payee_relationship" required>
                                                <option disabled value="">Please select a relationship</option>
                                                <option value="Father"
                                                    {{ old('payer_payee_relationship') == 'Father' ? 'selected' : '' }}>
                                                    Father</option>
                                                <option value="Mother"
                                                    {{ old('payer_payee_relationship') == 'Mother' ? 'selected' : '' }}>
                                                    Mother</option>
                                                <option value="Daughter"
                                                    {{ old('payer_payee_relationship') == 'Daughter' ? 'selected' : '' }}>
                                                    Daughter</option>
                                                <option value="Son"
                                                    {{ old('payer_payee_relationship') == 'Son' ? 'selected' : '' }}>Son
                                                </option>
                                                <option value="Sister"
                                                    {{ old('payer_payee_relationship') == 'Sister' ? 'selected' : '' }}>
                                                    Sister</option>
                                                <option value="Brother"
                                                    {{ old('payer_payee_relationship') == 'Brother' ? 'selected' : '' }}>
                                                    Brother</option>
                                                <option value="Wife"
                                                    {{ old('payer_payee_relationship') == 'Wife' ? 'selected' : '' }}>Wife
                                                </option>
                                                <option value="Husband"
                                                    {{ old('payer_payee_relationship') == 'Husband' ? 'selected' : '' }}>
                                                    Husband</option>
                                                <option value="Father-in-Law"
                                                    {{ old('payer_payee_relationship') == 'Father-in-Law' ? 'selected' : '' }}>
                                                    Father-in-Law</option>
                                                <option value="Mother-in-Law"
                                                    {{ old('payer_payee_relationship') == 'Mother-in-Law' ? 'selected' : '' }}>
                                                    Mother-in-Law</option>
                                                <option value="Aunty"
                                                    {{ old('payer_payee_relationship') == 'Aunty' ? 'selected' : '' }}>
                                                    Aunty</option>
                                                <option value="Uncle"
                                                    {{ old('payer_payee_relationship') == 'Uncle' ? 'selected' : '' }}>
                                                    Uncle</option>
                                                <option value="Cousin"
                                                    {{ old('payer_payee_relationship') == 'Cousin' ? 'selected' : '' }}>
                                                    Cousin</option>
                                                <option value="Nephew"
                                                    {{ old('payer_payee_relationship') == 'Nephew' ? 'selected' : '' }}>
                                                    Nephew</option>
                                                <option value="Niece"
                                                    {{ old('payer_payee_relationship') == 'Niece' ? 'selected' : '' }}>
                                                    Niece</option>
                                                <option value="Grand Mother"
                                                    {{ old('payer_payee_relationship') == 'Grand Mother' ? 'selected' : '' }}>
                                                    Grand Mother</option>
                                                <option value="Grand Father"
                                                    {{ old('payer_payee_relationship') == 'Grand Father' ? 'selected' : '' }}>
                                                    Grand Father</option>
                                                <option value="Grand Daughter"
                                                    {{ old('payer_payee_relationship') == 'Grand Daughter' ? 'selected' : '' }}>
                                                    Grand Daughter</option>
                                                <option value="Grand Son"
                                                    {{ old('payer_payee_relationship') == 'Grand Son' ? 'selected' : '' }}>
                                                    Grand Son</option>
                                                <option value="Friend"
                                                    {{ old('payer_payee_relationship') == 'Friend' ? 'selected' : '' }}>
                                                    Friend</option>
                                                <option value="Friend's Mother"
                                                    {{ old('payer_payee_relationship') == "Friend's Mother" ? 'selected' : '' }}>
                                                    Friend's Mother</option>
                                                <option value="Friend's Father"
                                                    {{ old('payer_payee_relationship') == "Friend's Father" ? 'selected' : '' }}>
                                                    Friend's Father</option>
                                            </select>

                                            @error('payer_payee_relationship')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>



                                        <div id="error-container"></div>


                                        <div class="form-group" id="paymentFormFields">
                                            <!-- Payment form fields will be dynamically inserted here -->
                                        </div>
                                        <div class="form-group">
                                            <label for="beneficiaryFirstName">Beneficiary First Name:</label>
                                            <input type="text" id="beneficiaryFirstName" required
                                                class="form-control @error('rec_first_name') is-invalid @enderror"
                                                name="rec_first_name" required placeholder="Enter Beneficiary First Name" onblur="validateField(this)"
                                                value="{{ old('rec_first_name') }}">

                                                <span id="beneficiarySurnameError" class="error-message"></span>
                                            @error('rec_first_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                      

                                        <div class="form-group">
                                            <label for="beneficiarySurname">Beneficiary Surname:</label>
                                            <input type="text" id="beneficiarySurname" required
                                                class="form-control @error('rec_surname') is-invalid @enderror"
                                                name="rec_surname" required placeholder="Enter Beneficiary Surname"
                                                value="{{ old('rec_surname') }}">
                                            @error('rec_surname')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        
                                        <div class="form-group">
                                            <label for="beneficiaryMiddleName">Beneficiary Middle Name:</label>
                                            <input type="text" id="beneficiaryMiddleName"
                                                class="form-control @error('beneficiaryMiddleName') is-invalid @enderror"
                                                name="rec_middle_name" placeholder="Enter Beneficiary Middle Name"
                                                value="{{ old('rec_middle_name') }}">
                                            @error('beneficiaryMiddleName')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="houseNumber">House Number:</label>
                                            <input type="text" id="houseNumber" required
                                                class="form-control @error('rec_house_number') is-invalid @enderror"
                                                name="rec_house_number" required placeholder="Enter House Number"
                                                value="{{ old('rec_house_number') }}">
                                            @error('rec_house_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="area">Area:</label>
                                            <input type="text" id="area" required
                                                class="form-control @error('rec_area') is-invalid @enderror"
                                                name="rec_area" required placeholder="Enter Area"
                                                value="{{ old('rec_area') }}">
                                            @error('rec_area')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="city">City:</label>
                                            <input type="text" id="city" required
                                                class="form-control @error('rec_city') is-invalid @enderror"
                                                name="rec_city" required placeholder="Enter City"
                                                value="{{ old('rec_city') }}">
                                            @error('rec_city')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <input type="hidden" id="currency" name="currency">


                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Create Beneficiary</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <script>
                function validateField(inputField) {
      var value = inputField.value.trim();

      if (value === "") {
        alert(inputField.name + " cannot be empty");
        // You can add more sophisticated feedback, such as changing the field color, showing error messages, etc.
      }

      // Add additional validation for other fields as needed...
    }
                var currencies = {
                    GBR:"GBP",
    CHE:  "CHF",             
    ADO: "EUR",
    ARE: "AED",
    AUS: "AUD",
    AUT: "EUR",
    BEL: "EUR",
    CAN: "CAD",
    CHN: "CNY",
    CYP: "EUR",
    DEU: "EUR",
    ESP: "EUR",
    EST: "EUR",
    FIN: "EUR",
    FRA: "EUR",
    GRC: "EUR",
    HRV: "EUR",
    HKG: "HKD",
    IRL: "EUR",
    IND: "INR",
    ITA: "EUR",
    JPN: "JPY",
    LTA: "EUR",
    LTV: "EUR",
    LUX: "EUR",
    LVA: "EUR",
    LTU: "EUR",
    MCO: "EUR",
    MLT: "EUR",
    MYS: "MYR",
    NLD: "EUR",
    PAK: "PKR",
    POL: "PLN",
    PRT: "EUR",
    SMR: "EUR",
    SVK: "EUR",
    SVN: "EUR",
    SGP: "SGD",
    THA: "THB",
    USA: "USD",
    VAT: "EUR",
    ZAF: "ZAR",
    ZMB: "ZMW",
    MOZ: "MZN",
    MWI:"MWK",
};

var paymentOptions = {
    LVA:["BD"],
    GBR:["BD"],
    ADO: ["BD"],
    ARE: ["BD"],
    AUS: ["BD"],
    AUT: ["BD"],
    BEL: ["BD"],
    CAN: ["BD"],
    CHN: ["C"],
    CYP: ["BD"],
    DEU: ["BD"],
    ESP: ["BD"],
    EST: ["BD"],
    FIN: ["BD"],
    FRA: ["BD"],
    GRC: ["BD"],
    HRV: ["BD"],
    HKG: ["BD"],
    IRL: ["BD"],
    IND: ["BD", "CP"],
    ITA: ["BD"],
    JPN: ["BD"],
    LTA: ["BD"],
    LTV: ["BD"],
    LUX: ["BD"],
    LTU: ["BD"], 
    MCO: ["BD"],
    MLT: ["BD"],
    MYS: ["BD"],
    NLD: ["BD"],
    PAK: ["BD", "CP", "MW"],
    POL: ["BD"],
    PRT: ["BD"],
    SMR: ["BD"],
    SVK: ["BD"],
    SVN: ["BD"],
    SGP: ["BD"],
    THA: ["BD"],
    USA: ["BD"],
    VAT: ["BD"],
    ZAF: ["BD"],
    ZMB: ["MW","BD"],
    MWI: ["MW"],
    MOZ: ["MW"],
    CHE:["BD"],
    
};



                function updatePaymentMethods() {
                    var countrySelect = document.getElementById("countrySelect");
                    var selectedCountry = countrySelect.value;

                    var paymentMethodSelect = document.getElementById("paymentMethodSelect");
                    paymentMethodSelect.innerHTML = ""; // Clear previous options

                    // Add payment options based on the selected country
                    paymentOptions[selectedCountry].forEach(function(option) {
                        var optionElement = document.createElement("option");
                        optionElement.value = option;
                        optionElement.name = "payment_option";
                        optionElement.text = mapPaymentOptionToText(option);
                        paymentMethodSelect.appendChild(optionElement);
                    });
                    updateFormFields();
                }

                function updateFormFields() {
                    var paymentMethodSelect = document.getElementById("paymentMethodSelect");
                    var selectedPaymentMethod = paymentMethodSelect.value;

                    var countrySelect = document.getElementById("countrySelect");
                    var selectedCountry = countrySelect.value;

                    // Clear previous payment form fields
                    var paymentFormFields = document.getElementById("paymentFormFields");
                    paymentFormFields.innerHTML = "";

                    // Add payment form fields based on the selected payment method
                    switch (selectedPaymentMethod) {
                        case "CP":
                            addCashPickUpFields();
                            break;
                        case "MW":
                            addMobileWalletFields();
                            break;
                        case "C":
                            addCardFields();
                            break;
                        case "BD":
                            addBankDepositFields(selectedCountry);
                            break;
                        default:
                            // Handle other payment methods or set a default form
                            addCashPickUpFields();
                    }

                    // Display currency information
                    var currencyDisplay = document.getElementById("currencyDisplay");
                    currencyDisplay.textContent = "Currency: " + currencies[selectedCountry];
                    currencyDisplay.classList.add("form-control");

                    var currencyDropdown = document.createElement("select");
                    currencyDropdown.id = "currencyDropdown";
                    currencyDropdown.name = "currency";
                    

                    // Check if the selected country has a corresponding currency
                    if (currencies.hasOwnProperty(selectedCountry)) {
                        var currencyOption = document.createElement("option");
                        currencyOption.value = selectedCountry;
                        currencyOption.textContent = currencies[selectedCountry];
                        currencyOption.selected = true;
                        // if (selectedCountry === 'AUS') {
                        // var additionalOption = document.createElement("option");
                        // additionalOption.value = 'ZWL';
                        // additionalOption.textContent = 'ZWL';
                        // currencyDropdown.appendChild(additionalOption);
                        // }
                        currencyDropdown.appendChild(currencyOption);

                        // Update the hidden input field with the selected currency value
                            var currencyInput = document.getElementById("currency");
                            currencyInput.value = currencies[selectedCountry];
                                        } else {
                        // Display a default option if the selected country has no corresponding currency
                        var defaultOption = document.createElement("option");
                        defaultOption.value = "";
                        defaultOption.textContent = "No Currency Available";
                        currencyDropdown.appendChild(defaultOption);
                    }

                    // Append the currency dropdown to the currencyDisplay element
                    var currencyDisplay = document.getElementById("currencyDisplay");
                    currencyDisplay.textContent = "Currency: ";
                    currencyDisplay.appendChild(currencyDropdown);
                     
                }

                function addCashPickUpFields() {
                    var paymentFormFields = document.getElementById("paymentFormFields");

                    var pickUpLocationLabel = document.createElement("label");
                    pickUpLocationLabel.textContent = "E-Wallet Account";
                    pickUpLocationLabel.htmlFor = "pickUpLocationInput";
                    pickUpLocationLabel.classList.add("col-form-label"); // Add class for styling

                    var pickUpLocationInput = document.createElement("input");
                    pickUpLocationInput.type = "text";
                    pickUpLocationInput.placeholder = "Enter E-Wallet Account";
                    pickUpLocationInput.id = "pickUpLocationInput";
                    pickUpLocationInput.name = "rec_ewallet"; // Add name attribute
                    pickUpLocationInput.classList.add("form-control");

                    // Set the value from old input if it exists
                    var oldEwalletLocation = "{{ old('rec_ewallet') }}";
                    pickUpLocationInput.value = oldEwalletLocation;

                    // Append the label and input field to the form or container
                    paymentFormFields.appendChild(pickUpLocationLabel);
                    paymentFormFields.appendChild(pickUpLocationInput);

                    // Append the hidden input to the parent element
                    var hiddenInput = document.createElement("input");
                    hiddenInput.type = "hidden";
                    hiddenInput.id = "hiddenEwalletInput";
                    hiddenInput.name = "hidden_ewallet"; // Add name attribute for the hidden input
                    hiddenInput.value = oldEwalletLocation; // Set the value from old input if it exists
                    paymentFormFields.appendChild(hiddenInput);
                    }



                function addMobileWalletFields() {
                    var mobileNumberLabel = document.createElement("label");
                    mobileNumberLabel.textContent = "Mobile Number";
                    mobileNumberLabel.htmlFor = "mobileNumberInput";

                    var mobileNumberInput = document.createElement("input");
                    mobileNumberInput.type = "number";
                    mobileNumberInput.placeholder = "Mobile Number";
                    mobileNumberInput.id = "mobileNumberInput";
                    mobileNumberInput.name = "recipient_account_uri"; // Add name attribute
                    mobileNumberInput.classList.add("form-control");

                    // Set the value from old input if it exists
                    var oldMobileNumber = "{{ old('recipient_account_uri') }}";
                    mobileNumberInput.value = oldMobileNumber;
                    var form = document.getElementById("paymentFormFields");
                    form.appendChild(mobileNumberLabel);
                    form.appendChild(mobileNumberInput);

                   var parentElement = document.getElementById("paymentFormFields");

                   

                    // Append the hidden input to the parent element
                    parentElement.appendChild(hiddenInput);

                    // Add other Mobile Wallet fields as needed
                }

                function addCardFields() {
                    var paymentFormFields = document.getElementById("paymentFormFields");

                    // Add Card fields
                    var cardNumberLabel = document.createElement("label");
                    cardNumberLabel.textContent = "Card Number";
                    cardNumberLabel.htmlFor = "cardNumberInput";
                    cardNumberLabel.classList.add("col-form-label");

                    var cardNumberInput = document.createElement("input");
                    cardNumberInput.type = "text";
                    cardNumberInput.placeholder = "Card Number";
                    cardNumberInput.id = "cardNumberInput";
                    cardNumberInput.name = "rec_pan"; // Add name attribute
                    cardNumberInput.classList.add("form-control");

                    var oldcardNumber = "{{ old('rec_pan') }}";
                    cardNumberInput.value = oldcardNumber;
                    paymentFormFields.appendChild(cardNumberLabel);
                    paymentFormFields.appendChild(cardNumberInput);

                  
                    // Append the hidden input to the parent element
                    paymentFormFields.appendChild(hiddenInput);

                    // Government ID Field
                    var GovernmentIDLabel = document.createElement("label");
                    GovernmentIDLabel.textContent = "Government ID";
                    GovernmentIDLabel.htmlFor = "GovernmentIDInput";
                    GovernmentIDLabel.classList.add("col-form-label");

                    var GovernmentIDInput = document.createElement("input");
                    GovernmentIDInput.type = "text";
                    GovernmentIDInput.placeholder = "Government ID";
                    GovernmentIDInput.id = "GovernmentIDInput";
                    GovernmentIDInput.name = "rec_idc"; // Add name attribute
                    GovernmentIDInput.classList.add("form-control");

                    var oldgvtID = "{{ old('rec_idc') }}";
                    GovernmentIDInput.value = oldgvtID;

                    paymentFormFields.appendChild(GovernmentIDLabel);
                    paymentFormFields.appendChild(GovernmentIDInput);
                }


                function addBankDepositFields(selectedCountry) {
                    


                    if (selectedCountry === "ZAF") {
                    var paymentFormFields = document.getElementById("paymentFormFields");

                    var bankNameLabel = document.createElement("label");
                    bankNameLabel.for = "bankName";
                    bankNameLabel.textContent = "BAN (Bank Account Number)";
                    bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                    paymentFormFields.appendChild(bankNameLabel);

                    var bankNameInput = document.createElement("input");
                    bankNameInput.type = "text";
                    bankNameInput.placeholder = "Enter BAN (Bank Account Number)";
                    bankNameInput.id = "bankName";
                    bankNameInput.name = "rec_ban";
                    bankNameInput.classList.add("form-control");
                    bankNameInput.classList.add("form-group");
                    bankNameInput.required = true; // Make the field required
                    var oldBankName = "{{ old('rec_ban') }}";
                    bankNameInput.value = oldBankName;
                    paymentFormFields.appendChild(bankNameInput);

                    var bicLabel = document.createElement("label");
                    bicLabel.for = "bic";
                    bicLabel.textContent = "BIC (Bank Identifier Code)";
                    bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                    paymentFormFields.appendChild(bicLabel);

                    var bicInput = document.createElement("input");
                    bicInput.type = "text";
                    bicInput.placeholder = "Enter BIC (Bank Identifier Code)";
                    bicInput.id = "bic";
                    bicInput.name = "rec_bic";
                    bicInput.classList.add("form-group");
                    bicInput.classList.add("form-control");
                    bicInput.required = true; // Make the field required
                    var oldBic = "{{ old('rec_bic') }}";
                    bicInput.value = oldBic;
                    paymentFormFields.appendChild(bicInput);

                    // Label for Email field
                    var emailLabel = document.createElement("label");
                    emailLabel.for = "email";
                    emailLabel.textContent = "Email";
                    emailLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                    paymentFormFields.appendChild(emailLabel);

                    // Input field for Email
                    var emailInput = document.createElement("input");
                    emailInput.type = "email"; // Set the input type to "email" for email validation
                    emailInput.placeholder = "Enter Beneficiary Email";
                    emailInput.id = "email";
                    emailInput.name = "rec_email";
                    emailInput.classList.add("form-group");
                    emailInput.classList.add("form-control");
                    emailInput.required = true; // Make the field required
                    var oldEmail = "{{ old('rec_email') }}";
                    emailInput.value = oldEmail;
                    paymentFormFields.appendChild(emailInput);

                    

                    // Add other Bank Deposit fields as needed for 
                } else if (selectedCountry === "USA") {
                    var paymentFormFields = document.getElementById("paymentFormFields");

                    var bankNameLabel = document.createElement("label");
                    bankNameLabel.for = "bankName";
                    bankNameLabel.textContent = "BAN (Bank Account Number)";
                    bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                    paymentFormFields.appendChild(bankNameLabel);

                    var bankNameInput = document.createElement("input");
                    bankNameInput.type = "text";
                    bankNameInput.placeholder = "Enter BAN (Bank Account Number)";
                    bankNameInput.id = "bankName";
                    bankNameInput.name = "rec_ban";
                    bankNameInput.classList.add("form-control");
                    bankNameInput.classList.add("form-group");
                    bankNameInput.required = true; // Make the field required
                    var oldBankName = "{{ old('rec_ban') }}";
                    bankNameInput.value = oldBankName;
                    paymentFormFields.appendChild(bankNameInput);

                    var bicLabel = document.createElement("label");
                    bicLabel.for = "bic";
                    bicLabel.textContent = "BIC (Bank Identifier Code)";
                    bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                    paymentFormFields.appendChild(bicLabel);

                    var bicInput = document.createElement("input");
                    bicInput.type = "text";
                    bicInput.placeholder = "Enter BIC (Bank Identifier Code)";
                    bicInput.id = "bic";
                    bicInput.name = "rec_bic";
                    bicInput.classList.add("form-group");
                    bicInput.classList.add("form-control");
                    bicInput.required = true; // Make the field required
                    var oldBic = "{{ old('rec_bic') }}";
                    bicInput.value = oldBic;
                    paymentFormFields.appendChild(bicInput);
                    // ... (previous code)

                    // Label for bank type
                    var bankTypeLabel = document.createElement("label");
                    bankTypeLabel.for = "bankType";
                    bankTypeLabel.textContent = "Bank Account Type ";
                    bankTypeLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                    paymentFormFields.appendChild(bankTypeLabel);

                    // Create dropdown (select) for bank type
                    var bankTypeSelect = document.createElement("select");
                    bankTypeSelect.id = "rec_bank_type_field_input";
                    bankTypeSelect.name = "rec_bank_type";
                    bankTypeSelect.placeholder = "Enter Bank Type";
                    bankTypeSelect.classList.add("form-control");
                    bankTypeSelect.classList.add("form-group");
                    bankTypeSelect.required = true; // Make the field required

                    // Define options for the dropdown
                    var bankTypeOptions = [
                        { value: 'C', text: 'Checking account' },
                        { value: 'P', text: 'Saving account' }
                    ];

                    // Create and append option elements
                    bankTypeOptions.forEach(function (option) {
                        var optionElement = document.createElement("option");
                        optionElement.value = option.value;
                        optionElement.text = option.text;
                        bankTypeSelect.appendChild(optionElement);
                    });

                    // Set the selected value from local storage or old input
                    var storedValueBankType = localStorage.getItem(bankTypeSelect.name) || "{{ old('" + bankTypeSelect.name + "') }}";
                    bankTypeSelect.value = storedValueBankType;

                    // Update local storage on change
                    bankTypeSelect.addEventListener('change', function () {
                        localStorage.setItem(bankTypeSelect.name, bankTypeSelect.value);
                    });

                    paymentFormFields.appendChild(bankTypeSelect);


                    // Label for Postal field
                    var postalLabel = document.createElement("label");
                    postalLabel.for = "postalcode";
                    postalLabel.textContent = "Rec Postal Code";
                    postalLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                    paymentFormFields.appendChild(postalLabel);

                    // Input field for Postal
                    var postalInput = document.createElement("input");
                    postalInput.type = "text"; // Set the input type to "email" for email validation
                    postalInput.placeholder = "Enter Postal Code";
                    postalInput.id = "postal";
                    postalInput.name = "rec_postal_code";
                    postalInput.classList.add("form-group");
                    postalInput.classList.add("form-control");
                    postalInput.required = true; // Make the field required
                    var oldEmail = "{{ old('rec_postal_code') }}";
                    postalInput.value = oldEmail;
                    paymentFormFields.appendChild(postalInput);

                    // Label for bankname field
                    var banknameLabel = document.createElement("label");
                    banknameLabel.for = "bankname";
                    banknameLabel.textContent = "Bank Name ";
                    banknameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                    paymentFormFields.appendChild(banknameLabel);

                    // Input field for bankname
                    var banknameInput = document.createElement("input");
                    banknameInput.type = "text"; // Set the input type to "email" for email validation
                    banknameInput.placeholder = "Enter Bank Bame";
                    banknameInput.id = "bankname";
                    banknameInput.name = "rec_bank_name";
                    banknameInput.classList.add("form-group");
                    banknameInput.classList.add("form-control");
                    banknameInput.required = true; // Make the field required
                    var oldEmail = "{{ old('rec_bank_name') }}";
                    banknameInput.value = oldEmail;
                    paymentFormFields.appendChild(banknameInput);

                    // Label for subdivison field
                    var subdivisionLabel = document.createElement("label");
                    subdivisionLabel.for = "subdivison";
                    subdivisionLabel.textContent = "Rec Country Subdivison ";
                    subdivisionLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                    paymentFormFields.appendChild(subdivisionLabel);

                    // Input field for subdivison
                    var subdivisionInput = document.createElement("input");
                    subdivisionInput.type = "text"; // Set the input type to "email" for email validation
                    subdivisionInput.placeholder = "Enter Bank Bame";
                    subdivisionInput.id = "countrysubdivison";
                    subdivisionInput.name = "rec_country_subdivision";
                    subdivisionInput.classList.add("form-group");
                    subdivisionInput.classList.add("form-control");
                    subdivisionInput.required = true; // Make the field required
                    var oldSubvision = "{{ old('rec_country_subdivision') }}";
                    subdivisionInput.value = oldSubvision;
                    paymentFormFields.appendChild(subdivisionInput);
                    }
                else if (selectedCountry === "THA" || selectedCountry==="ZMB") {
                    var paymentFormFields = document.getElementById("paymentFormFields");

                    
                    var bankNameLabel = document.createElement("label");
                    bankNameLabel.for = "bankName";
                    bankNameLabel.textContent = "BAN (Bank Account Number)";
                    bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                    paymentFormFields.appendChild(bankNameLabel);

                    var bankNameInput = document.createElement("input");
                    bankNameInput.type = "text";
                    bankNameInput.placeholder = "Enter BAN (Bank Account Number)";
                    bankNameInput.id = "bankName";
                    bankNameInput.name = "rec_ban";
                    bankNameInput.classList.add("form-control");
                    bankNameInput.classList.add("form-group");
                    bankNameInput.required = true; // Make the field required
                    var oldBankName = "{{ old('rec_ban') }}";
                    bankNameInput.value = oldBankName;
                    paymentFormFields.appendChild(bankNameInput);

                    var bicLabel = document.createElement("label");
                    bicLabel.for = "bic";
                    bicLabel.textContent = "BIC (Bank Identifier Code)";
                    bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                    paymentFormFields.appendChild(bicLabel);

                    var bicInput = document.createElement("input");
                    bicInput.type = "text";
                    bicInput.placeholder = "Enter BIC";
                    bicInput.id = "bic";
                    bicInput.name = "rec_bic";
                    bicInput.classList.add("form-group");
                    bicInput.classList.add("form-control");
                    bicInput.required = true; // Make the field required
                    var oldBic = "{{ old('rec_bic') }}";
                    bicInput.value = oldBic;
                    paymentFormFields.appendChild(bicInput);

                   

                   
                }
                else if (selectedCountry === "IND") {

                        var paymentFormFields = document.getElementById("paymentFormFields");

                        
                        var bankNameLabel = document.createElement("label");
                        bankNameLabel.for = "bankName";
                        bankNameLabel.textContent = "BAN ( Bank Account Number)";
                        bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        paymentFormFields.appendChild(bankNameLabel);

                        var bankNameInput = document.createElement("input");
                        bankNameInput.type = "text";
                        bankNameInput.placeholder = "BAN ( Bank Account Number)";
                        bankNameInput.id = "bankName";
                        bankNameInput.classList.add("form-control");
                        bankNameInput.classList.add("form-group");
                        
                        paymentFormFields.appendChild(bankNameInput);

                        var bicLabel = document.createElement("label");
                        bicLabel.for = "bic";
                        bicLabel.textContent = "BIC (Bank Identifier Code)";
                        bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        paymentFormFields.appendChild(bicLabel);

                        var bicInput = document.createElement("input");
                        bicInput.type = "text";
                        bicInput.placeholder = "Enter BIC";
                        bicInput.id = "bic";

                        bicInput.classList.add("form-control");
                        paymentFormFields.appendChild(bicInput);

                    } else if (selectedCountry === "JPN") {
                        var paymentFormFields = document.getElementById("paymentFormFields");

                        var bankNameLabel = document.createElement("label");
                            bankNameLabel.for = "bankName";
                            bankNameLabel.textContent = "BAN (Bank Account Number)";
                            bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                            paymentFormFields.appendChild(bankNameLabel);

                            var bankNameInput = document.createElement("input");
                            bankNameInput.type = "text";
                            bankNameInput.placeholder = "Enter BAN (Bank Account Number)";
                            bankNameInput.id = "bankName";
                            bankNameInput.name = "rec_ban";
                            bankNameInput.classList.add("form-control");
                            bankNameInput.classList.add("form-group");
                            bankNameInput.required = true; // Make the field required
                            var oldBankName = "{{ old('rec_ban') }}";
                            bankNameInput.value = oldBankName;
                            paymentFormFields.appendChild(bankNameInput);

                            var bicLabel = document.createElement("label");
                            bicLabel.for = "bic";
                            bicLabel.textContent = "BIC (Bank Identifier Code)";
                            bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                            paymentFormFields.appendChild(bicLabel);

                            var bicInput = document.createElement("input");
                            bicInput.type = "text";
                            bicInput.placeholder = "Enter BIC";
                            bicInput.id = "bic";
                            bicInput.name = "rec_bic";
                            bicInput.classList.add("form-group");
                            bicInput.classList.add("form-control");
                            bicInput.required = true; // Make the field required
                            var oldBic = "{{ old('rec_bic') }}";
                            bicInput.value = oldBic;
                            paymentFormFields.appendChild(bicInput);

                        // Add Bank Code field
                        var bankCodeFormGroup = document.createElement("div");
                        bankCodeFormGroup.classList.add("form-group");

                        var bankCodeLabel = document.createElement("label");
                        bankCodeLabel.for = "bankCode";
                        bankCodeLabel.textContent = "Bank Code";
                        bankCodeLabel.classList.add("col-form-label");
                        bankCodeFormGroup.appendChild(bankCodeLabel);

                        var bankCodeInput = document.createElement("input");
                        bankCodeInput.type = "text";
                        bankCodeInput.placeholder = "Enter Bank Code";
                        bankCodeInput.id = "bankCode";
                        bankCodeInput.name = "rec_bank_code";
                        bankCodeInput.classList.add("form-control");
                        bankCodeInput.required = true; // Make the field required
                            var oldbankCodeInput = "{{ old('rec_bank_code') }}";
                            bankCodeInput.value = oldbankCodeInput;
                        bankCodeFormGroup.appendChild(bankCodeInput);

                        paymentFormFields.appendChild(bankCodeFormGroup);

                        // Create dropdown (select) for bank type
                        var bankTypeFormGroup = document.createElement("div");
                        bankTypeFormGroup.classList.add("form-group");

                        var bankTypeLabel = document.createElement("label");
                        bankTypeLabel.for = "rec_bank_type_field_input";
                        bankTypeLabel.textContent = "Bank Type";
                        bankTypeLabel.classList.add("col-form-label");
                        bankTypeFormGroup.appendChild(bankTypeLabel);

                        var bankTypeSelect = document.createElement("select");
                        bankTypeSelect.id = "rec_bank_type_field_input";
                        bankTypeSelect.name = "rec_bank_type";
                        bankTypeSelect.classList.add("form-control");
                        bankTypeSelect.required = true;

                        // Define options for the dropdown
                        var bankTypeOptions = [
                            { value: 'C', text: 'Checking account' },
                            { value: 'P', text: 'Saving account' }
                        ];

                        // Create and append option elements
                        bankTypeOptions.forEach(function (option) {
                            var optionElement = document.createElement("option");
                            optionElement.value = option.value;
                            optionElement.text = option.text;
                            bankTypeSelect.appendChild(optionElement);
                        });

                        // Set the selected value from local storage or old input
                        var storedValueBankType = localStorage.getItem(bankTypeSelect.name) || "{{ old('" + bankTypeSelect.name + "') }}";
                        bankTypeSelect.value = storedValueBankType;

                        // Update local storage on change
                        bankTypeSelect.addEventListener('change', function () {
                            localStorage.setItem(bankTypeSelect.name, bankTypeSelect.value);
                        });

                        bankTypeFormGroup.appendChild(bankTypeSelect);
                        paymentFormFields.appendChild(bankTypeFormGroup);
                    }
                        else if (selectedCountry === "AUS" ) {
                        var paymentFormFields = document.getElementById("paymentFormFields");

                        // Add Bank Deposit fields for AUS
                        var bankNameLabel = document.createElement("label");
                        bankNameLabel.for = "bankName";
                        bankNameLabel.textContent = "BAN (Bank Account Number)";
                        bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        paymentFormFields.appendChild(bankNameLabel);

                        var bankNameInput = document.createElement("input");
                        bankNameInput.type = "text";
                        bankNameInput.placeholder = "BAN (Bank Account Number)";
                        bankNameInput.id = "bankName";
                        bankNameInput.name = "rec_ban"; // Name for storing the value
                        bankNameInput.classList.add("form-control");
                        bankNameInput.classList.add("form-group");
                        paymentFormFields.appendChild(bankNameInput);

                        var bicLabel = document.createElement("label");
                        bicLabel.for = "bic";
                        bicLabel.textContent = "BIC (Bank Identifier Code)";
                        bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        paymentFormFields.appendChild(bicLabel);

                        var bicInput = document.createElement("input");
                        bicInput.type = "text";
                        bicInput.placeholder = "Enter BIC";
                        bicInput.id = "bic";
                        bicInput.name = "rec_bic"; // Name for storing the value
                        bicInput.classList.add("form-control");
                        paymentFormFields.appendChild(bicInput);

                        // Add Bank Code field
                        var bankCodeLabel = document.createElement("label");
                        bankCodeLabel.for = "bankCode";
                        bankCodeLabel.textContent = "Bank Code";
                        bankCodeLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        paymentFormFields.appendChild(bankCodeLabel);

                        var bankCodeInput = document.createElement("input");
                        bankCodeInput.type = "text";
                        bankCodeInput.placeholder = "Enter Bank Code";
                        bankCodeInput.id = "bankCode";
                        bankCodeInput.name = "rec_bank_code"; // Name for storing the value
                        bankCodeInput.classList.add("form-control");
                        paymentFormFields.appendChild(bankCodeInput);
                    } else if (selectedCountry === "CAN" || selectedCountry === "HKG" || selectedCountry ==="SGP" || selectedCountry ==="MYS") {
                        var paymentFormFields = document.getElementById("paymentFormFields");

                        // Add Bank Deposit fields for CAN
                        var bankNameLabel = document.createElement("label");
                        bankNameLabel.for = "bankName";
                        bankNameLabel.textContent = "BAN (Bank Account Number)";
                        bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        paymentFormFields.appendChild(bankNameLabel);

                        var bankNameInput = document.createElement("input");
                        bankNameInput.type = "text";
                        bankNameInput.placeholder = "BAN (Bank Account Number)";
                        bankNameInput.id = "bankName";
                        bankNameInput.name = "rec_ban"; // Name for storing the value
                        bankNameInput.classList.add("form-control");
                        bankNameInput.classList.add("form-group");
                        paymentFormFields.appendChild(bankNameInput);

                        var bicLabel = document.createElement("label");
                        bicLabel.for = "bic";
                        bicLabel.textContent = "BIC (Bank Identifier Code)";
                        bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        paymentFormFields.appendChild(bicLabel);

                        var bicInput = document.createElement("input");
                        bicInput.type = "text";
                        bicInput.placeholder = "Enter BIC";
                        bicInput.id = "bic";
                        bicInput.name = "rec_bic"; // Name for storing the value
                        bicInput.classList.add("form-control");
                        paymentFormFields.appendChild(bicInput);


                    } else if (selectedCountry === "ARE") { // Example list of field names
                        // Example list of field names
                        var fieldNames = [
                            'rec_iban_field', 'rec_iban_field1',
                            'rec_idc_field', 'rec_idc_field1',
                            'rec_country_subdivision_field', 'rec_country_subdivision_field1',
                            'recipient_account_uri_field', 'recipient_account_uri_field1',
                            'id_expiration_date_field', 'id_expiration_date_field1',
                        ];

                        // Container to hold the created elements
                        var paymentFormFields = document.getElementById("paymentFormFields");

                        // Initialize dynamic form data object
                        var formData = {};

                        // Populate dynamic form data object with default values
                        // for (var i = 0; i < fieldNames.length; i++) {

                        //     formData[fieldNames[i].replace('_field', '')] = ' ' + (i + 1);
                        // }

                        // Create input fields and labels based on the original field names
                        for (var i = 0; i < fieldNames.length; i += 2) {
                        // Create label
                        var label = document.createElement("label");
                        label.for = fieldNames[i] + "_input";
                        label.textContent = fieldNames[i].replace(/_/g, " ").replace(" field", "").split(" ").map(word => word
                            .charAt(0).toUpperCase() + word.slice(1)).join(" ");
                        label.classList.add("col-form-label"); // Bootstrap class for label styling
                        paymentFormFields.appendChild(label);

                        // Create input field
                        var input = document.createElement("input");
                        input.placeholder = "Enter " + fieldNames[i].replace(/_/g, " ").replace(" field", "");
                        input.id = fieldNames[i] + "_input";
                        input.name = fieldNames[i].replace("_field", "");
                        input.classList.add("form-control");
                        input.classList.add("form-group");
                        input.required = true; // Make the field required

                        // Set the value from dynamic form data or old input
                        if (formData[input.name]) {
                            input.value = formData[input.name];
                        } else {
                            input.value = "{{ old('" + input.name + "') }}";
                        }

                        // Special handling for the expiration date field
                        if (fieldNames[i] === 'id_expiration_date_field') {
                            input.type = "date";
                        } else {
                            input.type = "text";
                        }

                        paymentFormFields.appendChild(input);
                    }




                    }


                     else if  (selectedCountry === "ARE" ||
                                selectedCountry === "GBR" ||
                                selectedCountry === "POL" ||
                                selectedCountry === "CHE" ||
                                selectedCountry === "ADO" ||
                                selectedCountry === "AUT" ||
                                selectedCountry === "BEL" ||
                                selectedCountry === "HRV" ||
                                selectedCountry === "CYP" ||
                                selectedCountry === "EST" ||
                                selectedCountry === "FIN" ||
                                selectedCountry === "FRA" ||
                                selectedCountry === "DEU" ||
                                selectedCountry === "GRC" ||
                                selectedCountry === "IRL" ||
                                selectedCountry === "ITA" ||
                                selectedCountry === "LVA" ||
                                selectedCountry === "LTU" ||
                                selectedCountry === "LUX" ||
                                selectedCountry === "MLT" ||
                                selectedCountry === "MCO" ||
                                selectedCountry === "NLD" ||
                                selectedCountry === "PRT" ||
                                selectedCountry === "SMR" ||
                                selectedCountry === "SVK" ||
                                selectedCountry === "SVN" ||
                                selectedCountry === "ESP" ||
                                selectedCountry === "VAT")
                                {
                                    
                        var paymentFormFields = document.getElementById("paymentFormFields");

                        // Label for IBAN field
                        var ibanLabel = document.createElement("label");
                        ibanLabel.for = "iban";
                        ibanLabel.textContent = "IBAN";
                        ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        paymentFormFields.appendChild(ibanLabel);

                        // Input field for IBAN
                        var ibanInput = document.createElement("input");
                        ibanInput.type = "text";
                        ibanInput.placeholder = "Enter IBAN";
                        ibanInput.id = "iban";
                        ibanInput.name = "rec_iban"; // Set the name attribute
                        ibanInput.classList.add("form-group");
                        ibanInput.classList.add("form-control");

                        // Set the value from old input if it exists
                        var oldIban = "{{ old('rec_iban') }}";
                        ibanInput.value = oldIban;

                        paymentFormFields.appendChild(ibanInput);




                        // Add other common Bank Deposit fields as needed for other countries
                    }
                }

                function mapPaymentOptionToText(option) {
                    switch (option) {
                        case "CP":
                            return "Cash Pick Up";
                        case "MW":
                            return "Mobile Wallet";
                        case "C":
                            return "Card";
                        case "BD":
                            return "Bank Deposit";
                        default:
                            return option;
                    }
                }

                function submitForm(event) {
                    event.preventDefault(); // Prevent the default form submission

                    var countrySelect = document.getElementById("countrySelect");
                    var selectedCountry = countrySelect.value;

                    var paymentMethodSelect = document.getElementById("paymentMethodSelect");
                    var selectedPaymentMethod = paymentMethodSelect.value;

                    alert("Form submitted!\nSelected Country Code: " + selectedCountry + "\nSelected Payment Method: " +
                        mapPaymentOptionToText(selectedPaymentMethod));
                }

                // Initial call to set up the form based on the default selected country and payment method
                updatePaymentMethods();
            </script>

        </body>

    </html>
@endsection
