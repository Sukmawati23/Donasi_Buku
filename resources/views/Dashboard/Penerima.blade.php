@extends('layouts.app')

@section('content')
<div style="background-color: #000080; min-height: 100vh;" class="text-white px-3 pt-4 pb-5">
    {{-- Logo --}}
    <div class="text-start mb-4">
        <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo" style="width: 45px;">
    </div>

    {{-- Sapaan --}}
    <h5 class="fw-bold">Halo, {{ Auth::user()->name }}</h5>

    {{-- Kartu Daftar Buku --}}
    <div class="mt-4 text-center">
        <div class="bg-primary bg-opacity-75 rounded-4 p-4 d-inline-block">
            <i class="fas fa-book fa-3x mb-3"></i>
            <p class="mb-2">Daftar Buku</p>
            <a href="{{ route('penerima.daftarBuku') }}" class="btn btn-primary px-4 py-1">Daftar Buku</a>
        </div>
    </div>

    {{-- Status Permintaan --}}
    <div class="mt-5">
        <h6 class="fw-bold mb-3">Status Permintaan</h6>
        <div class="table-responsive">
            <table class="table text-white" style="background-color: #191970;">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Tanggapan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengajuan as $pengajuan)
                        <tr>
                            <td>{{ $pengajuan->buku->judul ?? 'Tidak diketahui' }}</td>
                            <td>{{ $pengajuan->status }}</td>
                            <td>
                                @if($pengajuan->status === 'Disetujui')
                                    <span class="badge bg-success">Sukses</span>
                                @elseif($pengajuan->status === 'Ditolak')
                                    <span class="badge bg-danger">Gagal</span>
                                @else
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Belum ada permintaan buku</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Daftar Buku -->
    <div id="bookListSection" style="display: none;" class="container fade-in">
        <h3>Daftar Buku</h3>
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Cari ..." oninput="filterBooks()">
        </div>
        <div class="book-box">
            <table>
                <thead>
                    <tr>
                        <th>ID Buku</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Status Buku</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="bookTableBody">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
            <div id="noResults" class="no-results" style="display: none;">Buku tidak ditemukan.</div>
        </div>
        <button class="btn-kembali" onclick="hideBookList()">Kembali</button>
    </div>

    <!-- Detail Buku -->
    <div id="bookDetailSection" class="container fade-in" style="display: none;">
        <div class="book-detail">
            <h3>Detail Buku</h3>
            <div class="book-detail-content">
                <table>
                    <tbody id="bookDetailContent">
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>
            <button class="btn-ajukan" onclick="confirmAjukanBuku()">Ajukan Buku</button>
            <button class="btn-kembali" onclick="hideBookDetail()">Kembali</button>
        </div>
    </div>

    <!-- Notifikasi Pengajuan -->
    <div id="notificationSection" style="display: none;" class="container fade-in">
        <div class="notification-section">
            <h2>Ajukan Permintaan Buku</h2>
            <div>
                <img src="img-notifikasi.png" alt="Permintaan Diajukan" style="width: 120px; margin: 20px 0;">
            </div>
            <h3>Permintaan telah diajukan</h3>
            <p>Permintaan buku Anda telah berhasil diajukan.</p>
            <button class="btn-daftar" onclick="kembaliKeBeranda()">Kembali ke Beranda</button>
        </div>
    </div>

    <!-- Profil -->
    <div id="profileSection" class="fade-in">
        <p class="title">Profil Penerima</p>
        <div class="profile-pic-wrapper" onclick="document.getElementById('uploadFotoProfil').click()">
            <img id="fotoProfilPreview" src="profile-placeholder.jpg" />
            <i class="fas fa-camera"></i>
            <input type="file" id="uploadFotoProfil" accept="image/*" style="display:none;" onchange="previewFotoProfil(event)" />
        </div>
        <p style="margin-top: 10px; font-weight: bold;" id="profileName">Nama Lengkap</p>

        <div class="profile-menu">
            <div onclick="showSettings()"><i class="fas fa-cog"></i> Pengaturan</div>
            <div onclick="showHelp()"><i class="fas fa-question-circle"></i> Bantuan</div>
            <div onclick="showTerms()"><i class="fas fa-file-alt"></i> Syarat & Ketentuan</div>
            <div onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Logout</div>
        </div>
    </div>

    <!-- Notifikasi -->
    <div id="notificationsSection" class="fade-in">
        <img src="bell-icon.png" alt="Notifikasi" class="notification-icon" />
        <h2>Notifikasi</h2>
        <div id="notifContainer">
            <!-- Data akan diisi oleh JavaScript -->
        </div>
    </div>

    <!-- Pengaturan Akun -->
    <div id="settingsSection" class="fade-in">
        <h2 style="background-color:#0000b3; color:white; padding:10px; border-radius: 5px; text-align:center;">
            <i class="fas fa-cog"></i> Pengaturan Akun
        </h2>
        <div style="margin:20px 0;">
            <div style="padding:10px; border-bottom:1px solid #aaa; cursor:pointer;" onclick="showEditAccount()">
                Edit Akun <span style="float:right;">›</span>
            </div>
            <div style="padding:10px; border-bottom:1px solid #aaa; cursor:pointer;" onclick="showChangeEmail()">
                Ubah Email <span style="float:right;">›</span>
            </div>
            <div style="padding:10px; border-bottom:1px solid #aaa; cursor:pointer;" onclick="showChangePassword()">
                Ganti Kata Sandi <span style="float:right;">›</span>
            </div>
            <div style="padding:10px; border-bottom:1px solid #aaa; cursor:pointer;" onclick="showPrivacy()">
                Privasi & Keamanan <span style="float:right;">›</span>
            </div>
        </div>
        <div style="margin: 10px 0; display: flex; align-items: center; justify-content: space-between;">
            <span>Kirim notifikasi via email</span>
            <label class="switch">
                <input type="checkbox" id="emailNotifCheckbox">
                <span class="slider round"></span>
            </label>
        </div>
        <button onclick="showDeleteAccountConfirm()" style="width:100%; background-color: darkred; color:white; padding:10px; border:none; border-radius:5px; font-weight:bold; margin-top: 20px;">
            Hapus Akun
        </button>
        <br><br>
        <button onclick="showProfile()" style="width:100%; background-color: #0000b3; color:white; padding:10px; border:none; border-radius:5px;">
            Kembali
        </button>
    </div>

    <!-- Bantuan -->
    <div id="helpSection" style="display: none;" class="fade-in">
        <h2 style="text-align:center;"><i class="fas fa-question-circle"></i> Bantuan</h2>
        <div style="background:white; color:#000; border-radius:10px; padding:15px; margin:20px;">
            <strong>Cara mengubah foto profil?</strong>
            <p>Anda dapat mengubah foto profil pada halaman utama profil.</p>
        </div>
        <div style="background:white; color:#000; border-radius:10px; padding:15px; margin:20px;">
            <strong>Tidak dapat mengakses akun</strong>
            <p>Coba atur ulang kata sandi atau hubungi kami untuk bantuan.</p>
        </div>
        <div style="background:white; color:#000; border-radius:10px; padding:15px; margin:20px;">
            <strong>Ketentuan pengguna</strong>
            <p>Baca syarat & ketentuan untuk informasi mengenai aturan.</p>
        </div>
        <div style="background:white; color:#000; border-radius:10px; padding:15px; margin:20px;">
            <strong>Butuh bantuan lainnya?</strong>
            <p>Hubungi kami di: <a href="mailto:donasibuku.app@gmail.com">donasibuku.app@gmail.com</a></p>
        </div>
        <button onclick="showProfile()" style="margin: 20px; padding: 10px 20px; background-color: #0000b3; color: white; border: none; border-radius: 5px;">
            Kembali
        </button>
    </div>

    <!-- Syarat & Ketentuan -->
    <div id="termsSection" style="display: none;" class="fade-in">
        <h2 style="color: #ADD8E6; text-align: center;">Syarat & Ketentuan Penerima</h2>
        <div style="background: white; color: #000080; padding: 20px; border-radius: 10px; margin: 20px; text-align: left;">
            <ol>
                <li>Data penerima harus benar dan dapat diverifikasi.</li>
                <li>Donasi hanya untuk keperluan yang sesuai dengan tujuan permohonan.</li>
                <li>Tidak diperbolehkan menyalahgunakan donasi untuk hal di luar kebutuhan.</li>
                <li>Penerima wajib melaporkan jika ada perubahan data atau kebutuhan.</li>
                <li>Dengan mendaftar, Anda setuju pada ketentuan ini.</li>
            </ol>
            <button onclick="showProfile()" style="margin-top: 20px; padding: 10px 20px; background-color: #0000b3; color: white; border: none; border-radius: 5px;">
                Kembali
            </button>
        </div>
    </div>

    <!-- Halaman Edit Akun -->
    <div id="editAccountSection" style="display: none;" class="fade-in">
        <h2 style="color: lightgray; text-align: center;">Edit Akun</h2>
        <div style="margin: 20px auto; text-align: center;">
            <div class="profile-pic-wrapper" onclick="document.getElementById('uploadFotoProfilEdit').click()">
                <img id="fotoProfilEditPreview" src="profile-placeholder.jpg" style="width: 100px; height: 100px; border-radius: 50%; background-color: white;" />
                <i class="fas fa-camera"></i>
                <input type="file" id="uploadFotoProfilEdit" accept="image/*" style="display:none;" onchange="previewFotoProfilEdit(event)" />
            </div>
        </div>
        <div style="max-width: 300px; margin: auto; text-align: left; padding: 20px;">
            <label><i class="fas fa-check-circle" style="color: lime;"></i> Nama Lengkap</label>
            <input type="text" id="editNama" placeholder="Nama Lengkap" style="width: 100%; margin-bottom: 10px; padding: 8px; border-radius: 5px; border: none;" />

            <label><i class="fas fa-check-circle" style="color: lime;"></i> Alamat</label>
            <input type="text" id="editAlamat" placeholder="Alamat" style="width: 100%; margin-bottom: 10px; padding: 8px; border-radius: 5px; border: none;" />

            <label><i class="fas fa-check-circle" style="color: lime;"></i> No. Telepon</label>
            <input type="text" id="editTelepon" placeholder="Nomor Telepon" style="width: 100%; margin-bottom: 20px; padding: 8px; border-radius: 5px; border: none;" />
        </div>
        <div style="text-align: center;">
            <button style="background-color: #0000cd; color: white; padding: 10px 20px; border: none; border-radius: 8px;" onclick="saveAccountChanges()">
                Simpan
            </button>
            <br><br>
            <button onclick="showSettings()" style="color: white; background: none; border: none; text-decoration: underline;">
                Kembali
            </button>
        </div>
    </div>

    <!-- Halaman Ubah Email -->
    <div id="changeEmailSection" style="display: none;" class="fade-in">
        <h2 style="text-align: center; color: white;">Ubah Email</h2>
        <div style="background-color: white; color: black; border-radius: 10px; padding: 20px; margin: 20px; text-align: center;">
            <img src="https://img.icons8.com/ios-filled/100/000000/new-post.png" style="width:80px; margin-bottom: 20px;" />
            <p style="font-weight: bold; font-size: 18px;">Ubah Email</p>
            <input type="email" placeholder="Email Saat ini" id="currentEmail" style="width:100%; margin-bottom:10px; padding:10px; border-radius:5px; border:1px solid #ccc;" required>
            <input type="email" placeholder="Email Baru" id="newEmail" style="width:100%; margin-bottom:20px; padding:10px; border-radius:5px; border:1px solid #ccc;" required>
            <button onclick="submitEmailChange()" style="width:100%; padding:10px; background-color:#000080; color:white; border:none; border-radius:5px;">
                PERBAHARUI EMAIL
            </button>
        </div>
    </div>

    <!-- Halaman Konfirmasi Email Berhasil -->
    <div id="emailSuccessSection" style="display: none;" class="fade-in">
        <h2 style="color:white; text-align: center;">Ubah Email</h2>
        <div style="background-color:white; color:black; border-radius:10px; padding:30px; margin: 20px;">
            <img src="https://img.icons8.com/ios-filled/100/26e07f/checkmark--v1.png" style="width:80px; margin-bottom:15px;" />
            <p style="font-weight:bold; font-size:18px; color:#000080;">Email berhasil diperbaharui</p>
            <p>Email Anda telah berhasil diperbaharui</p>
            <button onclick="showSettings()" style="margin-top:20px; padding:10px 20px; background-color:#000080; color:white; border:none; border-radius:5px;">
                OK
            </button>
        </div>
    </div>

    <!-- Halaman Ganti Kata Sandi -->
    <div id="changePasswordSection" style="display: none;" class="fade-in">
        <h2 style="text-align: center; color: white;">Ganti Kata Sandi</h2>
        <div style="background-color: white; color: black; border-radius: 10px; padding: 20px; margin: 20px; text-align: center;">
            <img src="https://img.icons8.com/ios-filled/100/000000/lock-2.png" style="width:80px; margin-bottom: 20px;" />
            <p style="font-weight: bold; font-size: 18px;">Ganti Kata Sandi</p>
            <input type="password" placeholder="Kata sandi saat ini" id="currentPassword" style="width:100%; margin-bottom:10px; padding:10px; border-radius:5px; border:1px solid #ccc;" required>
            <input type="password" placeholder="Kata sandi baru" id="newPassword" style="width:100%; margin-bottom:10px; padding:10px; border-radius:5px; border:1px solid #ccc;" required>
            <input type="password" placeholder="Konfirmasi kata sandi" id="confirmPassword" style="width:100%; margin-bottom:20px; padding:10px; border-radius:5px; border:1px solid #ccc;" required>
            <button onclick="submitPasswordChange()" style="width:100%; padding:10px; background-color:#000080; color:white; border:none; border-radius:5px;">
                Simpan
            </button>
        </div>
    </div>

    <!-- Halaman Konfirmasi Kata Sandi Berhasil -->
    <div id="passwordSuccessSection" style="display: none;" class="fade-in">
        <h2 style="color:white; text-align: center;">Kata Sandi Berhasil Diubah</h2>
        <div style="background-color:white; color:black; border-radius:10px; padding:30px; margin: 20px;">
            <img src="https://img.icons8.com/ios-filled/100/26e07f/checkmark--v1.png" style="width:80px; margin-bottom:15px;" />
            <p style="font-weight:bold; font-size:18px; color:#000080;">Kata sandi Anda telah berhasil diperbaharui.</p>
            <button onclick="showSettings()" style="margin-top:20px; padding:10px 20px; background-color:#000080; color:white; border:none; border-radius:5px;">
                Kembali ke Pengaturan
            </button>
        </div>
    </div>

    <!-- Halaman Privasi & Keamanan -->
    <div id="privacySection" style="display: none;" class="fade-in">
        <h3 style="color: white; margin-bottom: 30px;">
            <i class="fas fa-arrow-left" style="cursor:pointer; margin-right:10px;" onclick="showSettings()"></i> Privasi & Keamanan
        </h3>
        <div style="background-color: white; color: #000080; border-radius: 10px; padding: 20px; margin: 20px;">
            <p style="font-weight: bold; font-size: 18px;">Autentikasi Dua Faktor 
                <label class="switch" style="float:right;">
                    <input type="checkbox" id="twoFactorToggle" checked>
                    <span class="slider round"></span>
                </label>
            </p>
            <p style="margin-top: 10px; color: black;">Tambahkan lapisan keamanan tambahan pada akun Anda.</p>
        </div>
        <button onclick="showSettings()" style="margin: 20px; padding: 10px; width: calc(100% - 40px); background-color: #0000cd; color: white; border: none; border-radius: 5px;">
            Kembali
        </button>
    </div>

    <!-- Halaman Konfirmasi Hapus Akun -->
    <div id="deleteAccountConfirm" style="display: none;" class="fade-in">
        <h2 style="text-align:center; color: #ADD8E6;">Konfirmasi Penghapusan Akun</h2>
        <div style="background-color: white; color: black; border-radius: 10px; padding: 20px; margin: 20px;">
            <p style="font-weight: bold;">Apakah Anda yakin ingin menghapus akun Anda?</p>
            <p style="font-size: 14px;">Tindakan ini tidak dapat dibatalkan. Semua data Anda akan hilang secara permanen.</p>
            <div style="background-color: #ffe6e6; padding: 10px; border-radius: 5px; margin-top: 10px;">
                <strong style="color: red;">PERINGATAN:</strong>
                <ul style="padding-left: 20px;">
                    <li>Akun tidak dapat dipulihkan setelah dihapus.</li>
                    <li>Semua histori, preferensi, dan data Anda akan dihapus.</li>
                </ul>
            </div>
            <div style="margin-top: 20px; display: flex; justify-content: space-between;">
                <button onclick="showSettings()" style="padding: 10px 20px; background-color: gray; color: white; border: none; border-radius: 5px;">
                    Batalkan
                </button>
                <button onclick="confirmDeleteAccount()" style="padding: 10px 20px; background-color: red; color: white; border: none; border-radius: 5px;">
                    Ya, Hapus Akun
                </button>
            </div>
        </div>
    </div>

    <!-- Halaman Akun Berhasil Dihapus -->
    <div id="deleteSuccess" style="display: none;" class="fade-in">
        <h2 style="margin-top: 100px; text-align: center;">Akun Berhasil Dihapus</h2>
        <p style="margin: 20px 0; text-align: center;">
            Akun Anda telah dihapus secara permanen.<br>Terima kasih telah menggunakan layanan kami.
        </p>
        <div style="text-align: center;">
            <button onclick="goToHome()" style="background-color: white; color: #000080; padding: 10px 20px; border: none; border-radius: 5px;">
                Kembali ke Beranda
            </button>
        </div>
    </div>

    <!-- Navigasi Bawah -->
    <nav class="navbar fixed-bottom bg-light border-top">
        <div class="container d-flex justify-content-around py-2">
            <a href="{{ route('dashboard.penerima') }}" class="text-primary" onclick="showDashboard()">
                <i class="fas fa-home fa-lg"></i>
            </a>
            <a href="#" class="text-secondary" onclick="showNotifications()">
                <i class="fas fa-bell fa-lg"></i>
            </a>
            <a href="#" class="text-secondary" onclick="showProfile()">
                <i class="fas fa-user fa-lg"></i>
            </a>
        </div>
    </nav>
