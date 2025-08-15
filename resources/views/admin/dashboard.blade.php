@extends('layouts.app')

@section('content')
<div class="admin-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>DONASI BUKU</h2>
            <p>Dashboard Admin</p>
        </div>
        
        <div class="sidebar-nav">
            <div class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link active"><i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.pengajuan') }}" class="nav-link"><i class="fas fa-fw fa-check-circle"></i> Verifikasi</a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.laporan') }}" class="nav-link"><i class="fas fa-fw fa-file-alt"></i> Laporan</a>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Dashboard Admin</h1>
            <div class="user-menu">
                <div class="user-profile">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=4e73df&color=fff" alt="User" class="profile-img">
                    <span>{{ Auth::user()->name }}</span>
                    <i class="fas fa-caret-down"></i>
                </div>
                <div class="user-dropdown">
                    <a href="#" id="profileLink"><i class="fas fa-fw fa-user"></i> Profil</a>
                    <a href="#" onclick="confirmLogout()"><i class="fas fa-fw fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
        
        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <div class="welcome-message">
                <h3>Selamat datang, {{ Auth::user()->name }}!</h3>
                <p>Anda dapat mengelola semua data donasi buku di sini.</p>
            </div>
            
            <!-- Statistics Cards -->
            <div class="stats-cards">
                <div class="stat-card donasi">
                    <div class="stat-title">Total Donasi</div>
                    <div class="stat-value">{{ $totalDonasi }}</div>
                    <div class="stat-icon"><i class="fas fa-book"></i></div>
                </div>
                
                <div class="stat-card pengajuan">
                    <div class="stat-title">Total Pengajuan</div>
                    <div class="stat-value">{{ $totalPengajuan }}</div>
                    <div class="stat-icon"><i class="fas fa-file-alt"></i></div>
                </div>
                
                <div class="stat-card buku">
                    <div class="stat-title">Total Buku</div>
                    <div class="stat-value">{{ $totalBuku }}</div>
                    <div class="stat-icon"><i class="fas fa-book-open"></i></div>
                </div>
                
                <div class="stat-card user">
                    <div class="stat-title">Total User</div>
                    <div class="stat-value">{{ $totalUser }}</div>
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                </div>
            </div>
            
            <!-- Charts -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Statistik Donasi dan Pengajuan</h3>
                </div>
                <div class="chart-container">
                    <canvas id="laporanChart"></canvas>
                </div>
            </div>
            
            <!-- Recent Activities -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pengajuan Terbaru</h3>
                    <a href="{{ route('admin.pengajuan') }}" class="btn btn-primary">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Buku</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentPengajuan as $item)
                            <tr>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->buku->judul }}</td>
                                <td>
                                    <span class="badge {{ $item->status == 'menunggu' ? 'badge-warning' : 'badge-success' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td>
                                    @if($item->status == 'menunggu')
                                    <form method="POST" action="{{ route('admin.verifikasi', $item->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Verifikasi</button>
                                    </form>
                                    @else
                                    <span class="text-success">Terverifikasi</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

