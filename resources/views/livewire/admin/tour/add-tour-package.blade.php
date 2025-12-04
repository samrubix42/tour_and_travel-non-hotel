<div class="page-body">
    <div class="container-xl">

        <h2 class="page-title mb-3">Add Tour Package</h2>

        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form wire:submit.prevent="store"  class="card card-lg">
            <div class="card-body">

                <!-- =======================
                     GENERAL INFORMATION
                ========================-->
                <h3 class="card-title">General Information</h3>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" wire:model.live="title" class="form-control" placeholder="Enter tour title">
                        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" wire:model="slug" class="form-control" placeholder="auto-generated or custom">
                        @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-12 mt-2">
                        <label class="form-label">Meta Title</label>
                        <input type="text" wire:model.defer="meta_title" class="form-control" placeholder="SEO meta title">
                        @error('meta_title') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-12 mt-2">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text" wire:model.defer="meta_keywords" class="form-control" placeholder="comma separated keywords">
                        @error('meta_keywords') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-12 mt-2">
                        <label class="form-label">Meta Description</label>
                        <textarea wire:model.defer="meta_description" class="form-control" rows="3" placeholder="Short meta description"></textarea>
                        @error('meta_description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <hr>

                <!-- =======================
                       CATEGORY CHECKBOXES
                ========================-->
                <h3 class="card-title mt-4">Categories</h3>
                <div class="row">
                    @foreach($allCategories as $cat)
                    <div class="col-md-3 mb-2">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" wire:model="category_ids" value="{{ $cat->id }}">
                            <span class="form-check-label">
                                {{ $cat->name }}
                            </span>
                        </label>
                    </div>
                    @endforeach
                </div>
                @error('category_ids') <small class="text-danger">{{ $message }}</small> @enderror

                <hr>

                <!-- =======================
                      DESTINATION CHECKBOXES
                ========================-->
                <h3 class="card-title mt-4">Destinations</h3>
                <div class="row">
                    @foreach($allDestinations as $dest)
                    <div class="col-md-3 mb-2">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" wire:model="destination_ids" value="{{ $dest->id }}">
                            <span class="form-check-label">
                                {{ $dest->name }}
                            </span>
                        </label>
                    </div>
                    @endforeach
                </div>
                @error('destination_ids') <small class="text-danger">{{ $message }}</small> @enderror

                <hr>

                <!-- =======================
                       EXPERIENCES
                ========================-->
                <h3 class="card-title mt-4">Experiences</h3>
                <div class="row">
                    @foreach($allExperiences as $exp)
                    <div class="col-md-3 mb-2">
                        <label class="form-check">
                            <input class="form-check-input" type="checkbox" wire:model="experience_ids" value="{{ $exp->id }}">
                            <span class="form-check-label">{{ $exp->name ?? $exp->title ?? 'Experience' }}</span>
                        </label>
                    </div>
                    @endforeach
                </div>
                @error('experience_ids') <small class="text-danger">{{ $message }}</small> @enderror

                <hr>

                <!-- =======================
                           ITINERARY
                ========================-->
                <h3 class="card-title mt-4">Itinerary</h3>

                @foreach($itineraryDays as $idx => $day)
                <div class="card mb-3">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <h4>Day {{ $idx + 1 }}</h4>
                            @if($idx !== 0)
                            <button type="button"
                                wire:click.prevent="removeItineraryDay({{ $idx }})"
                                class="btn btn-danger btn-sm">
                                Remove
                            </button>
                            @endif
                        </div>

                        <div class="mb-3 mt-2">
                            <label class="form-label">Day Title</label>
                            <input type="text" class="form-control"
                                   wire:model.defer="itineraryDays.{{ $idx }}.title"
                                   placeholder="e.g. Arrival & Check-in">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Points (one per line)</label>
                            <textarea class="form-control" rows="4"
                                      wire:model.defer="itineraryDays.{{ $idx }}.points_text"
                                      placeholder="Enter points..."></textarea>
                        </div>

                    </div>
                </div>
                @endforeach

                <button type="button" class="btn btn-outline-primary" wire:click.prevent="addItineraryDay">
                    + Add Day
                </button>

                <hr>

                <!-- =======================
                           DESCRIPTION
                ========================-->
                <h3 class="card-title mt-4">Description</h3>
                <div class="mb-3">
                    <textarea wire:model.defer="description" class="form-control" rows="6"
                              placeholder="Enter description"></textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <hr>

                <!-- =======================
                        INCLUDES / OPTIONAL
                ========================-->
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title">Includes</h3>
                        <div class="mb-2">
                            @foreach($includes as $i => $inc)
                            <div class="d-flex mb-2" style="gap:8px">
                                <input type="text" wire:model.defer="includes.{{ $i }}" class="form-control" placeholder="e.g. Breakfast">
                                <button type="button" class="btn btn-outline-danger" wire:click.prevent="removeInclude({{ $i }})">Remove</button>
                            </div>
                            @endforeach
                            <button type="button" class="btn btn-sm btn-outline-primary" wire:click.prevent="addInclude">+ Add Include</button>
                            @error('includes') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h3 class="card-title">Optional</h3>
                        <div class="mb-2">
                            @foreach($optional as $j => $opt)
                            <div class="d-flex mb-2" style="gap:8px">
                                <input type="text" wire:model.defer="optional.{{ $j }}" class="form-control" placeholder="e.g. Single supplement">
                                <button type="button" class="btn btn-outline-danger" wire:click.prevent="removeOptional({{ $j }})">Remove</button>
                            </div>
                            @endforeach
                            <button type="button" class="btn btn-sm btn-outline-primary" wire:click.prevent="addOptional">+ Add Optional</button>
                            @error('optional') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <hr>

                <!-- =======================
                        PRICE + FEATURED
                ========================-->
                <h3 class="card-title mt-4">Pricing Options</h3>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Price</label>
                        <input type="number" step="0.01" wire:model.defer="price" class="form-control">
                        @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <label class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" wire:model.defer="is_featured">
                            <span class="form-check-label">Make Featured</span>
                        </label>
                    </div>
                </div>

                <hr>

                <!-- =======================
                        FEATURED IMAGE
                ========================-->
                <h3 class="card-title mt-4">Featured Image</h3>
                <div class="mb-3">
                    <div class="d-flex gap-3 align-items-center">
                        <div>
                            <input id="featuredImageInput" type="file" wire:model="featuredImage" accept="image/*" hidden>
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('featuredImageInput').click()">Choose Featured Image</button>
                        </div>
                        <div>
                            @if(!empty($featuredImage) && method_exists($featuredImage,'temporaryUrl'))
                                <img src="{{ $featuredImage->temporaryUrl() }}" alt="preview" style="height:72px;object-fit:cover;border-radius:4px;">
                            @else
                                <span class="text-muted">No featured image selected</span>
                            @endif
                        </div>
                    </div>
                    @error('featuredImage') <small class="text-danger">{{ $message }}</small> @enderror
                </div>


                <!-- =======================
                     MULTIPLE IMAGES (TABLER)
                ========================-->
                <h3 class="card-title mt-4">Gallery Images</h3>

                <div class="mb-3">

                    <div id="dropzoneAdd"
                         class="border-dashed border p-4 rounded text-center cursor-pointer bg-light"
                         style="min-height:120px;">
                        <div class="text-muted mb-2">
                            Drag & drop images here or click to browse
                        </div>

                        <input id="imagesInput" type="file" wire:model="images"
                               multiple accept="image/*" hidden>
                        <button type="button" class="btn btn-secondary"
                                onclick="document.getElementById('imagesInput').click()">
                            Choose Files
                        </button>

                        <div class="text-center mt-2" wire:loading wire:target="images">
                            <span class="spinner-border spinner-border-sm"></span> Uploading...
                        </div>
                    </div>

                    <div class="row mt-3">
                        @if(!empty($images))
                        @foreach($images as $i => $img)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="ratio ratio-4x3">
                                    @if(method_exists($img,'temporaryUrl'))
                                    <img src="{{ $img->temporaryUrl() }}" class="card-img-top" style="object-fit:cover;">
                                    @endif
                                </div>
                                <div class="card-footer p-2">
                                    <button class="btn btn-danger w-100 btn-sm"
                                            wire:click.prevent="removeImage({{ $i }})">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>

                </div>

                <hr>

                <!-- SUBMIT -->
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading wire:target="store" class="spinner-border spinner-border-sm me-2"></span>
                        Create Package
                    </button>
                    <a href="{{ route('admin.tour.package.list') }}" class="btn btn-link">Back to list</a>
                </div>

            </div>
        </form>

    </div>
</div>
