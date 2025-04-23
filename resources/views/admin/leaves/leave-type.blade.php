@extends('layouts.admin')
@section('content')
<style>
  .card-header {
    color: white !important;
  }
  .form-control, .form-select {
    border: 1px solid #dee2e6 !important;
  }
  .card {
    border: 1px solid #dee2e6 !important;
  }
  #head{
    color: white;
  }
  #a{
    color: white !important;
  }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            <!-- Add Leave Type Form -->
            <div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <form method="POST" action="{{ route('admin.leave-types.store') }}" class="mb-4">
        @csrf
        <div class="row g-3 align-items-end w-100">
          <div class="col-md-4">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="col-md-3">
            <label class="form-label">Default Balance</label>
            <input type="number" name="default_balance" class="form-control" step="0.01" min="0" required>
          </div>
          <div class="col-md-3">
            <label class="form-label">Description</label>
            <input type="text" name="description" class="form-control">
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-success w-100 m-0">Add</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

            <!-- Leave Types Table -->
            <div class="card my-4">  
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                        <h1 class="text-white text-capitalize ps-3">Leave Types</h1>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Description</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Default Balance</th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaveTypes as $leaveType)
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $leaveType->name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $leaveType->description ?? 'N/A' }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $leaveType->default_balance }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" 
                                                data-bs-target="#editModal{{ $leaveType->id }}">
                                            Edit
                                        </button>
                                        
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal{{ $leaveType->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Leave Type</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST" action="{{ route('admin.leave-types.update', $leaveType) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label class="form-label">Name</label>
                                                                <input type="text" name="name" class="form-control" value="{{ $leaveType->name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Description</label>
                                                                <textarea name="description" class="form-control">{{ $leaveType->description }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Default Balance</label>
                                                                <input type="number" name="default_balance" class="form-control" step="0.01" min="0" 
                                                                       value="{{ $leaveType->default_balance }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-warning">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
</div>
@endsection