@extends('layouts.public')
@section('content')

<!-- <style>
  /* White, Black and Orange Theme for document Management */
  :root {
    --black: #212121;
    --white: #ffffff;
    --orange: #FF5722;
    --light-gray: #f5f5f5;
    --dark-gray: #424242;
  }

  /* Button styling */
  .btn-success {
    background-color: #424242 !important;
    border-color: var(--orange) !important;
    color: var(--white) !important;
    transition: all 0.3s ease;
  }

  .btn-success:hover {
    background-color: #E64A19 !important;
    border-color: #E64A19 !important;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  }

  .btn-warning {
    background-color: var(--dark-gray) !important;
    border-color: var(--dark-gray) !important;
    color: var(--white) !important;
  }

  .btn-warning:hover {
    background-color: #313131 !important;
    border-color: #313131 !important;
  }

  /* Card styling */
  .card {
    background-color: var(--white);
    border: 0;
    border-radius: 8px !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  }

  .bg-gradient-dark {
    background: linear-gradient(45deg, var(--black), #424242) !important;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  }

  /* Table styling */
  .table {
    color: var(--black);
  }

  .table th {
    color: #6c757d;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    border-bottom: 1px solid #dee2e6;
  }

  .table td {
    padding: 12px;
    vertical-align: middle;
    border-bottom: 1px solid #dee2e6;
  }

  .table tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.03);
  }

  /* Status color styling - using custom classes for clarity */
  .status-pending {
    color: var(--orange) !important;
    font-weight: 500;
  }

  .status-approved {
    color: #4CAF50 !important;
    font-weight: 500;
  }

  .status-rejected {
    color: #F44336 !important;
    font-weight: 500;
  }
</style> -->

<div class="container-fluid py-2">
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h1 style="
        color: white;
        text-transform: capitalize;
        padding-left: 20px;
        font-weight: bold;
        font-size: 32px;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.4);
        ">
              Documents
            </h1>
          </div>

        </div>
        <div class="card-body px-3 pb-2">
          <a href="{{ route('docs.create') }}" class="btn btn-success">Upload Document</a>
          <div class="table-responsive p-0">
            <table class="table text-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Document Type</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Title</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Expiry Date</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Additional Info</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($documents as $document)
                <tr>
                  <td>{{ $document->document_type->name }}</td>
                  <td>{{ $document->title }}</td>
                  <td>{{ $document->expiry_date ? $document->expiry_date->format('d/m/Y') : 'No Expiry Date' }}</td>
                  <td>{{ $document->notes ? $document->notes : 'No Additional Info Entered' }}</td>
                  <td class="text-center">
                    @if($document->status == 'approved')
                    <span class="badge bg-gradient-success">Approved</span>
                    @elseif($document->status == 'pending')
                    <span class="badge bg-gradient-warning">Pending</span>
                    @elseif($document->status == 'rejected')
                    <span class="badge bg-gradient-danger">Rejected</span>
                    @else
                    <span class="badge bg-gradient-secondary">{{ ucfirst($document->status) }}</span>
                    @endif
                  </td>
                  <td>
                    <div class="btn-group" role="group">
                      <a href="{{ route('docs.show', $document->id) }}" class="btn btn-success btn-sm">View</a>
                      @if($document->status == 'pending')
                      <a href="{{ route('docs.edit', $document->id) }}" class="btn btn-warning btn-sm">Edit</a>
                      @endif
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