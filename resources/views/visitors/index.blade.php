@extends('layouts.app')

@section('content')

<div class="container">
    <h3 class="text-center m-5">Besucherkarten Überblick</h3>

    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (Auth::check() && Auth::user()->is_admin)
    <div class="card shadow p-3">
        <div class="row mb-4">
            <div class="d-flex justify-content-end">
                <a href="{{ route('visitors.create') }}" class="btn btn-outline-success btn-sm" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus" viewBox="0 0 16 16">
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                    </svg>
                    Anlegen
                </a>
            </div>
        </div>
        @endauth

        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Bild</th>
                    <th scope="col">Vorname</th>
                    <th scope="col">Nachname</th>
                    <th scope="col">Beruf</th>
                    <th scope="col">eMail</th>
                    <th scope="col">Telefonnr.</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <tbody class="table-group-divider">

                @foreach ($visitors as $visitor )
                <tr>
                    <th scope="row">{{ $loop->index}}</th>
                    <td>
                        <img src="{{ asset('images/' .$visitor->image) }}" class="img-thumbnail" width="100"
                            alt="Bild" />
                    </td>
                    <td>{{ $visitor->first_name }}</td>
                    <td>{{ $visitor->last_name }}</td>
                    <td>{{ $visitor->profession }}</td>
                    <td>{{ $visitor->email }}</td>
                    <td>{{ $visitor->tel_nr }}</td>

                    <td>

                        @if (Auth::check() && Auth::user()->is_admin)

                        <form action="{{ route('visitors.destroy', $visitor->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <div class="btn-group">
                                <a href="{{ route('visitors.edit', $visitor->id) }}"
                                    class="btn btn-outline-warning btn-sm" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path
                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                    </svg>
                                    Editieren
                                </a>
                            </div>

                            <div class="btn-group">
                                <a href="{{ route('visitors.show', $visitor->id) }}" class="btn btn-outline-info btn-sm"
                                    type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-eye" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                    Anzeigen
                                </a>
                            </div>

                            <div class="btn-group">
                                <button type="submit" class="btn btn-outline-danger btn-sm" value="Delete"
                                    id="visitor-delete" ONCLICK="deleteVerification()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path
                                            d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                    </svg>
                                    Löschen
                                </button>
                        </form>

                        <script>
                            const deleteVerification = () => {
                                    const response = confirm("Möchten Sie diesen Addressbucheintrag wirklich löschen?");                    
                                        if (response) {
                                            alert("Bestätigung wurde angeklickt");
                                                } else {
                                                    alert("Abbruch wurde angeklickt");
                                                }
                                }
                        </script>
                    </td>
                    @endauth
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- <div class="my-3 d-flex justify-content-end">
            {{ $visitors->links() }}
    </div> --}}
</div>
</div>
@endsection