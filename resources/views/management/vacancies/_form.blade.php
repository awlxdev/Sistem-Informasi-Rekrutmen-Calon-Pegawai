@php
    $vacancy = $vacancy ?? null;
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <div class="fw-bold mb-2">
            <i class="bi bi-exclamation-triangle me-1"></i>
            Periksa kembali data yang dimasukkan.
        </div>
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="dashboard-card p-3 p-md-4">
    <form method="POST" action="{{ $formAction }}">
        @csrf

        @if ($formMethod === 'PUT')
            @method('PUT')
        @endif

        <div class="mb-4">
            <div class="section-eyebrow mb-2">INFORMASI POSISI</div>
            <h5 class="fw-bold text-primary-custom mb-1">Informasi Umum</h5>
            <p class="text-muted small mb-0">
                Masukkan informasi utama posisi pekerjaan yang dibuka.
            </p>
        </div>

        <div class="row g-3">
            <div class="col-lg-8">
                <label class="form-label">Nama Posisi <span class="text-danger">*</span></label>
                <input type="text"
                       name="title"
                       class="form-control"
                       maxlength="150"
                       required
                       value="{{ old('title', $vacancy?->title) }}"
                       placeholder="Contoh: Staff Administrasi">
            </div>

            <div class="col-lg-4">
                <label class="form-label">Departemen</label>
                <input type="text"
                       name="department"
                       class="form-control"
                       maxlength="100"
                       value="{{ old('department', $vacancy?->department) }}"
                       placeholder="Contoh: Administrasi">
            </div>

            <div class="col-md-6">
                <label class="form-label">Jenis Pekerjaan</label>
                <select name="employment_type" class="form-select">
                    <option value="">Pilih jenis pekerjaan</option>
                    @foreach (['Full Time', 'Part Time', 'Kontrak', 'Magang', 'Freelance'] as $type)
                        <option value="{{ $type }}"
                            @selected(old('employment_type', $vacancy?->employment_type) === $type)>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Lokasi Penempatan</label>
                <input type="text"
                       name="location"
                       class="form-control"
                       maxlength="150"
                       value="{{ old('location', $vacancy?->location) }}"
                       placeholder="Contoh: Kota Sorong">
            </div>
        </div>

        <hr class="divider-soft my-4">

        <div class="mb-4">
            <div class="section-eyebrow mb-2">DESKRIPSI PEKERJAAN</div>
            <h5 class="fw-bold text-primary-custom mb-1">Rincian Posisi</h5>
            <p class="text-muted small mb-0">
                Jelaskan pekerjaan, kualifikasi, dan tanggung jawab posisi.
            </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi Pekerjaan <span class="text-danger">*</span></label>
            <textarea name="description"
                      class="form-control"
                      rows="6"
                      required
                      placeholder="Jelaskan gambaran umum posisi pekerjaan...">{{ old('description', $vacancy?->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Persyaratan / Kualifikasi</label>
            <textarea name="requirements"
                      class="form-control"
                      rows="5"
                      placeholder="Tuliskan persyaratan pendidikan, pengalaman, kemampuan, dan kualifikasi lain...">{{ old('requirements', $vacancy?->requirements) }}</textarea>
            <div class="form-text">Gunakan baris baru untuk memisahkan setiap persyaratan.</div>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggung Jawab Pekerjaan</label>
            <textarea name="responsibilities"
                      class="form-control"
                      rows="5"
                      placeholder="Tuliskan tugas dan tanggung jawab pekerjaan...">{{ old('responsibilities', $vacancy?->responsibilities) }}</textarea>
        </div>

        <hr class="divider-soft my-4">

        <div class="mb-4">
            <div class="section-eyebrow mb-2">PENGATURAN PENDAFTARAN</div>
            <h5 class="fw-bold text-primary-custom mb-1">Kuota dan Periode</h5>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Kuota Penerimaan <span class="text-danger">*</span></label>
                <input type="number"
                       name="quota"
                       class="form-control"
                       min="1"
                       max="100000"
                       required
                       value="{{ old('quota', $vacancy?->quota ?? 1) }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Tanggal Publikasi</label>
                <input type="date"
                       name="published_at"
                       class="form-control"
                       value="{{ old('published_at', $vacancy?->published_at?->format('Y-m-d')) }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Batas Pendaftaran</label>
                <input type="date"
                       name="closing_date"
                       class="form-control"
                       value="{{ old('closing_date', $vacancy?->closing_date?->format('Y-m-d')) }}">
                <div class="form-text">Kosongkan jika tidak ada batas tanggal.</div>
            </div>

            <div class="col-md-6">
                <label class="form-label">Status Lowongan <span class="text-danger">*</span></label>
                <select name="status" class="form-select" required>
                    <option value="draft"
                        @selected(old('status', $vacancy?->status ?? 'draft') === 'draft')>
                        Draft — Belum diterbitkan
                    </option>
                    <option value="published"
                        @selected(old('status', $vacancy?->status) === 'published')>
                        Published — Terbitkan
                    </option>
                    <option value="closed"
                        @selected(old('status', $vacancy?->status) === 'closed')>
                        Closed — Ditutup
                    </option>
                </select>
            </div>
        </div>

        <div class="alert alert-info mt-4 mb-0">
            <i class="bi bi-info-circle me-2"></i>
            Lowongan berstatus Draft tidak ditampilkan sebagai lowongan aktif.
            Pastikan informasi dan tanggal pendaftaran sudah benar sebelum menerbitkan.
        </div>

        <div class="d-flex flex-column flex-sm-row justify-content-between
                    gap-2 mt-4 pt-3 border-top">
            <a href="{{ route($routePrefix . '.vacancies.index') }}"
               class="btn btn-outline-secondary px-4">
                <i class="bi bi-arrow-left me-1"></i>
                Kembali
            </a>

            <button type="submit" class="btn btn-primary-custom px-4">
                <i class="bi bi-check2-circle me-1"></i>
                {{ $submitLabel }}
            </button>
        </div>
    </form>
</div>