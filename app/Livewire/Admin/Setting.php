<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting as SettingModel;
use Illuminate\Support\Str;

class Setting extends Component
{
    use WithFileUploads;
    public $key = '';
    public $value = '';
    public array $settings = [];
    public array $common = [
        'address' => '',
        'phone' => '',
        'phone_2' => '',
        'location' => '',
        'map_link' => '',
        'email' => '',
        'email_hr' => '',
        'instagram' => '',
        'facebook' => '',
        'twitter' => '',
        'linkedin' => '',
        'dribbble' => '',
        'youtube' => '',
        'logo' => '',
        'favicon' => '',
    ];
    public $logo;
    public $favicon;

    public function mount(): void
    {
        $this->loadSettings();
    }

    public function loadSettings(): void
    {
        $all = SettingModel::all()->pluck('value', 'key')->toArray();
        $this->settings = $all;
        foreach ($this->common as $k => $v) {
            $this->common[$k] = $all[$k] ?? '';
        }
    }

    public function saveCommon(): void
    {
        // handle logo upload
        if ($this->logo) {
            $path = $this->logo->store('settings', 'public');
            $logoUrl = 'storage/' . $path;
            SettingModel::updateOrCreate(['key' => 'logo'], ['value' => $logoUrl]);
            $this->common['logo'] = $logoUrl;
        }

        // handle favicon upload
        if ($this->favicon) {
            $path = $this->favicon->store('settings', 'public');
            $favUrl = 'storage/' . $path;
            SettingModel::updateOrCreate(['key' => 'favicon'], ['value' => $favUrl]);
            $this->common['favicon'] = $favUrl;
        }

        foreach ($this->common as $k => $v) {
            SettingModel::updateOrCreate(['key' => $k], ['value' => $v]);
        }

        $this->loadSettings();
        $this->dispatch('success','Settings saved successfully.');
    }

    public function addSetting(): void
    {
        $this->validate([
            'key' => 'required|string|max:191',
            'value' => 'nullable|string',
        ]);

        $k = Str::slug($this->key, '_');
        SettingModel::updateOrCreate(['key' => $k], ['value' => $this->value]);
        $this->key = '';
        $this->value = '';
        $this->loadSettings();
        $this->dispatch('success','Settings saved successfully.');
    }

    public function deleteSetting(string $key): void
    {
        SettingModel::where('key', $key)->delete();
        $this->loadSettings();
        $this->dispatch('success','Setting removed successfully.');
    }
    #[Layout('components.layouts.admin')]
    #[Title('Settings')]
    public function render()
    {
        return view('livewire.admin.setting');
    }
}
