@extends('layouts.admin')

@section('title', 'Accounts Management')

@section('content')

<!-- AOS Animation Library -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css" rel="stylesheet">

<style>
    .acc-wrapper {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        color: var(--text-dark);
    }

    .acc-header {
        margin-bottom: 2rem;
    }

    .acc-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.85rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0;
    }

    .acc-subtitle {
        font-size: 0.92rem;
        color: var(--text-muted);
        margin-top: 0.25rem;
    }

    /* Add account card */
    .add-account-card {
        background: #fff;
        border: 1px solid var(--border-soft);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-soft);
        overflow: hidden;
        margin-bottom: 1.75rem;
        transition: box-shadow 0.35s ease, transform 0.35s ease;
    }

    .add-account-card:hover {
        box-shadow: var(--shadow-hover);
        transform: translateY(-3px);
    }

    .add-account-header {
        padding: 1.2rem 1.6rem;
        border-bottom: 1px solid var(--border-soft);
        background: linear-gradient(180deg, #fbfbfe 0%, #f8f9fc 100%);
    }

    .add-account-header h5 {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        font-size: 1.02rem;
        font-weight: 600;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .add-account-header h5 i {
        color: var(--brand-primary);
        font-size: 0.95rem;
    }

    .add-account-body {
        padding: 1.6rem;
    }

    .form-label-sm {
        font-size: 0.78rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 0.4rem;
        display: block;
    }

    .acc-form .form-control {
        border: 1px solid var(--border-soft);
        border-radius: var(--radius-md);
        padding: 0.6rem 0.85rem;
        font-size: 0.9rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .acc-form .form-control:hover {
        border-color: var(--brand-primary-light);
    }

    .acc-form .form-control:focus {
        border-color: var(--brand-primary-light);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.14);
    }

    .acc-form .form-control::placeholder {
        color: #b3b8c5;
    }

    .btn-primary-add {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        background: linear-gradient(100deg, var(--brand-primary), var(--brand-primary-light));
        background-size: 200% 200%;
        background-position: 0% 50%;
        border: none;
        color: #fff;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 0.6rem 1rem;
        border-radius: var(--radius-md);
        box-shadow: 0 4px 12px rgba(67, 56, 202, 0.28);
        transition: box-shadow 0.25s ease, transform 0.2s ease, background-position 0.5s ease;
    }

    .btn-primary-add:hover {
        color: #fff;
        box-shadow: 0 8px 20px rgba(67, 56, 202, 0.4);
        transform: translateY(-2px);
        background-position: 100% 50%;
    }

    .btn-primary-add:active {
        transform: translateY(0);
    }

    /* Content card / table */
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

    .account-count {
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--text-muted);
        background: #f1f2f8;
        padding: 0.3rem 0.75rem;
        border-radius: 999px;
        transition: background-color 0.2s ease;
    }

    .acc-table {
        margin: 0;
        width: 100%;
    }

    .acc-table thead th {
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

    .acc-table tbody td {
        padding: 0.95rem 1.6rem;
        font-size: 0.9rem;
        color: var(--text-dark);
        border-bottom: 1px solid #f1f2f6;
        vertical-align: middle;
    }

    .acc-table tbody tr:last-child td {
        border-bottom: none;
    }

    .acc-table tbody tr {
        transition: background-color 0.2s ease, transform 0.2s ease;
    }

    .acc-table tbody tr:hover {
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

    .acc-table tbody tr:hover .id-chip {
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

    .acc-table tbody tr:hover .status-pill {
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

    .status-pill.neutral { background: #f1f5f9; color: #64748b; }
    .status-pill.neutral::before { background: #64748b; }

    .action-btns {
        display: flex;
        gap: 0.4rem;
    }

    .btn-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 8px;
        border: 1px solid transparent;
        font-size: 0.85rem;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .btn-icon:hover {
        transform: translateY(-2px) scale(1.06);
    }

    .btn-icon:active {
        transform: translateY(0) scale(0.97);
    }

    .btn-icon.pause {
        background: #fffbeb;
        color: #b45309;
        border-color: #fde9c2;
    }

    .btn-icon.pause:hover {
        background: #fef3c7;
        box-shadow: 0 4px 10px rgba(180, 83, 9, 0.18);
    }

    .btn-icon.play {
        background: #ecfdf5;
        color: #059669;
        border-color: #c9f2df;
    }

    .btn-icon.play:hover {
        background: #d1fae5;
        box-shadow: 0 4px 10px rgba(5, 150, 105, 0.18);
    }

    .btn-icon.delete {
        background: #fef2f2;
        color: #dc2626;
        border-color: #fbd7d7;
    }

    .btn-icon.delete:hover {
        background: #fee2e2;
        box-shadow: 0 4px 10px rgba(220, 38, 38, 0.18);
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

    .pagination-wrap {
        padding: 1.2rem 1.6rem;
        border-top: 1px solid var(--border-soft);
    }
</style>

<div class="acc-wrapper">

    <div class="acc-header" data-aos="fade-down" data-aos-duration="600">
        <h1 class="acc-title">Instagram Accounts</h1>
        <div class="acc-subtitle">Manage connected accounts, tokens, and their sync status</div>
    </div>

    <!-- Add Account Form -->
    <div class="add-account-card" data-aos="fade-up" data-aos-duration="600">
        <div class="add-account-header">
            <h5><i class="fas fa-user-plus"></i> Add New Account</h5>
        </div>
        <div class="add-account-body">
            <form action="{{ route('admin.accounts.store') }}" method="POST" class="acc-form">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label-sm">Account Label</label>
                        <input type="text" name="account_label" class="form-control" placeholder="e.g. Marketing Page" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-sm">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="e.g. brand_page" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-sm">Access Token</label>
                        <input type="text" name="access_token" class="form-control" placeholder="Paste access token" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn-primary-add">
                            <i class="fas fa-plus"></i> Add
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Accounts Table -->
    <div class="content-card" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
        <div class="content-card-header">
            <h5><i class="fas fa-users"></i> All Accounts</h5>
            @if($accounts->count() > 0)
                <span class="account-count">{{ $accounts->total() ?? $accounts->count() }} total</span>
            @endif
        </div>
        <div class="content-card-body">
            @if($accounts->count() > 0)
                <div class="table-responsive">
                    <table class="acc-table">
                        <thead>
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
                                <td><span class="id-chip">#{{ $account->id }}</span></td>
                                <td><strong>{{ $account->account_label }}</strong></td>
                                <td>{{ $account->username }}</td>
                                <td>
                                    <span class="status-pill {{ $account->status === 'active' ? 'success' : 'neutral' }}">
                                        {{ $account->status }}
                                    </span>
                                </td>
                                <td>{{ $account->last_sync_at ? $account->last_sync_at->diffForHumans() : 'Never' }}</td>
                                <td>{{ $account->created_at->format('d-M-Y') }}</td>
                                <td>
                                    <div class="action-btns">
                                        <!-- Toggle Status -->
                                        <form action="{{ route('admin.accounts.toggle-status', $account) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                    class="btn-icon {{ $account->status === 'active' ? 'pause' : 'play' }}"
                                                    title="{{ $account->status === 'active' ? 'Pause account' : 'Activate account' }}">
                                                <i class="fas fa-{{ $account->status === 'active' ? 'pause' : 'play' }}"></i>
                                            </button>
                                        </form>

                                        <!-- Delete (opens confirmation modal) -->
                                        <button type="button"
                                                class="btn-icon delete"
                                                title="Delete account"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteAccountModal"
                                                data-delete-url="{{ route('admin.accounts.destroy', $account) }}"
                                                data-account-label="{{ $account->account_label }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination-wrap">
                    {{ $accounts->links() }}
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content delete-modal-content">
            <div class="modal-body text-center pt-4 pb-3 px-4">
                <div class="delete-modal-icon">
                    <i class="fas fa-triangle-exclamation"></i>
                </div>
                <h5 class="delete-modal-title">Delete this account?</h5>
                <p class="delete-modal-text">
                    You're about to remove <strong id="deleteAccountLabel">this account</strong>.
                    This action can't be undone.
                </p>
            </div>
            <div class="modal-footer delete-modal-footer">
                <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteAccountForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-modal-delete">
                        <i class="fas fa-trash me-1"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .delete-modal-content {
        border: none;
        border-radius: var(--radius-lg);
        box-shadow: 0 20px 45px rgba(30, 27, 58, 0.18);
        overflow: hidden;
    }

    .delete-modal-icon {
        width: 58px;
        height: 58px;
        margin: 0 auto 1rem;
        border-radius: 50%;
        background: #fef2f2;
        color: #dc2626;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
    }

    .delete-modal-title {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 1.15rem;
        color: var(--text-dark);
        margin-bottom: 0.6rem;
    }

    .delete-modal-text {
        font-size: 0.9rem;
        color: var(--text-muted);
        margin: 0;
    }

    .delete-modal-footer {
        border-top: 1px solid var(--border-soft);
        padding: 1rem 1.4rem;
        justify-content: center;
        gap: 0.6rem;
    }

    .btn-modal-cancel {
        background: #f1f2f8;
        color: var(--text-muted);
        border: none;
        font-weight: 600;
        font-size: 0.88rem;
        padding: 0.55rem 1.3rem;
        border-radius: var(--radius-md);
        transition: background-color 0.2s ease, transform 0.15s ease;
    }

    .btn-modal-cancel:hover {
        background: #e5e7f2;
        transform: translateY(-1px);
    }

    .btn-modal-delete {
        background: linear-gradient(100deg, #dc2626, #ef4444);
        color: #fff;
        border: none;
        font-weight: 600;
        font-size: 0.88rem;
        padding: 0.55rem 1.4rem;
        border-radius: var(--radius-md);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.28);
        transition: box-shadow 0.2s ease, transform 0.15s ease;
    }

    .btn-modal-delete:hover {
        color: #fff;
        box-shadow: 0 6px 16px rgba(220, 38, 38, 0.38);
        transform: translateY(-1px);
    }
</style>

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

        const deleteModal = document.getElementById('deleteAccountModal');
        const deleteForm = document.getElementById('deleteAccountForm');
        const deleteLabel = document.getElementById('deleteAccountLabel');

        deleteModal.addEventListener('show.bs.modal', function (event) {
            const trigger = event.relatedTarget;
            const url = trigger.getAttribute('data-delete-url');
            const label = trigger.getAttribute('data-account-label');

            deleteForm.setAttribute('action', url);
            deleteLabel.textContent = label ? `"${label}"` : 'this account';
        });
    });
</script>

@endsection