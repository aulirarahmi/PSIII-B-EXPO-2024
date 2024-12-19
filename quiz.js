// Menangani navigasi quiz
document.addEventListener('DOMContentLoaded', function() {
    // Mendapatkan elemen-elemen yang diperlukan
    const nextButton = document.querySelector('.next-button');
    const dots = document.querySelectorAll('.dot');
    const form = document.querySelector('.answers-form');
    
    let currentQuestion = 0;
    
    // Data pertanyaan (contoh)
    const questions = [
        {
            question: "PERTANYAANPERTANYAANPERTANYAANPERTANYAAN",
            answers: ["jawaban 1", "jawaban 1", "jawaban 1", "jawaban 1"]
        },
        // Tambahkan pertanyaan lain sesuai kebutuhan
    ];

    // Fungsi untuk menangani klik tombol next
    nextButton.addEventListener('click', function() {
        // Periksa apakah ada jawaban yang dipilih
        const selectedAnswer = form.querySelector('input[type="radio"]:checked');
        
        if (selectedAnswer) {
            currentQuestion = (currentQuestion + 1) % dots.length;
            updatePagination();
            // Di sini bisa ditambahkan logika untuk menyimpan jawaban
            form.reset(); // Reset pilihan untuk pertanyaan berikutnya
        } else {
            alert('Silakan pilih jawaban terlebih dahulu');
        }
    });

    // Fungsi untuk memperbarui indikator pagination
    function updatePagination() {
        dots.forEach((dot, index) => {
            if (index === currentQuestion) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
    }
});