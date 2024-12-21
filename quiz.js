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
    document.querySelectorAll('.dropdown-toggle').forEach((dropdownToggle) => {
        dropdownToggle.addEventListener('click', function (e) {
            e.preventDefault(); // Mencegah link default
            const dropdownMenu = this.nextElementSibling;
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });
    });
    
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

    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("quizForm");
    
        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Cegah reload halaman
    
            // Simpan jawaban benar (sesuai database)
            const correctAnswers = {
                q1: "A", // Ganti sesuai dengan kunci jawaban di database
                q2: "B",
                q3: "C",
                q4: "D"
            };
    
            // Ambil data dari form
            const formData = new FormData(form);
            let score = 0;
            let totalQuestions = Object.keys(correctAnswers).length;
    
            // Bandingkan jawaban pengguna dengan jawaban benar
            for (let [key, value] of formData.entries()) {
                if (correctAnswers[key] === value) {
                    score++;
                }
            }
    
            // Tampilkan pop-up alert dengan nilai
            alert(`Nilai Anda: ${score}/${totalQuestions}`);
        });
    });
    
});