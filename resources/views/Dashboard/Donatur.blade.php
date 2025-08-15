@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Logo dan sambutan --}}
        <div class="text-center my-4">
            <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo" class="mb-2" style="width: 50px;">
            <h4><strong>Selamat Datang</strong></h4>
            <h5><strong><br>({{ Auth::user()->name }})</strong></h5>
        </div>

        {{-- Form Donasi Buku --}}
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <h5 class="card-title">Tambah Donasi Buku</h5>
                <form method="POST" action="#" enctype="multipart/form-data"> {{-- Tambah enctype --}}
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="judul" class="form-control" placeholder="Judul Buku">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="kategori">
                            <option value="">Pilih Kategori</option>
                <option value="fiction">Fiksi</option>
                <option value="non-fiction">Non-Fiksi</option>
                <option value="children">Anak-anak</option>
                <option value="mystery">Misteri</option>
                <option value="fantasy">Fantasi</option>
                <option value="biography">Biografi</option>
                <option value="history">Sejarah</option>
                <option value="science">Sains</option>
                <option value="self-help">Pengembangan Diri</option>
                <option value="cookbook">Buku Masak</option>
                <option value="travel">Perjalanan</option>
                <option value="poetry">Puisi</option>
                <option value="graphic-novel">Novel Grafis</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="kondisi" rows="2" placeholder="Kondisi Buku"></textarea>
                    </div>

                    {{-- Input jumlah buku --}}
                    <div class="mb-3">
                        <input type="number" name="jumlah" class="form-control" placeholder="Jumlah Buku" min="1">
                    </div>


                    {{-- Input tanggal donasi --}}
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal Donasi</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                    </div>
                    
                    {{-- Pilih Foto --}}
                    <div class="mb-3">
                        <label for="foto" class="form-label">Pilih Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control bg-light text-dark">
                    </div>

                    <button type="submit" class="btn btn-light w-100">Donasikan Buku</button>
                </form>
            </div>
        </div>

        {{-- Riwayat & Status Pengiriman --}}
        <div class="row">
            {{-- Riwayat Donasi --}}
            <div class="col-6">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h6 class="card-title">Riwayat Donasi</h6>
                        @forelse($donasi as $item)
                            <p class="card-text mb-1">
                                <strong>{{ $item->judul_buku }}</strong><br>
                                <span class="text-white-50">{{ ucfirst($item->status) }}</span>
                            </p>
                        @empty
                            <p class="card-text">Belum ada donasi</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Status Pengiriman --}}
            <div class="col-6">
                <div class="card text-white bg-secondary mb-2" style="font-size: 0.85rem;">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-2" style="font-size: 0.9rem;">Status Pengiriman</h6>
                        <p class="card-text mb-1">Menunggu: <strong>{{ $statusCount['menunggu'] ?? 0 }}</strong></p>
                        <p class="card-text">Diterima: <strong>{{ $statusCount['diterima'] ?? 0 }}</strong></p>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
        <div class="success-message" id="successMessage">
            <img src="{{ asset('checkmark.png') }}" alt="Checkmark">
            <h2>Donasi Berhasil</h2>
            <p>Terima kasih telah mendonasikan buku!</p>
            <button onclick="addAnotherDonation()">Tambah Donasi Lagi</button>
        </div>

            <!-- Profil -->
        <div id="profileSection" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Profil Donatur</h5>
                </div>
                <div class="card-body text-center">
                    <div class="profile-pic-wrapper mb-3" onclick="document.getElementById('uploadFotoProfil').click()">
                        <img id="fotoProfilPreview" src="{{ asset('profile-placeholder.jpg') }}" class="rounded-circle" style="width: 100px; height: 100px; border: 2px solid #007bff;">
                        <i class="fas fa-camera position-absolute bottom-0 end-0 bg-white text-primary rounded-circle p-2"></i>
                        <input type="file" id="uploadFotoProfil" accept="image/*" style="display:none;" onchange="previewFotoProfil(event)" />
                    </div>
                    <h5>{{ Auth::user()->name }}</h5>
                    
                    <div class="profile-menu mt-4">
                        <div class="list-group">
                            <button class="list-group-item list-group-item-action" onclick="showSettings()">
                                <i class="fas fa-cog me-2"></i> Pengaturan
                            </button>
                            <button class="list-group-item list-group-item-action" onclick="showHelp()">
                                <i class="fas fa-question-circle me-2"></i> Bantuan
                            </button>
                            <button class="list-group-item list-group-item-action" onclick="showTerms()">
                                <i class="fas fa-file-alt me-2"></i> Syarat & Ketentuan
                            </button>
                            <form method="POST" action="{{ route('logout') }}" class="list-group-item list-group-item-action">
                                @csrf
                                <button type="submit" class="btn btn-link text-decoration-none p-0">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifikasi -->
        <div id="notificationSection" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Notifikasi</h5>
                </div>
                <div class="card-body">
                    <div id="notifContainer"></div>
                </div>
            </div>
        </div>

        <!-- Pengaturan Akun -->
        <div id="settingsSection" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title"><i class="fas fa-cog me-2"></i> Pengaturan Akun</h5>
                </div>
                <div class="card-body">
                    <div class="list-group mb-3">
                        <button class="list-group-item list-group-item-action" onclick="showEditAccount()">
                            Edit Akun <i class="fas fa-chevron-right float-end"></i>
                        </button>
                        <button class="list-group-item list-group-item-action" onclick="showChangeEmail()">
                            Ubah Email <i class="fas fa-chevron-right float-end"></i>
                        </button>
                        <button class="list-group-item list-group-item-action" onclick="showChangePassword()">
                            Ganti Kata Sandi <i class="fas fa-chevron-right float-end"></i>
                        </button>
                        <button class="list-group-item list-group-item-action" onclick="showPrivacy()">
                            Privasi & Keamanan <i class="fas fa-chevron-right float-end"></i>
                        </button>
                    </div>
                     <div class="d-flex justify-content-between align-items-center mb-4">
                        <span>Kirim notifikasi via email</span>
                        <label class="switch">
                            <input type="checkbox" id="emailNotifCheckbox" onchange="saveNotifPreference()">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    
                    <button onclick="showDeleteAccountConfirm()" class="btn btn-danger w-100 mb-3">
                        <i class="fas fa-trash-alt me-2"></i> Hapus Akun
                    </button>
                    
                    <button onclick="showProfile()" class="btn btn-outline-primary w-100">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </button>
                </div>
            </div>
        </div>

         <!-- Bantuan -->
        <div id="helpSection" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title"><i class="fas fa-question-circle me-2"></i> Bantuan</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3 p-3 bg-light rounded">
                        <strong>Cara mengubah foto profil?</strong>
                        <p class="mb-0">Anda dapat mengubah foto profil pada halaman utama profil.</p>
                    </div>
                    <div class="mb-3 p-3 bg-light rounded">
                        <strong>Tidak dapat mengakses akun</strong>
                        <p class="mb-0">Coba atur ulang kata sandi atau hubungi kami untuk bantuan.</p>
                    </div>
                    <div class="mb-3 p-3 bg-light rounded">
                        <strong>Ketentuan pengguna</strong>
                        <p class="mb-0">Baca syarat & ketentuan untuk informasi mengenai aturan.</p>
                    </div>
                    <div class="mb-3 p-3 bg-light rounded">
                        <strong>Butuh bantuan lainnya?</strong>
                        <p class="mb-0">Hubungi kami di: <a href="mailto:donasibuku.app@gmail.com">donasibuku.app@gmail.com</a></p>
                    </div>
                    <button onclick="showProfile()" class="btn btn-outline-primary w-100 mt-3">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </button>
                </div>
            </div>
        </div>

         <!-- Syarat & Ketentuan -->
        <div id="termsSection" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Syarat & Ketentuan Donatur</h5>
                </div>
                <div class="card-body">
                    <ol class="mb-4">
                        <li>Data yang Anda isi harus benar dan lengkap.</li>
                        <li>Data Anda aman dan tidak akan dibagikan tanpa izin.</li>
                        <li>Donasi yang diberikan tidak bisa diminta kembali.</li>
                        <li>Donasi akan digunakan sesuai tujuan program.</li>
                        <li>Dengan mendaftar, Anda setuju pada ketentuan ini.</li>
                    </ol>
                    <button onclick="showProfile()" class="btn btn-outline-primary w-100">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </button>
                </div>
            </div>
        </div>

         <!-- Halaman Edit Akun -->
        <div id="editAccountSection" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Edit Akun</h5>
                </div>
                <div class="card-body text-center">
                    <div class="profile-pic-wrapper mb-3" onclick="document.getElementById('uploadFotoProfilEdit').click()">
                        <img id="fotoProfilEditPreview" src="{{ asset('profile-placeholder.jpg') }}" class="rounded-circle" style="width: 100px; height: 100px; border: 2px solid #007bff;">
                        <i class="fas fa-camera position-absolute bottom-0 end-0 bg-white text-primary rounded-circle p-2"></i>
                        <input type="file" id="uploadFotoProfilEdit" accept="image/*" style="display:none;" onchange="previewFotoProfilEdit(event)" />
                    </div>
                    
                    <div class="mb-3 text-start">
                        <label class="form-label"><i class="fas fa-check-circle text-success me-2"></i> Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Nama Lengkap">
                    </div>
                    
                    <div class="mb-3 text-start">
                        <label class="form-label"><i class="fas fa-check-circle text-success me-2"></i> Alamat</label>
                        <input type="text" class="form-control" placeholder="Alamat">
                    </div>
                    
                    <div class="mb-3 text-start">
                        <label class="form-label"><i class="fas fa-check-circle text-success me-2"></i> No. Telepon</label>
                        <input type="text" class="form-control" placeholder="Nomor Telepon">
                    </div>
                    
                    <button onclick="saveAccountChanges()" class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-save me-2"></i> Simpan
                    </button>
                    
                    <button onclick="showSettings()" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </button>
                </div>
            </div>
        </div>

        <!-- Halaman Ubah Email -->
        <div id="changeEmailSection" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Ubah Email</h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('icons/email-icon.png') }}" alt="Email" style="width: 80px;" class="mb-3">
                    <div class="mb-3 text-start">
                        <label class="form-label">Email Saat ini</label>
                        <input type="email" id="currentEmail" class="form-control" placeholder="Email Saat ini" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label">Email Baru</label>
                        <input type="email" id="newEmail" class="form-control" placeholder="Email Baru" required>
                    </div>
                    <button onclick="submitEmailChange()" class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-envelope me-2"></i> Perbarui Email
                    </button>
                    <button onclick="showSettings()" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </button>
                </div>
            </div>
        </div>

        <!-- Halaman Konfirmasi Email Berhasil -->
        <div id="emailSuccessSection" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title">Email Berhasil Diperbarui</h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('icons/success-icon.png') }}" alt="Success" style="width: 80px;" class="mb-3">
                    <p class="lead">Email Anda telah berhasil diperbarui</p>
                    <button onclick="showSettings()" class="btn btn-outline-success w-100">
                        <i class="fas fa-check me-2"></i> OK
                    </button>
                </div>
            </div>
        </div>

        <!-- Halaman Ganti Kata Sandi -->
        <div id="changePasswordSection" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Ganti Kata Sandi</h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('icons/password-icon.png') }}" alt="Password" style="width: 80px;" class="mb-3">
                    <div class="mb-3 text-start">
                        <label class="form-label">Kata sandi saat ini</label>
                        <input type="password" id="currentPassword" class="form-control" placeholder="Kata sandi saat ini" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label">Kata sandi baru</label>
                        <input type="password" id="newPassword" class="form-control" placeholder="Kata sandi baru" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label">Konfirmasi kata sandi</label>
                        <input type="password" id="confirmPassword" class="form-control" placeholder="Konfirmasi kata sandi" required>
                    </div>
                    <button onclick="submitPasswordChange()" class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-key me-2"></i> Simpan
                    </button>
                    <button onclick="showSettings()" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </button>
                </div>
            </div>
        </div>

        <!-- Halaman Konfirmasi Kata Sandi Berhasil -->
        <div id="passwordSuccessSection" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title">Kata Sandi Berhasil Diubah</h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('icons/success-icon.png') }}" alt="Success" style="width: 80px;" class="mb-3">
                    <p class="lead">Kata sandi Anda telah berhasil diperbarui.</p>
                    <button onclick="showSettings()" class="btn btn-outline-success w-100">
                        <i class="fas fa-check me-2"></i> Kembali ke Pengaturan
                    </button>
                </div>
            </div>
        </div>

        <!-- Halaman Privasi & Keamanan -->
        <div id="privacySection" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title"><i class="fas fa-shield-alt me-2"></i> Privasi & Keamanan</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded">
                        <div>
                            <h6 class="mb-0">Autentikasi Dua Faktor</h6>
                            <small class="text-muted">Tambahkan lapisan keamanan tambahan pada akun Anda.</small>
                        </div>
                        <label class="switch">
                            <input type="checkbox" id="twoFactorToggle" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <button onclick="showSettings()" class="btn btn-outline-primary w-100 mt-3">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </button>
                </div>
            </div>
        </div>

        <!-- Halaman Konfirmasi Hapus Akun -->
        <div id="deleteAccountConfirm" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title">Konfirmasi Penghapusan Akun</h5>
                </div>
                <div class="card-body">
                    <p class="fw-bold">Apakah Anda yakin ingin menghapus akun Anda?</p>
                    <p class="small">Tindakan ini tidak dapat dibatalkan. Semua data Anda akan hilang secara permanen.</p>
                    
                    <div class="alert alert-danger mt-3">
                        <strong>PERINGATAN:</strong>
                        <ul class="mt-2">
                            <li>Akun tidak dapat dipulihkan setelah dihapus</li>
                            <li>Semua histori, preferensi, dan data Anda akan dihapus</li>
                        </ul>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <button onclick="showSettings()" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i> Batalkan
                        </button>
                        <button onclick="confirmDeleteAccount()" class="btn btn-danger">
                            <i class="fas fa-trash-alt me-2"></i> Ya, Hapus Akun
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Halaman Akun Berhasil Dihapus -->
        <div id="deleteSuccess" class="mt-4" style="display: none;">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title">Akun Berhasil Dihapus</h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('icons/success-icon.png') }}" alt="Success" style="width: 80px;" class="mb-3">
                    <p class="lead">Akun Anda telah dihapus secara permanen.</p>
                    <p>Terima kasih telah menggunakan layanan kami.</p>
                    <a href="/" class="btn btn-outline-success">
                        <i class="fas fa-home me-2"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

        <!-- Navigasi Bawah -->
        <nav class="navbar fixed-bottom navbar-light bg-light border-top">
            <div class="container d-flex justify-content-around">
                <a href="#" class="text-primary" onclick="showDashboard()"><i class="fas fa-home fa-lg"></i></a>
                <a href="#" onclick="showNotifications()"><i class="fas fa-bell fa-lg text-secondary"></i></a>
                <a href="#" onclick="showProfile()"><i class="fas fa-user fa-lg text-secondary"></i></a>
            </div>
        </nav>
    </div>

    <script>
        let donations = [];

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize dashboard view
            showDashboard();
            
            // Load notification preference
            const checkbox = document.getElementById('emailNotifCheckbox');
            const saved = localStorage.getItem('notifEmail');
            if (saved !== null) {
                checkbox.checked = saved === 'true';
            }
        });

        function addNotification(title, time) {
            const notifContainer = document.getElementById('notifContainer');
            const notifCard = document.createElement('div');
            notifCard.className = 'alert alert-info';
            notifCard.innerHTML = `<p class="mb-1">• Buku '${title}' sudah diterima.</p><small class="text-muted">${time}</small>`;
            notifContainer.appendChild(notifCard);
        }

        function updateDonationHistory() {
            const receivedBooks = document.getElementById('receivedBooks');
            const processingBooks = document.getElementById('processingBooks');
            const shippedBooks = document.getElementById('shippedBooks');
            const waitingCount = document.getElementById('waitingCount');
            const receivedCount = document.getElementById('receivedCount');

            receivedBooks.innerHTML = donations.filter(d => d.status === 'Diterima').map(d => d.title).join(', ');
            processingBooks.innerHTML = donations.filter(d => d.status === 'Dalam Proses').map(d => d.title).join(', ');
            shippedBooks.innerHTML = donations.filter(d => d.status === 'Dikirim').map(d => d.title).join(', ');

            waitingCount.innerText = donations.filter(d => d.status === 'Dalam Proses').length;
            receivedCount.innerText = donations.filter(d => d.status === 'Diterima').length;
        }

        function addAnotherDonation() {
            document.getElementById('successMessage').style.display = 'none';
        }

        function showDashboard() {
            hideAllSections();
            document.getElementById('donationForm').style.display = 'block';
            document.querySelector('.donation-history').style.display = 'block';
        }

        function showNotifications() {
            hideAllSections();
            document.getElementById('notificationSection').style.display = 'block';
        }

        function showProfile() {
            hideAllSections();
            document.getElementById('profileSection').style.display = 'block';
        }

        function showSettings() {
            hideAllSections();
            document.getElementById('settingsSection').style.display = 'block';
        }

        function previewFotoProfil(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById('fotoProfilPreview').src = reader.result;
            };
            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }

        function showHelp() {
            hideAllSections();
            document.getElementById('helpSection').style.display = 'block';
        }
        
        function showTerms() {
            hideAllSections();
            document.getElementById('termsSection').style.display = 'block';
        }

        function previewFotoProfilEdit(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById('fotoProfilEditPreview').src = reader.result;
            };
            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }

        function showEditAccount() {
            hideAllSections();
            document.getElementById('editAccountSection').style.display = 'block';
        }

        function saveAccountChanges() {
            alert("Data akun berhasil disimpan!");
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

            // Simulasi pengubahan email berhasil
            hideAllSections();
            document.getElementById('emailSuccessSection').style.display = 'block';
        }

        function hideAllSections() {
            const sections = [
                'donationForm', 'successMessage', 'notificationSection',
                'profileSection', 'settingsSection', 'editAccountSection',
                'helpSection', 'termsSection', 'changeEmailSection', 'emailSuccessSection',
                'changePasswordSection', 'passwordSuccessSection', 'privacySection',
                'deleteAccountConfirm', 'deleteSuccess'
            ];
            sections.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.style.display = 'none';
            });
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

            // Simulasi validasi berhasil
            hideAllSections();
            document.getElementById('passwordSuccessSection').style.display = 'block';
        }

        function showPrivacy() {
            hideAllSections();
            document.getElementById('privacySection').style.display = 'block';
        }

        function saveNotifPreference() {
            const checkbox = document.getElementById('emailNotifCheckbox');
            localStorage.setItem('notifEmail', checkbox.checked);

            if (checkbox.checked) {
                alert("Notifikasi via email diaktifkan.");
            } else {
                alert("Notifikasi via email dimatikan.");
            }

            // Kirim ke backend (AJAX)
            fetch('/api/update-email-notification', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    notif_email: checkbox.checked
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
            // Simulasikan penghapusan akun
            console.log("Akun telah dihapus");
            hideAllSections();
            document.getElementById('deleteSuccess').style.display = 'block';
            localStorage.clear();
        }
    </script>
    
        @endsection