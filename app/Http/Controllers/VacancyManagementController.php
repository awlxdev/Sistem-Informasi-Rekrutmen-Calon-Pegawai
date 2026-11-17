<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class VacancyManagementController extends Controller
{
    private function prefix(Request $request): string
    {
        return str_starts_with(
            $request->route()->getName() ?? '',
            'hrd.'
        ) ? 'hrd' : 'admin';
    }

    private function pageData(Request $request): array
    {
        $prefix = $this->prefix($request);

        return [
            'routePrefix' => $prefix,
        ];
    }

    private function validationRules(?Vacancy $vacancy = null): array
    {
        return [
            'title' => ['required', 'string', 'max:150'],
            'department' => ['nullable', 'string', 'max:100'],
            'employment_type' => ['nullable', 'string', 'max:50'],
            'location' => ['nullable', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:50000'],
            'requirements' => ['nullable', 'string', 'max:50000'],
            'responsibilities' => ['nullable', 'string', 'max:50000'],
            'quota' => ['required', 'integer', 'min:1', 'max:100000'],
            'published_at' => ['nullable', 'date'],
            'closing_date' => [
                'nullable',
                'date',
                'after_or_equal:published_at',
            ],
            'status' => ['required', Rule::in(['draft', 'published', 'closed'])],
        ];
    }

    private function makeUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);

        if ($base === '') {
            $base = 'lowongan';
        }

        $slug = $base;
        $number = 2;

        while (
            Vacancy::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '-' . $number;
            $number++;
        }

        return $slug;
    }

    public function index(Request $request)
    {
        $query = Vacancy::query()
            ->with('creator')
            ->withCount('applications')
            ->latest();

        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') &&
            in_array($request->status, ['draft', 'published', 'closed'], true)) {
            $query->where('status', $request->status);
        }

        $vacancies = $query->paginate(10)->withQueryString();

        $statistics = [
            'total' => Vacancy::count(),
            'draft' => Vacancy::where('status', 'draft')->count(),
            'published' => Vacancy::where('status', 'published')->count(),
            'closed' => Vacancy::where('status', 'closed')->count(),
        ];

        return view(
            'management.vacancies.index',
            array_merge($this->pageData($request), compact('vacancies', 'statistics'))
        );
    }

    public function schedule(Request $request)
    {
        $vacancies = Vacancy::query()
            ->with('creator')
            ->withCount('applications')
            ->orderByRaw('CASE WHEN published_at IS NULL THEN 1 ELSE 0 END')
            ->orderBy('published_at', 'desc')
            ->paginate(15);

        $statistics = [
            'total' => Vacancy::count(),
            'published' => Vacancy::where('status', 'published')->count(),
            'draft' => Vacancy::where('status', 'draft')->count(),
            'closed' => Vacancy::where('status', 'closed')->count(),
        ];

        return view(
            'management.vacancies.schedule',
            array_merge(
                $this->pageData($request),
                compact('vacancies', 'statistics')
            )
        );
    }
    public function create(Request $request)
    {
        return view(
            'management.vacancies.create',
            $this->pageData($request)
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            $this->validationRules(),
            [
                'title.required' => 'Nama posisi wajib diisi.',
                'description.required' => 'Deskripsi pekerjaan wajib diisi.',
                'quota.required' => 'Kuota penerimaan wajib diisi.',
                'quota.min' => 'Kuota minimal 1 orang.',
                'closing_date.after_or_equal' => 'Batas pendaftaran tidak boleh sebelum tanggal publikasi.',
            ]
        );

        $validated['slug'] = $this->makeUniqueSlug($validated['title']);
        $validated['created_by'] = $request->user()->id;

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now()->toDateString();
        }

        Vacancy::create($validated);

        return redirect()
            ->route($this->prefix($request) . '.vacancies.index')
            ->with('success', 'Lowongan pekerjaan berhasil dibuat.');
    }

    public function edit(Request $request, Vacancy $vacancy)
    {
        return view(
            'management.vacancies.edit',
            array_merge(
                $this->pageData($request),
                compact('vacancy')
            )
        );
    }

    public function update(Request $request, Vacancy $vacancy)
    {
        $validated = $request->validate(
            $this->validationRules($vacancy),
            [
                'title.required' => 'Nama posisi wajib diisi.',
                'description.required' => 'Deskripsi pekerjaan wajib diisi.',
                'quota.required' => 'Kuota penerimaan wajib diisi.',
                'quota.min' => 'Kuota minimal 1 orang.',
                'closing_date.after_or_equal' => 'Batas pendaftaran tidak boleh sebelum tanggal publikasi.',
            ]
        );

        $validated['slug'] = $this->makeUniqueSlug(
            $validated['title'],
            $vacancy->id
        );

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = $vacancy->published_at?->toDateString()
                ?? now()->toDateString();
        }

        $vacancy->update($validated);

        return redirect()
            ->route($this->prefix($request) . '.vacancies.index')
            ->with('success', 'Informasi lowongan berhasil diperbarui.');
    }

    public function publish(Request $request, Vacancy $vacancy)
    {
        if (
            $vacancy->closing_date &&
            $vacancy->closing_date->lt(today())
        ) {
            return back()->with('error', 'Lowongan tidak dapat diterbitkan karena batas pendaftaran sudah lewat.');
        }

        $vacancy->update([
            'status' => 'published',
            'published_at' => $vacancy->published_at ?? today(),
        ]);

        return back()->with('success', 'Lowongan berhasil diterbitkan.');
    }

    public function close(Request $request, Vacancy $vacancy)
    {
        $vacancy->update(['status' => 'closed']);

        return back()->with('success', 'Pendaftaran lowongan berhasil ditutup.');
    }

    public function destroy(Request $request, Vacancy $vacancy)
    {
        if ($vacancy->applications()->exists()) {
            return back()->with(
                'error',
                'Lowongan tidak dapat dihapus karena sudah memiliki data lamaran. Silakan tutup lowongan tersebut.'
            );
        }

        DB::transaction(function () use ($vacancy) {
            $vacancy->delete();
        });

        return redirect()
            ->route($this->prefix($request) . '.vacancies.index')
            ->with('success', 'Lowongan berhasil dihapus.');
    }
}