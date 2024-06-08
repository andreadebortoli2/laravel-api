@extends('layouts.admin')

@section('content')
    <div class="container py-3">
        <h2>Recived mails</h2>
        @if (session('status'))
            <div class="bg-light my-2 p-3 border border-secondary">{{ session('status') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-success">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($mails as $mail)
                        <tr>
                            <td scope="row">{{ $mail->id }}</td>
                            <td>{{ $mail->name }}</td>
                            <td>{{ $mail->email }}</td>
                            <td scope="col">
                                <a class="btn btn-warning btn-sm m-2" href="{{ route('admin.mails.show', $mail) }}">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger btn-sm m-2" data-bs-toggle="modal"
                                    data-bs-target="#modal{{ $mail->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modal{{ $mail->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitle-{{ $mail->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitle-{{ $mail->id }}">
                                                    DELETING MAIL
                                                </h5>
                                            </div>
                                            <div class="modal-body">You're deleting the mail from <span
                                                    class="text-danger">{{ $mail->name }}</span>, it will not be
                                                possible to bring it back
                                            </div>
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
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td scope="row" colspan="4">No mails yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $mails->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
