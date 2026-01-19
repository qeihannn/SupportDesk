@extends('layouts.app')

@section('content')

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8" cellspacing="0" center>
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Tiket</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tickets as $ticket)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>
                    <a href="{{ route('tickets.show', $ticket->id) }}">
                        {{ $ticket->title }}
                    </a>
                </td>
                <td>
                    @if(auth()->user()->role == 'admin')
                        <form method="POST" action="{{ route('tickets.updateStatus', $ticket) }}">
                            @csrf
                            <select name="status" onchange="this.form.submit()">
                                <option value="menunggu" {{ $ticket->status == 'menunggu' ? 'selected' : '' }}>
                                    Menunggu
                                </option>
                                <option value="diproses" {{ $ticket->status == 'diproses' ? 'selected' : '' }}>
                                    Diproses
                                </option>
                                <option value="selesai" {{ $ticket->status == 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                            </select>
                        </form>
                    @else
                        {{ $ticket->status }}
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
