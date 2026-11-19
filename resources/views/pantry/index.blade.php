@extends('layouts.site')

@section('title', 'Hűtő')

@section('content')

    <div class="page-header">
        <h1 class="page-title">🧊 A hűtőm</h1>
    </div>

    {{-- Hibák kiírása --}}
    @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Új tétel hozzáadása --}}
    <form method="POST" action="{{ route('pantry.store') }}" class="pantry-form">
        @csrf

        <select name="ingredient_id" required>
            <option value="">Alapanyag...</option>
            @foreach ($ingredients as $ingredient)
                <option value="{{ $ingredient->id }}" @selected(old('ingredient_id') == $ingredient->id)>
                    {{ $ingredient->name }}
                </option>
            @endforeach
        </select>

        <input type="number" name="amount" step="0.01" min="0.01"
               value="{{ old('amount') }}" placeholder="Mennyiség" required>

        <select name="unit_id" required>
            <option value="">Egység...</option>
            @foreach ($units as $unit)
                <option value="{{ $unit->id }}" @selected(old('unit_id') == $unit->id)>
                    {{ $unit->abbreviation }}
                </option>
            @endforeach
        </select>

        <input type="date" name="expiry_date" value="{{ old('expiry_date') }}" title="Lejárati dátum (nem kötelező)">

        <button type="submit" class="btn">Hozzáadás</button>
    </form>

    {{-- A hűtő tartalma --}}
    @if ($items->isEmpty())
        <p class="empty">A hűtőd üres. Adj hozzá valamit fent!</p>
    @else
        <div class="card">
            <table class="pantry-table">
                <thead>
                    <tr>
                        <th>Alapanyag</th>
                        <th>Mennyiség</th>
                        <th>Lejárat</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->ingredient->name }}</td>
                            <td>{{ (float) $item->amount }} {{ $item->unit->abbreviation }}</td>
                            <td>
                                @if ($item->expiry_date === null)
                                    <span class="muted">–</span>
                                @elseif ($item->expiry_date->lt(today()))
                                    <span class="expired">{{ $item->expiry_date->format('Y.m.d.') }} (lejárt)</span>
                                @elseif ($item->expiry_date->lte(today()->addDays(3)))
                                    <span class="soon">{{ $item->expiry_date->format('Y.m.d.') }} (hamarosan lejár)</span>
                                @else
                                    {{ $item->expiry_date->format('Y.m.d.') }}
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('pantry.destroy', $item) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light">Törlés</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection