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
                                                <option  value="">Please select a country</option>
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
                                                <option  value="">Please select a sender</option>
                                                <!-- This is the unselectable option -->
                                                @foreach ($senders as $sender)
                                                    <option value="{{ $sender->id }}"
                                                            {{ $sender->id == old('customer_id') ? 'selected' : '' }}>
                                                        {{ $sender->first_name }} {{ $sender->surname }}
                                                        {{ "(". $sender->id_number .")" }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div id="customerError" class="invalid-feedback"></div>
                                        </div>

                                       
                                        <div class="form-group">
                                            <label
                                                for="payer_payee_relationship">{{ __('Select Payer-Payee Relationship') }}</label>
                                            <select id="payer_payee_relationship"
                                                class="form-control @error('payer_payee_relationship') is-invalid @enderror"
                                                name="payer_payee_relationship" required>
                                                <option disabled selected>Please select a relationship</option>
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

                                                                                    <!-- In your Blade view -->
                                            <div id="paymentFormFields" data-old-ewallet="{{ old('rec_ewallet') }}">
                                                <!-- other HTML content -->
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
            <script src="{{ asset('assets/js/validation/script.js') }}"></script><script>
            
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
    PAK: ["BD", "CP", "MW","IB"],
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

                            case "IB":
                            addBankIBDepositFields(selectedCountry);
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
                    
                    }



                function addMobileWalletFields() {
                    var countrySelect = document.getElementById("countrySelect");
                    var selectedCountry = countrySelect.value;
                    
                     if (selectedCountry === "ZMB") {
                                            // Label for Mobile Number field
                                    var mobileNumberLabel = document.createElement("label");
                                    mobileNumberLabel.textContent = "Mobile Number";
                                    mobileNumberLabel.htmlFor = "mobileNumberInput";
                                    mobileNumberLabel.classList.add("col-form-label"); // Bootstrap class for label styling

                                    // Container for Mobile Number input
                                    var mobileNumberContainer = document.createElement("div");
                                    mobileNumberContainer.classList.add("form-group"); // Bootstrap class for form group

                                    // Input field for Mobile Number
                                    var mobileNumberInput = document.createElement("input");
                                    mobileNumberInput.type = "number";
                                    mobileNumberInput.placeholder = "260 1 0000 0000 ";
                                    mobileNumberInput.id = "mobileNumberInput";
                                    mobileNumberInput.name = "recipient_account_uri"; // Add name attribute
                                    mobileNumberInput.classList.add("form-control");

                                    // Add event listener for input validation
                                    mobileNumberInput.addEventListener("input", function () {
                                        validateMobileNumberInput();
                                    });

                                    // Set initial value
                                    var oldMobileNumber = "{{ old('recipient_account_uri') }}";
                                    mobileNumberInput.value = oldMobileNumber;

                                    mobileNumberContainer.appendChild(mobileNumberInput);

                                    // Function to validate Mobile Number input
                                    function validateMobileNumberInput() {
                                        var mobileNumberValue = mobileNumberInput.value.replace(/\s/g, '');
                                        var regex = /^260[1-9]{1}[0-9]{8}$/;
                                        var isValid = regex.test(mobileNumberValue);

                                        if (mobileNumberValue.trim() === '') {
                                            // Add red border to indicate error
                                            mobileNumberInput.classList.remove("is-valid");
                                            mobileNumberInput.classList.add("is-invalid");

                                            // Display error message
                                            showErrorMessage(mobileNumberContainer, "Mobile Number is required.");
                                        } else if (!isValid) {
                                            // Add red border to indicate error
                                            mobileNumberInput.classList.remove("is-valid");
                                            mobileNumberInput.classList.add("is-invalid");

                                            // Display error message
                                            showErrorMessage(mobileNumberContainer, "Invalid Mobile Number format for ZAmbai, expected format 260 1 0000 0000 ");
                                        } else {
                                            // Add green border to indicate correctness
                                            mobileNumberInput.classList.remove("is-invalid");
                                            mobileNumberInput.classList.add("is-valid");

                                            // Remove any existing error message
                                            hideErrorMessage(mobileNumberContainer);
                                        }
                                    }

                                    // Function to show error message
                                    function showErrorMessage(container, message) {
                                        // Check if an error message already exists
                                        var existingErrorMessage = container.querySelector(".invalid-feedback");

                                        if (!existingErrorMessage) {
                                            // Create and append an error message element
                                            var errorMessage = document.createElement("div");
                                            errorMessage.textContent = message;
                                            errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                            container.appendChild(errorMessage);
                                        }
                                    }

                                    // Function to hide error message
                                    function hideErrorMessage(container) {
                                        // Remove any existing error message
                                        var existingErrorMessage = container.querySelector(".invalid-feedback");
                                        if (existingErrorMessage) {
                                            existingErrorMessage.remove();
                                        }
                                    }

                                    var form = document.getElementById("paymentFormFields");
                                    form.appendChild(mobileNumberLabel);
                                    form.appendChild(mobileNumberContainer);


                    }else if (selectedCountry === "MOZ") {
                                            // Label for Mobile Number field
                                    var mobileNumberLabel = document.createElement("label");
                                    mobileNumberLabel.textContent = "Mobile Number";
                                    mobileNumberLabel.htmlFor = "mobileNumberInput";
                                    mobileNumberLabel.classList.add("col-form-label"); // Bootstrap class for label styling

                                    // Container for Mobile Number input
                                    var mobileNumberContainer = document.createElement("div");
                                    mobileNumberContainer.classList.add("form-group"); // Bootstrap class for form group

                                    // Input field for Mobile Number
                                    var mobileNumberInput = document.createElement("input");
                                    mobileNumberInput.type = "number";
                                    mobileNumberInput.placeholder = "258 0 0000 0000";
                                    mobileNumberInput.id = "mobileNumberInput";
                                    mobileNumberInput.name = "recipient_account_uri"; // Add name attribute
                                    mobileNumberInput.classList.add("form-control");

                                    // Add event listener for input validation
                                    mobileNumberInput.addEventListener("input", function () {
                                        validateMobileNumberInput();
                                    });

                                    // Set initial value
                                    var oldMobileNumber = "{{ old('recipient_account_uri') }}";
                                    mobileNumberInput.value = oldMobileNumber;

                                    mobileNumberContainer.appendChild(mobileNumberInput);

                                    // Function to validate Mobile Number input
                                    function validateMobileNumberInput() {
                                        var mobileNumberValue = mobileNumberInput.value.replace(/\s/g, '');
                                        var regex = /^258[0-9]{9}/;
                                        var isValid = regex.test(mobileNumberValue);

                                        if (mobileNumberValue.trim() === '') {
                                            // Add red border to indicate error
                                            mobileNumberInput.classList.remove("is-valid");
                                            mobileNumberInput.classList.add("is-invalid");

                                            // Display error message
                                            showErrorMessage(mobileNumberContainer, "Invalid Mobile Number format for Mozambique, expected format 258 0 0000 0000");
                                        } else if (!isValid) {
                                            // Add red border to indicate error
                                            mobileNumberInput.classList.remove("is-valid");
                                            mobileNumberInput.classList.add("is-invalid");

                                            // Display error message
                                            showErrorMessage(mobileNumberContainer, "Invalid Mobile Number format for Mozambique, expected format 258 0 0000 0000 ");
                                        } else {
                                            // Add green border to indicate correctness
                                            mobileNumberInput.classList.remove("is-invalid");
                                            mobileNumberInput.classList.add("is-valid");

                                            // Remove any existing error message
                                            hideErrorMessage(mobileNumberContainer);
                                        }
                                    }

                                    // Function to show error message
                                    function showErrorMessage(container, message) {
                                        // Check if an error message already exists
                                        var existingErrorMessage = container.querySelector(".invalid-feedback");

                                        if (!existingErrorMessage) {
                                            // Create and append an error message element
                                            var errorMessage = document.createElement("div");
                                            errorMessage.textContent = message;
                                            errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                            container.appendChild(errorMessage);
                                        }
                                    }

                                    // Function to hide error message
                                    function hideErrorMessage(container) {
                                        // Remove any existing error message
                                        var existingErrorMessage = container.querySelector(".invalid-feedback");
                                        if (existingErrorMessage) {
                                            existingErrorMessage.remove();
                                        }
                                    }

                                    var form = document.getElementById("paymentFormFields");
                                    form.appendChild(mobileNumberLabel);
                                    form.appendChild(mobileNumberContainer);


                    }
                    else if (selectedCountry === "MWI") {
                                            // Label for Mobile Number field
                                    var mobileNumberLabel = document.createElement("label");
                                    mobileNumberLabel.textContent = "Mobile Number";
                                    mobileNumberLabel.htmlFor = "mobileNumberInput";
                                    mobileNumberLabel.classList.add("col-form-label"); // Bootstrap class for label styling

                                    // Container for Mobile Number input
                                    var mobileNumberContainer = document.createElement("div");
                                    mobileNumberContainer.classList.add("form-group"); // Bootstrap class for form group

                                    // Input field for Mobile Number
                                    var mobileNumberInput = document.createElement("input");
                                    mobileNumberInput.type = "number";
                                    mobileNumberInput.placeholder = "265 000 000 000";
                                    mobileNumberInput.id = "mobileNumberInput";
                                    mobileNumberInput.name = "recipient_account_uri"; // Add name attribute
                                    mobileNumberInput.classList.add("form-control");

                                    // Add event listener for input validation
                                    mobileNumberInput.addEventListener("input", function () {
                                        validateMobileNumberInput();
                                    });

                                    // Set initial value
                                    var oldMobileNumber = "{{ old('recipient_account_uri') }}";
                                    mobileNumberInput.value = oldMobileNumber;

                                    mobileNumberContainer.appendChild(mobileNumberInput);

                                    // Function to validate Mobile Number input
                                    function validateMobileNumberInput() {
                                        var mobileNumberValue = mobileNumberInput.value.replace(/\s/g, '');
                                        var regex = /^265[0-9]{9}/;
                                        var isValid = regex.test(mobileNumberValue);

                                        if (mobileNumberValue.trim() === '') {
                                            // Add red border to indicate error
                                            mobileNumberInput.classList.remove("is-valid");
                                            mobileNumberInput.classList.add("is-invalid");

                                            // Display error message
                                            showErrorMessage(mobileNumberContainer, "Mobile Number is required.");
                                        } else if (!isValid) {
                                            // Add red border to indicate error
                                            mobileNumberInput.classList.remove("is-valid");
                                            mobileNumberInput.classList.add("is-invalid");

                                            // Display error message
                                            showErrorMessage(mobileNumberContainer, "Invalid Mobile Number format for Malawi, expected format 265 000 000 000 ");
                                        } else {
                                            // Add green border to indicate correctness
                                            mobileNumberInput.classList.remove("is-invalid");
                                            mobileNumberInput.classList.add("is-valid");

                                            // Remove any existing error message
                                            hideErrorMessage(mobileNumberContainer);
                                        }
                                    }

                                    // Function to show error message
                                    function showErrorMessage(container, message) {
                                        // Check if an error message already exists
                                        var existingErrorMessage = container.querySelector(".invalid-feedback");

                                        if (!existingErrorMessage) {
                                            // Create and append an error message element
                                            var errorMessage = document.createElement("div");
                                            errorMessage.textContent = message;
                                            errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                            container.appendChild(errorMessage);
                                        }
                                    }

                                    // Function to hide error message
                                    function hideErrorMessage(container) {
                                        // Remove any existing error message
                                        var existingErrorMessage = container.querySelector(".invalid-feedback");
                                        if (existingErrorMessage) {
                                            existingErrorMessage.remove();
                                        }
                                    }

                                    var form = document.getElementById("paymentFormFields");
                                    form.appendChild(mobileNumberLabel);
                                    form.appendChild(mobileNumberContainer);


                    }
                     else if (selectedCountry === "PAK") {
                                    // Label for Mobile Number field
                                        var mobileNumberLabel = document.createElement("label");
                                        mobileNumberLabel.textContent = "Mobile Number";
                                        mobileNumberLabel.htmlFor = "mobileNumberInput";
                                        mobileNumberLabel.classList.add("col-form-label"); // Bootstrap class for label styling

                                        // Container for Mobile Number input
                                        var mobileNumberContainer = document.createElement("div");
                                        mobileNumberContainer.classList.add("form-group"); // Bootstrap class for form group

                                        // Input field for Mobile Number
                                        var mobileNumberInput = document.createElement("input");
                                        mobileNumberInput.type = "number";
                                        mobileNumberInput.placeholder = "92 0000 0000 00";
                                        mobileNumberInput.id = "mobileNumberInput";
                                        mobileNumberInput.name = "recipient_account_uri"; // Add name attribute
                                        mobileNumberInput.classList.add("form-control");

                                        // Add event listener for input validation
                                        mobileNumberInput.addEventListener("input", function () {
                                            validateMobileNumberInput();
                                        });

                                        // Set initial value
                                        var oldMobileNumber = "{{ old('recipient_account_uri') }}";
                                        mobileNumberInput.value = oldMobileNumber;

                                        mobileNumberContainer.appendChild(mobileNumberInput);

                                        // Function to validate Mobile Number input
                                        function validateMobileNumberInput() {
                                            var mobileNumberValue = mobileNumberInput.value.replace(/\s/g, '');
                                            var regex = /^92[0-9]{10}$/;
                                            var isValid = regex.test(mobileNumberValue);

                                            if (mobileNumberValue.trim() === '') {
                                                // Add red border to indicate error
                                                mobileNumberInput.classList.remove("is-valid");
                                                mobileNumberInput.classList.add("is-invalid");

                                                // Display error message
                                                showErrorMessage(mobileNumberContainer, "Invalid Mobile Number of Pakistan .");
                                            } else if (!isValid) {
                                                // Add red border to indicate error
                                                mobileNumberInput.classList.remove("is-valid");
                                                mobileNumberInput.classList.add("is-invalid");

                                                // Display error message
                                                showErrorMessage(mobileNumberContainer, "Invalid Mobile Number of Pakistan, expected format  92 0000 0000 00");
                                            } else {
                                                // Add green border to indicate correctness
                                                mobileNumberInput.classList.remove("is-invalid");
                                                mobileNumberInput.classList.add("is-valid");

                                                // Remove any existing error message
                                                hideErrorMessage(mobileNumberContainer);
                                            }
                                        }

                                        // Function to show error message
                                        function showErrorMessage(container, message) {
                                            // Check if an error message already exists
                                            var existingErrorMessage = container.querySelector(".invalid-feedback");

                                            if (!existingErrorMessage) {
                                                // Create and append an error message element
                                                var errorMessage = document.createElement("div");
                                                errorMessage.textContent = message;
                                                errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                container.appendChild(errorMessage);
                                            }
                                        }

                                        // Function to hide error message
                                        function hideErrorMessage(container) {
                                            // Remove any existing error message
                                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                                            if (existingErrorMessage) {
                                                existingErrorMessage.remove();
                                            }
                                        }

                                        // Prevent form submission if mobile number is incorrect
                                        var form = document.getElementById("paymentFormFields");
                                        form.addEventListener("submit", function (event) {
                                            validateMobileNumberInput(); // Validate the mobile number before submission

                                            // Check if the mobile number input is valid
                                            if (!mobileNumberInput.classList.contains("is-valid")) {
                                                event.preventDefault(); // Prevent form submission
                                            }
                                        });

                                        form.appendChild(mobileNumberLabel);
                                        form.appendChild(mobileNumberContainer);
                                    }
                }
                
                function addCardFields(selectedCountry) {
    if (selectedCountry === "CHN") {
        var paymentFormFields = document.getElementById("paymentFormFields");

        // Add Card fields
        var cardNumberLabel = document.createElement("label");
        cardNumberLabel.textContent = "Card Number";
        cardNumberLabel.htmlFor = "cardNumberInput";
        cardNumberLabel.classList.add("col-form-label");

        var cardNumberInput = document.createElement("input");
        cardNumberInput.type = "text";
        cardNumberInput.placeholder = "62X 0000 0000 0000 0000";
        cardNumberInput.id = "cardNumberInput";
        cardNumberInput.name = "rec_pan"; // Add name attribute
        cardNumberInput.classList.add("form-control");

        // Add event listener for input validation
        cardNumberInput.addEventListener("input", function () {
            validateCardNumberInput();
        });

        paymentFormFields.appendChild(cardNumberLabel);
        paymentFormFields.appendChild(cardNumberInput);

        // Add rec_idc fields
        var recIdcLabel = document.createElement("label");
        recIdcLabel.textContent = "Rec IDC";
        recIdcLabel.htmlFor = "recIdcInput";
        recIdcLabel.classList.add("col-form-label");

        var recIdcInput = document.createElement("input");
        recIdcInput.type = "text";
        recIdcInput.placeholder = "Rec IDC";
        recIdcInput.id = "recIdcInput";
        recIdcInput.name = "rec_idc"; // Add name attribute
        recIdcInput.classList.add("form-control");

        // Add event listener for input validation
        recIdcInput.addEventListener("input", function () {
            validateRecIdcInput();
        });

        paymentFormFields.appendChild(recIdcLabel);
        paymentFormFields.appendChild(recIdcInput);

        var form = document.getElementById("myForm"); // replace "yourFormId" with your actual form ID

        // Function to show error message beneath the input field
        function showErrorMessage(container, inputField, message) {
            // Check if an error message element already exists
            var existingErrorMessage = container.querySelector(".error-message");
            if (existingErrorMessage) {
                existingErrorMessage.textContent = message; // Update existing message
            } else {
                // Create a new error message element
                var errorMessage = document.createElement("div");
                errorMessage.textContent = message;
                errorMessage.classList.add("error-message", "invalid-feedback");

                // Insert the error message after the input field
                container.insertBefore(errorMessage, inputField.nextSibling);
            }
        }

        // Function to hide error message
        function hideErrorMessage(container) {
            var existingErrorMessage = container.querySelector(".error-message");
            if (existingErrorMessage) {
                container.removeChild(existingErrorMessage);
            }
        }

        // Function to validate Card Number input
        function validateCardNumberInput() {
            var cardNumberInput = document.getElementById("cardNumberInput");
            var cardNumberValue = cardNumberInput.value.replace(/\s/g, '');
            // Validation regex for card numbers (16 digits)
            var regex = /^62.*[0-9]{16}(?:[0-9]{3})?$/;

            var isValid = regex.test(cardNumberValue);

            if (cardNumberValue.trim() === '' || !isValid) {
                // Add red border to indicate error
                cardNumberInput.classList.remove("is-valid");
                cardNumberInput.classList.add("is-invalid");

                // Display error message beneath the input field
                showErrorMessage(paymentFormFields, cardNumberInput, "Invalid Card Number for China, expected format 62X 0000 0000 0000 0000");
            } else {
                // Add green border to indicate correctness
                cardNumberInput.classList.remove("is-invalid");
                cardNumberInput.classList.add("is-valid");

                // Remove any existing error message
                hideErrorMessage(paymentFormFields);
            }
        }

        // Function to validate Rec IDC input
        function validateRecIdcInput() {
            var recIdcInput = document.getElementById("recIdcInput");
            var recIdcValue = recIdcInput.value;
            // You can add any specific validation logic for rec_idc as needed

            // For a string, you might want to ensure it's not empty or has a minimum length, etc.
            var regex = /^[A-Za-z0-9]+$/;
            var isValid = regex.test(recIdcValue);

            if (!isValid) {
                // Add red border to indicate error
                recIdcInput.classList.remove("is-valid");
                recIdcInput.classList.add("is-invalid");

                // Display error message beneath the input field
                showErrorMessage(paymentFormFields, recIdcInput, "Rec IDC cannot be empty. Please enter a value.");
            } else {
                // Add green border to indicate correctness
                recIdcInput.classList.remove("is-invalid");
                recIdcInput.classList.add("is-valid");

                // Remove any existing error message
                hideErrorMessage(paymentFormFields);
            }
        }

        // Include rec_idc validation in form submission check
        form.addEventListener("submit", function (event) {
            validateCardNumberInput();
            validateRecIdcInput(); // Validate rec_idc before submission

            // Check if both card number and rec_idc inputs are valid
            if (!document.getElementById("cardNumberInput").classList.contains("is-valid") || !document.getElementById("recIdcInput").classList.contains("is-valid")) {
                return false; // Prevent form submission
            }
        });
    }
}
function addBankIBDepositFields(selectedCountry) {
    if (selectedCountry === "PAK") {
    var paymentFormFields = document.getElementById("paymentFormFields");

    // Create container for ibanInput
    var ibanContainer = document.createElement("div");
    ibanContainer.classList.add("form-group"); // Bootstrap class for form group

    // Create label element
    var ibanLabel = document.createElement("label");
    ibanLabel.for = "iban";
    ibanLabel.textContent = "IBAN";
    ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
    ibanContainer.appendChild(ibanLabel);

    // Create input element
    var ibanInput = document.createElement("input");
    ibanInput.type = "text";
    ibanInput.placeholder = "Enter IBAN";
    ibanInput.id = "iban";
    ibanInput.name = "rec_iban";
    ibanInput.classList.add("form-control");
    ibanInput.required = true; // Make the field required

    // Add event listener for input validation
    ibanInput.addEventListener("input", function () {
        validateIbanInput();
    });

    ibanContainer.appendChild(ibanInput);
    paymentFormFields.appendChild(ibanContainer);

    // Function to validate ibanInput
    function validateIbanInput() {
        var ibanValue = ibanInput.value.replace(/\s/g, '');
        var regex = /^[A-Z]{2}\d{2}[0-9]{4}\d{16}$/; // Adjust the regex as needed for IBAN validation

        if (ibanValue === '') {
            // Add red border to indicate error
            ibanInput.classList.remove("is-valid");
            ibanInput.classList.add("is-invalid");

            // Display error message
            showErrorMessage(ibanContainer, "Please enter a valid PAK IBAN and must match the pattern: /^[A-Z]{2}\d{2}[0-9]{4}\d{16}$/");
        } else if (!regex.test(ibanValue)) {
            // Add red border to indicate error
            ibanInput.classList.remove("is-valid");
            ibanInput.classList.add("is-invalid");

            // Display error message
            showErrorMessage(ibanContainer, "Please enter a valid PAK IBAN and must match the pattern: /^[A-Z]{2}\d{2}[0-9]{4}\d{16}$/");
        } else {
            // Add green border to indicate correctness
            ibanInput.classList.remove("is-invalid");
            ibanInput.classList.add("is-valid");

            // Remove any existing error message
            hideErrorMessage(ibanContainer);
        }
    }

    // Function to show error message
    function showErrorMessage(container, message) {
        // Check if an error message already exists
        var existingErrorMessage = container.querySelector(".invalid-feedback");

        if (!existingErrorMessage) {
            // Create and append an error message element
            var errorMessage = document.createElement("div");
            errorMessage.textContent = message;
            errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
            container.appendChild(errorMessage);
        }
    }

    // Function to hide error message
    function hideErrorMessage(container) {
        // Remove any existing error message
        var existingErrorMessage = container.querySelector(".invalid-feedback");
        if (existingErrorMessage) {
            existingErrorMessage.remove();
        }
    }
}


}




                function addBankDepositFields(selectedCountry) {
                    


                    if (selectedCountry === "ZAF") {
                        var paymentFormFields = document.getElementById("paymentFormFields");

                        // Create container for bankNameInput
                        var bankNameContainer = document.createElement("div");
                        bankNameContainer.classList.add("form-group"); // Bootstrap class for form group

                        // Create label element
                        var bankNameLabel = document.createElement("label");
                        bankNameLabel.for = "bankName";
                        bankNameLabel.textContent = "BAN (Bank Account Number)";
                        bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        bankNameContainer.appendChild(bankNameLabel);

                        // Create input element
                        var bankNameInput = document.createElement("input");
                        bankNameInput.type = "text";
                        bankNameInput.placeholder = "Enter BAN (Bank Account Number)";
                        bankNameInput.id = "bankName";
                        bankNameInput.name = "rec_ban";
                        bankNameInput.classList.add("form-control");
                        bankNameInput.required = true; // Make the field required

                        // Add event listener for input validation
                        bankNameInput.addEventListener("input", function () {
                            validateBankNameInput();
                        });

                        bankNameContainer.appendChild(bankNameInput);
                        paymentFormFields.appendChild(bankNameContainer);

                        // Function to validate bankNameInput
                        function validateBankNameInput() {
                            var bankNameValue = bankNameInput.value;
                            var regex = /^.{8,11}/;
                            var isValid = regex.test(bankNameValue);

                            if (bankNameValue.trim() === '') {
                                // Add red border to indicate error
                                bankNameInput.classList.remove("is-valid");
                                bankNameInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bankNameContainer, "Bank Account Number  of South Africa is required & Bank Account Number must be 8 to 11 characters long.");
                            } else if (!isValid) {
                                // Add red border to indicate error
                                bankNameInput.classList.remove("is-valid");
                                bankNameInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bankNameContainer, "Bank Account Number of South Africa must be 8 to 11 characters long.");
                            } else {
                                // Add green border to indicate correctness
                                bankNameInput.classList.remove("is-invalid");
                                bankNameInput.classList.add("is-valid");

                                // Remove any existing error message
                                hideErrorMessage(bankNameContainer);
                            }
                        }

                        // Function to show error message
                        function showErrorMessage(container, message) {
                            // Check if an error message already exists
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            
                            if (!existingErrorMessage) {
                                // Create and append an error message element
                                var errorMessage = document.createElement("div");
                                errorMessage.textContent = message;
                                errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                container.appendChild(errorMessage);
                            }
                        }

                        // Function to hide error message
                        function hideErrorMessage(container) {
                            // Remove any existing error message
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            if (existingErrorMessage) {
                                existingErrorMessage.remove();
                            }
                        }




                        var bicLabel = document.createElement("label");
                        bicLabel.for = "bic";
                        bicLabel.textContent = "BIC (Bank Identifier Code)";
                        bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        paymentFormFields.appendChild(bicLabel);

                        // Create container for BIC input
                        var bicContainer = document.createElement("div");
                        bicContainer.classList.add("form-group"); // Bootstrap class for form group

                        var bicInput = document.createElement("input");
                        bicInput.type = "text";
                        bicInput.placeholder = "XXXX ZAXX";
                        bicInput.id = "bic";
                        bicInput.name = "rec_bic";
                        bicInput.classList.add("form-control");
                        bicInput.required = true; // Make the field required

                        // Add event listener for input validation
                        bicInput.addEventListener("input", function () {
                            validateBicInput();
                        });

                        // Set initial value
                        var oldBic = "{{ old('rec_bic') }}";
                        bicInput.value = oldBic;

                        bicContainer.appendChild(bicInput);
                        paymentFormFields.appendChild(bicContainer);

                        // Function to validate BIC input
                        function validateBicInput() {
                            var bicValue = bicInput.value.replace(/\s/g, '');
                            var regex = /^[A-Z]{4}ZA.{2}.*/;
                            var isValid = regex.test(bicValue);

                            if (bicValue.trim() === '') {
                                // Add red border to indicate error
                                bicInput.classList.remove("is-valid");
                                bicInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bicContainer, "invalid BIC of South Africa, expected  XXXXZAXX");
                            } else if (!isValid) {
                                // Add red border to indicate error
                                bicInput.classList.remove("is-valid");
                                bicInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bicContainer, "invalid BIC of South Africa, expected  XXXX ZAXX");
                            } else {
                                // Add green border to indicate correctness
                                bicInput.classList.remove("is-invalid");
                                bicInput.classList.add("is-valid");

                                // Remove any existing error message
                                hideErrorMessage(bicContainer);
                            }
                        }

                        // Function to show error message
                        function showErrorMessage(container, message) {
                            // Check if an error message already exists
                            var existingErrorMessage = container.querySelector(".invalid-feedback");

                            if (!existingErrorMessage) {
                                // Create and append an error message element
                                var errorMessage = document.createElement("div");
                                errorMessage.textContent = message;
                                errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                container.appendChild(errorMessage);
                            }
                        }

                        // Function to hide error message
                        function hideErrorMessage(container) {
                            // Remove any existing error message
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            if (existingErrorMessage) {
                                existingErrorMessage.remove();
                            }
                        }




                   // Label for Email field
                            var emailLabel = document.createElement("label");
                            emailLabel.for = "email";
                            emailLabel.textContent = "Email";
                            emailLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                            paymentFormFields.appendChild(emailLabel);

                            // Container for Email input
                            var emailContainer = document.createElement("div");
                            emailContainer.classList.add("form-group"); // Bootstrap class for form group

                            // Input field for Email
                            var emailInput = document.createElement("input");
                            emailInput.type = "email"; // Set the input type to "email" for email validation
                            emailInput.placeholder = "Enter Beneficiary Email";
                            emailInput.id = "email";
                            emailInput.name = "rec_email";
                            emailInput.classList.add("form-control");

                            // Add event listener for input validation
                            emailInput.addEventListener("input", function () {
                                validateEmailInput();
                            });

                            // Set initial value
                            var oldEmail = "{{ old('rec_email') }}";
                            emailInput.value = oldEmail;

                            emailContainer.appendChild(emailInput);
                            paymentFormFields.appendChild(emailContainer);

                            // Function to validate Email input
                            function validateEmailInput() {
                                var emailValue = emailInput.value;
                                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                var isValid = emailRegex.test(emailValue);

                                if (!isValid) {
                                    // Add red border to indicate error
                                    emailInput.classList.remove("is-valid");
                                    emailInput.classList.add("is-invalid");

                                    // Display error message
                                    showErrorMessage(emailContainer, "Enter a valid email address.");
                                } else {
                                    // Add green border to indicate correctness
                                    emailInput.classList.remove("is-invalid");
                                    emailInput.classList.add("is-valid");

                                    // Remove any existing error message
                                    hideErrorMessage(emailContainer);
                                }
                            }

                            // Function to show error message
                            function showErrorMessage(container, message) {
                                // Check if an error message already exists
                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                if (!existingErrorMessage) {
                                    // Create and append an error message element
                                    var errorMessage = document.createElement("div");
                                    errorMessage.textContent = message;
                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                    container.appendChild(errorMessage);
                                }
                            }

                            // Function to hide error message
                            function hideErrorMessage(container) {
                                // Remove any existing error message
                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                if (existingErrorMessage) {
                                    existingErrorMessage.remove();
                                }
                            }
                  

                                        }  if (selectedCountry === "PAK") {
                            var paymentFormFields = document.getElementById("paymentFormFields");

                            // Label for Bank Name field
                            var bankNameLabel = document.createElement("label");
                            bankNameLabel.for = "bankName";
                            bankNameLabel.textContent = "BAN (Bank Account Number)";
                            bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                            paymentFormFields.appendChild(bankNameLabel);

                            // Container for Bank Name input
                            var bankNameContainer = document.createElement("div");
                            bankNameContainer.classList.add("form-group"); // Bootstrap class for form group

                            // Input field for Bank Name
                            var bankNameInput = document.createElement("input");
                            bankNameInput.type = "text";
                            bankNameInput.placeholder = "Enter BAN (Bank Account Number)";
                            bankNameInput.id = "bankName";
                            bankNameInput.name = "rec_ban";
                            bankNameInput.classList.add("form-control");
                            bankNameInput.required = true;

                            // Add event listener for input validation
                            bankNameInput.addEventListener("input", function () {
                                validateBankNameInput();
                            });

                            // Set initial value
                            var oldBankName = "{{ old('rec_ban') }}";
                            bankNameInput.value = oldBankName;

                            bankNameContainer.appendChild(bankNameInput);
                            paymentFormFields.appendChild(bankNameContainer);

                            // Function to validate Bank Name input
                            function validateBankNameInput() {
                                var bankNameValue = bankNameInput.value;

                                if (bankNameValue.trim() === '') {
                                    // Add red border to indicate error
                                    bankNameInput.classList.remove("is-valid");
                                    bankNameInput.classList.add("is-invalid");

                                    // Display error message
                                    showErrorMessage(bankNameContainer, "Bank Account Number is required.");
                                } else {
                                    // Add green border to indicate correctness
                                    bankNameInput.classList.remove("is-invalid");
                                    bankNameInput.classList.add("is-valid");

                                    // Remove any existing error message
                                    hideErrorMessage(bankNameContainer);
                                }
                            }

                            // Function to show error message
                            function showErrorMessage(container, message) {
                                // Check if an error message already exists
                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                if (!existingErrorMessage) {
                                    // Create and append an error message element
                                    var errorMessage = document.createElement("div");
                                    errorMessage.textContent = message;
                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                    container.appendChild(errorMessage);
                                }
                            }

                            // Function to hide error message
                            function hideErrorMessage(container) {
                                // Remove any existing error message
                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                if (existingErrorMessage) {
                                    existingErrorMessage.remove();
                                }
                            }

                            var bicLabel = document.createElement("label");
                            bicLabel.for = "bic";
                            bicLabel.textContent = "BIC (Bank Identifier Code)";
                            bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                            paymentFormFields.appendChild(bicLabel);

                            // Create container for BIC input
                            var bicContainer = document.createElement("div");
                            bicContainer.classList.add("form-group"); // Bootstrap class for form group

                            var bicInput = document.createElement("input");
                            bicInput.type = "text";
                            bicInput.placeholder = "0000 0000 0";
                            bicInput.id = "bic";
                            bicInput.name = "rec_bic";
                            bicInput.classList.add("form-control");
                            bicInput.required = true; // Make the field required

                            // Add event listener for input validation
                            bicInput.addEventListener("input", function () {
                                validateBicInput();
                            });

                            // Set initial value
                            var oldBic = "{{ old('rec_bic') }}";
                            bicInput.value = oldBic;

                            bicContainer.appendChild(bicInput);
                            paymentFormFields.appendChild(bicContainer);

                            // Function to validate BIC input
                            function validateBicInput() {
                                var bicValue = bicInput.value.replace(/\s/g, '');
                                var regex = /^[0-9]{9}$/;
                                var isValid = regex.test(bicValue);

                                if (bicValue.trim() === '') {
                                    // Add red border to indicate error
                                    bicInput.classList.remove("is-valid");
                                    bicInput.classList.add("is-invalid");

                                    // Display error message
                                    showErrorMessage(bicContainer, "Invalid BIC format oF USA, expected formart 0000 0000 0");
                                } else if (!isValid) {
                                    // Add red border to indicate error
                                    bicInput.classList.remove("is-valid");
                                    bicInput.classList.add("is-invalid");

                                    // Display error message
                                    showErrorMessage(bicContainer, "Invalid BIC format oF USA, expected formart 0000 0000 0");
                                } else {
                                    // Add green border to indicate correctness
                                    bicInput.classList.remove("is-invalid");
                                    bicInput.classList.add("is-valid");

                                    // Remove any existing error message
                                    hideErrorMessage(bicContainer);
                                }
                            }

                            // Function to show error message
                            function showErrorMessage(container, message) {
                                // Check if an error message already exists
                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                if (!existingErrorMessage) {
                                    // Create and append an error message element
                                    var errorMessage = document.createElement("div");
                                    errorMessage.textContent = message;
                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                    container.appendChild(errorMessage);
                                }
                            }

                            // Function to hide error message
                            function hideErrorMessage(container) {
                                // Remove any existing error message
                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                if (existingErrorMessage) {
                                    existingErrorMessage.remove();
                                }
                            }
                        }

                 else if (selectedCountry === "USA") {
                    var paymentFormFields = document.getElementById("paymentFormFields");

                   // Label for Bank Name field
                    var bankNameLabel = document.createElement("label");
                    bankNameLabel.for = "bankName";
                    bankNameLabel.textContent = "BAN (Bank Account Number)";
                    bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                    paymentFormFields.appendChild(bankNameLabel);

                    // Container for Bank Name input
                    var bankNameContainer = document.createElement("div");
                    bankNameContainer.classList.add("form-group"); // Bootstrap class for form group

                    // Input field for Bank Name
                    var bankNameInput = document.createElement("input");
                    bankNameInput.type = "text";
                    bankNameInput.placeholder = "Enter BAN (Bank Account Number)";
                    bankNameInput.id = "bankName";
                    bankNameInput.name = "rec_ban";
                    bankNameInput.classList.add("form-control");
                    bankNameInput.required = true; 

                    // Add event listener for input validation
                    bankNameInput.addEventListener("input", function () {
                        validateBankNameInput();
                    });

                    // Set initial value
                    var oldBankName = "{{ old('rec_ban') }}";
                    bankNameInput.value = oldBankName;

                    bankNameContainer.appendChild(bankNameInput);
                    paymentFormFields.appendChild(bankNameContainer);

                    // Function to validate Bank Name input
                    function validateBankNameInput() {
                        var bankNameValue = bankNameInput.value;

                        if (bankNameValue.trim() === '') {
                            // Add red border to indicate error
                            bankNameInput.classList.remove("is-valid");
                            bankNameInput.classList.add("is-invalid");

                            // Display error message
                            showErrorMessage(bankNameContainer, "Bank Account Number is required.");
                        } else {
                            // Add green border to indicate correctness
                            bankNameInput.classList.remove("is-invalid");
                            bankNameInput.classList.add("is-valid");

                            // Remove any existing error message
                            hideErrorMessage(bankNameContainer);
                        }
                    }

                    // Function to show error message
                    function showErrorMessage(container, message) {
                        // Check if an error message already exists
                        var existingErrorMessage = container.querySelector(".invalid-feedback");

                        if (!existingErrorMessage) {
                            // Create and append an error message element
                            var errorMessage = document.createElement("div");
                            errorMessage.textContent = message;
                            errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                            container.appendChild(errorMessage);
                        }
                    }

                    // Function to hide error message
                    function hideErrorMessage(container) {
                        // Remove any existing error message
                        var existingErrorMessage = container.querySelector(".invalid-feedback");
                        if (existingErrorMessage) {
                            existingErrorMessage.remove();
                        }
                    }


                    var bicLabel = document.createElement("label");
                        bicLabel.for = "bic";
                        bicLabel.textContent = "BIC (Bank Identifier Code)";
                        bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        paymentFormFields.appendChild(bicLabel);

                        // Create container for BIC input
                        var bicContainer = document.createElement("div");
                        bicContainer.classList.add("form-group"); // Bootstrap class for form group

                        var bicInput = document.createElement("input");
                        bicInput.type = "text";
                        bicInput.placeholder = "0000 0000 0";
                        bicInput.id = "bic";
                        bicInput.name = "rec_bic";
                        bicInput.classList.add("form-control");
                        bicInput.required = true; // Make the field required

                        // Add event listener for input validation
                        bicInput.addEventListener("input", function () {
                            validateBicInput();
                        });

                        // Set initial value
                        var oldBic = "{{ old('rec_bic') }}";
                        bicInput.value = oldBic;

                        bicContainer.appendChild(bicInput);
                        paymentFormFields.appendChild(bicContainer);

                        // Function to validate BIC input
                        function validateBicInput() {
                            var bicValue = bicInput.value.replace(/\s/g, '');
                            var regex =/^[0-9]{9}$/;
                            var isValid = regex.test(bicValue);

                            if (bicValue.trim() === '') {
                                // Add red border to indicate error
                                bicInput.classList.remove("is-valid");
                                bicInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bicContainer, "Invalid BIC oF USA, expected format 0000 0000 0 ");
                            } else if (!isValid) {
                                // Add red border to indicate error
                                bicInput.classList.remove("is-valid");
                                bicInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bicContainer, "Invalid BIC oF USA, expected format 0000 0000 0");
                            } else {
                                // Add green border to indicate correctness
                                bicInput.classList.remove("is-invalid");
                                bicInput.classList.add("is-valid");

                                // Remove any existing error message
                                hideErrorMessage(bicContainer);
                            }
                        }

                        // Function to show error message
                        function showErrorMessage(container, message) {
                            // Check if an error message already exists
                            var existingErrorMessage = container.querySelector(".invalid-feedback");

                            if (!existingErrorMessage) {
                                // Create and append an error message element
                                var errorMessage = document.createElement("div");
                                errorMessage.textContent = message;
                                errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                container.appendChild(errorMessage);
                            }
                        }

                        // Function to hide error message
                        function hideErrorMessage(container) {
                            // Remove any existing error message
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            if (existingErrorMessage) {
                                existingErrorMessage.remove();
                            }
                        }
                    

                        // Create label for bank type
                        var bankTypeLabel = document.createElement("label");
                        bankTypeLabel.for = "rec_bank_type";
                        bankTypeLabel.textContent = "Bank Account Type";
                        bankTypeLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        paymentFormFields.appendChild(bankTypeLabel);

                        // Create container for bank type select
                        var bankTypeContainer = document.createElement("div");
                        bankTypeContainer.classList.add("form-group"); // Bootstrap class for form group

                        // Create dropdown (select) for bank type
                        var bankTypeSelect = document.createElement("select");
                        bankTypeSelect.id = "rec_bank_type_field_input";
                        bankTypeSelect.name = "rec_bank_type";
                        bankTypeSelect.classList.add("form-control");

                        // Define options for the dropdown
                        var bankTypeOptions = [
                            { value: '', text: 'Select Bank Account Type', disabled: true, selected: true },
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
                        bankTypeSelect.required=true;

                        // Add event listener for input validation
                        bankTypeSelect.addEventListener("change", function () {
                            validateBankTypeSelect();
                        });

                        bankTypeContainer.appendChild(bankTypeSelect);
                        paymentFormFields.appendChild(bankTypeContainer);

                        // Function to validate bank type select
                        function validateBankTypeSelect() {
                            var selectedBankType = bankTypeSelect.value;

                            if (selectedBankType === '') {
                                // Add red border to indicate error
                                bankTypeSelect.classList.remove("is-valid");
                                bankTypeSelect.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bankTypeContainer, "Bank Account Type is required.");
                            } else {
                                // Add green border to indicate correctness
                                bankTypeSelect.classList.remove("is-invalid");
                                bankTypeSelect.classList.add("is-valid");

                                // Remove any existing error message
                                hideErrorMessage(bankTypeContainer);
                            }
                        }

                        // Function to show error message
                        function showErrorMessage(container, message) {
                            // Check if an error message already exists
                            var existingErrorMessage = container.querySelector(".invalid-feedback");

                            if (!existingErrorMessage) {
                                // Create and append an error message element
                                var errorMessage = document.createElement("div");
                                errorMessage.textContent = message;
                                errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                container.appendChild(errorMessage);
                            }
                        }

                        // Function to hide error message
                        function hideErrorMessage(container) {
                            // Remove any existing error message
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            if (existingErrorMessage) {
                                existingErrorMessage.remove();
                            }
                        }





                            // Label for Postal field
                            var postalLabel = document.createElement("label");
                            postalLabel.for = "postal";
                            postalLabel.textContent = "Rec Postal Code";
                            postalLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                            paymentFormFields.appendChild(postalLabel);

                            // Container for Postal input
                            var postalContainer = document.createElement("div");
                            postalContainer.classList.add("form-group"); // Bootstrap class for form group

                            // Input field for Postal
                            var postalInput = document.createElement("input");
                            postalInput.type = "text";
                            postalInput.placeholder = "Enter Postal Code";
                            postalInput.id = "postal";
                            postalInput.name = "rec_postal_code";
                            postalInput.classList.add("form-control");
                            postalInput.required = true;

                            // Add event listener for input validation
                            postalInput.addEventListener("input", function () {
                                validatePostalInput();
                            });

                            // Set initial value
                            var oldPostalCode = "{{ old('rec_postal_code') }}";
                            postalInput.value = oldPostalCode;

                            postalContainer.appendChild(postalInput);
                            paymentFormFields.appendChild(postalContainer);

                            // Function to validate Postal input
                            function validatePostalInput() {
                                var postalValue = postalInput.value;

                                // Regular expression to match 5 digits
                                var postalRegex = /^\d{5}$/;

                                if (postalValue.trim() === '' || !postalRegex.test(postalValue)) {
                                    // Add red border to indicate error
                                    postalInput.classList.remove("is-valid");
                                    postalInput.classList.add("is-invalid");

                                    // Display error message
                                    showErrorMessage(postalContainer, "Enter a valid 5-digit Postal Code.");
                                } else {
                                    // Add green border to indicate correctness
                                    postalInput.classList.remove("is-invalid");
                                    postalInput.classList.add("is-valid");

                                    // Remove any existing error message
                                    hideErrorMessage(postalContainer);
                                }
                            }

                            // Function to show error message
                            function showErrorMessage(container, message) {
                                // Check if an error message already exists
                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                if (!existingErrorMessage) {
                                    // Create and append an error message element
                                    var errorMessage = document.createElement("div");
                                    errorMessage.textContent = message;
                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                    container.appendChild(errorMessage);
                                }
                            }

                            // Function to hide error message
                            function hideErrorMessage(container) {
                                // Remove any existing error message
                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                if (existingErrorMessage) {
                                    existingErrorMessage.remove();
                                }
                            }


                    // Label for bankname field
                            var banknameLabel = document.createElement("label");
                            banknameLabel.for = "bankname";
                            banknameLabel.textContent = "Bank Name ";
                            banknameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                            paymentFormFields.appendChild(banknameLabel);

                            // Container for bankname input
                            var banknameContainer = document.createElement("div");
                            banknameContainer.classList.add("form-group"); // Bootstrap class for form group

                            // Input field for bankname
                            var banknameInput = document.createElement("input");
                            banknameInput.type = "text";
                            banknameInput.placeholder = "Enter Bank Name";
                            banknameInput.id = "bankname";
                            banknameInput.name = "rec_bank_name";
                            banknameInput.classList.add("form-control");
                            banknameInput.required = true;

                            // Add event listener for input validation
                            banknameInput.addEventListener("input", function () {
                                validateBanknameInput();
                            });

                            // Set initial value
                            var oldBankName = "{{ old('rec_bank_name') }}";
                            banknameInput.value = oldBankName;

                            banknameContainer.appendChild(banknameInput);
                            paymentFormFields.appendChild(banknameContainer);

                            // Function to validate Bank Name input
                            function validateBanknameInput() {
                                var banknameValue = banknameInput.value;

                                if (banknameValue.trim() === '') {
                                    // Add red border to indicate error
                                    banknameInput.classList.remove("is-valid");
                                    banknameInput.classList.add("is-invalid");

                                    // Display error message
                                    showErrorMessage(banknameContainer, "Bank Name is required.");
                                } else {
                                    // Add green border to indicate correctness
                                    banknameInput.classList.remove("is-invalid");
                                    banknameInput.classList.add("is-valid");

                                    // Remove any existing error message
                                    hideErrorMessage(banknameContainer);
                                }
                            }


                    // Label for subdivision field
                                    var subdivisionLabel = document.createElement("label");
                                    subdivisionLabel.for = "subdivision";
                                    subdivisionLabel.textContent = "Rec Country Subdivision";
                                    subdivisionLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                    paymentFormFields.appendChild(subdivisionLabel);

                                    // Container for subdivision input
                                    var subdivisionContainer = document.createElement("div");
                                    subdivisionContainer.classList.add("form-group"); // Bootstrap class for form group

                                    // Input field for subdivision
                                    var subdivisionInput = document.createElement("input");
                                    subdivisionInput.type = "text";
                                    subdivisionInput.placeholder = "Enter Country Subdivision";
                                    subdivisionInput.id = "subdivision";
                                    subdivisionInput.name = "rec_country_subdivision";
                                    subdivisionInput.classList.add("form-control");
                                    subdivisionInput.required = true; // Make the field required

                                    // Add event listener for input validation
                                    subdivisionInput.addEventListener("input", function () {
                                        validateSubdivisionInput();
                                    });

                                    // Set initial value
                                    var oldSubdivision = "{{ old('rec_country_subdivision') }}";
                                    subdivisionInput.value = oldSubdivision;

                                    subdivisionContainer.appendChild(subdivisionInput);
                                    paymentFormFields.appendChild(subdivisionContainer);

                                    // Function to validate Country Subdivision input
                                    function validateSubdivisionInput() {
                                        var subdivisionValue = subdivisionInput.value;

                                        if (subdivisionValue.trim() === '') {
                                            // Add red border to indicate error
                                            subdivisionInput.classList.remove("is-valid");
                                            subdivisionInput.classList.add("is-invalid");

                                            // Display error message
                                            showErrorMessage(subdivisionContainer, "Country Subdivision is required.");
                                        } else {
                                            // Add green border to indicate correctness
                                            subdivisionInput.classList.remove("is-invalid");
                                            subdivisionInput.classList.add("is-valid");

                                            // Remove any existing error message
                                            hideErrorMessage(subdivisionContainer);
                                        }
                                    }

                    }
                else if (selectedCountry === "THA" || selectedCountry==="ZMB") {
                    var countrySelect = document.getElementById("countrySelect");
                    var selectedCountry = countrySelect.value;

                    if(selectedCountry === "THA"){
                       
                        var paymentFormFields = document.getElementById("paymentFormFields");

                    
                            // Create container for bankNameInput
                            var bankNameContainer = document.createElement("div");
                                bankNameContainer.classList.add("form-group"); // Bootstrap class for form group

                                // Create label element
                                var bankNameLabel = document.createElement("label");
                                bankNameLabel.for = "bankName";
                                bankNameLabel.textContent = "BAN (Bank Account Number)";
                                bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                bankNameContainer.appendChild(bankNameLabel);

                                // Create input element
                                var bankNameInput = document.createElement("input");
                                bankNameInput.type = "text";
                                bankNameInput.placeholder = "Enter BAN (Bank Account Number)";
                                bankNameInput.id = "bankName";
                                bankNameInput.name = "rec_ban";
                                bankNameInput.classList.add("form-control");
                                bankNameInput.required = true; // Make the field required

                                // Add event listener for input validation
                                bankNameInput.addEventListener("input", function () {
                                    validateBankNameInput();
                                });

                                bankNameContainer.appendChild(bankNameInput);
                                paymentFormFields.appendChild(bankNameContainer);

                                // Function to validate bankNameInput
                                function validateBankNameInput() {
                                    var bankNameValue = bankNameInput.value;
                                    var regex = /^.+/;
                                    var isValid = regex.test(bankNameValue);

                                    if (bankNameValue.trim() === '') {
                                        // Add red border to indicate error
                                        bankNameInput.classList.remove("is-valid");
                                        bankNameInput.classList.add("is-invalid");

                                        // Display error message
                                        showErrorMessage(bankNameContainer, "Bank Account Number is required ");
                                    } else if (!isValid) {
                                        // Add red border to indicate error
                                        bankNameInput.classList.remove("is-valid");
                                        bankNameInput.classList.add("is-invalid");

                                        // Display error message
                                        showErrorMessage(bankNameContainer, "Bank Account Number is required");
                                    } else {
                                        // Add green border to indicate correctness
                                        bankNameInput.classList.remove("is-invalid");
                                        bankNameInput.classList.add("is-valid");

                                        // Remove any existing error message
                                        hideErrorMessage(bankNameContainer);
                                    }
                                }

                                // Function to show error message
                                function showErrorMessage(container, message) {
                                    // Check if an error message already exists
                                    var existingErrorMessage = container.querySelector(".invalid-feedback");
                                    
                                    if (!existingErrorMessage) {
                                        // Create and append an error message element
                                        var errorMessage = document.createElement("div");
                                        errorMessage.textContent = message;
                                        errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                        container.appendChild(errorMessage);
                                    }
                                }

                                // Function to hide error message
                                function hideErrorMessage(container) {
                                    // Remove any existing error message
                                    var existingErrorMessage = container.querySelector(".invalid-feedback");
                                    if (existingErrorMessage) {
                                        existingErrorMessage.remove();
                                    }
                                }

                                var bicLabel = document.createElement("label");
                                bicLabel.for = "bic";
                                bicLabel.textContent = "BIC (Bank Identifier Code)";
                                bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                paymentFormFields.appendChild(bicLabel);

                                // Create container for BIC input
                                var bicContainer = document.createElement("div");
                                bicContainer.classList.add("form-group"); // Bootstrap class for form group

                                var bicInput = document.createElement("input");
                                bicInput.type = "text";
                                bicInput.placeholder = "XXX THXX";
                                bicInput.id = "bic";
                                bicInput.name = "rec_bic";
                                bicInput.classList.add("form-control");
                                bicInput.required = true; // Make the field required

                                // Add event listener for input validation
                                bicInput.addEventListener("input", function () {
                                    validateBicInput();
                                });

                                // Set initial value
                                var oldBic = "{{ old('rec_bic') }}";
                                bicInput.value = oldBic;

                                bicContainer.appendChild(bicInput);
                                paymentFormFields.appendChild(bicContainer);

                                // Function to validate BIC input
                                function validateBicInput() {
                                    var bicValue = bicInput.value.replace(/\s/g, '');
                                    var regex =/^[A-Z]{4}TH.{2}.*/;  
                                    var isValid = regex.test(bicValue);

                                    if (bicValue.trim() === '') {
                                        // Add red border to indicate error
                                        bicInput.classList.remove("is-valid");
                                        bicInput.classList.add("is-invalid");

                                        // Display error message
                                        showErrorMessage(bicContainer, "Invalid Thailand BIC format, expected  XXXX THXX");
                                    } else if (!isValid) {
                                        // Add red border to indicate error
                                        bicInput.classList.remove("is-valid");
                                        bicInput.classList.add("is-invalid");

                                        // Display error message
                                        showErrorMessage(bicContainer, "Invalid Thailand BIC format, expected  XXX THXX");
                                    } else {
                                        // Add green border to indicate correctness
                                        bicInput.classList.remove("is-invalid");
                                        bicInput.classList.add("is-valid");

                                        // Remove any existing error message
                                        hideErrorMessage(bicContainer);
                                    }
                                }

                                // Function to show error message
                                function showErrorMessage(container, message) {
                                    // Check if an error message already exists
                                    var existingErrorMessage = container.querySelector(".invalid-feedback");

                                    if (!existingErrorMessage) {
                                        // Create and append an error message element
                                        var errorMessage = document.createElement("div");
                                        errorMessage.textContent = message;
                                        errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                        container.appendChild(errorMessage);
                                    }
                                }

                                // Function to hide error message
                                function hideErrorMessage(container) {
                                    // Remove any existing error message
                                    var existingErrorMessage = container.querySelector(".invalid-feedback");
                                    if (existingErrorMessage) {
                                        existingErrorMessage.remove();
                                    }
                                }

                            



                    }

                    else if (selectedCountry === "ZMB"){
                        var paymentFormFields = document.getElementById("paymentFormFields");

                    
                    // Create container for bankNameInput
                    var bankNameContainer = document.createElement("div");
                        bankNameContainer.classList.add("form-group"); // Bootstrap class for form group

                        // Create label element
                        var bankNameLabel = document.createElement("label");
                        bankNameLabel.for = "bankName";
                        bankNameLabel.textContent = "BAN (Bank Account Number)";
                        bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        bankNameContainer.appendChild(bankNameLabel);

                        // Create input element
                        var bankNameInput = document.createElement("input");
                        bankNameInput.type = "text";
                        bankNameInput.placeholder = "Enter BAN (Bank Account Number)";
                        bankNameInput.id = "bankName";
                        bankNameInput.name = "rec_ban";
                        bankNameInput.classList.add("form-control");
                        bankNameInput.required = true; // Make the field required

                        // Add event listener for input validation
                        bankNameInput.addEventListener("input", function () {
                            validateBankNameInput();
                        });

                        bankNameContainer.appendChild(bankNameInput);
                        paymentFormFields.appendChild(bankNameContainer);

                        // Function to validate bankNameInput
                        function validateBankNameInput() {
                            var bankNameValue = bankNameInput.value;
                            var regex = /^.+/;
                            var isValid = regex.test(bankNameValue);

                            if (bankNameValue.trim() === '') {
                                // Add red border to indicate error
                                bankNameInput.classList.remove("is-valid");
                                bankNameInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bankNameContainer, "Bank Account Number is required ");
                            } else if (!isValid) {
                                // Add red border to indicate error
                                bankNameInput.classList.remove("is-valid");
                                bankNameInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bankNameContainer, "Bank Account Number is required");
                            } else {
                                // Add green border to indicate correctness
                                bankNameInput.classList.remove("is-invalid");
                                bankNameInput.classList.add("is-valid");

                                // Remove any existing error message
                                hideErrorMessage(bankNameContainer);
                            }
                        }

                        // Function to show error message
                        function showErrorMessage(container, message) {
                            // Check if an error message already exists
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            
                            if (!existingErrorMessage) {
                                // Create and append an error message element
                                var errorMessage = document.createElement("div");
                                errorMessage.textContent = message;
                                errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                container.appendChild(errorMessage);
                            }
                        }

                        // Function to hide error message
                        function hideErrorMessage(container) {
                            // Remove any existing error message
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            if (existingErrorMessage) {
                                existingErrorMessage.remove();
                            }
                        }

                        var bicLabel = document.createElement("label");
                        bicLabel.for = "bic";
                        bicLabel.textContent = "BIC (Bank Identifier Code)";
                        bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        paymentFormFields.appendChild(bicLabel);

                        // Create container for BIC input
                        var bicContainer = document.createElement("div");
                        bicContainer.classList.add("form-group"); // Bootstrap class for form group

                        var bicInput = document.createElement("input");
                        bicInput.type = "text";
                        bicInput.placeholder = "XXXX ZMXX";
                        bicInput.id = "bic";
                        bicInput.name = "rec_bic";
                        bicInput.classList.add("form-control");
                        bicInput.required = true; // Make the field required

                        // Add event listener for input validation
                        bicInput.addEventListener("input", function () {
                            validateBicInput();
                        });

                        // Set initial value
                        var oldBic = "{{ old('rec_bic') }}";
                        bicInput.value = oldBic;

                        bicContainer.appendChild(bicInput);
                        paymentFormFields.appendChild(bicContainer);

                        // Function to validate BIC input
                        function validateBicInput() {
                            var bicValue = bicInput.value.replace(/\s/g, '');
                            var regex =/^[A-Z]{4}ZM.{2}.*/;
                            var isValid = regex.test(bicValue);

                            if (bicValue.trim() === '') {
                                // Add red border to indicate error
                                bicInput.classList.remove("is-valid");
                                bicInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bicContainer, "Invalid BIC  of Zambia, expected XXXX ZMXX");
                            } else if (!isValid) {
                                // Add red border to indicate error
                                bicInput.classList.remove("is-valid");
                                bicInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bicContainer, "Invalid BIC  of Zambia, expected XXXX ZMXX ");
                            } else {
                                // Add green border to indicate correctness
                                bicInput.classList.remove("is-invalid");
                                bicInput.classList.add("is-valid");

                                // Remove any existing error message
                                hideErrorMessage(bicContainer);
                            }
                        }

                        // Function to show error message
                        function showErrorMessage(container, message) {
                            // Check if an error message already exists
                            var existingErrorMessage = container.querySelector(".invalid-feedback");

                            if (!existingErrorMessage) {
                                // Create and append an error message element
                                var errorMessage = document.createElement("div");
                                errorMessage.textContent = message;
                                errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                container.appendChild(errorMessage);
                            }
                        }

                        // Function to hide error message
                        function hideErrorMessage(container) {
                            // Remove any existing error message
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            if (existingErrorMessage) {
                                existingErrorMessage.remove();
                            }
                        }

                    }
                    

                   

                   
                }
                else if (selectedCountry === "IND") {

                    var paymentFormFields = document.getElementById("paymentFormFields");

                    
// Create container for bankNameInput
var bankNameContainer = document.createElement("div");
    bankNameContainer.classList.add("form-group"); // Bootstrap class for form group

    // Create label element
    var bankNameLabel = document.createElement("label");
    bankNameLabel.for = "bankName";
    bankNameLabel.textContent = "BAN (Bank Account Number)";
    bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
    bankNameContainer.appendChild(bankNameLabel);

    // Create input element
    var bankNameInput = document.createElement("input");
    bankNameInput.type = "text";
    bankNameInput.placeholder = "Enter BAN (Bank Account Number)";
    bankNameInput.id = "bankName";
    bankNameInput.name = "rec_ban";
    bankNameInput.classList.add("form-control");
    bankNameInput.required = true; // Make the field required

    // Add event listener for input validation
    bankNameInput.addEventListener("input", function () {
        validateBankNameInput();
    });

    bankNameContainer.appendChild(bankNameInput);
    paymentFormFields.appendChild(bankNameContainer);

    // Function to validate bankNameInput
    function validateBankNameInput() {
        var bankNameValue = bankNameInput.value;
        var regex = /^.*/;
        var isValid = regex.test(bankNameValue);

        if (bankNameValue.trim() === '') {
            // Add red border to indicate error
            bankNameInput.classList.remove("is-valid");
            bankNameInput.classList.add("is-invalid");

            // Display error message
            showErrorMessage(bankNameContainer, "Bank Account Number is required ");
        } else if (!isValid) {
            // Add red border to indicate error
            bankNameInput.classList.remove("is-valid");
            bankNameInput.classList.add("is-invalid");

            // Display error message
            showErrorMessage(bankNameContainer, "Bank Account Number is required");
        } else {
            // Add green border to indicate correctness
            bankNameInput.classList.remove("is-invalid");
            bankNameInput.classList.add("is-valid");

            // Remove any existing error message
            hideErrorMessage(bankNameContainer);
        }
    }

    // Function to show error message
    function showErrorMessage(container, message) {
        // Check if an error message already exists
        var existingErrorMessage = container.querySelector(".invalid-feedback");
        
        if (!existingErrorMessage) {
            // Create and append an error message element
            var errorMessage = document.createElement("div");
            errorMessage.textContent = message;
            errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
            container.appendChild(errorMessage);
        }
    }

    // Function to hide error message
    function hideErrorMessage(container) {
        // Remove any existing error message
        var existingErrorMessage = container.querySelector(".invalid-feedback");
        if (existingErrorMessage) {
            existingErrorMessage.remove();
        }
    }

    var bicLabel = document.createElement("label");
    bicLabel.for = "bic";
    bicLabel.textContent = "BIC (Bank Identifier Code)";
    bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
    paymentFormFields.appendChild(bicLabel);

    // Create container for BIC input
    var bicContainer = document.createElement("div");
    bicContainer.classList.add("form-group"); // Bootstrap class for form group

    var bicInput = document.createElement("input");
    bicInput.type = "text";
    bicInput.placeholder = "XXXX[0]000 000";
    bicInput.id = "bic";
    bicInput.name = "rec_bic";
    bicInput.classList.add("form-control");
    bicInput.required = true; // Make the field required

    // Add event listener for input validation
    bicInput.addEventListener("input", function () {
        validateBicInput();
    });

    // Set initial value
    var oldBic = "{{ old('rec_bic') }}";
    bicInput.value = oldBic;

    bicContainer.appendChild(bicInput);
    paymentFormFields.appendChild(bicContainer);

    // Function to validate BIC input
    function validateBicInput() {
        var bicValue = bicInput.value.replace(/\s/g, '');
        var regex =/^[A-Z]{4}[0]{1}[A-Z0-9]{6}/;  
        var isValid = regex.test(bicValue);

        if (bicValue.trim() === '') {
            // Add red border to indicate error
            bicInput.classList.remove("is-valid");
            bicInput.classList.add("is-invalid");

            // Display error message
            showErrorMessage(bicContainer, "Invalid BIC of India,expected  format XXXX[0]000 000");
        } else if (!isValid) {
            // Add red border to indicate error
            bicInput.classList.remove("is-valid");
            bicInput.classList.add("is-invalid");

            // Display error message
            showErrorMessage(bicContainer, "Invalid BIC of India,expected  format XXXX[0]000 000");
        } else {
            // Add green border to indicate correctness
            bicInput.classList.remove("is-invalid");
            bicInput.classList.add("is-valid");

            // Remove any existing error message
            hideErrorMessage(bicContainer);
        }
    }

    // Function to show error message
    function showErrorMessage(container, message) {
        // Check if an error message already exists
        var existingErrorMessage = container.querySelector(".invalid-feedback");

        if (!existingErrorMessage) {
            // Create and append an error message element
            var errorMessage = document.createElement("div");
            errorMessage.textContent = message;
            errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
            container.appendChild(errorMessage);
        }
    }

    // Function to hide error message
    function hideErrorMessage(container) {
        // Remove any existing error message
        var existingErrorMessage = container.querySelector(".invalid-feedback");
        if (existingErrorMessage) {
            existingErrorMessage.remove();
        }
    }

                    } else if (selectedCountry === "JPN") {
                        var paymentFormFields = document.getElementById("paymentFormFields");

// Create container for bankNameInput
var bankNameContainer = document.createElement("div");
bankNameContainer.classList.add("form-group"); // Bootstrap class for form group

// Create label element
var bankNameLabel = document.createElement("label");
bankNameLabel.for = "bankName";
bankNameLabel.textContent = "BAN (Bank Account Number)";
bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
bankNameContainer.appendChild(bankNameLabel);

// Create input element
var bankNameInput = document.createElement("input");
bankNameInput.type = "text";
bankNameInput.placeholder = "Enter BAN (Bank Account Number)";
bankNameInput.id = "bankName";
bankNameInput.name = "rec_ban";
bankNameInput.classList.add("form-control");
bankNameInput.required = true; // Make the field required

// Add event listener for input validation
bankNameInput.addEventListener("input", function () {
    validateBankNameInput();
});

bankNameContainer.appendChild(bankNameInput);
paymentFormFields.appendChild(bankNameContainer);

// Function to validate bankNameInput
function validateBankNameInput() {
    var bankNameValue = bankNameInput.value;
    var regex = /^[0-9]{1,7}$/;
    var isValid = regex.test(bankNameValue);

    if (bankNameValue.trim() === '') {
        // Add red border to indicate error
        bankNameInput.classList.remove("is-valid");
        bankNameInput.classList.add("is-invalid");

        // Display error message
        showErrorMessage(bankNameContainer, "Bank Account Number  of Japan is required & Bank Account Number must be 1 to 7 digits long.");
    } else if (!isValid) {
        // Add red border to indicate error
        bankNameInput.classList.remove("is-valid");
        bankNameInput.classList.add("is-invalid");

        // Display error message
        showErrorMessage(bankNameContainer, "Bank Account Number  of Japan is required & Bank Account Number must be 1 to 7 digits long.");
    } else {
        // Add green border to indicate correctness
        bankNameInput.classList.remove("is-invalid");
        bankNameInput.classList.add("is-valid");

        // Remove any existing error message
        hideErrorMessage(bankNameContainer);
    }
}

// Function to show error message
function showErrorMessage(container, message) {
    // Check if an error message already exists
    var existingErrorMessage = container.querySelector(".invalid-feedback");
    
    if (!existingErrorMessage) {
        // Create and append an error message element
        var errorMessage = document.createElement("div");
        errorMessage.textContent = message;
        errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
        container.appendChild(errorMessage);
    }
}

// Function to hide error message
function hideErrorMessage(container) {
    // Remove any existing error message
    var existingErrorMessage = container.querySelector(".invalid-feedback");
    if (existingErrorMessage) {
        existingErrorMessage.remove();
    }
}




var bicLabel = document.createElement("label");
bicLabel.for = "bic";
bicLabel.textContent = "BIC (Bank Identifier Code)";
bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
paymentFormFields.appendChild(bicLabel);

// Create container for BIC input
var bicContainer = document.createElement("div");
bicContainer.classList.add("form-group"); // Bootstrap class for form group

var bicInput = document.createElement("input");
bicInput.type = "text";
bicInput.placeholder = "XXXX JPXX";
bicInput.id = "bic";
bicInput.name = "rec_bic";
bicInput.classList.add("form-control");
bicInput.required = true; // Make the field required

// Add event listener for input validation
bicInput.addEventListener("input", function () {
    validateBicInput();
});

// Set initial value
var oldBic = "{{ old('rec_bic') }}";
bicInput.value = oldBic;

bicContainer.appendChild(bicInput);
paymentFormFields.appendChild(bicContainer);

// Function to validate BIC input
function validateBicInput() {
    var bicValue = bicInput.value.replace(/\s/g, '');
    var regex = /^[A-Z]{4}JP.{2}.*/;
    var isValid = regex.test(bicValue);

    if (bicValue.trim() === '') {
        // Add red border to indicate error
        bicInput.classList.remove("is-valid");
        bicInput.classList.add("is-invalid");

        // Display error message
        showErrorMessage(bicContainer, "BIC of Japan is required, exepected format XXXX JPXX");
    } else if (!isValid) {
        // Add red border to indicate error
        bicInput.classList.remove("is-valid");
        bicInput.classList.add("is-invalid");

        // Display error message
        showErrorMessage(bicContainer, "BIC of Japan is required, exepected format XXXX JPXX");
    } else {
        // Add green border to indicate correctness
        bicInput.classList.remove("is-invalid");
        bicInput.classList.add("is-valid");

        // Remove any existing error message
        hideErrorMessage(bicContainer);
    }
}

// Function to show error message
function showErrorMessage(container, message) {
    // Check if an error message already exists
    var existingErrorMessage = container.querySelector(".invalid-feedback");

    if (!existingErrorMessage) {
        // Create and append an error message element
        var errorMessage = document.createElement("div");
        errorMessage.textContent = message;
        errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
        container.appendChild(errorMessage);
    }
}

// Function to hide error message
function hideErrorMessage(container) {
    // Remove any existing error message
    var existingErrorMessage = container.querySelector(".invalid-feedback");
    if (existingErrorMessage) {
        existingErrorMessage.remove();
    }
}

                        // Add Bank Code field
                       // Create container for bankCodeInput
var bankCodeContainer = document.createElement("div");
bankCodeContainer.classList.add("form-group"); // Bootstrap class for form group

// Create label element
var bankCodeLabel = document.createElement("label");
bankCodeLabel.for = "bankCode";
bankCodeLabel.textContent = "Bank Code";
bankCodeLabel.classList.add("col-form-label"); // Bootstrap class for label styling
bankCodeContainer.appendChild(bankCodeLabel);

// Create input element
var bankCodeInput = document.createElement("input");
bankCodeInput.type = "text";
bankCodeInput.placeholder = "Enter Bank Code";
bankCodeInput.id = "bankCode";
bankCodeInput.name = "rec_bank_code";
bankCodeInput.classList.add("form-control");
bankCodeInput.required = true; // Make the field required

// Add event listener for input validation
bankCodeInput.addEventListener("input", function () {
    validateBankCodeInput();
});

bankCodeContainer.appendChild(bankCodeInput);
paymentFormFields.appendChild(bankCodeContainer);

// Function to validate bankCodeInput
function validateBankCodeInput() {
    var bankCodeValue = bankCodeInput.value;
    var regex = /^[0-9]{6,9}$/;
    var isValid = regex.test(bankCodeValue);

    if (bankCodeValue.trim() === '') {
        // Add red border to indicate error
        bankCodeInput.classList.remove("is-valid");
        bankCodeInput.classList.add("is-invalid");

        // Display error message
        showErrorMessage(bankCodeContainer, "Bank Code of Australia is required & Bank Code must be 6 to 9 characters long.");
    } else if (!isValid) {
        // Add red border to indicate error
        bankCodeInput.classList.remove("is-valid");
        bankCodeInput.classList.add("is-invalid");

        // Display error message
        showErrorMessage(bankCodeContainer, "Bank Code  of Australia must be 6 to 9 characters long.");
    } else {
        // Add green border to indicate correctness
        bankCodeInput.classList.remove("is-invalid");
        bankCodeInput.classList.add("is-valid");

        // Remove any existing error message
        hideErrorMessage(bankCodeContainer);
    }
}

// Function to show error message
function showErrorMessage(container, message) {
    // Check if an error message already exists
    var existingErrorMessage = container.querySelector(".invalid-feedback");

    if (!existingErrorMessage) {
        // Create and append an error message element
        var errorMessage = document.createElement("div");
        errorMessage.textContent = message;
        errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
        container.appendChild(errorMessage);
    }
}

// Function to hide error message
function hideErrorMessage(container) {
    // Remove any existing error message
    var existingErrorMessage = container.querySelector(".invalid-feedback");
    if (existingErrorMessage) {
        existingErrorMessage.remove();
    }
}

                        // Create label for bank type
                        var bankTypeLabel = document.createElement("label");
                        bankTypeLabel.for = "rec_bank_type";
                        bankTypeLabel.textContent = "Bank Account Type";
                        bankTypeLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        paymentFormFields.appendChild(bankTypeLabel);

                        // Create container for bank type select
                        var bankTypeContainer = document.createElement("div");
                        bankTypeContainer.classList.add("form-group"); // Bootstrap class for form group

                        // Create dropdown (select) for bank type
                        var bankTypeSelect = document.createElement("select");
                        bankTypeSelect.id = "rec_bank_type_field_input";
                        bankTypeSelect.name = "rec_bank_type";
                        bankTypeSelect.classList.add("form-control");

                        // Define options for the dropdown
                        var bankTypeOptions = [
                            { value: '', text: 'Select Bank Account Type', disabled: true, selected: true },
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
                        bankTypeSelect.required=true;

                        // Add event listener for input validation
                        bankTypeSelect.addEventListener("change", function () {
                            validateBankTypeSelect();
                        });

                        bankTypeContainer.appendChild(bankTypeSelect);
                        paymentFormFields.appendChild(bankTypeContainer);

                        // Function to validate bank type select
                        function validateBankTypeSelect() {
                            var selectedBankType = bankTypeSelect.value;

                            if (selectedBankType === '') {
                                // Add red border to indicate error
                                bankTypeSelect.classList.remove("is-valid");
                                bankTypeSelect.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bankTypeContainer, "Bank Account Type is required.");
                            } else {
                                // Add green border to indicate correctness
                                bankTypeSelect.classList.remove("is-invalid");
                                bankTypeSelect.classList.add("is-valid");

                                // Remove any existing error message
                                hideErrorMessage(bankTypeContainer);
                            }
                        }

                        // Function to show error message
                        function showErrorMessage(container, message) {
                            // Check if an error message already exists
                            var existingErrorMessage = container.querySelector(".invalid-feedback");

                            if (!existingErrorMessage) {
                                // Create and append an error message element
                                var errorMessage = document.createElement("div");
                                errorMessage.textContent = message;
                                errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                container.appendChild(errorMessage);
                            }
                        }

                        // Function to hide error message
                        function hideErrorMessage(container) {
                            // Remove any existing error message
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            if (existingErrorMessage) {
                                existingErrorMessage.remove();
                            }
                        }
                    }
                        else if (selectedCountry === "AUS" ) {
                            var paymentFormFields = document.getElementById("paymentFormFields");

// Create container for bankNameInput
var bankNameContainer = document.createElement("div");
bankNameContainer.classList.add("form-group"); // Bootstrap class for form group

// Create label element
var bankNameLabel = document.createElement("label");
bankNameLabel.for = "bankName";
bankNameLabel.textContent = "BAN (Bank Account Number)";
bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
bankNameContainer.appendChild(bankNameLabel);

// Create input element
var bankNameInput = document.createElement("input");
bankNameInput.type = "text";
bankNameInput.placeholder = "Enter BAN (Bank Account Number)";
bankNameInput.id = "bankName";
bankNameInput.name = "rec_ban";
bankNameInput.classList.add("form-control");
bankNameInput.required = true; // Make the field required

// Add event listener for input validation
bankNameInput.addEventListener("input", function () {
    validateBankNameInput();
});

bankNameContainer.appendChild(bankNameInput);
paymentFormFields.appendChild(bankNameContainer);

// Function to validate bankNameInput
function validateBankNameInput() {
    var bankNameValue = bankNameInput.value;
    var regex = /^[0-9]{6,9}/;
    var isValid = regex.test(bankNameValue);

    if (bankNameValue.trim() === '') {
        // Add red border to indicate error
        bankNameInput.classList.remove("is-valid");
        bankNameInput.classList.add("is-invalid");

        // Display error message
        showErrorMessage(bankNameContainer, "Bank Account Number  of Australia is required & Bank Account Number must be 6 to 9 characters long.");
    } else if (!isValid) {
        // Add red border to indicate error
        bankNameInput.classList.remove("is-valid");
        bankNameInput.classList.add("is-invalid");

        // Display error message
        showErrorMessage(bankNameContainer, "Bank Account Number of  Australia must be  6 to 9 characters long.");
    } else {
        // Add green border to indicate correctness
        bankNameInput.classList.remove("is-invalid");
        bankNameInput.classList.add("is-valid");

        // Remove any existing error message
        hideErrorMessage(bankNameContainer);
    }
}

// Function to show error message
function showErrorMessage(container, message) {
    // Check if an error message already exists
    var existingErrorMessage = container.querySelector(".invalid-feedback");
    
    if (!existingErrorMessage) {
        // Create and append an error message element
        var errorMessage = document.createElement("div");
        errorMessage.textContent = message;
        errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
        container.appendChild(errorMessage);
    }
}

// Function to hide error message
function hideErrorMessage(container) {
    // Remove any existing error message
    var existingErrorMessage = container.querySelector(".invalid-feedback");
    if (existingErrorMessage) {
        existingErrorMessage.remove();
    }
}




var bicLabel = document.createElement("label");
bicLabel.for = "bic";
bicLabel.textContent = "BIC (Bank Identifier Code)";
bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
paymentFormFields.appendChild(bicLabel);

// Create container for BIC input
var bicContainer = document.createElement("div");
bicContainer.classList.add("form-group"); // Bootstrap class for form group

var bicInput = document.createElement("input");
bicInput.type = "text";
bicInput.placeholder = "XXXX AUXX";
bicInput.id = "bic";
bicInput.name = "rec_bic";
bicInput.classList.add("form-control");
bicInput.required = true; // Make the field required

// Add event listener for input validation
bicInput.addEventListener("input", function () {
    validateBicInput();
});

// Set initial value
var oldBic = "{{ old('rec_bic') }}";
bicInput.value = oldBic;

bicContainer.appendChild(bicInput);
paymentFormFields.appendChild(bicContainer);

// Function to validate BIC input
function validateBicInput() {
    var bicValue = bicInput.value.replace(/\s/g, '');
    var regex = /^[A-Z]{4}AU.{2}.*/;
    var isValid = regex.test(bicValue);

    if (bicValue.trim() === '') {
        // Add red border to indicate error
        bicInput.classList.remove("is-valid");
        bicInput.classList.add("is-invalid");

        // Display error message
        showErrorMessage(bicContainer, "Invalid BIC of Australia, expected XXXX AUXX");
    } else if (!isValid) {
        // Add red border to indicate error
        bicInput.classList.remove("is-valid");
        bicInput.classList.add("is-invalid");

        // Display error message
        showErrorMessage(bicContainer, "Invalid BIC of Australia, expected XXXX AUXX");
    } else {
        // Add green border to indicate correctness
        bicInput.classList.remove("is-invalid");
        bicInput.classList.add("is-valid");

        // Remove any existing error message
        hideErrorMessage(bicContainer);
    }
}

// Function to show error message
function showErrorMessage(container, message) {
    // Check if an error message already exists
    var existingErrorMessage = container.querySelector(".invalid-feedback");

    if (!existingErrorMessage) {
        // Create and append an error message element
        var errorMessage = document.createElement("div");
        errorMessage.textContent = message;
        errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
        container.appendChild(errorMessage);
    }
}

// Function to hide error message
function hideErrorMessage(container) {
    // Remove any existing error message
    var existingErrorMessage = container.querySelector(".invalid-feedback");
    if (existingErrorMessage) {
        existingErrorMessage.remove();
    }
}

                        // Add Bank Code field
                       // Create container for bankCodeInput
var bankCodeContainer = document.createElement("div");
bankCodeContainer.classList.add("form-group"); // Bootstrap class for form group

// Create label element
var bankCodeLabel = document.createElement("label");
bankCodeLabel.for = "bankCode";
bankCodeLabel.textContent = "Bank Code";
bankCodeLabel.classList.add("col-form-label"); // Bootstrap class for label styling
bankCodeContainer.appendChild(bankCodeLabel);

// Create input element
var bankCodeInput = document.createElement("input");
bankCodeInput.type = "text";
bankCodeInput.placeholder = "Enter Bank Code";
bankCodeInput.id = "bankCode";
bankCodeInput.name = "rec_bank_code";
bankCodeInput.classList.add("form-control");
bankCodeInput.required = true; // Make the field required

// Add event listener for input validation
bankCodeInput.addEventListener("input", function () {
    validateBankCodeInput();
});

bankCodeContainer.appendChild(bankCodeInput);
paymentFormFields.appendChild(bankCodeContainer);

// Function to validate bankCodeInput
function validateBankCodeInput() {
    var bankCodeValue = bankCodeInput.value;
    var regex = /^[0-9]{6,9}$/;
    var isValid = regex.test(bankCodeValue);

    if (bankCodeValue.trim() === '') {
        // Add red border to indicate error
        bankCodeInput.classList.remove("is-valid");
        bankCodeInput.classList.add("is-invalid");

        // Display error message
        showErrorMessage(bankCodeContainer, "Bank Code of Australia is required & Bank Code must be 6 to 9 characters long.");
    } else if (!isValid) {
        // Add red border to indicate error
        bankCodeInput.classList.remove("is-valid");
        bankCodeInput.classList.add("is-invalid");

        // Display error message
        showErrorMessage(bankCodeContainer, "Bank Code  of Australia must be 6 to 9 characters long.");
    } else {
        // Add green border to indicate correctness
        bankCodeInput.classList.remove("is-invalid");
        bankCodeInput.classList.add("is-valid");

        // Remove any existing error message
        hideErrorMessage(bankCodeContainer);
    }
}

// Function to show error message
function showErrorMessage(container, message) {
    // Check if an error message already exists
    var existingErrorMessage = container.querySelector(".invalid-feedback");

    if (!existingErrorMessage) {
        // Create and append an error message element
        var errorMessage = document.createElement("div");
        errorMessage.textContent = message;
        errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
        container.appendChild(errorMessage);
    }
}

// Function to hide error message
function hideErrorMessage(container) {
    // Remove any existing error message
    var existingErrorMessage = container.querySelector(".invalid-feedback");
    if (existingErrorMessage) {
        existingErrorMessage.remove();
    }
}

                    } else if (selectedCountry === "CAN" || selectedCountry === "HKG" || selectedCountry ==="SGP" || selectedCountry ==="MYS") {

                        if (selectedCountry === "CAN"){
                        var paymentFormFields = document.getElementById("paymentFormFields");

                        // Create container for bankNameInput
                        var bankNameContainer = document.createElement("div");
                        bankNameContainer.classList.add("form-group"); // Bootstrap class for form group

                        // Create label element
                        var bankNameLabel = document.createElement("label");
                        bankNameLabel.for = "bankName";
                        bankNameLabel.textContent = "BAN (Bank Account Number)";
                        bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        bankNameContainer.appendChild(bankNameLabel);

                        // Create input element
                        var bankNameInput = document.createElement("input");
                        bankNameInput.type = "text";
                        bankNameInput.placeholder = "XXXX CAXX";
                        bankNameInput.id = "bankName";
                        bankNameInput.name = "rec_ban";
                        bankNameInput.classList.add("form-control");
                        bankNameInput.required = true; // Make the field required

                        // Add event listener for input validation
                        bankNameInput.addEventListener("input", function () {
                            validateBankNameInput();
                        });

                        bankNameContainer.appendChild(bankNameInput);
                        paymentFormFields.appendChild(bankNameContainer);

                        // Function to validate bankNameInput
                        function validateBankNameInput() {
                            var bankNameValue = bankNameInput.value;
                            var regex = /^[0-9]{5,12}/;
                            var isValid = regex.test(bankNameValue);

                            if (bankNameValue.trim() === '') {
                                // Add red border to indicate error
                                bankNameInput.classList.remove("is-valid");
                                bankNameInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bankNameContainer, "Bank Account Number  of Canada is required & Bank Account Number must be 5 to numbers long.");
                            } else if (!isValid) {
                                // Add red border to indicate error
                                bankNameInput.classList.remove("is-valid");
                                bankNameInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bankNameContainer, "Bank Account Number  of Canada Is required & Bank Account Number must be 5 to numbers long.");
                            } else {
                                // Add green border to indicate correctness
                                bankNameInput.classList.remove("is-invalid");
                                bankNameInput.classList.add("is-valid");

                                // Remove any existing error message
                                hideErrorMessage(bankNameContainer);
                            }
                        }

                        // Function to show error message
                        function showErrorMessage(container, message) {
                            // Check if an error message already exists
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            
                            if (!existingErrorMessage) {
                                // Create and append an error message element
                                var errorMessage = document.createElement("div");
                                errorMessage.textContent = message;
                                errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                container.appendChild(errorMessage);
                            }
                        }

                        // Function to hide error message
                        function hideErrorMessage(container) {
                            // Remove any existing error message
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            if (existingErrorMessage) {
                                existingErrorMessage.remove();
                            }
                        }




                        var bicLabel = document.createElement("label");
                        bicLabel.for = "bic";
                        bicLabel.textContent = "BIC (Bank Identifier Code)";
                        bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        paymentFormFields.appendChild(bicLabel);

                        // Create container for BIC input
                        var bicContainer = document.createElement("div");
                        bicContainer.classList.add("form-group"); // Bootstrap class for form group

                        var bicInput = document.createElement("input");
                        bicInput.type = "text";
                        bicInput.placeholder = "XXXX CAXX"
                        bicInput.id = "bic";
                        bicInput.name = "rec_bic";
                        bicInput.classList.add("form-control");
                        bicInput.required = true; // Make the field required

                        // Add event listener for input validation
                        bicInput.addEventListener("input", function () {
                            validateBicInput();
                        });

                        // Set initial value
                        var oldBic = "{{ old('rec_bic') }}";
                        bicInput.value = oldBic;

                        bicContainer.appendChild(bicInput);
                        paymentFormFields.appendChild(bicContainer);

                        // Function to validate BIC input
                        function validateBicInput() {
                            var bicValue = bicInput.value.replace(/\s/g, '');
                            var regex = /^[A-Z]{4}CA.{2}.*/;
                            var isValid = regex.test(bicValue);

                            if (bicValue.trim() === '') {
                                // Add red border to indicate error
                                bicInput.classList.remove("is-valid");
                                bicInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bicContainer, "Invalid BIC of Canada, expected format XXXX CAXX ");
                            } else if (!isValid && isValid.length !== 8) {
                                
                                // Add red border to indicate error
                                bicInput.classList.remove("is-valid");
                                bicInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bicContainer, "Invalid BIC of Canada, expected format XXXX CAXX");
                            } else {
                                // Add green border to indicate correctness
                                bicInput.classList.remove("is-invalid");
                                bicInput.classList.add("is-valid");

                                // Remove any existing error message
                                hideErrorMessage(bicContainer);
                            }
                        }

                        // Function to show error message
                        function showErrorMessage(container, message) {
                            // Check if an error message already exists
                            var existingErrorMessage = container.querySelector(".invalid-feedback");

                            if (!existingErrorMessage) {
                                // Create and append an error message element
                                var errorMessage = document.createElement("div");
                                errorMessage.textContent = message;
                                errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                container.appendChild(errorMessage);
                            }
                        }

                        // Function to hide error message
                        function hideErrorMessage(container) {
                            // Remove any existing error message
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            if (existingErrorMessage) {
                                existingErrorMessage.remove();
                            }
                        }
                        }

                        else if(selectedCountry === "HKG" ){
                            var paymentFormFields = document.getElementById("paymentFormFields");

                        // Create container for bankNameInput
                        var bankNameContainer = document.createElement("div");
                        bankNameContainer.classList.add("form-group"); // Bootstrap class for form group

                        // Create label element
                        var bankNameLabel = document.createElement("label");
                        bankNameLabel.for = "bankName";
                        bankNameLabel.textContent = "BAN (Bank Account Number)";
                        bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        bankNameContainer.appendChild(bankNameLabel);

                        // Create input element
                        var bankNameInput = document.createElement("input");
                        bankNameInput.type = "text";
                        bankNameInput.placeholder = "Enter BAN (Bank Account Number)";
                        bankNameInput.id = "bankName";
                        bankNameInput.name = "rec_ban";
                        bankNameInput.classList.add("form-control");
                        bankNameInput.required = true; // Make the field required

                        // Add event listener for input validation
                        bankNameInput.addEventListener("input", function () {
                            validateBankNameInput();
                        });

                        bankNameContainer.appendChild(bankNameInput);
                        paymentFormFields.appendChild(bankNameContainer);

                        // Function to validate bankNameInput
                        function validateBankNameInput() {
                            var bankNameValue = bankNameInput.value;
                            var regex = /^.*/;
                            var isValid = regex.test(bankNameValue);

                            if (bankNameValue.trim() === '') {
                                // Add red border to indicate error
                                bankNameInput.classList.remove("is-valid");
                                bankNameInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bankNameContainer, "Bank Account Number  of Hong Kong is required ");
                            } else if (!isValid) {
                                // Add red border to indicate error
                                bankNameInput.classList.remove("is-valid");
                                bankNameInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bankNameContainer, "Bank Account Number  of Hong Kong is required ");
                            } else {
                                // Add green border to indicate correctness
                                bankNameInput.classList.remove("is-invalid");
                                bankNameInput.classList.add("is-valid");

                                // Remove any existing error message
                                hideErrorMessage(bankNameContainer);
                            }
                        }

                        // Function to show error message
                        function showErrorMessage(container, message) {
                            // Check if an error message already exists
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            
                            if (!existingErrorMessage) {
                                // Create and append an error message element
                                var errorMessage = document.createElement("div");
                                errorMessage.textContent = message;
                                errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                container.appendChild(errorMessage);
                            }
                        }

                        // Function to hide error message
                        function hideErrorMessage(container) {
                            // Remove any existing error message
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            if (existingErrorMessage) {
                                existingErrorMessage.remove();
                            }
                        }




                        var bicLabel = document.createElement("label");
                        bicLabel.for = "bic";
                        bicLabel.textContent = "BIC (Bank Identifier Code)";
                        bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        paymentFormFields.appendChild(bicLabel);

                        // Create container for BIC input
                        var bicContainer = document.createElement("div");
                        bicContainer.classList.add("form-group"); // Bootstrap class for form group

                        var bicInput = document.createElement("input");
                        bicInput.type = "text";
                        bicInput.placeholder = "000";
                        bicInput.id = "bic";
                        bicInput.name = "rec_bic";
                        bicInput.classList.add("form-control");
                        bicInput.required = true; // Make the field required

                        // Add event listener for input validation
                        bicInput.addEventListener("input", function () {
                            validateBicInput();
                        });

                        // Set initial value
                        var oldBic = "{{ old('rec_bic') }}";
                        bicInput.value = oldBic;

                        bicContainer.appendChild(bicInput);
                        paymentFormFields.appendChild(bicContainer);

                        // Function to validate BIC input
                        function validateBicInput() {
                            var bicValue = bicInput.value.replace(/\s/g, '');
                            var regex = /^[0-9]{3}/;
                            var isValid = regex.test(bicValue);

                            if (bicValue.trim() === '') {
                                // Add red border to indicate error
                                bicInput.classList.remove("is-valid");
                                bicInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bicContainer, "Invalid BIC of Hong Kong, expected 000");
                            } else if (!isValid) {
                                // Add red border to indicate error
                                bicInput.classList.remove("is-valid");
                                bicInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bicContainer, "Invalid BIC of Hong Kong, expected 000");
                            } else {
                                // Add green border to indicate correctness
                                bicInput.classList.remove("is-invalid");
                                bicInput.classList.add("is-valid");

                                // Remove any existing error message
                                hideErrorMessage(bicContainer);
                            }
                        }

                        // Function to show error message
                        function showErrorMessage(container, message) {
                            // Check if an error message already exists
                            var existingErrorMessage = container.querySelector(".invalid-feedback");

                            if (!existingErrorMessage) {
                                // Create and append an error message element
                                var errorMessage = document.createElement("div");
                                errorMessage.textContent = message;
                                errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                container.appendChild(errorMessage);
                            }
                        }

                        // Function to hide error message
                        function hideErrorMessage(container) {
                            // Remove any existing error message
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            if (existingErrorMessage) {
                                existingErrorMessage.remove();
                            }
                        }

                        }
                        else if(selectedCountry ==="SGP"){
                            var paymentFormFields = document.getElementById("paymentFormFields");

                        // Create container for bankNameInput
                        var bankNameContainer = document.createElement("div");
                        bankNameContainer.classList.add("form-group"); // Bootstrap class for form group

                        // Create label element
                        var bankNameLabel = document.createElement("label");
                        bankNameLabel.for = "bankName";
                        bankNameLabel.textContent = "BAN (Bank Account Number)";
                        bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        bankNameContainer.appendChild(bankNameLabel);

                        // Create input element
                        var bankNameInput = document.createElement("input");
                        bankNameInput.type = "text";
                        bankNameInput.placeholder = "Enter BAN (Bank Account Number)";
                        bankNameInput.id = "bankName";
                        bankNameInput.name = "rec_ban";
                        bankNameInput.classList.add("form-control");
                        bankNameInput.required = true; // Make the field required

                        // Add event listener for input validation
                        bankNameInput.addEventListener("input", function () {
                            validateBankNameInput();
                        });

                        bankNameContainer.appendChild(bankNameInput);
                        paymentFormFields.appendChild(bankNameContainer);

                        // Function to validate bankNameInput
                        function validateBankNameInput() {
                            var bankNameValue = bankNameInput.value;
                            var regex = /^.*/;
                            var isValid = regex.test(bankNameValue);

                            if (bankNameValue.trim() === '') {
                                // Add red border to indicate error
                                bankNameInput.classList.remove("is-valid");
                                bankNameInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bankNameContainer, "Bank Account Number  of Singapore is required ");
                            } else if (!isValid) {
                                // Add red border to indicate error
                                bankNameInput.classList.remove("is-valid");
                                bankNameInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bankNameContainer, "Bank Account Number  of Singapore Africa is required ");
                            } else {
                                // Add green border to indicate correctness
                                bankNameInput.classList.remove("is-invalid");
                                bankNameInput.classList.add("is-valid");

                                // Remove any existing error message
                                hideErrorMessage(bankNameContainer);
                            }
                        }

                        // Function to show error message
                        function showErrorMessage(container, message) {
                            // Check if an error message already exists
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            
                            if (!existingErrorMessage) {
                                // Create and append an error message element
                                var errorMessage = document.createElement("div");
                                errorMessage.textContent = message;
                                errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                container.appendChild(errorMessage);
                            }
                        }

                        // Function to hide error message
                        function hideErrorMessage(container) {
                            // Remove any existing error message
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            if (existingErrorMessage) {
                                existingErrorMessage.remove();
                            }
                        }




                        var bicLabel = document.createElement("label");
                        bicLabel.for = "bic";
                        bicLabel.textContent = "BIC (Bank Identifier Code)";
                        bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        paymentFormFields.appendChild(bicLabel);

                        // Create container for BIC input
                        var bicContainer = document.createElement("div");
                        bicContainer.classList.add("form-group"); // Bootstrap class for form group

                        var bicInput = document.createElement("input");
                        bicInput.type = "text";
                        bicInput.placeholder = "XXXX SGXX";
                        bicInput.id = "bic";
                        bicInput.name = "rec_bic";
                        bicInput.classList.add("form-control");
                        bicInput.required = true; // Make the field required

                        // Add event listener for input validation
                        bicInput.addEventListener("input", function () {
                            validateBicInput();
                        });

                        // Set initial value
                        var oldBic = "{{ old('rec_bic') }}";
                        bicInput.value = oldBic;

                        bicContainer.appendChild(bicInput);
                        paymentFormFields.appendChild(bicContainer);

                        // Function to validate BIC input
                        function validateBicInput() {
                            var bicValue = bicInput.value.replace(/\s/g, '');
                            var regex = /^[A-Z]{4}SG.{2}.*/;
                            var isValid = regex.test(bicValue);

                            if (bicValue.trim() === '') {
                                // Add red border to indicate error
                                bicInput.classList.remove("is-valid");
                                bicInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bicContainer, "Invalid BIC of Singapore, expected  is XXXX SGXX");
                            } else if (!isValid) {
                                // Add red border to indicate error
                                bicInput.classList.remove("is-valid");
                                bicInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bicContainer, "Invalid BIC of Singapore, expected  is XXXX SGXX");
                            } else {
                                // Add green border to indicate correctness
                                bicInput.classList.remove("is-invalid");
                                bicInput.classList.add("is-valid");

                                // Remove any existing error message
                                hideErrorMessage(bicContainer);
                            }
                        }

                        // Function to show error message
                        function showErrorMessage(container, message) {
                            // Check if an error message already exists
                            var existingErrorMessage = container.querySelector(".invalid-feedback");

                            if (!existingErrorMessage) {
                                // Create and append an error message element
                                var errorMessage = document.createElement("div");
                                errorMessage.textContent = message;
                                errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                container.appendChild(errorMessage);
                            }
                        }

                        // Function to hide error message
                        function hideErrorMessage(container) {
                            // Remove any existing error message
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            if (existingErrorMessage) {
                                existingErrorMessage.remove();
                            }
                        }

                        }
                        else if ( selectedCountry ==="MYS"){
                            var paymentFormFields = document.getElementById("paymentFormFields");

                        // Create container for bankNameInput
                        var bankNameContainer = document.createElement("div");
                        bankNameContainer.classList.add("form-group"); // Bootstrap class for form group

                        // Create label element
                        var bankNameLabel = document.createElement("label");
                        bankNameLabel.for = "bankName";
                        bankNameLabel.textContent = "BAN (Bank Account Number)";
                        bankNameLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        bankNameContainer.appendChild(bankNameLabel);

                        // Create input element
                        var bankNameInput = document.createElement("input");
                        bankNameInput.type = "text";
                        bankNameInput.placeholder = "Enter BAN (Bank Account Number)";
                        bankNameInput.id = "bankName";
                        bankNameInput.name = "rec_ban";
                        bankNameInput.classList.add("form-control");
                        bankNameInput.required = true; // Make the field required

                        // Add event listener for input validation
                        bankNameInput.addEventListener("input", function () {
                            validateBankNameInput();
                        });

                        bankNameContainer.appendChild(bankNameInput);
                        paymentFormFields.appendChild(bankNameContainer);

                        // Function to validate bankNameInput
                        function validateBankNameInput() {
                            var bankNameValue = bankNameInput.value;
                            var regex = /^.*/;
                            var isValid = regex.test(bankNameValue);

                            if (bankNameValue.trim() === '') {
                                // Add red border to indicate error
                                bankNameInput.classList.remove("is-valid");
                                bankNameInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bankNameContainer, "Bank Account Number  of Malaysia is required ");
                            } else if (!isValid) {
                                // Add red border to indicate error
                                bankNameInput.classList.remove("is-valid");
                                bankNameInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bankNameContainer, "Bank Account Number  of Malaysia is required");
                            } else {
                                // Add green border to indicate correctness
                                bankNameInput.classList.remove("is-invalid");
                                bankNameInput.classList.add("is-valid");

                                // Remove any existing error message
                                hideErrorMessage(bankNameContainer);
                            }
                        }

                        // Function to show error message
                        function showErrorMessage(container, message) {
                            // Check if an error message already exists
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            
                            if (!existingErrorMessage) {
                                // Create and append an error message element
                                var errorMessage = document.createElement("div");
                                errorMessage.textContent = message;
                                errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                container.appendChild(errorMessage);
                            }
                        }

                        // Function to hide error message
                        function hideErrorMessage(container) {
                            // Remove any existing error message
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            if (existingErrorMessage) {
                                existingErrorMessage.remove();
                            }
                        }




                        var bicLabel = document.createElement("label");
                        bicLabel.for = "bic";
                        bicLabel.textContent = "BIC (Bank Identifier Code)";
                        bicLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                        paymentFormFields.appendChild(bicLabel);

                        // Create container for BIC input
                        var bicContainer = document.createElement("div");
                        bicContainer.classList.add("form-group"); // Bootstrap class for form group

                        var bicInput = document.createElement("input");
                        bicInput.type = "text";
                        bicInput.placeholder = "XXXX MYXX";
                        bicInput.id = "bic";
                        bicInput.name = "rec_bic";
                        bicInput.classList.add("form-control");
                        bicInput.required = true; // Make the field required

                        // Add event listener for input validation
                        bicInput.addEventListener("input", function () {
                            validateBicInput();
                        });

                        // Set initial value
                        var oldBic = "{{ old('rec_bic') }}";
                        bicInput.value = oldBic;

                        bicContainer.appendChild(bicInput);
                        paymentFormFields.appendChild(bicContainer);

                        // Function to validate BIC input
                        function validateBicInput() {
                            var bicValue = bicInput.value.replace(/\s/g, '');
                            var regex = /^[A-Z]{4}MY.{2}.*/;
                            var isValid = regex.test(bicValue);

                            if (bicValue.trim() === '') {
                                // Add red border to indicate error
                                bicInput.classList.remove("is-valid");
                                bicInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bicContainer, "Invalid BIC of Malaysia, expected format is XXXX MYXX");
                            } else if (!isValid) {
                                // Add red border to indicate error
                                bicInput.classList.remove("is-valid");
                                bicInput.classList.add("is-invalid");

                                // Display error message
                                showErrorMessage(bicContainer, "Invalid BIC of Malaysia, expected format is XXXX MYXX");
                            } else {
                                // Add green border to indicate correctness
                                bicInput.classList.remove("is-invalid");
                                bicInput.classList.add("is-valid");

                                // Remove any existing error message
                                hideErrorMessage(bicContainer);
                            }
                        }

                        // Function to show error message
                        function showErrorMessage(container, message) {
                            // Check if an error message already exists
                            var existingErrorMessage = container.querySelector(".invalid-feedback");

                            if (!existingErrorMessage) {
                                // Create and append an error message element
                                var errorMessage = document.createElement("div");
                                errorMessage.textContent = message;
                                errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                container.appendChild(errorMessage);
                            }
                        }

                        // Function to hide error message
                        function hideErrorMessage(container) {
                            // Remove any existing error message
                            var existingErrorMessage = container.querySelector(".invalid-feedback");
                            if (existingErrorMessage) {
                                existingErrorMessage.remove();
                            }
                        }

                        }
                     


                    } 
                    else if (selectedCountry === "ARE") { // Example list of field names
                       // Example list of field names
var fieldNames = [
    'rec_idc_field', 'rec_idc_field1', 'rec_iban_field','rec_iban_field1',
    'rec_country_subdivision_field', 'rec_country_subdivision_field1',
    'recipient_account_uri_field', 'recipient_account_uri_field1',
    'id_expiration_date_field', 'id_expiration_date_field1',
];

// Container to hold the created elements
var paymentFormFields = document.getElementById("paymentFormFields");

// Initialize dynamic form data object
var formData = {};

for (var i = 0; i < fieldNames.length; i += 2) {
    // Create label
    var label = document.createElement("label");
    label.for = fieldNames[i] + "_input";
    label.textContent = fieldNames[i].replace(/_/g, " ").replace(" field", "").split(" ").map(word => word
        .charAt(0).toUpperCase() + word.slice(1)).join(" ");
    label.classList.add("col-form-label"); // Bootstrap class for label styling
    paymentFormFields.appendChild(label);

    // Create container for input and error message
    var inputContainer = document.createElement("div");
    inputContainer.classList.add("form-group"); // Bootstrap class for form group
    paymentFormFields.appendChild(inputContainer);

    // Create input field
    var input = document.createElement("input");
    input.placeholder = "Enter " + fieldNames[i].replace(/_/g, " ").replace(" field", "");
    input.id = fieldNames[i] + "_input";
    input.name = fieldNames[i].replace("_field", "");
    input.classList.add("form-control");
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

    // Add event listener for input validation
    input.addEventListener("input", function () {
        validateDynamicInput(this);
    });

    // Create error message container
    var errorContainer = document.createElement("div");
    errorContainer.classList.add("error-container"); // Add your custom error container class
    paymentFormFields.appendChild(errorContainer);

    // Append input and error message container to the main form container
    inputContainer.appendChild(input);
    inputContainer.appendChild(errorContainer);
}

// Function to validate dynamic input with individual regex
function validateDynamicInput(input) {
    var inputValue = input.value;

    // Add your individual validation logic here based on the field name
    switch (input.name) {
        case 'rec_iban':
            validateIban(input, inputValue);
            break;
        case 'rec_idc':
            validateIdc(input, inputValue);
            break;
        // Add cases for other fields as needed
        default:
            // Default validation (if needed)
            break;
    }
}

// Function to validate IBAN
function validateIban(input, value) {
    var regex = /^AE[0-9]{21}$/; // Replace with your IBAN regex
    validateField(input, value, regex, "Enter a valid United Arab Emirates IBAN, expected AE 0000 0000 0000 0000 0000 0");
}

// Function to validate IDC
function validateIdc(input, value) {
    var regex = /^.*/; // Replace with your IDC regex
    validateField(input, value, regex, "Enter a valid United Arab Emirates IDC .");
}

// Function to validate field with regex
function validateField(input, value, regex, errorMessage) {
    var isValid = regex.test(value);

    if (value.trim() === '') {
        // Add red border to indicate error
        input.classList.remove("is-valid");
        input.classList.add("is-invalid");

        // Display error message
        showErrorMessage(input.parentNode, errorMessage);
    } else if (!isValid) {
        // Add red border to indicate error
        input.classList.remove("is-valid");
        input.classList.add("is-invalid");

        // Display error message
        showErrorMessage(input.parentNode, errorMessage);
    } else {
        // Add green border to indicate correctness
        input.classList.remove("is-invalid");
        input.classList.add("is-valid");

        // Remove any existing error message
        hideErrorMessage(input.parentNode);
    }
}

// Function to show error message
function showErrorMessage(container, message) {
    // Check if an error message already exists
    var existingErrorMessage = container.querySelector(".invalid-feedback");

    if (!existingErrorMessage) {
        // Create and append an error message element
        var errorMessage = document.createElement("div");
        errorMessage.textContent = message;
        errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
        container.appendChild(errorMessage);
    }
}

// Function to hide error message
function hideErrorMessage(container) {
    // Remove any existing error message
    var existingErrorMessage = container.querySelector(".invalid-feedback");
    if (existingErrorMessage) {
        existingErrorMessage.remove();
    }
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
                                {var countrySelect = document.getElementById("countrySelect");
                                             var selectedCountry = countrySelect.value;
                                              if (selectedCountry === "ARE"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "Enter IBAN";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^AE[0-9]{21}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid ARE IBAN. and must match the pattern: /^AE[0-9]{21}$/");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                                             else if (selectedCountry === "GBR"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = " GB00 XXXX 0000 0000 0000 00";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^GB[0-9]{2}[A-Z]{4}[0-9]{14}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid United Kingdom IBAN, expected GB00 XXXX 0000 0000 0000 00");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                                             else if (selectedCountry === "POL"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "PL 0000 0000 0000 0000 0000";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^PL\d{20}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid POL IBAN, extected formt PL 0000 0000 0000 0000 0000 ");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                                             else if (selectedCountry === "CHE"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "CH 0000 0000 0000 0000 000 XX";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^CH[0-9]{19}[A-Za-z0-9]{2}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid CHE IBAN, expected CH 0000 0000 0000 0000 000 XX");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                                    
                                   else if (selectedCountry === "ADO"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "AD00 0000 0000 0000 0000 0000";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^AD[0-9]{22}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Andorra IBAN, expected format AD00 0000 0000 0000 0000 0000");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }

                             else if (selectedCountry === "AUT"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "AT00 0000 0000 0000 0000";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^AT[0-9]{18}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Austria IBAN, expected format AT00 0000 0000 0000 0000");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }

                             else if (selectedCountry === "BEL"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "BE00 0000 0000 0000";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^BE[0-9]{14}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Belgium IBAN, expected format BE00 0000 0000 0000");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                             else if (selectedCountry === "HRV"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "HR00 0000 0000 0000 0000 0";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^HR[0-9]{19}/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Croatia IBAN, expected format HR00 0000 0000 0000 0000 0");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                             else if (selectedCountry === "CYP"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "CY00 0000 0000 XXXX XXXX XXXX XXXX";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^CY[0-9]{10}[A-Z,0-9]{16}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Cyprus IBAN, expected format CY00 0000 0000 XXXX XXXX XXXX XXXX");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                             else if (selectedCountry === "EST"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = " EE00 0000 0000 0000 0000";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^EE[0-9]{18}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Estonia IBAN, expected format EE00 0000 0000 0000 0000");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                             else if (selectedCountry === "FIN"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "FI00 0000 0000 0000 00";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^FI[0-9]{16}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Finland IBAN, expected format FI00 0000 0000 0000 00");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                             else if (selectedCountry === "FRA"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "FR00 000 0000 000X XXXX XXXX XX00";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, ''); 
                                                var regex = /^FR[0-9]{12}[A-Z,0-9]{11}[0-9]{2}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid France IBAN, expected format FR00 000 0000 000X XXXX XXXX XX00");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                             else if (selectedCountry === "DEU"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "DE00 0000 0000 0000 0000 00";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^DE[0-9]{20}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Germany IBAN, expected format DE00 0000 0000 0000 0000 00");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                             else if (selectedCountry === "GRC"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "GR0 0000 0000 XXXX XXXX XXXX XXXX";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^GR[0-9]{9}[A-Z,0-9]{16}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Greece IBAN, expected format GR0 0000 0000 XXXX XXXX XXXX XXXX");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                             else if (selectedCountry === "IRL"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "IE 00XX XX00 0000 0000 0000";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^IE[0-9]{2}[A-Z]{4}[0-9]{14}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Ireland IBAN, expected format IE 00XX XX00 0000 0000 0000");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                             else if (selectedCountry === "ITA"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "IT0 0X00 0000 0000 XXXX XXXX XXXX";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^IT[0-9]{2}[A-Z]{1}[0-9]{10}[A-Z,0-9]{12}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Italy IBAN, expected format IT0 0X00 0000 0000 XXXX XXXX XXXX");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                             else if (selectedCountry === "LVA"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "LV00 XXXX 0000 0000 0000 0";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^LV[0-9]{2}[A-Z]{4}[0-9]{13}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Latvia IBAN, expected format LV00 XXXX 0000 0000 0000 0");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                             else if (selectedCountry === "LTU"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "LT00 0000 0000 0000 0000";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^LT[0-9]{18}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid LTU IBAN, expected format LT00 0000 0000 0000 0000");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                             else if (selectedCountry === "LUX"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "LU0 0000X XXXX XXXX XXXX";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^LU[0-9]{5}[A-Z,0-9]{13}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Luxembourg IBAN, expected format LU0 0000X XXXX XXXX XXXX");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                             else if (selectedCountry === "MLT"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "MT0 0XXX X000 00XX XXXX XXXX XXXX XXXX";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^MT[0-9]{2}[A-Z]{4}[0-9]{5}[A-Z,0-9]{18}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid MLT IBAN, expected format MT0 0XXX X000 00XX XXXX XXXX XXXX XXXX");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                             else if (selectedCountry === "MCO"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "MC0 0000 0000 0000 0000 0000 0000";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^MC[0-9]{25}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Monaco IBAN, expected format MC0 0000 0000 0000 0000 0000 0000");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                             else if (selectedCountry === "NLD"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "NL00 XXXX 0000 0000 00";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^NL[0-9]{2}[A-Z]{4}[0-9]{10}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Netherlands IBAN, expected format NL00 XXXX 0000 0000 00");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                             else if (selectedCountry === "PRT"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "PT00 0000 0000 0000 0000 0000 0";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^PT[0-9]{23}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Portugal IBAN, expected format PT00 0000 0000 0000 0000 0000 0");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                             else if (selectedCountry === "SMR"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "SM0 0X00 0000 0000 0000 0000 0000";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^SM[0-9]{2}[A-Z]{1}[0-9]{22}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid San Marino IBAN, expected format SM0 0X00 0000 0000 0000 0000 0000");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }




                             }
                             else if (selectedCountry === "SVK"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "SK00 0000 0000 0000 0000 0000";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex = /^SK[0-9]{22}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Slovak Republic IBAN, expected format SK00 0000 0000 0000 0000 0000");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }
                             }
                             else if (selectedCountry === "SVN"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "SI0 0000 0000 0000 0000";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, ''); 
                                                var regex =/^SI[0-9]{17}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Slovenia IBAN, expected format SI0 0000 0000 0000 0000");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }
                             }
                              else if (selectedCountry === "ESP"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "ES 0000 0000 0000 0000 0000 00";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            
                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, ''); // Remove spaces from the input value
                                                var regex = /^ES[0-9]{22}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid IBAN, expected format ES 0000 0000 0000 0000 0000 00");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }


                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }
                             }
                             else if (selectedCountry === "VAT"){
                                        var paymentFormFields = document.getElementById("paymentFormFields");
                                     
                                            // Create container for ibanInput
                                            var ibanContainer = document.createElement("div");
                                            ibanContainer.classList.add("form-group"); // Bootstrap class for form group

                                            // Create label element
                                            var ibanLabel = document.createElement("label");
                                            ibanLabel.for = "iban";
                                            ibanLabel.textContent = "IBAN";
                                            ibanLabel.classList.add("col-form-label"); // Bootstrap class for label styling
                                            ibanContainer.appendChild(ibanLabel);

                                            // Create input element
                                            var ibanInput = document.createElement("input");
                                            ibanInput.type = "text";
                                            ibanInput.placeholder = "VA 0000 0000 0000 0000 0000";
                                            ibanInput.id = "iban";
                                            ibanInput.name = "rec_iban";
                                            ibanInput.classList.add("form-control");
                                            ibanInput.required = true; // Make the field required

                                            // Add event listener for input validation
                                            ibanInput.addEventListener("input", function () {
                                                validateIbanInput();
                                            });

                                            ibanContainer.appendChild(ibanInput);
                                            paymentFormFields.appendChild(ibanContainer);

                                            // Function to validate ibanInput
                                            function validateIbanInput() {
                                                var ibanValue = ibanInput.value.replace(/\s/g, '');
                                                var regex =/^VA[0-9]{20}$/; // Adjust the regex as needed for IBAN validation

                                                if (ibanValue === '') {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "IBAN is required.");
                                                } else if (!regex.test(ibanValue)) {
                                                    // Add red border to indicate error
                                                    ibanInput.classList.remove("is-valid");
                                                    ibanInput.classList.add("is-invalid");

                                                    // Display error message
                                                    showErrorMessage(ibanContainer, "Please enter a valid Vatican City IBAN, expected format VA 0000 0000 0000 0000 0000");
                                                } else {
                                                    // Add green border to indicate correctness
                                                    ibanInput.classList.remove("is-invalid");
                                                    ibanInput.classList.add("is-valid");

                                                    // Remove any existing error message
                                                    hideErrorMessage(ibanContainer);
                                                }
                                            }

                                            // Function to show error message
                                            function showErrorMessage(container, message) {
                                                // Check if an error message already exists
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");

                                                if (!existingErrorMessage) {
                                                    // Create and append an error message element
                                                    var errorMessage = document.createElement("div");
                                                    errorMessage.textContent = message;
                                                    errorMessage.classList.add("invalid-feedback"); // Bootstrap class for error message styling
                                                    container.appendChild(errorMessage);
                                                }
                                            }

                                            // Function to hide error message
                                            function hideErrorMessage(container) {
                                                // Remove any existing error message
                                                var existingErrorMessage = container.querySelector(".invalid-feedback");
                                                if (existingErrorMessage) {
                                                    existingErrorMessage.remove();
                                                }
                                            }
                             }

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
                            return "Bank Account";
                        case "IB":
                            return "Bank IBAN";
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
               


    event.preventDefault();
                   </script>

            

        </body>

    </html>
@endsection
