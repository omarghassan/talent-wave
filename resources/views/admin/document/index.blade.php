@extends('layouts.admin')
@section('content')
@if (session('message'))
<div class="alert alert-success text-center" role="alert">
  {{ session('message') }}
</div>
@endif
<div class="container-fluid py-2">
  <div class="row">
    <div class="col-12">
      <div class="d-flex align-items-center justify-content-between mb-4">
        <div id="employeesSearchContainer">
          <form method="GET" action="{{route('document.index')}}" id="employeesDepartmentForm" class="employeesForm">
            <select id="employeesDepartmentFilter" name="filter" onchange="this.form.submit()">
              <option value="" selected>select status</option>
              <option value="approved">Approved</option>
              <option value="rejected">Rejected</option>
              <option value="pending">Pending</option>
            </select>
          </form>
        </div>
      </div>
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
            <h1 class="text-white text-capitalize ps-3">Documents</h1>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Employee</th>
                  <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Title</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">download</th>

                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">status</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">note</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">document type</th>
                  <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($documents as $document)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div>
                        <img src="{{ asset($document->user->profile_picture) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $document->user->name }}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{ $document->title }}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs font-weight-bold mb-0"> @php
                      $ext = pathinfo($document->file_path, PATHINFO_EXTENSION);
                      $icon = match($ext) {
                      'pdf' => 'fa-file-pdf text-danger',
                      'doc', 'docx' => 'fa-file-word text-primary',
                      'jpg', 'png' => 'fa-file-image text-success',
                      default => 'fa-file'
                      };
                      @endphp
                      <a href="{{ route('documents.download', $document->id) }}">Download</a>
                  </td>
                  <td class="align-middle text-center">
                    <span class="badge
                        @if($document->status == 'approved') bg-success
                        @elseif($document->status == 'rejected') bg-danger
                        @elseif($document->status == 'pending') bg-warning
                        @endif ">
                      {{ ucfirst(str_replace('_', ' ', $document->status)) }}
                    </span>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs font-weight-bold mb-0">{{ $document->notes }}</p>
                  </td>
                  <td class="align-middle text-center">
                    <p class="text-xs font-weight-bold mb-0">{{ $document->document_type->name }}</p>
                  </td>
                  <td class="align-middle text-center">
                    <div class="d-flex justify-content-center gap-2">
                      <a href="{{ route('documents.view', $document->id) }}" class="btn btn-sm btn-success">Show</a>
                      <form method="POST" action="{{ route('document.approve',['id'=> $document->id]) }}" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-sm btn-warning">Approve</button>
                      </form>
                      <form method="POST" action="{{ route('document.rejecte',['id' => $document->id]) }}" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                      </form>
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
  <div class="pagination-dark">

  </div>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>




  @endsection