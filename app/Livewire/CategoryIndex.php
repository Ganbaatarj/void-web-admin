<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public int $perPage = 10;

    // form fields
    public ?int $editingId = null;
    public string $name = '';
    public string $description = '';
    public bool $is_active = true;

    public bool $showModal = false;
    public bool $confirmingDelete = false;
    public ?int $deleteId = null;

    protected function rules(): array
    {
        $unique = 'unique:categories,name';
        if ($this->editingId) {
            $unique .= ',' . $this->editingId;
        }
        return [
            'name' => ['required', 'string', 'max:100', $unique],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['boolean'],
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openCreate()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEdit(int $id)
    {
        $cat = Category::findOrFail($id);
        $this->editingId = $cat->id;
        $this->name = $cat->name;
        $this->description = $cat->description ?? '';
        $this->is_active = $cat->is_active;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $payload = [
            'name' => trim($this->name),
            'slug' => Str::slug($this->name),
            'description' => $this->description ?: null,
            'is_active' => $this->is_active,
        ];

        if ($this->editingId) {
            Category::whereKey($this->editingId)->update($payload);
            session()->flash('success', 'Ангилал амжилттай шинэчиллээ.');
        } else {
            Category::create($payload);
            session()->flash('success', 'Ангилал амжилттай нэмлээ.');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function confirmDelete(int $id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function delete()
    {
        if ($this->deleteId) {
            Category::whereKey($this->deleteId)->delete();
            session()->flash('success', 'Ангиллыг устгалаа (soft delete).');
        }
        $this->deleteId = null;
        $this->confirmingDelete = false;
    }

    public function restore(int $id)
    {
        Category::withTrashed()->whereKey($id)->restore();
        session()->flash('success', 'Ангиллыг сэргээв.');
    }

    private function resetForm()
    {
        $this->reset(['editingId', 'name', 'description', 'is_active']);
        $this->is_active = true;
    }

    public function render()
    {
        $q = Category::query()
            ->withTrashed()
            ->when(
                $this->search,
                fn($qq) =>
                $qq->where(function ($w) {
                    $w->where('name', 'like', "%{$this->search}%")
                        ->orWhere('slug', 'like', "%{$this->search}%");
                })
            )
            ->orderByDesc('id');

        $categories = $q->paginate($this->perPage);

        return view('livewire.category-index', compact('categories'))
            ->layout('layouts.app')
            ->title('Ангилал');
    }
}