</div>

 <script>
        // Variabel untuk menyimpan data (kosong awalnya)
        let books = [];
        let requestStatus = [];
        let notifications = [];

        // Inisialisasi halaman
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil data user dari localStorage atau buat baru jika belum ada
            const userData = JSON.parse(localStorage.getItem('userData')) || {
                namaLengkap: "{{ Auth::user()->name }}",
                email: "{{ Auth::user()->email }}",
                alamat: "",
                telepon: "",
                fotoProfil: "profile-placeholder.jpg"
            };

            // Tampilkan data user
            document.getElementById("profileName").textContent = userData.namaLengkap;
            document.getElementById("fotoProfilPreview").src = userData.fotoProfil;
            document.getElementById("fotoProfilEditPreview").src = userData.fotoProfil;
            document.getElementById("editNama").value = userData.namaLengkap;
            document.getElementById("editAlamat").value = userData.alamat;
            document.getElementById("editTelepon").value = userData.telepon;
            document.getElementById("currentEmail").value = userData.email;

            // Coba ambil data dari localStorage
            const savedBooks = localStorage.getItem('books');
            const savedRequests = localStorage.getItem('requestStatus');
            const savedNotifs = localStorage.getItem('notifications');

            // Jika ada data tersimpan, gunakan itu
            if (savedBooks) books = JSON.parse(savedBooks);
            if (savedRequests) requestStatus = JSON.parse(savedRequests);
            if (savedNotifs) notifications = JSON.parse(savedNotifs);

            // Load preferensi notifikasi email
            const emailNotif = localStorage.getItem('emailNotif') === 'true';
            document.getElementById('emailNotifCheckbox').checked = emailNotif;
        });

        // Fungsi untuk menambahkan buku baru
        function addNewBook(bookData) {
            books.push(bookData);
            localStorage.setItem('books', JSON.stringify(books));
            displayBooks(books);
        }

        // Fungsi untuk menambahkan status permintaan baru
        function addNewRequest(requestData) {
            requestStatus.push(requestData);
            localStorage.setItem('requestStatus', JSON.stringify(requestStatus));
            
            // Perbarui tampilan jika di halaman dashboard
            if (document.getElementById('dashboardSection').style.display === 'block') {
                updateRequestStatusDisplay();
            }
        }

        // Fungsi untuk menambahkan notifikasi baru
        function addNewNotification(notificationData) {
            notifications.push(notificationData);
            localStorage.setItem('notifications', JSON.stringify(notifications));
            
            // Perbarui tampilan jika di halaman notifikasi
            if (document.getElementById('notificationsSection').style.display === 'block') {
                updateNotificationDisplay();
            }
        }

        // Fungsi untuk memperbarui tampilan status permintaan
        function updateRequestStatusDisplay() {
            const tbody = document.querySelector("#dashboardSection table tbody");
            tbody.innerHTML = "";
            
            if (requestStatus.length === 0) {
                tbody.innerHTML = `<tr><td colspan="3" class="text-center">Belum ada permintaan buku</td></tr>`;
                return;
            }
            
            requestStatus.forEach(request => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${request.title || 'Tidak diketahui'}</td>
                    <td>${request.response || '-'}</td>
                    <td>
                        ${request.status === 'Disetujui' ? 
                          '<span class="badge bg-success">Sukses</span>' : 
                          request.status === 'Ditolak' ? 
                          '<span class="badge bg-danger">Gagal</span>' : 
                          '<span class="badge bg-warning text-dark">Menunggu</span>'}
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        // Fungsi untuk memperbarui tampilan notifikasi
        function updateNotificationDisplay() {
            const container = document.getElementById("notifContainer");
            container.innerHTML = "";
            
            if (notifications.length === 0) {
                container.innerHTML = `<div class="notif-card">Belum ada notifikasi</div>`;
                return;
            }
            
            notifications.forEach(notif => {
                const notifCard = document.createElement("div");
                notifCard.className = "notif-card";
                notifCard.innerHTML = `
                    <strong>${notif.title || 'Notifikasi'}</strong>
                    <p>${notif.message || '-'}</p>
                    <small>${notif.date || ''} ${notif.time ? `(${notif.time})` : ''}</small>
                `;
                container.appendChild(notifCard);
            });
        }

        // Fungsi untuk mengajukan buku (contoh implementasi)
        function ajukanBuku() {
            // Dapatkan data buku yang sedang dilihat
            const bookId = document.getElementById('bookDetailSection').getAttribute('data-book-id');
            const book = books.find(b => b.id === bookId);
            
            if (!book) {
                alert("Buku tidak ditemukan!");
                return;
            }
            
            // Buat permintaan baru
            const newRequest = {
                title: book.title,
                response: "Permintaan sedang diproses",
                status: "Menunggu"
            };
            
            addNewRequest(newRequest);
            
            // Buat notifikasi
            const newNotification = {
                title: "Pengajuan Buku",
                message: `Anda telah mengajukan buku "${book.title}"`,
                date: new Date().toLocaleDateString('id-ID'),
                time: new Date().toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'})
            };
            
            addNewNotification(newNotification);
            
            hideAllSections();
            document.getElementById('notificationSection').style.display = 'block';
            
            setTimeout(() => {
                showDashboard();
                alert("Permintaan buku berhasil diajukan!");
            }, 2000);
        }

        function kembaliKeBeranda() {
            hideAllSections();
            document.getElementById('dashboardSection').style.display = 'block';
        }

        function displayBooks(booksToDisplay) {
            const tbody = document.getElementById("bookTableBody");
            tbody.innerHTML = "";
            const noResults = document.getElementById("noResults");
            
            if (booksToDisplay.length === 0) {
                noResults.style.display = "block";
            } else {
                noResults.style.display = "none";
                booksToDisplay.forEach(book => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${book.id}</td>
                        <td>${book.title}</td>
                        <td>${book.author}</td>
                        <td>${book.category}</td>
                        <td>${book.status}</td>
                        <td>${book.publisher}</td>
                        <td>${book.year}</td>
                        <td><button onclick="showBookDetail('${book.id}')" style="padding: 5px 10px; background-color: #0000cd; color: white; border: none; border-radius: 3px;">Detail</button></td>
                    `;
                    tbody.appendChild(row);
                });
            }
        }

        function filterBooks() {
            const searchInput = document.getElementById("searchInput").value.toLowerCase();
            const filteredBooks = books.filter(book => 
                book.title.toLowerCase().includes(searchInput) || 
                book.author.toLowerCase().includes(searchInput) ||
                book.category.toLowerCase().includes(searchInput)
            );
            displayBooks(filteredBooks);
        }

        function showNotifications() {
            hideAllSections();
            document.getElementById('notificationsSection').style.display = 'block';
        }

        function showProfile() {
            hideAllSections();
            document.getElementById('profileSection').style.display = 'block';
        }

        function showSettings() {
            hideAllSections();
            document.getElementById('settingsSection').style.display = 'block';
        }

        function showHelp() {
            hideAllSections();
            document.getElementById('helpSection').style.display = 'block';
        }

        function showTerms() {
            hideAllSections();
            document.getElementById('termsSection').style.display = 'block';
        }

        function previewFotoProfil(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function() {
                const img = document.getElementById('fotoProfilPreview');
                img.src = reader.result;
                
                // Simpan ke localStorage (simulasi)
                const userData = JSON.parse(localStorage.getItem('userData')) || {};
                userData.fotoProfil = reader.result;
                localStorage.setItem('userData', JSON.stringify(userData));
            };
            reader.readAsDataURL(input.files[0]);
        }

        function previewFotoProfilEdit(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('fotoProfilEditPreview').src = reader.result;
                
                // Update juga di preview profil utama
                document.getElementById('fotoProfilPreview').src = reader.result;
                
                // Simpan ke localStorage (simulasi)
                const userData = JSON.parse(localStorage.getItem('userData')) || {};
                userData.fotoProfil = reader.result;
                localStorage.setItem('userData', JSON.stringify(userData));
            };
            reader.readAsDataURL(input.files[0]);
        }

        function showEditAccount() {
            hideAllSections();
            document.getElementById('editAccountSection').style.display = 'block';
        }

        function saveAccountChanges() {
            const nama = document.getElementById('editNama').value;
            const alamat = document.getElementById('editAlamat').value;
            const telepon = document.getElementById('editTelepon').value;
            
            // Simpan ke localStorage (simulasi)
            const userData = JSON.parse(localStorage.getItem('userData')) || {};
            userData.namaLengkap = nama;
            userData.alamat = alamat;
            userData.telepon = telepon;
            localStorage.setItem('userData', JSON.stringify(userData));
            
            // Update tampilan
            document.getElementById("profileName").textContent = nama;
            
            alert("Perubahan berhasil disimpan!");
            showSettings();
        }

        function showChangeEmail() {
            hideAllSections();
            document.getElementById('changeEmailSection').style.display = 'block';
        }

        function submitEmailChange() {
            const currentEmail = document.getElementById('currentEmail').value;
            const newEmail = document.getElementById('newEmail').value;

            if (!currentEmail || !newEmail) {
                alert("Harap isi semua field.");
                return;
            }

            // Simpan ke localStorage (simulasi)
            const userData = JSON.parse(localStorage.getItem('userData')) || {};
            userData.email = newEmail;
            localStorage.setItem('userData', JSON.stringify(userData));
            
            hideAllSections();
            document.getElementById('emailSuccessSection').style.display = 'block';
        }

        function showChangePassword() {
            hideAllSections();
            document.getElementById('changePasswordSection').style.display = 'block';
        }

        function submitPasswordChange() {
            const current = document.getElementById('currentPassword').value;
            const newPass = document.getElementById('newPassword').value;
            const confirmPass = document.getElementById('confirmPassword').value;

            if (!current || !newPass || !confirmPass) {
                alert("Harap isi semua kolom.");
                return;
            }

            if (newPass !== confirmPass) {
                alert("Kata sandi baru dan konfirmasi tidak cocok.");
                return;
            }

            // Simpan ke localStorage (simulasi)
            const userData = JSON.parse(localStorage.getItem('userData')) || {};
            userData.password = newPass; // Note: Dalam aplikasi nyata, password harus di-hash
            localStorage.setItem('userData', JSON.stringify(userData));
            
            hideAllSections();
            document.getElementById('passwordSuccessSection').style.display = 'block';
        }

        function showPrivacy() {
            hideAllSections();
            document.getElementById('privacySection').style.display = 'block';
        }

        function saveNotifPreference() {
            const isChecked = document.getElementById('emailNotifCheckbox').checked;
            localStorage.setItem('emailNotif', isChecked);
            
            // Kirim ke backend (AJAX)
            fetch('/api/update-email-notification', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                },
                body: JSON.stringify({
                    notif_email: isChecked
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log("Status notifikasi disimpan:", data);
            })
            .catch(error => {
                console.error("Gagal menyimpan status notifikasi:", error);
            });
        }

        function showDeleteAccountConfirm() {
            hideAllSections();
            document.getElementById('deleteAccountConfirm').style.display = 'block';
        }

        function confirmDeleteAccount() {
            // Simulasi penghapusan akun
            localStorage.removeItem('userData');
            
            hideAllSections();
            document.getElementById('deleteSuccess').style.display = 'block';
        }

        function goToHome() {
            // Redirect ke halaman login (simulasi)
            window.location.href = '/login';
        }

        function confirmLogout() {
            if (confirm("Apakah Anda yakin ingin logout?")) {
                // Redirect ke halaman login (simulasi)
                window.location.href = '/logout';
            }
        }

        function hideAllSections() {
            const sections = [
                'dashboardSection', 'bookListSection', 'bookDetailSection', 
                'notificationSection', 'profileSection', 'notificationsSection',
                'settingsSection', 'helpSection', 'termsSection', 'editAccountSection',
                'changeEmailSection', 'emailSuccessSection', 'changePasswordSection',
                'passwordSuccessSection', 'privacySection', 'deleteAccountConfirm',
                'deleteSuccess'
            ];
            
            sections.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.style.display = 'none';
            });
        }
    </script>    
@endsection
