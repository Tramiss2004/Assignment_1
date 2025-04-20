<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GBN: Update License</title>
    <link rel="stylesheet" href="{{ asset('css/ITAssetCreate.css') }}"> {{-- Assuming same CSS --}}
    {{-- Add other necessary CSS/JS links (e.g., Bootstrap if needed) --}}
</head>


<div class="container">
    <h2>Update License (License ID: {{ $license->id }})</h2>

    {{-- Display validation errors if any --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('license.update', $license->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">License Name: </label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $license->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">License Version: </label>
            <input type="text" name="version" class="form-control" value="{{ old('version', $license->version) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Expiry Date: </label>
            <input type="date" name="expiry_date" class="form-control" value="{{ old('expiry_date', $license->expiry_date) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status: </label>
            <input type="text" id="status" name="status" class="form-control" value="{{ old('status', $license->status) == 1 ? 'Valid' : 'Expired' }}" readonly>
            <input type="hidden" name="status_value" id="status_value" value="{{ old('status') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Serial No: </label>
            <input type="text" name="serial_no" class="form-control" value="{{ old('serial_no', $license->serial_no) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Vendor: </label>
            <input type="text" name="vendor" class="form-control" value="{{ old('vendor', $license->vendor) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Purchase Date: </label>
            <input type="date" name="date_purchase" class="form-control" value="{{ old('date_purchase', $license->date_purchase) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">License Type: </label>
            <select name="license_type" id="license_type" class="form-control" required>
                @php $currentLicenseType = old('license_type', $license->license_type); @endphp
                <option value="Permanent" {{ old('license_type') == 'Permanent' ? 'selected' : '' }}>Permanent</option>
                <option value="Renewable" {{ old('license_type') == 'Renewable' ? 'selected' : '' }}>Renewable</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Key: </label>
            <input type="text" name="product_key" class="form-control" value="{{ old('product_key', $license->product_key) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Quantity: </label>
            <input type="text" name="quantity" class="form-control" value="{{ old('quantity', $license->quantity) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Asset</button>
        <a href="{{ route('license.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>


<script>
    function calculateExpiryDate() {
        const expiryInput = document.querySelector('[name="expiry_date"]');
        const statusText = document.getElementById("status"); // this is the visible text input
        const statusHidden = document.getElementById("status_value"); // this is the hidden field

        const expiryDateStr = expiryInput.value;

        if (!expiryDateStr) return;

        const expiryDate = new Date(expiryDateStr); // works because you're using <input type="date">
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        const isValid = expiryDate >= today ? 1 : 0;
        statusText.value = isValid ? "Valid" : "Expired";
        statusHidden.value = isValid;
    }

    document.addEventListener("DOMContentLoaded", function () {
        calculateExpiryDate();
        document.querySelector('[name="expiry_date"]').addEventListener("change", calculateExpiryDate);
    });
</script>
<x-footer />
