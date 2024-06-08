@extends('layouts.admin')

@section('content')
    <div class="container py-3">
        <div class="row row-cols-2">
            <div class="col-10">
                <div class="metadata py-3">
                    <strong>From:</strong> <span>{{ $mail->name }}</span>
                    <br>
                    <strong>Address:</strong> <span>{{ $mail->email }}</span>
                </div>
                <p>{{ $mail->message }}</p>
            </div>
            <div class="col-2 p-4">
                <div class="actions d-flex justify-content-end pb-4">
                    <a class="btn btn-secondary mx-2" href="{{ route('admin.mails.index') }}">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <!-- Modal trigger button -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId-delete">
                        <i class="fa-solid fa-trash"></i>
                    </button>

                    <!-- Modal Body -->
                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                    <div class="modal fade" id="modalId-delete" tabindex="-1" data-bs-backdrop="static"
                        data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId">
                                        DELETING PROJECT
                                    </h5>
                                </div>
                                <div class="modal-body">You're deleting tha mail from <span
                                        class="text-danger">{{ $mail->name }}</span>, it will not be
                                    possible to bring it back</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="fa-solid fa-arrow-left"></i>
                                    </button>
                                    <form action="{{ route('admin.mails.destroy', $mail) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            DELETE
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
