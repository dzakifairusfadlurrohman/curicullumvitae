<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicantController extends Controller
{
    // 🟢 List semua pelamar
    public function index()
    {
        $applicants = Applicant::latest()->get();
        return view('applicants.index', compact('applicants'));
    }

    // 🟢 Form tambah pelamar
    public function create()
    {
        return view('applicants.create');
    }

    // 🟢 Simpan pelamar baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required',
            'alamat' => 'required',
            'pendidikan' => 'required',
            'pengalaman_kerja' => 'nullable',
            'keahlian' => 'nullable',
            'cv_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = $request->only([
            'nama_lengkap',
            'email',
            'no_hp',
            'alamat',
            'pendidikan',
            'pengalaman_kerja',
            'keahlian',
        ]);

        if ($request->hasFile('cv_file')) {
            $cvPath = $request->file('cv_file')->store('cv', 'public');
            $data['cv_file'] = $cvPath;
        }

        Applicant::create($data);

        return redirect()->route('dashboard')->with('success', 'Data berhasil disimpan!');
    }

    // 🟢 Detail pelamar
    public function show($id)
    {
        $applicant = Applicant::findOrFail($id);
        return view('applicants.show', compact('applicant'));
    }

    // 🟡 Form edit pelamar
    public function edit($id)
    {
        $applicant = Applicant::findOrFail($id);
        return view('applicants.edit', compact('applicant'));
    }

    // 🟡 Simpan hasil edit
    public function update(Request $request, $id)
    {
        $applicant = Applicant::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:applicants,email,' . $id,
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required',
            'pendidikan' => 'required|string',
            'pengalaman_kerja' => 'nullable|string',
            'keahlian' => 'nullable|string',
            'cv_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('cv_file')) {
            // hapus file lama
            if ($applicant->cv_file) {
                Storage::disk('public')->delete($applicant->cv_file);
            }

            $data['cv_file'] = $request->file('cv_file')->store('cv', 'public');
        }

        $applicant->update($data);

        return redirect()->route('applicants.index')->with('success', 'Data pelamar berhasil diperbarui.');
    }

    // 🔴 Hapus pelamar
    public function destroy($id)
    {
        $applicant = Applicant::findOrFail($id);
        
        if ($applicant->cv_file) {
            Storage::disk('public')->delete($applicant->cv_file);
        }

        $applicant->delete();

        return redirect()->route('admin.applicants.index')->with('success', 'Data berhasil dihapus');
    }
}
