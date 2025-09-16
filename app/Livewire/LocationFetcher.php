<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
#[Title('Location Fetcher')]
class LocationFetcher extends Component
{
    public $latitude, $longitude;
    public $area, $city, $state, $pincode, $fullAddress;

    #[\Livewire\Attributes\On('setLocation')]
    public function setLocation($data)
    {
        $this->latitude = $data['lat'];
        $this->longitude = $data['lon'];

        $this->getLocationDetails();
    }

    public function getLocationDetails()
    {
        $apiKey = config('services.locationiq.key');

        $response = Http::get("https://us1.locationiq.com/v1/reverse.php", [
            'key' => $apiKey,
            'lat' => $this->latitude,
            'lon' => $this->longitude,
            'format' => 'json'
        ]);

        if ($response->ok()) {
            $data = $response->json();

            $address = $data['address'] ?? [];

            $this->fullAddress = $data['display_name'] ?? '';
            $this->area = $address['suburb'] ?? $address['neighbourhood'] ?? '';
            $this->city = $address['city'] ?? $address['town'] ?? $address['village'] ?? '';
            $this->state = $address['state'] ?? '';
            $this->pincode = $address['postcode'] ?? '';
        } else {
            $this->fullAddress = 'Error retrieving address';
        }
    }

    public function render()
    {
        return view('livewire.location-fetcher');
    }
}
