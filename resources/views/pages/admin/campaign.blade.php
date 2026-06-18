@extends('layout.admin')

@section('title', 'Campaign — GO K-POP Admin')

@section('admin_content')
    <!-- Page Header -->
    <div style="margin-bottom:2rem;display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:1rem">
        <div>
            <h1 class="admin-panel-title" style="margin-bottom:.25rem">Manajemen Campaign</h1>
            <p class="admin-panel-sub" style="margin-bottom:0">Kelola seluruh lapak group order album K-Pop</p>
        </div>
    </div>

    <!-- Tabs -->
    <div
        style="display:flex;gap:8px;padding:4px;border-radius:14px;background:rgba(26,26,36,.6);border:1px solid rgba(255,255,255,.1);width:fit-content;margin-bottom:1.5rem">
        <button class="camp-tab active" id="tab-list" data-tab="list">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <line x1="8" y1="6" x2="21" y2="6" />
                <line x1="8" y1="12" x2="21" y2="12" />
                <line x1="8" y1="18" x2="21" y2="18" />
                <line x1="3" y1="6" x2="3.01" y2="6" />
                <line x1="3" y1="12" x2="3.01" y2="12" />
                <line x1="3" y1="18" x2="3.01" y2="18" />
            </svg>
            Kelola Campaign
        </button>
        <button class="camp-tab" id="tab-form" data-tab="form">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path
                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
            </svg>
            <span id="tab-form-label">Buka Lapak Baru</span>
        </button>
    </div>

    <!-- ══ PANEL: KELOLA CAMPAIGN ══ -->
    <div id="panel-list">
        <div
            style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:1.5rem">
            <p style="font-size:.875rem;color:var(--slate-400)">
                Total <strong style="color:#fff" id="stat-total-camp">6</strong> lapak ·
                <span style="color:var(--neon-400)" id="stat-aktif">6 aktif</span> ·
                <span style="color:var(--slate-500)" id="stat-closed">0 ditutup</span>
            </p>
            <button class="btn btn-accent" style="padding:8px 18px;border-radius:10px;font-size:.875rem"
                id="btn-new-campaign">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Buka Lapak Baru
            </button>
        </div>

        <div class="campaign-grid" id="campaign-grid">
            @foreach ($albums as $album)
                <div class="campaign-card" data-campaign-id="1" data-has-orders="true">
                    <div class="album-img-wrap"
                        style="aspect-ratio:4/3;border-radius:12px;overflow:hidden;margin-bottom:1rem;position:relative">
                        <img src="https://images.pexels.com/photos/1762537/pexels-photo-1762537.jpeg?auto=compress&cs=tinysrgb&w=600"
                            alt="ISTJ" style="width:100%;height:100%;object-fit:cover">
                        <span class="camp-status-badge camp-badge-aktif">{{ $album->status }}</span>
                    </div>
                    <p class="campaign-group">{{ $album->group_name }}</p>
                    <p class="campaign-title">{{ $album->title }}</p>
                    <div
                        style="display:flex;align-items:center;justify-content:space-between;font-size:.875rem;margin-bottom:1rem">
                        <span style="color:#fff;font-weight:600">Rp{{ number_format($album->price) }}</span>
                        <span
                            style="font-size:.75rem;color:var(--slate-500)">{{ $album->slots_left }}/{{ $album->total_slots }}
                            slot</span>
                    </div>
                    <div class="progress-bar" style="margin-bottom:1rem">
                        <div class="progress-fill" style="width:50%;background:#eab308"></div>
                    </div>
                    <div style="display:flex;gap:8px">
                        <button class="btn-camp-edit" data-id="{{ $album->id }}" data-group="{{ $album->group_name }}"
                            data-title="{{ $album->title }}" data-price="{{ $album->price }}"
                            data-slots="{{ $album->total_slots }}" data-slots-left="{{ $album->slots_left }}"
                            data-variants='@json($album->variants->pluck("name"))' data-members='@json($album->members->pluck("name"))'>
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                            Edit
                        </button>
                        <button class="btn-camp-close" data-id="1" data-title="ISTJ - The 5th Album"
                            data-has-orders="true">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <rect x="3" y="11" width="18" height="11" rx="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                            Tutup
                        </button>
                    </div>
                </div>
            @endforeach
            {{-- <!-- NCT 127 -->
            <div class="campaign-card" data-campaign-id="1" data-has-orders="true">
                <div class="album-img-wrap"
                    style="aspect-ratio:4/3;border-radius:12px;overflow:hidden;margin-bottom:1rem;position:relative">
                    <img src="https://images.pexels.com/photos/1762537/pexels-photo-1762537.jpeg?auto=compress&cs=tinysrgb&w=600"
                        alt="ISTJ" style="width:100%;height:100%;object-fit:cover">
                    <span class="camp-status-badge camp-badge-aktif">Aktif</span>
                </div>
                <p class="campaign-group">NCT 127</p>
                <p class="campaign-title">ISTJ - The 5th Album</p>
                <div
                    style="display:flex;align-items:center;justify-content:space-between;font-size:.875rem;margin-bottom:1rem">
                    <span style="color:#fff;font-weight:600">Rp285.000</span>
                    <span style="font-size:.75rem;color:var(--slate-500)">15/30 slot</span>
                </div>
                <div class="progress-bar" style="margin-bottom:1rem">
                    <div class="progress-fill" style="width:50%;background:#eab308"></div>
                </div>
                <div style="display:flex;gap:8px">
                    <button class="btn-camp-edit" data-id="1">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                        </svg>
                        Edit
                    </button>
                    <button class="btn-camp-close" data-id="1" data-title="ISTJ - The 5th Album"
                        data-has-orders="true">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <rect x="3" y="11" width="18" height="11" rx="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                        Tutup
                    </button>
                </div>
            </div>

            <!-- SEVENTEEN -->
            <div class="campaign-card" data-campaign-id="2" data-has-orders="true">
                <div class="album-img-wrap"
                    style="aspect-ratio:4/3;border-radius:12px;overflow:hidden;margin-bottom:1rem;position:relative">
                    <img src="https://images.pexels.com/photos/1190297/pexels-photo-1190297.jpeg?auto=compress&cs=tinysrgb&w=600"
                        alt="FML" style="width:100%;height:100%;object-fit:cover">
                    <span class="camp-status-badge camp-badge-aktif">Aktif</span>
                </div>
                <p class="campaign-group">SEVENTEEN</p>
                <p class="campaign-title">FML - 10th Mini Album</p>
                <div
                    style="display:flex;align-items:center;justify-content:space-between;font-size:.875rem;margin-bottom:1rem">
                    <span style="color:#fff;font-weight:600">Rp310.000</span>
                    <span style="font-size:.75rem;color:var(--slate-500)">8/50 slot</span>
                </div>
                <div class="progress-bar" style="margin-bottom:1rem">
                    <div class="progress-fill" style="width:84%;background:#e11d48"></div>
                </div>
                <div style="display:flex;gap:8px">
                    <button class="btn-camp-edit" data-id="2">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                        </svg>
                        Edit
                    </button>
                    <button class="btn-camp-close" data-id="2" data-title="FML - 10th Mini Album"
                        data-has-orders="true">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <rect x="3" y="11" width="18" height="11" rx="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                        Tutup
                    </button>
                </div>
            </div>

            <!-- aespa -->
            <div class="campaign-card" data-campaign-id="3" data-has-orders="false">
                <div class="album-img-wrap"
                    style="aspect-ratio:4/3;border-radius:12px;overflow:hidden;margin-bottom:1rem;position:relative">
                    <img src="https://images.pexels.com/photos/1540137/pexels-photo-1540137.jpeg?auto=compress&cs=tinysrgb&w=600"
                        alt="MY WORLD" style="width:100%;height:100%;object-fit:cover">
                    <span class="camp-status-badge camp-badge-aktif">Aktif</span>
                </div>
                <p class="campaign-group">AESPA</p>
                <p class="campaign-title">MY WORLD - 3rd Mini Album</p>
                <div
                    style="display:flex;align-items:center;justify-content:space-between;font-size:.875rem;margin-bottom:1rem">
                    <span style="color:#fff;font-weight:600">Rp250.000</span>
                    <span style="font-size:.75rem;color:var(--slate-500)">22/40 slot</span>
                </div>
                <div class="progress-bar" style="margin-bottom:1rem">
                    <div class="progress-fill" style="width:45%;background:#22c55e"></div>
                </div>
                <div style="display:flex;gap:8px">
                    <button class="btn-camp-edit" data-id="3">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                        </svg>
                        Edit
                    </button>
                    <button class="btn-camp-delete" data-id="3" data-title="MY WORLD - 3rd Mini Album">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <polyline points="3 6 5 6 21 6" />
                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                        </svg>
                        Hapus
                    </button>
                </div>
            </div>

            <!-- Stray Kids -->
            <div class="campaign-card" data-campaign-id="4" data-has-orders="true">
                <div class="album-img-wrap"
                    style="aspect-ratio:4/3;border-radius:12px;overflow:hidden;margin-bottom:1rem;position:relative">
                    <img src="https://images.pexels.com/photos/1644697/pexels-photo-1644697.jpeg?auto=compress&cs=tinysrgb&w=600"
                        alt="5-STAR" style="width:100%;height:100%;object-fit:cover">
                    <span class="camp-status-badge camp-badge-aktif">Aktif</span>
                </div>
                <p class="campaign-group">STRAY KIDS</p>
                <p class="campaign-title">5-STAR - 3rd Album</p>
                <div
                    style="display:flex;align-items:center;justify-content:space-between;font-size:.875rem;margin-bottom:1rem">
                    <span style="color:#fff;font-weight:600">Rp295.000</span>
                    <span style="font-size:.75rem;color:var(--slate-500)">3/35 slot</span>
                </div>
                <div class="progress-bar" style="margin-bottom:1rem">
                    <div class="progress-fill" style="width:91%;background:#e11d48"></div>
                </div>
                <div style="display:flex;gap:8px">
                    <button class="btn-camp-edit" data-id="4">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                        </svg>
                        Edit
                    </button>
                    <button class="btn-camp-close" data-id="4" data-title="5-STAR - 3rd Album"
                        data-has-orders="true">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <rect x="3" y="11" width="18" height="11" rx="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                        Tutup
                    </button>
                </div>
            </div>

            <!-- NewJeans -->
            <div class="campaign-card" data-campaign-id="5" data-has-orders="true">
                <div class="album-img-wrap"
                    style="aspect-ratio:4/3;border-radius:12px;overflow:hidden;margin-bottom:1rem;position:relative">
                    <img src="https://images.pexels.com/photos/1670934/pexels-photo-1670934.jpeg?auto=compress&cs=tinysrgb&w=600"
                        alt="Get Up" style="width:100%;height:100%;object-fit:cover">
                    <span class="camp-status-badge camp-badge-aktif">Aktif</span>
                </div>
                <p class="campaign-group">NEWJEANS</p>
                <p class="campaign-title">Get Up - 2nd EP</p>
                <div
                    style="display:flex;align-items:center;justify-content:space-between;font-size:.875rem;margin-bottom:1rem">
                    <span style="color:#fff;font-weight:600">Rp240.000</span>
                    <span style="font-size:.75rem;color:var(--slate-500)">30/45 slot</span>
                </div>
                <div class="progress-bar" style="margin-bottom:1rem">
                    <div class="progress-fill" style="width:33%;background:#22c55e"></div>
                </div>
                <div style="display:flex;gap:8px">
                    <button class="btn-camp-edit" data-id="5">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                        </svg>
                        Edit
                    </button>
                    <button class="btn-camp-close" data-id="5" data-title="Get Up - 2nd EP" data-has-orders="true">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <rect x="3" y="11" width="18" height="11" rx="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                        Tutup
                    </button>
                </div>
            </div>

            <!-- ENHYPEN -->
            <div class="campaign-card" data-campaign-id="6" data-has-orders="false">
                <div class="album-img-wrap"
                    style="aspect-ratio:4/3;border-radius:12px;overflow:hidden;margin-bottom:1rem;position:relative">
                    <img src="https://images.pexels.com/photos/1540137/pexels-photo-1540137.jpeg?auto=compress&cs=tinysrgb&w=600"
                        alt="DARK BLOOD" style="width:100%;height:100%;object-fit:cover">
                    <span class="camp-status-badge camp-badge-aktif">Aktif</span>
                </div>
                <p class="campaign-group">ENHYPEN</p>
                <p class="campaign-title">DARK BLOOD - 4th Mini Album</p>
                <div
                    style="display:flex;align-items:center;justify-content:space-between;font-size:.875rem;margin-bottom:1rem">
                    <span style="color:#fff;font-weight:600">Rp270.000</span>
                    <span style="font-size:.75rem;color:var(--slate-500)">12/30 slot</span>
                </div>
                <div class="progress-bar" style="margin-bottom:1rem">
                    <div class="progress-fill" style="width:60%;background:#eab308"></div>
                </div>
                <div style="display:flex;gap:8px">
                    <button class="btn-camp-edit" data-id="6">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                        </svg>
                        Edit
                    </button>
                    <button class="btn-camp-delete" data-id="6" data-title="DARK BLOOD - 4th Mini Album">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <polyline points="3 6 5 6 21 6" />
                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                        </svg>
                        Hapus
                    </button>
                </div>
            </div> --}}

        </div><!-- /campaign-grid -->
    </div><!-- /panel-list -->

    <!-- ══ PANEL: FORM ══ -->
    <div id="panel-form" class="hidden">
        <div style="max-width:680px">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:1.5rem">
                <div>
                    <h2 style="font-size:1.25rem;font-weight:700;color:#fff;margin-bottom:4px" id="form-title">Buka Lapak
                        Baru</h2>
                    <p style="font-size:.875rem;color:var(--slate-400)" id="form-subtitle">Buat campaign group order album
                        baru</p>
                </div>
                <button class="btn btn-ghost"
                    style="padding:8px 14px;border-radius:10px;font-size:.8rem;white-space:nowrap" id="btn-batal-edit">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                    Batal Edit
                </button>
            </div>

            <form id="campaign-form" action="{{ route('admin.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="admin-card" style="padding:1.75rem">
                    <!-- Upload Cover -->
                    <div class="form-group">
                        <label class="form-label">Foto / Gambar Cover Album</label>
                        <input type="file" id="cover-file-input" accept="image/jpeg,image/png,image/webp"
                            style="position:fixed;top:-9999px;left:-9999px;opacity:0;width:1px;height:1px"
                            name="album_cover" />
                        @error('album_cover')
                            <small style="color:#ef4444">
                                {{ $message }}
                            </small>
                        @enderror
                        <div style="display:flex;justify-content:center">
                            <div class="cover-upload-wrap" id="cover-upload-wrap">
                                <div class="cover-upload-empty" id="cover-empty">
                                    <div
                                        style="width:48px;height:48px;border-radius:50%;background:rgba(225,29,72,.1);border:1px solid rgba(225,29,72,.2);display:flex;align-items:center;justify-content:center;margin:0 auto 12px">
                                        <svg width="24" height="24" fill="none" stroke="var(--accent-400)"
                                            stroke-width="2" viewBox="0 0 24 24">
                                            <path
                                                d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                                            <circle cx="12" cy="13" r="4" />
                                        </svg>
                                    </div>
                                    <p style="font-size:.875rem;color:#fff;font-weight:600">Drag &amp; Drop atau Klik untuk
                                        Upload</p>
                                    <p style="font-size:.75rem;color:var(--slate-500);margin-top:4px">Format JPG/PNG,
                                        rekomendasi rasio 1:1</p>
                                </div>
                                <div class="cover-upload-preview hidden" id="cover-preview">
                                    <img src="" alt="Cover Album" id="cover-preview-img" />
                                    <div class="cover-upload-actions">
                                        <button class="btn-cover-ganti" id="btn-cover-ganti" type="button">
                                            <svg width="14" height="14" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                <polyline points="17 8 12 3 7 8" />
                                                <line x1="12" y1="3" x2="12" y2="15" />
                                            </svg>
                                            Ganti
                                        </button>
                                        <button class="btn-cover-hapus" id="btn-cover-hapus" type="button">
                                            <svg width="14" height="14" fill="none" stroke="currentColor"
                                                stroke-width="2" viewBox="0 0 24 24">
                                                <polyline points="3 6 5 6 21 6" />
                                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="c-group">Nama Grup K-Pop</label>
                        <input type="text" class="form-input no-icon" id="c-group"
                            placeholder="Contoh: NCT 127, Seventeen" name="group_name"
                            value="{{ old('group_name') }}" />
                        @error('group_name')
                            <small style="color:#ef4444">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="c-title">Judul Album</label>
                        <input type="text" class="form-input no-icon" id="c-title" placeholder="Contoh: ISTJ, FML"
                            name="title" value="{{ old('title') }}" />
                        @error('title')
                            <small style="color:#ef4444">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
                        <div class="form-group">
                            <label class="form-label" for="c-price">Estimasi Harga (Rp)</label>
                            <input type="number" class="form-input no-icon" id="c-price" placeholder="285000"
                                name="price" value="{{ old('price') }}" />
                            @error('price')
                                <small style="color:#ef4444">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="c-slots">Target Kuota Slot</label>
                            <input type="number" class="form-input no-icon" id="c-slots" placeholder="100"
                                name="slots" value="{{ old('slots') }}" />
                            @error('slots')
                                <small style="color:#ef4444">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>

                    <!-- Sisa slot (hanya tampil saat edit) -->
                    <div class="form-group hidden" id="slots-left-group">
                        <label class="form-label" for="c-slots-left">Sisa Slot Tersedia</label>
                        <input type="number" class="form-input no-icon" id="c-slots-left" placeholder="Sisa slot" />
                    </div>

                    <!-- Varian -->
                    <div class="form-group">
                        <label class="form-label">Daftar Varian Album</label>
                        <div class="tag-add-wrap">
                            <input type="text" class="form-input no-icon" id="variant-input"
                                placeholder="Ketik nama varian lalu tekan Enter" />
                            <button class="btn-add-tag" id="btn-add-variant" type="button">
                                <svg width="16" height="16" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                            </button>
                        </div>
                        <div class="tag-list" id="variant-tags"></div>
                        @error('variants')
                            <small style="color:#ef4444">
                                {{ $message }}
                            </small>
                        @enderror

                        @error('variants.*')
                            <small style="color:#ef4444">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <!-- Member -->
                    <div class="form-group">
                        <label class="form-label">Daftar Nama Member</label>
                        <div class="tag-add-wrap">
                            <input type="text" class="form-input no-icon" id="member-input"
                                placeholder="Ketik nama lalu tekan Enter" />
                            <button class="btn-add-tag" id="btn-add-member" type="button">
                                <svg width="16" height="16" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                            </button>
                        </div>
                        <div class="tag-list" id="member-tags"></div>
                        @error('members')
                            <small style="color:#ef4444">
                                {{ $message }}
                            </small>
                        @enderror
                        @error('members.*')
                            <small style="color:#ef4444">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div style="padding-top:1.25rem;border-top:1px solid rgba(255,255,255,.06)">
                        <button class="btn btn-accent"
                            style="width:100%;padding:14px;border-radius:12px;font-size:.875rem" id="btn-publish"
                            type="submit">
                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                                <polyline points="17 21 17 13 7 13 7 21" />
                                <polyline points="7 3 7 8 15 8" />
                            </svg>
                            <span id="btn-publish-label">Simpan &amp; Publikasikan</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /panel-form -->

@endsection

@section('admin_content_custom')
    <!-- ══ CONFIRM MODAL (Tutup / Hapus Campaign) ══ -->
    <div class="modal-overlay" id="confirm-modal">
        <div class="modal-box" style="max-width:440px">
            <div style="display:flex;align-items:flex-start;gap:12px;margin-bottom:1.25rem">
                <div
                    style="width:44px;height:44px;border-radius:50%;background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.3);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    <svg width="22" height="22" fill="none" stroke="#f87171" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path
                            d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                        <line x1="12" y1="9" x2="12" y2="13" />
                        <line x1="12" y1="17" x2="12.01" y2="17" />
                    </svg>
                </div>
                <div>
                    <h3 style="font-size:1.125rem;font-weight:700;color:#fff;margin-bottom:6px" id="confirm-title">Tutup
                        Lapak Ini?</h3>
                    <p style="font-size:.875rem;color:var(--slate-400)" id="confirm-desc"></p>
                    <p style="font-size:.75rem;margin-top:8px" id="confirm-note"></p>
                </div>
            </div>
            <div style="display:flex;gap:10px">
                <button class="btn btn-ghost" style="flex:1;padding:11px;border-radius:12px;justify-content:center"
                    id="btn-confirm-cancel">Batal</button>
                <button class="btn btn-danger"
                    style="flex:1;padding:11px;border-radius:12px;justify-content:center;background:rgba(239,68,68,.85);color:#fff;border:none"
                    id="btn-confirm-ok">
                    <span id="confirm-ok-label">Ya, Tutup Lapak</span>
                </button>
            </div>
        </div>
    </div>
@endsection

@section('js_custom')
    @if (session('success'))
        <script>
            $(document).ready(function() {
                GKP.showToast(
                    @json(session('success')),
                    'success'
                );
            });
        </script>
    @endif

    <script src="{{ asset('asset/js/admin-campaign.js') }}"></script>

    @if (old('variants'))
        <script>
            $(document).ready(function() {
                const oldVariants = @json(old('variants'));
                oldVariants.forEach(function(item) {
                    addTagEl('variant-tags', item);
                });
            });
        </script>
    @endif

    @if (old('members'))
        <script>
            $(document).ready(function() {
                const oldMembers = @json(old('members'));
                oldMembers.forEach(function(item) {
                    addTagEl('member-tags', item);
                });
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#panel-list').addClass('hidden');
                $('#panel-form').removeClass('hidden');
                $('#tab-list').removeClass('active');
                $('#tab-form').addClass('active');
            });
        </script>
    @endif
@endsection
