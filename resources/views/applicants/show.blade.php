<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail CV Pelamar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">👤 Detail CV Pelamar</h1>
        <a href="{{ route('applicants.index') }}" class="btn btn-outline-secondary">← Kembali</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="card-title text-primary mb-3">{{ $applicant->nama_lengkap }}</h4>

            <div class="row mb-2">
                <div class="col-sm-3 fw-semibold">Email</div>
                <div class="col-sm-9">{{ $applicant->email }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-3 fw-semibold">No HP</div>
                <div class="col-sm-9">{{ $applicant->no_hp }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-3 fw-semibold">Alamat</div>
                <div class="col-sm-9">{{ $applicant->alamat }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-3 fw-semibold">Pendidikan</div>
                <div class="col-sm-9">{{ $applicant->pendidikan }}</div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-3 fw-semibold">Pengalaman Kerja</div>
                <div class="col-sm-9">{!! nl2br(e($applicant->pengalaman_kerja ?? '-')) !!}</div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-3 fw-semibold">Keahlian</div>
                <div class="col-sm-9">{!! nl2br(e($applicant->keahlian ?? '-')) !!}</div>
            </div>

            @if ($applicant->cv_file)
                <div class="row mb-2">
                    <div class="col-sm-3 fw-semibold">CV</div>
                    <div class="col-sm-9">
                        <a href="{{ asset('storage/' . $applicant->cv_file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            📄 Lihat CV (PDF)
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>
