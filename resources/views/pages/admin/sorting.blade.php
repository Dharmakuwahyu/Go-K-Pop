@extends('layout.admin')

@section('title', 'Sorting PC — GO K-POP Admin')

@section('admin_content')
    <h1 class="admin-panel-title">Sorting Photocard Otomatis</h1>
    <p class="admin-panel-sub">Masukkan jumlah kartu fisik per member, lalu jalankan sorting</p>

    <div class="admin-card">

        <h2 style="font-size:1.125rem;font-weight:700;color:#fff;margin-bottom:1rem">
            Pilih Album
        </h2>

        <select id="album-select" class="form-input">

            <option value="">
                -- Pilih Album --
            </option>

            @foreach ($albums as $album)
                <option value="{{ $album->id }}">
                    {{ $album->group_name }} - {{ $album->title }}
                </option>
            @endforeach

        </select>

    </div>

    <!-- Input kartu per member -->
    <div class="admin-card">
        <h2
            style="font-size:1.125rem;font-weight:700;color:#fff;margin-bottom:1.25rem;display:flex;align-items:center;gap:8px">
            <svg width="20" height="20" fill="none" stroke="var(--accent-400)" stroke-width="2"
                viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            </svg>
            Jumlah Fisik Kartu per Member
        </h2>

        <div class="sorting-member-grid" id="member-inputs">
            {{-- @foreach ($members as $member)
                <div class="sorting-member-row">
                    <span class="sorting-member-name">
                        {{ $member }}
                    </span>

                    <input type="number" min="0" class="form-input no-icon"
                        style="padding:10px 12px;font-size:.875rem" placeholder="0" data-member="{{ $member }}"
                        id="card-{{ \Illuminate\Support\Str::slug($member) }}">
                </div>
            @endforeach --}}
        </div>

        <button class="btn btn-neon" style="width:100%;padding:14px;border-radius:14px;margin-top:1.5rem;font-size:.9rem"
            id="btn-run-sorting">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polygon points="5 3 19 12 5 21 5 3" />
            </svg>
            Jalankan Sorting Otomatis
        </button>
    </div>

    <!-- Hasil sorting (hidden by default) -->
    <div class="admin-card hidden" id="sorting-result">
        <h2
            style="font-size:1.125rem;font-weight:700;color:#fff;margin-bottom:1.25rem;display:flex;align-items:center;gap:8px">
            <svg width="20" height="20" fill="none" stroke="var(--gold-400)" stroke-width="2" viewBox="0 0 24 24">
                <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6" />
                <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18" />
                <path d="M4 22h16" />
                <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22" />
                <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22" />
                <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z" />
            </svg>
            Hasil Sorting Photocard
        </h2>
        <div class="admin-table-wrap">
            <table class="admin-table sorting-result-table">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Pembeli</th>
                        <th>Prioritas</th>
                        <th>Waktu Transfer</th>
                    </tr>
                </thead>
                <tbody id="sorting-result-tbody"></tbody>
            </table>
        </div>
        <div style="display:flex;justify-content:flex-end;margin-top:1.5rem">
            <button class="btn btn-neon hidden" id="btn-save-sorting">
                Simpan Hasil Sorting
            </button>
        </div>
    </div>
@endsection

@section('js_custom')
    <script src="{{ asset('asset/js/admin-sorting.js') }}"></script>
@endsection
