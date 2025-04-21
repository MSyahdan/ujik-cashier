@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    .dashboard-container {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        padding: 40px 20px;
        position: relative;
        overflow: hidden;
    }

    .welcome-header {
        text-align: center;
        margin-bottom: 50px;
        color: #333;
        font-weight: 800;
        font-size: 2.8rem;
        position: relative;
        animation: bounceIn 1s ease-in-out;
    }

    .welcome-header::after {
        content: '';
        width: 100px;
        height: 5px;
        background: linear-gradient(to right, #007bff, #ff4d4d);
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 5px;
    }

    .stats-card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        animation: fadeInUp 0.5s ease-in-out;
        animation-fill-mode: backwards;
        border: none;
        overflow: hidden;
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(255, 255, 255, 0.2), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stats-card:hover::before {
        opacity: 1;
    }

    .stats-card:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .stats-card .card-icon {
        font-size: 3rem;
        padding: 25px;
        color: #fff;
        text-align: center;
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 70%);
    }

    .stats-card .card-body {
        padding: 20px;
        text-align: center;
    }

    .stats-card .card-title {
        font-size: 1.3rem;
        color: #444;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .stats-card .card-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #222;
    }

    .card-icon.bg-success { background-color: #28a745; }
    .card-icon.bg-warning { background-color: #ffc107; }
    .card-icon.bg-primary { background-color: #007bff; }
    .card-icon.bg-danger { background-color: #dc3545; }

    @keyframes bounceIn {
        0% { transform: scale(0.5); opacity: 0; }
        60% { transform: scale(1.2); opacity: 1; }
        100% { transform: scale(1); }
    }

    @keyframes fadeInUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    @media (max-width: 768px) {
        .welcome-header {
            font-size: 2rem;
        }

        .stats-card .card-icon {
            font-size: 2rem;
            padding: 15px;
        }

        .stats-card .card-value {
            font-size: 1.8rem;
        }

        .stats-card {
            margin-bottom: 20px;
        }
    }
</style>

<div class="dashboard-container">
    <div class="container">
        <div class="welcome-header">
            Selamat Datang, {{ substr(auth()->user()->name, 0, 15) }}!
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Kartu Produk -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="stats-card" style="animation-delay: 0.1s;">
                    <div class="card-icon bg-success text-white">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="card-body">
                        <div class="card-title">Produk</div>
                        <div class="card-value">{{ $productCount }}</div>
                    </div>
                </div>
            </div>

            <!-- Kartu Penjualan -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="stats-card" style="animation-delay: 0.2s;">
                    <div class="card-icon bg-warning text-white">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-body">
                        <div class="card-title">Penjualan</div>
                        <div class="card-value">{{ $salesCount }}</div>

                        <!-- Deskripsi Member & Non-Member -->
                        <div class="mt-3 text-start small text-muted">
                            <p class="mb-1"><strong>Member:</strong> Penjualan dari pelanggan yang terdaftar sebagai anggota ({{ $memberSalesCount }} transaksi).</p>
                            <p class="mb-0"><strong>Non-Member:</strong> Penjualan dari pelanggan umum tanpa keanggotaan ({{ $nonMemberSalesCount }} transaksi).</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu User (Superadmin saja) -->
            @if (auth()->user()->role == 'superadmin')
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="stats-card" style="animation-delay: 0.3s;">
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card-body">
                        <div class="card-title">User</div>
                        <div class="card-value">{{ $userCount }}</div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Kartu Member -->
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="stats-card" style="animation-delay: 0.4s;">
                    <div class="card-icon bg-danger text-white">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="card-body">
                        <div class="card-title">Member</div>
                        <div class="card-value">{{ $memberCount }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection