<div>
    <button onclick="getLocation()" class="bg-info-500 text-white p-2 rounded">Get My Location</button>

    @if ($fullAddress)
        <div class="mt-4">
            <p><strong>Full Address:</strong> {{ $fullAddress }}</p>
            <p><strong>Latitude:</strong> {{ $latitude }}</p>
            <p><strong>Longitude:</strong> {{ $longitude }}</p>
            <p><strong>Area:</strong> {{ $area }}</p>
            <p><strong>City/District:</strong> {{ $city }}</p>
            <p><strong>State:</strong> {{ $state }}</p>
            <p><strong>Pincode:</strong> {{ $pincode }}</p>
        </div>
    @endif
</div>
