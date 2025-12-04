<?php

namespace App\View\Builders;

use Illuminate\Support\Collection;

class AdminSidebar
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public static function menu($user): self
    {
        return new self($user);
    }

    public function get(): Collection
    {
        $menu = collect([
            (object)[
                'title' => 'Dashboard',
                'icon' => 'ti ti-home',
                'url' => route('admin.dashboard'),
                'hasSubmenu' => false,
                'submenu' => [],
            ],
            (object)[
                'title' => 'Tour & Travel',
                'icon' => 'ti ti-map',
                'url' => '#',
                'hasSubmenu' => true,
                'submenu' => [
                    (object)[
                        'title' => 'Categories',
                        'url' => route('admin.tour.category.list'),
                    ],
                    (object)[
                        'title' => 'Destinations',
                        'url' => route('admin.tour.destination.list'),
                    ],
                    (object)[
                        'title' => 'Experiences',
                        'url' => route('admin.tour.experience.list'),
                    ],
                    (object)[
                        'title' => 'Tour Packages',
                        'url' => route('admin.tour.package.list'),
                    ],
                ],
            ],
            (object)[
                'title' => 'Banners',
                'icon' => 'ti ti-photo',
                'url' => route('admin.banners'),
                'hasSubmenu' => false,
                'submenu' => [],
            ],
            (object)[
                'title' => 'Page Management',
                'icon' => 'ti ti-file-text',
                'url' => route('admin.page.management'),
                'hasSubmenu' => false,
                'submenu' => [],
            ],
            (object)[
                'title' => 'Blog',
                'icon' => 'ti ti-article',
                'url' => '#',
                'hasSubmenu' => true,
                'submenu' => [
                    (object)[
                        'title' => 'Categories',
                        'url' => route('admin.blog.category.list'),
                    ],
                    (object)[
                        'title' => 'Blog Posts',
                        'url' => route('admin.blog.post.list'),
                    ],
                ],
            ],
            (object)[
                'title' => 'Enquiries',
                'icon' => 'ti ti-mail',
                'url' => '#',
                'hasSubmenu' => true,
                'submenu' => [
                    (object)[
                        'title' => 'Tour Enquiries',
                        'url' => route('admin.enquire.tour.contact.list'),
                    ],
                    (object)[
                        'title' => 'Hotel Enquiries',
                        'url' => route('admin.enquire.hotel.contact.list'),
                    ],
                ],
            ],
            (object)[
                'title' => 'Hotel',
                'icon' => 'ti ti-building-hospital',
                'url' => '#',
                'hasSubmenu' => true,
                'submenu' => [
                    (object)[
                        'title' => 'Categories',
                        'url' => route('admin.hotel.category.list'),
                    ],
                    (object)[
                        'title' => 'Hotel List',
                        'url' => route('admin.hotel.list'),
                    ],
                    (object)[
                        'title' => 'Add Hotel',
                        'url' => route('admin.hotel.create'),
                    ],
                ],
            ],
            (object)[
                'title' => 'Settings',
                'icon' => 'ti ti-settings',
                'url' => route('admin.settings'),
                'hasSubmenu' => false,
                'submenu' => [],
            ],
        ]);
        return $menu;
    }
}
