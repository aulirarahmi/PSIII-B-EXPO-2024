// Menunggu DOM selesai dimuat
document.addEventListener('DOMContentLoaded', function() {
    // Mengambil semua tombol rambu
    const signButtons = document.querySelectorAll('.sign-button');
    // Mengambil elemen preview gambar
    const previewImage = document.querySelector('.sign-preview img');
    
    // Data gambar preview untuk setiap jenis rambu
    const signImages = {
        'Rambu Peringatan': 'warning-preview.png',
        'Rambu Larangan': 'prohibition-preview.png',
        'Rambu Petunjuk': 'guide-preview.png',
        'Rambu Perintah': 'mandatory-preview.png'
    };
    
    // Menambahkan event listener untuk setiap tombol rambu
    signButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Menghapus kelas aktif dari semua tombol
            signButtons.forEach(btn => btn.classList.remove('active'));
            // Menambahkan kelas aktif ke tombol yang diklik
            this.classList.add('active');
            // Mengubah gambar preview sesuai dengan jenis rambu yang dipilih
            const signType = this.textContent;
            previewImage.src = signImages[signType];
        });
    });
    
    // Mengambil tombol autentikasi
    const loginBtn = document.querySelector('.login-btn');
    const signupBtn = document.querySelector('.signup-btn');
    
    // Menambahkan event listener untuk tombol login
    loginBtn.addEventListener('click', function() {
        // Implementasi login di sini
        console.log('Login clicked');
    });
    
    // Menambahkan event listener untuk tombol sign up
    signupBtn.addEventListener('click', function() {
        // Implementasi sign up di sini
        console.log('Sign up clicked');
    });
    
    // Smooth scroll untuk link navigasi
    const navLinks = document.querySelectorAll('.nav-menu a');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            targetSection.scrollIntoView({ behavior: 'smooth' });
        });
    });
    
    // Menambahkan event listener untuk bagian kuis
    const quizSection = document.querySelector('.quiz-section');
    quizSection.addEventListener('click', function() {
        // Implementasi navigasi ke halaman kuis
        console.log('Navigating to quiz page');
    });
});

