@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4">Dashboard</h1>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Accounts</h5>
                <h2 class="display-4">{{ $totalAccounts ?? 0 }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Active Accounts</h5>
                <h2 class="display-4">{{ $activeAccounts ?? 0 }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <h5 class="card-title">Inactive Accounts</h5>
                <h2 class="display-4">{{ $inactiveAccounts ?? 0 }}</h2>
            </div>
        </div>
    </div>
</div>

<!-- Recent Accounts -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Recent Accounts</h5>
            </div>
            <div class="card-body">
                @if(isset($recentAccounts) && $recentAccounts->count() > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Label</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Last Sync</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentAccounts as $account)
                            <tr>
                                <td>{{ $account->id }}</td>
                                <td>{{ $account->account_label }}</td>
                                <td>{{ $account->username }}</td>
                                <td>
                                    <span class="badge bg-{{ $account->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ $account->status }}
                                    </span>
                                </td>
                                <td>{{ $account->last_sync_at ? $account->last_sync_at->diffForHumans() : 'Never' }}</td>
                                <td>
                                    <a href="{{ route('admin.accounts.index') }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View All
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">No accounts found.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Recent Action Logs -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Recent Action Logs</h5>
            </div>
            <div class="card-body">
                @if(isset($recentLogs) && $recentLogs->count() > 0)
                    <table class="table table-hover">
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
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->instagramAccount->account_label ?? 'N/A' }}</td>
                                <td>{{ $log->target_username }}</td>
                                <td>{{ $log->action_type }}</td>
                                <td>
                                    <span class="badge bg-{{ $log->status === 'success' ? 'success' : ($log->status === 'failed' ? 'danger' : 'warning') }}">
                                        {{ $log->status }}
                                    </span>
                                </td>
                                <td>{{ $log->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">No action logs found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection