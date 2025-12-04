<?php

namespace App\Livewire\Admin\Dashboard;


use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Hotel;
use App\Models\TourPackage;
use App\Models\Destination;
use App\Models\User;
use App\Models\ContactForHotel;
use App\Models\ContactForTour;
use Carbon\Carbon;
use App\Models\Banner;
use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\Contact;
use App\Models\DestinationCategory;
use App\Models\Experience;
use App\Models\HotelCategory;
use App\Models\HotelGallery;
use App\Models\Page;
use App\Models\Post;
use App\Models\TourPackageCategory;
use App\Models\TourPackageDestination;
use App\Models\TourPackageExperience;
use App\Models\TourPackageGallery;
use Livewire\Attributes\Title;

class Dashboard extends Component
{
    public array $counts = [];
    public array $labels = [];
    public array $chartLabels = [];
    public array $chartDatasets = [];
    public $recentHotelContacts = [];
    public $recentTourContacts = [];
    public $recentHotels = [];
    public $recentTours = [];
    public $recentDestinations = [];
    public $recentPosts = [];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData(): void
    {
        $this->counts = [
            'banners' => Banner::count(),
            'categories' => Category::count(),
            'blog_categories' => BlogCategory::count(),
            'destinations' => Destination::count(),
            'destination_categories' => DestinationCategory::count(),
            'experiences' => Experience::count(),
            'hotels' => Hotel::count(),
            'hotel_categories' => HotelCategory::count(),
            'hotel_galleries' => HotelGallery::count(),
            'pages' => Page::count(),
            'posts' => Post::count(),
            'tour_packages' => TourPackage::count(),
            'tour_package_categories' => TourPackageCategory::count(),
            'tour_package_destinations' => TourPackageDestination::count(),
            'tour_package_experiences' => TourPackageExperience::count(),
            'tour_package_galleries' => TourPackageGallery::count(),
            'users' => User::count(),
            'contacts' => Contact::count(),
            'hotel_contacts' => ContactForHotel::count(),
            'tour_contacts' => ContactForTour::count(),
        ];

        $this->labels = [
            'banners' => 'Banners',
            'categories' => 'Categories',
            'blog_categories' => 'Blog Categories',
            'destinations' => 'Destinations',
            'destination_categories' => 'Destination Categories',
            'experiences' => 'Experiences',
            'hotels' => 'Hotels',
            'hotel_categories' => 'Hotel Categories',
            'hotel_galleries' => 'Hotel Galleries',
            'pages' => 'Pages',
            'posts' => 'Posts',
            'tour_packages' => 'Tour Packages',
            'tour_package_categories' => 'Tour Package Categories',
            'tour_package_destinations' => 'Tour Package Destinations',
            'tour_package_experiences' => 'Tour Package Experiences',
            'tour_package_galleries' => 'Tour Package Galleries',
            'users' => 'Users',
            'contacts' => 'Contacts',
            'hotel_contacts' => 'Hotel Contacts',
            'tour_contacts' => 'Tour Contacts',
        ];

        $this->recentHotelContacts = ContactForHotel::orderBy('created_at', 'desc')->take(6)->get();
        $this->recentTourContacts = ContactForTour::orderBy('created_at', 'desc')->take(6)->get();
        $this->recentHotels = Hotel::orderBy('created_at', 'desc')->take(6)->get();
        $this->recentTours = TourPackage::orderBy('created_at', 'desc')->take(6)->get();
        $this->recentDestinations = Destination::orderBy('created_at', 'desc')->take(6)->get();
        $this->recentPosts = Post::orderBy('created_at', 'desc')->take(6)->get();

        // Prepare simple last-6-month labels and datasets for a small line chart
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $m = Carbon::now()->subMonths($i);
            $months[] = $m;
            $this->chartLabels[] = $m->format('M Y');
        }

        $hotelCounts = [];
        $tourCounts = [];
        $postCounts = [];

        foreach ($months as $m) {
            $hotelCounts[] = Hotel::whereYear('created_at', $m->year)->whereMonth('created_at', $m->month)->count();
            $tourCounts[] = TourPackage::whereYear('created_at', $m->year)->whereMonth('created_at', $m->month)->count();
            $postCounts[] = Post::whereYear('created_at', $m->year)->whereMonth('created_at', $m->month)->count();
        }

        $this->chartDatasets = [
            [
                'label' => 'Hotels',
                'data' => $hotelCounts,
                'borderColor' => '#0d6efd',
                'backgroundColor' => 'rgba(13,110,253,0.08)',
                'tension' => 0.3,
            ],
            [
                'label' => 'Tour Packages',
                'data' => $tourCounts,
                'borderColor' => '#198754',
                'backgroundColor' => 'rgba(25,135,84,0.08)',
                'tension' => 0.3,
            ],
            [
                'label' => 'Posts',
                'data' => $postCounts,
                'borderColor' => '#fd7e14',
                'backgroundColor' => 'rgba(253,126,20,0.08)',
                'tension' => 0.3,
            ],
        ];
    }
    #[Layout('components.layouts.admin')]
    #[Title('Dashboard')]
    public function render()
    {
        return view('livewire.admin.dashboard.dashboard', [
            'counts' => $this->counts,
            'labels' => $this->labels,
            'recentHotelContacts' => $this->recentHotelContacts,
            'recentTourContacts' => $this->recentTourContacts,
            'recentHotels' => $this->recentHotels,
            'recentTours' => $this->recentTours,
            'recentDestinations' => $this->recentDestinations,
            'recentPosts' => $this->recentPosts,
        ]);
    }
}
