<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Pelamar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="form-container">
        <h2 class="mb-4 text-primary">✏️ Edit Data Pelamar</h2>

        <a href="{{ route('admin.applicants.index') }}" class="btn btn-outline-secondary mb-4">← Kembali ke Daftar</a>

        {{-- Error Validation --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <h5 class="mb-2">⚠️ Terdapat kesalahan:</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.applicants.update', $applicant->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $applicant->nama_lengkap) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $applicant->email) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">No HP</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $applicant->no_hp) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Pendidikan</label>
                    <select name="pendidikan" class="form-select" required>
                        <option value="">-- Pilih Pendidikan --</option>
                        <option value="SMK" {{ old('pendidikan', $applicant->pendidikan ?? '') == 'SMK' ? 'selected' : '' }}>SMK</option>
                        <option value="D3" {{ old('pendidikan', $applicant->pendidikan ?? '') == 'D3' ? 'selected' : '' }}>D3</option>
                        <option value="D4" {{ old('pendidikan', $applicant->pendidikan ?? '') == 'D4' ? 'selected' : '' }}>D4</option>
                        <option value="Sarjana" {{ old('pendidikan', $applicant->pendidikan ?? '') == 'Sarjana' ? 'selected' : '' }}>Sarjana</option>
                        <option value="Master" {{ old('pendidikan', $applicant->pendidikan ?? '') == 'Master' ? 'selected' : '' }}>Master</option>
                        <option value="Doktor" {{ old('pendidikan', $applicant->pendidikan ?? '') == 'Doktor' ? 'selected' : '' }}>Doktor</option>
                        <option value="Sertifikasi" {{ old('pendidikan', $applicant->pendidikan ?? '') == 'Sertifikasi' ? 'selected' : '' }}>Sertifikasi</option>
                    </select>

            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat', $applicant->alamat) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Pengalaman Kerja</label>
                <textarea name="pengalaman_kerja" class="form-control" rows="3">{{ old('pengalaman_kerja', $applicant->pengalaman_kerja) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Keahlian</label>
                <textarea name="keahlian" class="form-control" rows="3">{{ old('keahlian', $applicant->keahlian) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="form-label">Upload CV Baru (PDF)</label>
                <input type="file" name="cv_file" class="form-control" accept=".pdf">
                @if ($applicant->cv_file)
                    <small class="text-muted">CV saat ini: <a href="{{ asset('storage/' . $applicant->cv_file) }}" target="_blank">Lihat File</a></small>
                @endif
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
