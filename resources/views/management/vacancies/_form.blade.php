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
    <form method="POST"
          action="{{ $formAction }}"
          data-regencies-url="{{ route($routePrefix . '.vacancies.regencies', ['province' => '__PROVINCE__']) }}"
          data-initial-regency-id="{{ old('regency_id', $selectedRegencyId ?? '') }}">
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
                <label class="form-label">Provinsi</label>

                <select name="province_id" id="province_id" class="form-select">
                    <option value="">Pilih provinsi</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province->id }}"
                            @selected((string) old('province_id', $selectedProvinceId ?? '') === (string) $province->id)>
                            {{ $province->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Kabupaten/Kota</label>

                <select name="regency_id"
                        id="regency_id"
                        class="form-select"
                        disabled>
                    <option value="">Pilih kabupaten/kota</option>
                </select>

                <div class="form-text">
                    Pilih provinsi terlebih dahulu untuk menampilkan kabupaten/kota.
                </div>
            </div>

            <input type="hidden"
                   name="location"
                   id="location"
                   value="{{ old('location', $vacancy?->location) }}">
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
@push('scripts')
<script nonce="{{ Vite::cspNonce() }}">
document.addEventListener('DOMContentLoaded', function () {
    const provinceSelect = document.getElementById('province_id');
    const regencySelect = document.getElementById('regency_id');
    const locationInput = document.getElementById('location');
    const form = provinceSelect?.closest('form');

    if (!provinceSelect || !regencySelect || !locationInput || !form) return;

    const regenciesUrl = form.dataset.regenciesUrl;
    const initialRegencyId = form.dataset.initialRegencyId || '';

    function updateLocation() {
        const regencyOption = regencySelect.selectedOptions[0];
        const provinceOption = provinceSelect.selectedOptions[0];

        if (
            regencySelect.value &&
            provinceSelect.value &&
            regencyOption &&
            provinceOption
        ) {
            locationInput.value =
                regencyOption.textContent.trim() + ', ' +
                provinceOption.textContent.trim();
        } else {
            locationInput.value = '';
        }
    }

    async function loadRegencies(provinceId, selectedId = '') {
        regencySelect.innerHTML =
            '<option value="">Memuat kabupaten/kota...</option>';

        regencySelect.disabled = true;

        if (!provinceId) {
            regencySelect.innerHTML =
                '<option value="">Pilih kabupaten/kota</option>';

            return;
        }

        try {
            const url = regenciesUrl.replace(
                '__PROVINCE__',
                encodeURIComponent(provinceId)
            );

            const response = await fetch(url, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            });

            if (!response.ok) {
                throw new Error('Gagal mengambil data kabupaten/kota.');
            }

            const data = await response.json();

            regencySelect.innerHTML =
                '<option value="">Pilih kabupaten/kota</option>';

            data.forEach(function (regency) {
                const option = document.createElement('option');

                option.value = regency.id;
                option.textContent = regency.name;
                option.selected =
                    String(regency.id) === String(selectedId);

                regencySelect.appendChild(option);
            });

            regencySelect.disabled = false;

            updateLocation();
        } catch (error) {
            console.error(error);

            regencySelect.innerHTML =
                '<option value="">Gagal memuat data. Silakan coba lagi.</option>';

            regencySelect.disabled = true;
        }
    }

    provinceSelect.addEventListener('change', function () {
        locationInput.value = '';
        loadRegencies(this.value);
    });

    regencySelect.addEventListener('change', updateLocation);

    if (provinceSelect.value) {
        loadRegencies(provinceSelect.value, initialRegencyId);
    }
});
</script>
@endpush
