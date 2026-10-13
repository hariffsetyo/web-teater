<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MemberRequest;
use App\Models\Member;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::query();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('kelas', 'like', "%{$search}%")
                  ->orWhere('angkatan', 'like', "%{$search}%");
            });
        }

        if ($request->filled('divisi')) {
            $query->where('divisi', $request->divisi);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $members = $query->latest()->paginate(15)->withQueryString();

        return view('admin.anggota.index', compact('members'));
    }

    public function create()
    {
        return view('admin.anggota.create');
    }

    public function store(MemberRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = ImageUploadService::upload($request->file('foto'), 'members', 600, 600);
        }

        Member::create($data);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota baru berhasil ditambahkan ke panggung teater!');
    }

    public function edit(Member $member)
    {
        return view('admin.anggota.edit', compact('member'));
    }

    public function update(MemberRequest $request, Member $member)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            ImageUploadService::delete($member->foto);
            $data['foto'] = ImageUploadService::upload($request->file('foto'), 'members', 600, 600);
        }

        $member->update($data);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy(Member $member)
    {
        ImageUploadService::delete($member->foto);
        $member->delete();

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Data anggota berhasil dihapus.');
    }

    public function bulkAlumni(Request $request)
    {
        $request->validate([
            'member_ids' => 'required|array',
            'member_ids.*' => 'exists:members,id',
        ]);

        Member::whereIn('id', $request->member_ids)->update(['status' => 'alumni']);

        return redirect()->route('admin.anggota.index')
            ->with('success', count($request->member_ids) . ' anggota terpilih berhasil diubah statusnya menjadi Alumni!');
    }
}
