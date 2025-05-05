<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah - Selamat Datang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-green-600 text-white py-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center px-6">
            <h1 class="text-2xl font-bold">Bank Sampah</h1>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="#" class="hover:text-gray-300">Product</a></li>
                    <li><a href="#" class="hover:text-gray-300">News</a></li>
                    <li><a href="/login" class="hover:text-gray-300">Login</a></li>
                    <li><a href="/register" class="hover:text-gray-300">Register</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <main class="container mx-auto mt-6 p-6 text-center">
        <div class="relative w-full h-64 bg-cover bg-center" style="background-image: url('https://source.unsplash.com/featured/?recycling');">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <h2 class="text-white text-3xl font-bold">Sistem Informasi Bank Sampah</h2>
            </div>
        </div>
        
        <section class="mt-10 bg-white p-6 shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold text-green-700">Keuntungan Menggunakan Sistem Ini</h2>
            <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-green-100 p-4 shadow-md rounded-lg border border-green-400 flex flex-col items-center">
                    <img src="https://img.icons8.com/ios-filled/50/228B22/easy.png" alt="Mudah Digunakan" class="mb-3">
                    <h3 class="text-lg font-bold">Mudah Digunakan</h3>
                    <p class="text-gray-600 mt-2 text-center">Akses yang mudah dan cepat untuk mengelola sampah dengan sistem digital.</p>
                </div>
                <div class="bg-green-100 p-4 shadow-md rounded-lg border border-green-400 flex flex-col items-center">
                    <img src="https://img.icons8.com/ios-filled/50/228B22/earth-care.png" alt="Bantu Lingkungan" class="mb-3">
                    <h3 class="text-lg font-bold">Bantu Lingkungan</h3>
                    <p class="text-gray-600 mt-2 text-center">Mengurangi dampak negatif sampah dengan pengelolaan yang lebih baik.</p>
                </div>
                <div class="bg-green-100 p-4 shadow-md rounded-lg border border-green-400 flex flex-col items-center">
                    <img src="https://img.icons8.com/ios-filled/50/228B22/money-bag.png" alt="Keuntungan Finansial" class="mb-3">
                    <h3 class="text-lg font-bold">Keuntungan Finansial</h3>
                    <p class="text-gray-600 mt-2 text-center">Dapatkan manfaat ekonomi dari sampah yang didaur ulang.</p>
                </div>
            </div>
        </section>
        
        <section class="mt-10 bg-gray-200 p-6 shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold text-green-700">Berita & Event</h2>
            <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-4 shadow-md rounded-lg border border-gray-300">
                    <h3 class="text-lg font-bold">Event 1</h3>
                    <p class="text-gray-600 mt-2">Deskripsi singkat tentang event atau berita.</p>
                </div>
                <div class="bg-white p-4 shadow-md rounded-lg border border-gray-300">
                    <h3 class="text-lg font-bold">Event 2</h3>
                    <p class="text-gray-600 mt-2">Deskripsi singkat tentang event atau berita.</p>
                </div>
                <div class="bg-white p-4 shadow-md rounded-lg border border-gray-300">
                    <h3 class="text-lg font-bold">Event 3</h3>
                    <p class="text-gray-600 mt-2">Deskripsi singkat tentang event atau berita.</p>
                </div>
            </div>
        </section>
    </main>
    
    <footer class="bg-gray-800 text-white text-center py-4 mt-10">
        <p>&copy; 2025 Bank Sampah. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>
