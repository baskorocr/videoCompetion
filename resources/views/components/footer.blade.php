<!-- Konten utama halaman -->
<div class="content">
    <!-- Konten lainnya -->
</div>

<footer id="footer" class="flex-shrink-0 px-6 py-4 mt-200">
    <p class="flex items-center justify-center gap-1 text-sm text-gray-600 dark:text-gray-400">
        <span>Made with</span>

        <span>
            <x-heroicon-s-heart class="w-6 h-6 text-red-500" />
        </span>

        <span>by</span>

        <a
            href="https://www.instagram.com/syncbas_"
            target="_blank"
            class="text-blue-600 hover:underline"
        >
            Mahesa Putra Baskoro
        </a>
    </p>
</footer>
<script>
    function positionFooter() {
        var contentHeight = document.querySelector('.content').offsetHeight;
        var windowHeight = window.innerHeight;
        var footer = document.getElementById('footer');
        
        // Cek apakah tinggi konten lebih kecil dari tinggi layar
        if (contentHeight < windowHeight) {
            // Menambahkan margin agar footer tetap di bawah, dengan sedikit penyesuaian agar tidak terlalu jauh
            var marginBottom = (windowHeight - contentHeight - 650) + 'px';  // Mengurangi 20px agar tidak terlalu jauh
            footer.style.marginTop = marginBottom;
        } else {
            // Jika konten lebih tinggi dari layar, reset margin-top
            footer.style.marginTop = '0';
        }
    }

    // Jalankan fungsi saat halaman dimuat dan saat ukuran jendela diubah
    window.addEventListener('load', positionFooter);
    window.addEventListener('resize', positionFooter);
</script>
