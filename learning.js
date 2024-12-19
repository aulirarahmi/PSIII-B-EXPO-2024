// Data contoh untuk konten (akan diganti dengan data dari database)
const contentData = [
    {
        image: 'tubes image/RambuPeingatan.png',
        title: 'Persimpangan tiga tipe T',
        description: 'deskripsi nyadeskrips riya deskripsi nyadeskrips riya deskripsi nyadeskrips riya deskripsi nyadeskrips riya deskripsi nyadeskrips riya'
    },
    {
        image: 'tubes image/RambuLarangan.png',
        title: 'Ini untuk judul dari database',
        description: 'deskripsi nyadeskrips riya deskripsi nyadeskrips riya deskripsi nyadeskrips riya deskripsi nyadeskrips riya deskripsi nyadeskrips riya'
    },
    {
        image: 'tubes image/RambuPerintah.png',
        title: 'Ini untuk judul dari database',
        description: 'deskripsi nyadeskrips riya deskripsi nyadeskrips riya deskripsi nyadeskrips riya deskripsi nyadeskrips riya deskripsi nyadeskrips riya'
    }
];

// Fungsi untuk membuat elemen box konten
function createContentBox(data) {
    // Membuat elemen box
    const box = document.createElement('div');
    box.className = 'content-box';

    // Membuat elemen gambar
    const img = document.createElement('img');
    img.src = data.image;
    img.alt = data.title;

    // Membuat elemen judul
    const title = document.createElement('h3');
    title.textContent = data.title;

    // Membuat elemen deskripsi
    const description = document.createElement('p');
    description.textContent = data.description;

    // Menambahkan semua elemen ke dalam box
    box.appendChild(img);
    box.appendChild(title);
    box.appendChild(description);

    return box;
}

// Fungsi untuk menampilkan semua konten
function displayContent() {
    const container = document.getElementById('gridContainer');
    
    // Membersihkan container
    container.innerHTML = '';
    
    // Menambahkan setiap box konten ke container
    contentData.forEach(data => {
        const box = createContentBox(data);
        container.appendChild(box);
    });
}

// Menjalankan fungsi displayContent saat halaman dimuat
document.addEventListener('DOMContentLoaded', displayContent);