@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<!-- AOS Animation Library -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css" rel="stylesheet">

<style>
    .dash-wrapper {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        color: var(--text-dark);
    }

    .dash-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .dash-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.85rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
    }

    .dash-subtitle {
        font-size: 0.92rem;
        color: var(--text-muted);
        margin-top: 0.25rem;
    }

    .btn-connect {
        display: inline-flex;
        align-items: center;
        gap: 0.55rem;
        background: linear-gradient(100deg, #833AB4 0%, #C13584 50%, #F77737 100%);
        background-size: 200% 200%;
        background-position: 0% 50%;
        color: #fff;
        border: none;
        padding: 0.7rem 1.4rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.92rem;
        text-decoration: none;
        box-shadow: 0 6px 18px rgba(193, 53, 132, 0.32);
        transition: box-shadow 0.25s ease, transform 0.2s ease, background-position 0.5s ease;
    }

    .btn-connect:hover {
        color: #fff;
        box-shadow: 0 10px 26px rgba(193, 53, 132, 0.48);
        transform: translateY(-3px) scale(1.02);
        background-position: 100% 50%;
    }

    .btn-connect:active {
        transform: translateY(-1px) scale(0.99);
    }

    /* Stat cards */
    .stat-card {
        position: relative;
        background: #fff;
        border: 1px solid var(--border-soft);
        border-radius: var(--radius-lg);
        padding: 1.6rem;
        box-shadow: var(--shadow-soft);
        transition: box-shadow 0.35s ease, transform 0.35s ease;
        height: 100%;
        overflow: hidden;
    }

    .stat-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.35s ease;
    }

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-card.c-primary::before { background: linear-gradient(90deg, var(--brand-primary), var(--brand-primary-light)); }
    .stat-card.c-success::before { background: linear-gradient(90deg, #059669, #34d399); }
    .stat-card.c-neutral::before { background: linear-gradient(90deg, #64748b, #94a3b8); }

    .stat-card:hover {
        box-shadow: var(--shadow-hover);
        transform: translateY(-6px);
    }

    .stat-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }

    .stat-label {
        font-size: 0.84rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 0.6rem;
    }

    .stat-value {
        font-family: 'Poppins', sans-serif;
        font-size: 2.15rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
        line-height: 1;
        transition: color 0.3s ease;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
        transition: transform 0.35s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.12) rotate(-6deg);
    }

    .stat-icon.blue   { background: linear-gradient(135deg, #eef2ff, #e0e7ff); color: var(--brand-primary); }
    .stat-icon.green  { background: linear-gradient(135deg, #ecfdf5, #d1fae5); color: #059669; }
    .stat-icon.gray   { background: linear-gradient(135deg, #f1f5f9, #e2e8f0); color: #64748b; }

    /* Content cards */
    .content-card {
        background: #fff;
        border: 1px solid var(--border-soft);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-soft);
        overflow: hidden;
        transition: box-shadow 0.35s ease, transform 0.35s ease;
    }

    .content-card:hover {
        box-shadow: var(--shadow-hover);
        transform: translateY(-3px);
    }

    .content-card-header {
        padding: 1.2rem 1.6rem;
        border-bottom: 1px solid var(--border-soft);
        background: linear-gradient(180deg, #fbfbfe 0%, #f8f9fc 100%);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .content-card-header h5 {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        font-size: 1.02rem;
        font-weight: 600;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .content-card-header h5 i {
        color: var(--brand-primary);
        font-size: 0.95rem;
    }

    .dash-table {
        margin: 0;
        width: 100%;
    }

    .dash-table thead th {
        background: #f8f9fc;
        color: var(--text-muted);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        border-bottom: 1px solid var(--border-soft);
        padding: 0.85rem 1.6rem;
        white-space: nowrap;
    }

    .dash-table tbody td {
        padding: 0.95rem 1.6rem;
        font-size: 0.9rem;
        color: var(--text-dark);
        border-bottom: 1px solid #f1f2f6;
        vertical-align: middle;
    }

    .dash-table tbody tr:last-child td {
        border-bottom: none;
    }

    .dash-table tbody tr {
        transition: background-color 0.2s ease, transform 0.2s ease;
    }

    .dash-table tbody tr:hover {
        background: #f8f9fc;
        transform: scale(1.003);
    }

    .id-chip {
        display: inline-block;
        background: #f1f2f8;
        color: var(--text-muted);
        font-weight: 600;
        font-size: 0.78rem;
        padding: 0.2rem 0.55rem;
        border-radius: 6px;
        transition: background-color 0.2s ease;
    }

    .dash-table tbody tr:hover .id-chip {
        background: #e5e7f5;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.3rem 0.75rem;
        border-radius: 999px;
        font-size: 0.76rem;
        font-weight: 600;
        text-transform: capitalize;
        transition: transform 0.2s ease;
    }

    .dash-table tbody tr:hover .status-pill {
        transform: scale(1.05);
    }

    .status-pill::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .status-pill.success { background: #ecfdf5; color: #059669; }
    .status-pill.success::before { background: #059669; }

    .status-pill.danger  { background: #fef2f2; color: #dc2626; }
    .status-pill.danger::before { background: #dc2626; }

    .status-pill.warning { background: #fffbeb; color: #d97706; }
    .status-pill.warning::before { background: #d97706; }

    .status-pill.neutral { background: #f1f5f9; color: #64748b; }
    .status-pill.neutral::before { background: #64748b; }

    .btn-view-all {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: #fff;
        color: var(--brand-primary);
        border: 1px solid #e0e3f5;
        padding: 0.4rem 0.9rem;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .btn-view-all:hover {
        background: var(--brand-primary);
        color: #fff;
        border-color: var(--brand-primary);
        box-shadow: 0 4px 12px rgba(67, 56, 202, 0.25);
        transform: translateY(-2px);
    }

    .empty-state {
        padding: 3rem 1.5rem;
        text-align: center;
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .empty-state i {
        font-size: 1.8rem;
        color: #d1d5db;
        margin-bottom: 0.75rem;
        display: block;
    }

    .section-gap {
        margin-bottom: 2rem;
    }

    /* Action panel hover effects */
    #dispatch-action-btn {
        transition: box-shadow 0.25s ease, transform 0.2s ease, filter 0.2s ease !important;
    }

    #dispatch-action-btn:hover {
        box-shadow: 0 8px 20px rgba(5, 150, 105, 0.35) !important;
        transform: translateY(-2px) !important;
        filter: brightness(1.05);
    }

    .content-card-body .form-control {
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .content-card-body .form-control:hover {
        border-color: var(--brand-primary) !important;
    }

    .content-card-body .form-control:focus {
        border-color: var(--brand-primary) !important;
        box-shadow: 0 0 0 3px rgba(67, 56, 202, 0.12);
    }
</style>

<div class="dash-wrapper">

    <!-- Header + Connect Button -->
    <div class="dash-header" data-aos="fade-down" data-aos-duration="600">
        <div>
            <h1 class="dash-title">Dashboard</h1>
            <div class="dash-subtitle">Overview of your connected Instagram accounts and activity</div>
        </div>
        <a href="{{ route('meta.redirect') }}" class="btn-connect">
           <i class="fab fa-instagram"></i> Connect with Instagram
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="row section-gap g-3">
        <div class="col-md-4" data-aos="fade-up" data-aos-duration="600" data-aos-delay="0">
            <div class="stat-card c-primary">
                <div class="stat-top">
                    <div>
                        <div class="stat-label">Total Accounts</div>
                        <p class="stat-value">{{ $totalAccounts ?? 0 }}</p>
                    </div>
                    <div class="stat-icon blue"><i class="fas fa-layer-group"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
            <div class="stat-card c-success">
                <div class="stat-top">
                    <div>
                        <div class="stat-label">Active Accounts</div>
                        <p class="stat-value">{{ $activeAccounts ?? 0 }}</p>
                    </div>
                    <div class="stat-icon green"><i class="fas fa-check-circle"></i></div>
                </div>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
            <div class="stat-card c-neutral">
                <div class="stat-top">
                    <div>
                        <div class="stat-label">Inactive Accounts</div>
                        <p class="stat-value">{{ $inactiveAccounts ?? 0 }}</p>
                    </div>
                    <div class="stat-icon gray"><i class="fas fa-times-circle"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Accounts -->
    <div class="row section-gap">
        <div class="col-md-12" data-aos="fade-up" data-aos-duration="700">
            <div class="content-card">
                <div class="content-card-header">
                    <h5><i class="fas fa-users"></i> Recent Accounts</h5>
                    <a href="{{ route('admin.accounts.index') }}" class="btn-view-all">
                        <i class="fas fa-eye"></i> View All
                    </a>
                </div>
                <div class="content-card-body">
                    @if(isset($recentAccounts) && $recentAccounts->count() > 0)
                        <div class="table-responsive">
                            <table class="dash-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Label</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>Last Sync</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentAccounts as $account)
                                    <tr>
                                        <td><span class="id-chip">#{{ $account->id }}</span></td>
                                        <td><strong>{{ $account->account_label }}</strong></td>
                                        <td>{{ $account->username }}</td>
                                        <td>
                                            <span class="status-pill {{ $account->status === 'active' ? 'success' : 'neutral' }}">
                                                {{ $account->status }}
                                            </span>
                                        </td>
                                        <td>{{ $account->last_sync_at ? $account->last_sync_at->diffForHumans() : 'Never' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            No accounts found.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Action Panel -->
    <div class="row section-gap">
        <div class="col-md-12" data-aos="fade-up" data-aos-duration="700">
            <div class="content-card">
                <div class="content-card-header">
                    <h5><i class="fas fa-paper-plane"></i> Instagram Action Panel</h5>
                </div>
                <div class="content-card-body" style="padding: 1.6rem;">
                    <form action="{{ route('admin.actions.dispatch') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-4">
                                <input type="text" name="target_username" class="form-control" placeholder="Target Username" required style="border-radius: 8px; border: 1px solid #e2e8f0;">
                            </div>
                            <div class="col-md-4">
                                <select name="action_type" class="form-control" required style="border-radius: 8px; border: 1px solid #e2e8f0;">
                                    <option value="">Select Action</option>
                                    <option value="follow">Follow</option>
                                    <option value="unfollow">Unfollow</option>
                                    <option value="comment">Comment</option>
                                    <option value="like">Like</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" id="dispatch-action-btn" class="btn btn-success" style="border-radius: 8px; padding: 0.6rem 1.8rem; font-weight: 600; background: linear-gradient(135deg, #059669, #34d399); border: none; width: 100%;">
                                    <i class="fas fa-play"></i> Dispatch Action
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Action Logs -->
    <div class="row">
        <div class="col-md-12" data-aos="fade-up" data-aos-duration="700">
            <div class="content-card">
                <div class="content-card-header">
                    <h5><i class="fas fa-list-check"></i> Recent Action Logs</h5>
                </div>
                <div class="content-card-body">
                    @if(isset($recentLogs) && $recentLogs->count() > 0)
                        <div class="table-responsive">
                            <table class="dash-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Account</th>
                                        <th>Target Username</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentLogs as $log)
                                    <tr>
                                        <td><span class="id-chip">#{{ $log->id }}</span></td>
                                        <td><strong>{{ $log->instagramAccount->account_label ?? 'N/A' }}</strong></td>
                                        <td>{{ $log->target_username }}</td>
                                        <td>{{ $log->action_type }}</td>
                                        <td>
                                            @php
                                                $pillClass = match($log->status) {
                                                    'success' => 'success',
                                                    'failed' => 'danger',
                                                    default => 'warning',
                                                };
                                                $statusText = match($log->status) {
                                                    'success' => 'Success: HTTP ' . ($log->response_payload['http_code'] ?? '200'),
                                                    'failed'  => 'Failed: ' . ($log->response_payload['http_code'] ?? 'API Error'),
                                                    default   => 'Pending',
                                                };
                                            @endphp
                                            <span class="status-pill {{ $pillClass }}">
                                                {{ $statusText }}
                                            </span>
                                        </td>
                                        <td>{{ $log->created_at->diffForHumans() }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            No action logs found.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

<!-- AOS Animation Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof AOS !== 'undefined') {
            AOS.init({
                once: true,
                offset: 50,
                easing: 'ease-out-cubic'
            });
        }
    });
</script>

@endsection