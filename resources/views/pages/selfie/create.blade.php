@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
        <h2 class="text-xl font-bold mb-4">Absensi Selfie</h2>

        <form id="selfieForm" method="POST" action="{{ route('selfie.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm mb-1">NISN</label>
                <input type="text" name="nisn" required class="w-full border p-2 rounded" />
            </div>

            <div class="mb-4">
                <label class="block text-sm mb-1">Keterangan</label>
                <select name="keterangan" class="w-full border p-2 rounded" required>
                    <option value="">Pilih</option>
                    <option value="Hadir">Hadir</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Izin">Izin</option>
                    <option value="Terlambat">Terlambat</option>
                    <option value="Alpha">Alpha</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm mb-1">Selfie</label>
                <div class="relative">
                    <video id="video" autoplay class="w-full rounded mb-2 border-2 border-gray-400"></video>
                    <canvas id="canvas" class="hidden"></canvas>
                    <button type="button" id="captureBtn"
                        class="bg-blue-600 text-white px-4 py-2 rounded absolute bottom-4 right-4">
                        Ambil Foto
                    </button>
                    <input type="hidden" name="image" id="imageInput">
                </div>
            </div>

            <!-- Lokasi -->
            <div class="mb-4">
                <label class="block text-sm mb-1">Lokasi Terkini</label>
                <div id="map" style="height: 300px;"></div>
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
                <input type="hidden" name="alamat" id="alamat">
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded w-full">Kirim</button>
            </div>
        </form>
    </div>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureBtn = document.getElementById('captureBtn');
        const imageInput = document.getElementById('imageInput');
        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');
        const alamatInput = document.getElementById('alamat');

        // Akses Kamera
        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(error => {
                alert("Kamera tidak dapat diakses. Pastikan kamera tersedia.");
            });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(pos => {
                const lat = pos.coords.latitude;
                const lon = pos.coords.longitude;

                latitudeInput.value = lat;
                longitudeInput.value = lon;

                // Gunakan Leaflet untuk peta
                const map = L.map('map').setView([lat, lon], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

                // Tambahkan marker ke peta
                const marker = L.marker([lat, lon]).addTo(map);

                // Ambil alamat menggunakan Nominatim (API OpenStreetMap)
                fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`)
                    .then(response => response.json())
                    .then(data => {
                        const address = data.display_name;
                        alamatInput.value = address;
                        marker.bindPopup(`<b>Lokasi Terkini:</b><br>${address}`).openPopup();
                    })
                    .catch(error => {
                        console.error('Error fetching location address:', error);
                    });
            });
        }

        // Ambil Selfie
        captureBtn.addEventListener('click', () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Mengambil gambar dalam format base64
            const dataURL = canvas.toDataURL('image/jpeg');
            imageInput.value = dataURL;
            alert("Foto diambil! Sekarang klik Kirim.");
        });
    </script>
@endsection