<style>
    :root {
        --primary-color: #4e73df;
        --secondary-color: #f8f9fc;
        --success-color: #1cc88a;
        --info-color: #36b9cc;
        --warning-color: #f6c23e;
        --danger-color: #e74a3b;
        --dark-color: #5a5c69;
    }
    
    .admin-container {
        display: grid;
        grid-template-columns: 250px 1fr;
        min-height: 100vh;
        font-family: 'Nunito', 'Segoe UI', sans-serif;
        background-color: #f8f9fc;
    }
    
    .sidebar {
        background-color: var(--primary-color);
        color: white;
        padding: 20px 0;
        position: fixed;
        height: 100%;
        width: 250px;
    }
    
    .sidebar-header {
        padding: 0 20px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.2);
    }
    
    .sidebar-nav {
        padding: 20px;
    }
    
    .nav-item {
        margin-bottom: 5px;
    }
    
    .nav-item a {
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        display: block;
        padding: 10px 15px;
        border-radius: 5px;
        transition: all 0.3s;
    }
    
    .nav-item a:hover, .nav-item a.active {
        background-color: rgba(255,255,255,0.1);
        color: white;
    }
    
    .nav-item i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }
    
    .main-content {
        margin-left: 250px;
        padding: 20px;
        width: calc(100% - 250px);
    }
    
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e3e6f0;
    }
    
    .user-menu {
        position: relative;
    }
    
    .user-profile {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        padding: 5px 10px;
        border-radius: 5px;
        transition: all 0.3s;
    }
    
    .user-profile:hover {
        background-color: #f0f0f0;
    }
    
    .profile-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
    
    .user-dropdown {
        display: none;
        position: absolute;
        right: 0;
        background-color: white;
        min-width: 200px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        border-radius: 5px;
        z-index: 100;
        padding: 10px 0;
    }
    
    .user-menu:hover .user-dropdown {
        display: block;
    }
    
    .user-dropdown a {
        display: block;
        padding: 8px 20px;
        color: #333;
        text-decoration: none;
    }
    
    .user-dropdown a:hover {
        background-color: #f8f9fc;
    }
    
    .welcome-message {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
    }
    
    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        padding: 20px;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 5px;
        height: 100%;
    }
    
    .stat-card.donasi::before {
        background-color: var(--primary-color);
    }
    
    .stat-card.pengajuan::before {
        background-color: var(--info-color);
    }
    
    .stat-card.buku::before {
        background-color: var(--success-color);
    }
    
    .stat-card.user::before {
        background-color: var(--warning-color);
    }
    
    .stat-title {
        font-size: 14px;
        color: var(--dark-color);
        text-transform: uppercase;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .stat-value {
        font-size: 24px;
        font-weight: 700;
        margin: 5px 0;
    }
    
    .stat-icon {
        position: absolute;
        right: 20px;
        top: 20px;
        font-size: 40px;
        opacity: 0.2;
    }
    
    .card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        margin-bottom: 20px;
        padding: 20px;
    }
    
    .card-header {
        border-bottom: 1px solid #e3e6f0;
        padding-bottom: 10px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .card-title {
        font-weight: 600;
        margin: 0;
        color: var(--dark-color);
    }
    
    .btn {
        display: inline-block;
        padding: 8px 15px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
        border: none;
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #2e59d9;
    }
    
    .btn-success {
        background-color: var(--success-color);
        color: white;
    }
    
    .btn-success:hover {
        background-color: #17a673;
    }
    
    .btn-danger {
        background-color: var(--danger-color);
        color: white;
    }
    
    .btn-danger:hover {
        background-color: #d62c1a;
    }
    
    .btn-secondary {
        background-color: #858796;
        color: white;
    }
    
    .btn-secondary:hover {
        background-color: #717384;
    }
    
    .btn-sm {
        padding: 5px 10px;
        font-size: 12px;
    }
    
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .table th, .table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #e3e6f0;
    }
    
    .table th {
        background-color: #f8f9fc;
        font-weight: 600;
        color: var(--dark-color);
    }
    
    .table tr:hover {
        background-color: #f8f9fc;
    }
    
    .badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .badge-success {
        background-color: #d1f3e8;
        color: var(--success-color);
    }
    
    .badge-warning {
        background-color: #fef5e0;
        color: var(--warning-color);
    }
    
    .badge-danger {
        background-color: #fbe9e7;
        color: var(--danger-color);
    }
    
    .badge-primary {
        background-color: #e0e6ff;
        color: var(--primary-color);
    }
    
    .chart-container {
        position: relative;
        height: 300px;
        margin-bottom: 20px;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1050;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        outline: 0;
        background-color: rgba(0,0,0,0.5);
    }
    
    .modal-dialog {
        position: relative;
        width: auto;
        margin: 0.5rem;
        pointer-events: none;
    }
    
    .modal-content {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
        pointer-events: auto;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0,0,0,.2);
        border-radius: 0.3rem;
        outline: 0;
    }
    
    .modal-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        padding: 1rem;
        border-bottom: 1px solid #dee2e6;
        border-top-left-radius: 0.3rem;
        border-top-right-radius: 0.3rem;
    }
    
    .modal-title {
        margin-bottom: 0;
        line-height: 1.5;
    }
    
    .modal-body {
        position: relative;
        flex: 1 1 auto;
        padding: 1rem;
    }
    
    .modal-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 1rem;
        border-top: 1px solid #dee2e6;
        border-bottom-right-radius: 0.3rem;
        border-bottom-left-radius: 0.3rem;
    }
    
    .close {
        float: right;
        font-size: 1.5rem;
        font-weight: 700;
        line-height: 1;
        color: #000;
        text-shadow: 0 1px 0 #fff;
        opacity: .5;
        background: transparent;
        border: 0;
    }
    
    .close:hover {
        opacity: .75;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize chart
        const ctx = document.getElementById('laporanChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($laporanGabung->pluck('bulan')),
                datasets: [
                    {
                        label: 'Total Donasi',
                        data: @json($laporanGabung->pluck('total_donasi')),
                        backgroundColor: 'rgba(78, 115, 223, 0.6)',
                    },
                    {
                        label: 'Total Pengajuan',
                        data: @json($laporanGabung->pluck('total_pengajuan')),
                        backgroundColor: 'rgba(28, 200, 138, 0.6)',
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
        
        // User dropdown toggle
        const userProfile = document.querySelector('.user-profile');
        const userDropdown = document.querySelector('.user-dropdown');
        
        userProfile.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown.style.display = userDropdown.style.display === 'block' ? 'none' : 'block';
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            userDropdown.style.display = 'none';
        });
    });
    
    function confirmLogout() {
        // Show modal
        const modal = document.createElement('div');
        modal.className = 'modal';
        modal.style.display = 'block';
        modal.innerHTML = `
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Logout</h5>
                        <button type="button" class="close" onclick="this.closest('.modal').style.display='none'">&times;</button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin logout?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="this.closest('.modal').style.display='none'">Batal</button>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
        
        // Close modal when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });
    }
</script>
@endsection