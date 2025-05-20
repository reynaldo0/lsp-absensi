@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 px-4">
        <!-- Page Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Absensi Selfie</h1>
            <p class="text-lg text-gray-600">Lihat data absensi siswa dengan keterangan, lokasi, dan selfie
                masing-masing.</p>
        </div>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="table-auto w-full text-sm text-gray-800">
                <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold">NISN</th>
                        <th class="px-6 py-3 text-left font-semibold">Keterangan</th>
                        <th class="px-6 py-3 text-left font-semibold">Selfie</th>
                        <th class="px-6 py-3 text-left font-semibold">Latitude</th>
                        <th class="px-6 py-3 text-left font-semibold">Longitude</th>
                        <th class="px-6 py-3 text-left font-semibold">Alamat</th>
                        <th class="px-6 py-3 text-left font-semibold">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absensis as $absensi)
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="px-6 py-4 text-gray-700">{{ $absensi->siswa->nisn }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $absensi->keterangan }}</td>
                            <td class="px-6 py-4">
                                <img src="{{ Storage::url($absensi->image_path) }}" alt="Selfie"
                                    class="rounded-lg w-20 h-20 object-cover">
                            </td>
                            <td class="px-6 py-4 text-gray-700">{{ $absensi->latitude }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $absensi->longitude }}</td>
                            <td class="px-6 py-4 text-gray-700">
                                <span id="address-{{ $absensi->id }}"
                                    class="text-gray-600">{{ $absensi->alamat ?: 'Mencari alamat...' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($absensi->latitude && $absensi->longitude)
                                    <button onclick="openMap({{ $absensi->latitude }}, {{ $absensi->longitude }})"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                        Lihat di Peta
                                    </button>
                                @else
                                    <span class="text-gray-400">Lokasi tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-12 bg-gray-100 p-6 rounded-lg shadow-lg">
            <div id="map" style="height: 400px;" class="rounded-lg"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([0, 0], 13); // Set initial view to coordinates (0, 0)

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            // Initialize geocoder
            var geocoder = L.Control.Geocoder.nominatim();

            // Function to display address based on latitude and longitude
            function reverseGeocode(lat, lng, id) {
                geocoder.reverse([lat, lng], 13, function(results) {
                    var address = results[0] ? results[0].name : "Alamat tidak ditemukan";
                    // Update the address element with the appropriate ID
                    document.getElementById('address-' + id).textContent = address;
                });
            }

            // Loop through absensi data and display address
            @foreach ($absensis as $absensi)
                if ({{ $absensi->latitude }} && {{ $absensi->longitude }}) {
                    reverseGeocode({{ $absensi->latitude }}, {{ $absensi->longitude }}, '{{ $absensi->id }}');
                }
            @endforeach
        });

        // Function to open map at the given latitude and longitude
        function openMap(lat, lng) {
            var url = `https://www.google.com/maps?q=${lat},${lng}&hl=en`;
            window.open(url, '_blank');
        }
    </script>
@endsection
