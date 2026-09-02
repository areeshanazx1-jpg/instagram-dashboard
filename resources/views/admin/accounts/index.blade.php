@extends('layouts.admin')

@section('title', 'Accounts Management')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4">Instagram Accounts</h1>
        
        <!-- Add Account Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Add New Account</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.accounts.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" name="account_label" class="form-control" placeholder="Account Label" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="access_token" class="form-control" placeholder="Access Token" required>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Add Account</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                @if($accounts->count() > 0)
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Label</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Last Sync</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($accounts as $account)
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
                                <td>{{ $account->created_at->format('d-M-Y') }}</td>
                                <td>
                                    <!-- Toggle Status -->
                                    <form action="{{ route('admin.accounts.toggle-status', $account) }}" 
                                          method="POST" 
                                          style="display: inline-block;">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-sm btn-{{ $account->status === 'active' ? 'warning' : 'success' }}">
                                            <i class="fas fa-{{ $account->status === 'active' ? 'pause' : 'play' }}"></i>
                                        </button>
                                    </form>
                                    
                                    <!-- Delete -->
                                    <form action="{{ route('admin.accounts.destroy', $account) }}" 
                                          method="POST" 
                                          style="display: inline-block;"
                                          onsubmit="return confirm('Are you sure you want to delete this account?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    {{ $accounts->links() }}
                @else
                    <p class="text-muted">No accounts found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection