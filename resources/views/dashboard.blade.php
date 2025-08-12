<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            📋 Dashboard - Manajemen Data Pelamar
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl sm:rounded-lg p-6">

                {{-- Tombol Tambah --}}
                <div class="flex justify-end mb-4">
                    <a href="{{ route('admin.applicants.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded shadow">
                        + Tambah Pelamar
                    </a>
                </div>

                {{-- Tabel --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-100 uppercase text-xs font-semibold">
                            <tr>
                                <th class="px-6 py-3">Nama</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                            @forelse ($applicants as $applicant)
                                <tr>
                                    <td class="px-6 py-4">{{ $applicant->nama_lengkap }}</td>
                                    <td class="px-6 py-4">{{ $applicant->email }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('admin.applicants.edit', $applicant->id) }}"
                                           class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium mr-3">
                                            ✏️ Edit
                                        </a>
                                        <form action="{{ route('admin.applicants.destroy', $applicant->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus pelamar ini?')"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 font-medium">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center px-6 py-6 text-gray-500 dark:text-gray-400">
                                        Tidak ada data pelamar.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
