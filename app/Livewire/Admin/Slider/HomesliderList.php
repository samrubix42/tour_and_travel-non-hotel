<?php

namespace App\Livewire\Admin\Slider;

use Livewire\Component;
use App\Models\Homeslider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Throwable;

class HomesliderList extends Component
{
    use WithFileUploads;

    public $image;
    public $editImage;
    public $editingId = null;
    public $deleteId = null;
    public $showDeleteModal = false;

    public function save(): void
    {
        $validated = $this->validate([
            'image' => ['required', 'image', 'max:4096'],
        ]);

        try {
            $path = $validated['image']->store('homesliders', 'public');

            Homeslider::create([
                'image_path' => $path,
            ]);

            $this->reset('image');
            $this->dispatch('slider-uploaded');
            $this->dispatch('success', 'Home slider uploaded successfully.');
        } catch (Throwable $exception) {
            report($exception);
            $this->dispatch('error', 'Upload failed. Please try again.');
        }
    }

    public function startEdit(int $id): void
    {
        $this->editingId = $id;
        $this->resetErrorBag();
        $this->editImage = null;
    }

    public function cancelEdit(): void
    {
        $this->editingId = null;
        $this->editImage = null;
        $this->resetErrorBag();
    }

    public function update(): void
    {
        $validated = $this->validate([
            'editImage' => ['required', 'image', 'max:4096'],
        ]);

        $slider = Homeslider::find($this->editingId);

        if (! $slider) {
            $this->dispatch('error', 'Slider not found.');
            $this->cancelEdit();
            return;
        }

        try {
            $newPath = $validated['editImage']->store('homesliders', 'public');

            if ($slider->image_path && ! Str::startsWith($slider->image_path, ['http://', 'https://'])) {
                Storage::disk('public')->delete($slider->image_path);
            }

            $slider->update([
                'image_path' => $newPath,
            ]);

            $this->cancelEdit();
            $this->dispatch('success', 'Home slider updated successfully.');
        } catch (Throwable $exception) {
            report($exception);
            $this->dispatch('error', 'Update failed. Please try again.');
        }
    }

    public function delete(int $id): void
    {
        $slider = Homeslider::find($id);

        if (! $slider) {
            $this->dispatch('error', 'Slider not found.');
            return;
        }

        try {
            if ($slider->image_path && ! Str::startsWith($slider->image_path, ['http://', 'https://'])) {
                Storage::disk('public')->delete($slider->image_path);
            }

            $slider->delete();

            if ($this->editingId === $id) {
                $this->cancelEdit();
            }

            $this->dispatch('success', 'Home slider deleted successfully.');
        } catch (Throwable $exception) {
            report($exception);
            $this->dispatch('error', 'Delete failed. Please try again.');
        }
    }

    public function openDeleteModal(int $id): void
    {
        $this->deleteId = $id;
        $this->showDeleteModal = true;
    }

    public function closeDeleteModal(): void
    {
        $this->showDeleteModal = false;
        $this->deleteId = null;
    }

    public function confirmDelete(): void
    {
        if (! $this->deleteId) {
            $this->dispatch('error', 'No slider selected for delete.');
            return;
        }

        $this->delete((int) $this->deleteId);
        $this->closeDeleteModal();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $sliders = Homeslider::latest()->get();
        return view('livewire.admin.slider.homeslider-list', compact('sliders'));
    }
}
