<!DOCTYPE html>
<html>
<head>
    <title>Payment Portal</title>
</head>
<link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
<link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
<script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
<body>
    <h1>Payment Portal</h1>
    <form action="/payment" method="POST">
        @csrf
        <label for="account_number">Account Number:</label>
        <x-bladewind::input><input type="text" id="account_number" name="account_number" required></x-bladewind::input>

        <label for="amount">Amount:</label>
        <x-bladewind::input><input type="text" id="amount" name="amount" required></x-bladewind::input>

        <x-bladewind::button>type="submit">Pay Now</x-bladewind::button>
    </form>
</body>
</html>
