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
    <script>
        $(document).ready(function() {
            // Sample data for available countries, payment methods, and payout currencies
            var data = [{
                    country: "South Africa",
                    code: "ZAF",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "ZAR"
                },
                {
                    country: "United States",
                    code: "USA",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "USD"
                },
                {
                    country: "United Kingdom",
                    code: "GBR",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "GBP"
                },
                {
                    country: "Canada",
                    code: "CAN",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "CAD"
                },
                {
                    country: "United Arab Emirates",
                    code: "ARE",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "AED"
                },
                {
                    country: "Australia",
                    code: "AUS",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "AUD"
                },
                {
                    country: "Andorra",
                    code: "ADO",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Austria",
                    code: "AUT",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Belgium",
                    code: "BEL",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Croatia",
                    code: "HRV",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Cyprus",
                    code: "CYP",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Estonia",
                    code: "EST",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Finland",
                    code: "FIN",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "France",
                    code: "FRA",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Germany",
                    code: "DEU",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Greece",
                    code: "GRC",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Ireland",
                    code: "IRL",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Italy",
                    code: "ITA",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Latvia",
                    code: "LVA",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Lithuania",
                    code: "LTU",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Luxembourg",
                    code: "LUX",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Malta",
                    code: "MLT",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Monaco",
                    code: "MCO",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Netherlands",
                    code: "NLD",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Portugal",
                    code: "PRT",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "San Marino",
                    code: "SMR",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Slovak Republic",
                    code: "SVK",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Slovenia",
                    code: "SVN",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Spain",
                    code: "ESP",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "Vatican City",
                    code: "VAT",
                    paymentMethod: "Bank Deposit",
                    payoutCurrency: "EUR"
                },
                {
                    country: "China",
                    code: "CHN",
                    paymentMethod: "Cards",
                    payoutCurrency: "EUR"
                },
                {
                    country: "India",
                    code: "IND",
                    paymentMethod: "Cash Pick Up",
                    payoutCurrency: "INR"
                },
                {
                    country: "Pakistan",
                    code: "PAK",
                    paymentMethod: "Cash Pick Up",
                    payoutCurrency: "PKR"
                },
                {
                    country: "Mozambique",
                    code: "MOZ",
                    paymentMethod: "Mobile Wallet",
                    payoutCurrency: "MZN"
                },
                {
                    country: "Zambia",
                    code: "ZMB",
                    paymentMethod: "Mobile Wallet",
                    payoutCurrency: "ZMW"
                },
                {
                    country: "Malawi",
                    code: "MWI",
                    paymentMethod: "Mobile Wallet",
                    payoutCurrency: "MWK"
                },
                {
                    country: "Pakistan",
                    code: "PAK",
                    paymentMethod: "Mobile Wallet",
                    payoutCurrency: "PKR"
                }
            ];

            // Populate the country select options
            var countrySelect = $("#country");
            $.each(data, function(index, item) {
                countrySelect.append('<option value="' + item.code + '">' + item.country + '</option>');
            });

            // Attach the updatePayments function to the change event of the country select
            $("#country").on("change", updatePayments);

            // Trigger the updatePayments function on page load
            updatePayments();

            // Handle form submission
            $("#myForm").submit(function(e) {
                e.preventDefault();

                // Gather selected values
                var selectedCountry = $("#country option:selected").text();
                var selectedCountryCode = $("#country").val();
                var selectedPaymentMethod = $("#payment-options").val();
                var selectedCurrency = $("#currency-options").val();
                var selectedRecIban = $("#rec_iban").val();


                // Display or use the selected values as needed
                console.log("Selected Country:", selectedCountry, "Code:", selectedCountryCode);
                console.log("Selected Payment Method:", selectedPaymentMethod);
                console.log("Selected Currency:", selectedCurrency);
                console.log("Selected Rec IBAN:", selectedRecIban);
            });

            function updatePayments() {
                var country = $("#country").val();
                var paymentOptions = $("#payment-options");
                var currencyOptions = $("#currency-options");
                var recIbanLabel = $("#rec-iban-label");
                var recIbanInput = $("#rec_iban");
                var otherFields = $("#other-fields");
                var notAvailableMessage = $("#not-available-message");

                // Reset payment, currency, and rec_iban options
                paymentOptions.empty();
                currencyOptions.empty();
                recIbanLabel.hide();
                recIbanInput.hide().val('');
                
    var selectedPaymentMethod = $("#payment-options").val();


    var recBanLabel = $("#rec-ban-label");
    var recBanInput = $("#rec_ban");
    var recBicLabel = $("#rec-bic-label");
    var recBicInput = $("#rec_bic");

    // Reset all fields
    recIbanLabel.hide();
    recIbanInput.hide().val('');
    recBanLabel.hide();
    recBanInput.hide().val('');
    recBicLabel.hide();
    recBicInput.hide().val('');

                // Filter the data based on the selected country
                var filteredData = data.filter(function(item) {
                    return item.code === country;
                });

                // Populate payment options and currency based on the filtered data
                $.each(filteredData, function(index, item) {
                    paymentOptions.append('<option value="' + item.paymentMethod + '">' + item
                        .paymentMethod + '</option>');
                    currencyOptions.append('<option value="' + item.payoutCurrency + '">' + item
                        .payoutCurrency + '</option>');
                });

                // Show or hide rec_iban label and input based on the selected country
                if (country === "POL" || country === "GBR" || country === "CHE" || country === "ARE" || country ===
                    "EUR" || country === "ADO" || country === "AUT" || country === "BEL" || country === "HRV" ||
                    country === "CYP" || country === "EST" || country === "FIN" || country === "FRA" || country ===
                    "DEU" || country === "GRC" || country === "IRL" || country === "ITA" || country === "LVA" ||
                    country === "LTU" || country === "LUX" || country === "MLT" || country === "MCO" || country ===
                    "NLD" || country === "PRT" || country === "SMR" || country === "SVK" || country === "SVN" ||
                    country === "ESP" || country === "VAT")  {
                    recIbanLabel.show();
                    recIbanInput.show();
                    recBanLabel.show();
        recBanInput.show();
        recBicLabel.show();
        recBicInput.show();
                }
                // Show other fields and hide the message
                otherFields.show();
                notAvailableMessage.hide();

                // Add comments for views based on specific country and method of payment
                // View to show based on a specific country
                console.log("View based on specific country - ", selectedCountry);

                // View to show based on a specific method of payment
                console.log("View based on specific method of payment - ", selectedPaymentMethod);
            }
        });
    </script>
    </head>

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

                            <form id=myForm method="POST" action="{{ route('beneficiary.store') }}">
                                @csrf
                                <label for="country">Select Country:</label>
                                <select id="country"></select><br>

                                <label for="payment-options">Available Payments:</label>
                                <select id="payment-options"></select><br>

                                <label for="currency-options">Available Currency:</label>
                                <select id="currency-options"></select><br>

                                <div class="card-body" id="other-fields" >
                                    <!-- Other mandatory fields can be added here -->
                                    <div class="form-group">
                                        <label for="customer_id">{{ __('Select Sender') }}*</label>
                                        <select id="customer_id"
                                            class="form-control @error('customer_id') is-invalid @enderror"
                                            name="customer_id" required>
                                            <option disabled value="">Please select a sender</option>
                                            <!-- This is the unselectable option -->
                                            @foreach ($senders as $sender)
                                                <option value="{{ $sender->id }}" {{ $sender->id == old('customer_id') ? 'selected' : '' }}>
                                                    {{ $sender->first_name }} {{ $sender->surname }} {{ $sender->id_number }}
                                                </option>
                                            @endforeach
                                        </select>
                                    
                                        @error('customer_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <label for="name">Name:</label>
                                    <input type="text" id="name"><br>
                                    <label for="address">Address:</label>
                                    <input type="text" id="address"><br>
                                </div>

                                <div id="not-available-message" style="color: red; display: none;">
                                    Payment method is not available in this country.
                                </div>

                                <!-- rec_iban label and input fields -->
                                <div id="rec-iban-container">
                                    <label id="rec-iban-label" for="rec_iban">Rec IBAN:</label>
                                    <input type="text" id="rec_iban" style="display: none;"><br>
                                </div>

                                <!-- rec_ban and rec_bic label and input fields -->
                                <div id="rec-ban-container" style="display: none;">
                                    <label id="rec-ban-label" for="rec_ban">Rec BAN:</label>
                                    <input type="text" id="rec_ban"><br>
                                </div>
                                <div id="rec-bic-container" style="display: none;">
                                    <label id="rec-bic-label" for="rec_bic">Rec BIC:</label>
                                    <input type="text" id="rec_bic"><br>
                                </div>

                                <!-- Payment method dropdown -->
                                <div class="form-group">
                                    <label for="payment-options">Select Payment Method:</label>
                                    <select id="payment-options" class="form-control">
                                        <option value="Bank Deposit">Bank Deposit</option>
                                        <option value="Cards">Cards</option>
                                        <option value="Cash Pick Up">Cash Pick Up</option>
                                        <option value="Mobile Wallet">Mobile Wallet</option>
                                    </select>
                                </div>



                               
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create Beneficiary</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </section>
    </body>

    </html>
    @endsection