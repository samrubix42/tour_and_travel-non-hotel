<div>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">Update Hotel</h1>
            <a href="{{ route('admin.hotel.list') }}" class="btn btn-outline-secondary btn-sm">Back to list</a>
        </div>

        <div class="card">
            <div class="card-body">
                <form wire:submit.prevent="saveHotel">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="card mb-3">
                        <div class="card-header bg-white">
                            <strong>Basic Info</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.live="name" placeholder="Hotel name">
                                        @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Slug</label>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror" wire:model.defer="slug" placeholder="auto generated">
                                        @error('slug') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Category</label>
                                        <select class="form-select @error('category_id') is-invalid @enderror" wire:model.defer="category_id">
                                            <option value="">-- Select Category --</option>
                                            @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Destination</label>
                                        <select class="form-select @error('destination_id') is-invalid @enderror" wire:model.defer="destination_id">
                                            <option value="">-- Select Destination --</option>
                                            @foreach($destinations as $dest)
                                            <option value="{{ $dest->id }}">{{ $dest->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('destination_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" wire:model.defer="address" placeholder="Street, city, country">
                                @error('address') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-3">
                                <div class="card-header bg-white"><strong>Contact & Media</strong></div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Phone</label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model.defer="phone" placeholder="e.g. +1 800 123 456">
                                                @error('phone') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model.defer="email" placeholder="contact@hotel.com">
                                                @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" wire:model="image">
                                        @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                        <div class="mt-2">
                                            <div wire:loading wire:target="image" class="text-muted small">
                                                <span class="spinner-border spinner-border-sm me-1" role="status"></span>Uploading image...
                                            </div>
                                            @if(!empty($existingImageUrl) || !empty($existingImagePath))
                                            <div class="mt-2">
                                                @if(!empty($existingImageUrl))
                                                <img src="{{ $existingImageUrl }}" alt="image" style="max-width:150px;">
                                                @elseif(!empty($existingImagePath))
                                                <img src="{{ asset('storage/' . $existingImagePath) }}" alt="image" style="max-width:150px;">
                                                @endif
                                            </div>
                                            @endif
                                            @if($image)
                                            <div class="mt-2">
                                                Photo Preview:
                                                <img src="{{ $image->temporaryUrl() }}" alt="preview" style="max-width:150px;">
                                            </div>
                                            @endif
                                        </div>
                                        <hr />
                                        <label class="form-label">Gallery images</label>
                                        <input type="file" class="form-control @error('gallery') is-invalid @enderror" wire:model="gallery" multiple>
                                        @error('gallery') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                        @error('gallery.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                        <div class="mt-2">
                                            <div wire:loading wire:target="gallery" class="text-muted small">
                                                <span class="spinner-border spinner-border-sm me-1" role="status"></span>Uploading gallery images...
                                            </div>
                                            @if(!empty($gallery))
                                            <div class="mt-2 d-flex gap-2 flex-wrap">
                                                @foreach($gallery as $g)
                                                <div style="width:100px;">
                                                    <img src="{{ $g->temporaryUrl() }}" alt="preview" style="width:100%; height:70px; object-fit:cover;">
                                                </div>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                        @if(!empty($existingGalleries))
                                        <div class="mt-2 d-flex gap-2 flex-wrap">
                                            @foreach($existingGalleries as $eg)
                                            <div style="width:100px; position:relative;">
                                                <img src="{{ $eg['image_url'] ?? (isset($eg['storage_path']) ? asset('storage/' . $eg['storage_path']) : '') }}" alt="thumb" style="width:100%; height:70px; object-fit:cover; border:1px solid #ddd;">
                                                <button class="btn btn-sm btn-danger" style="position:absolute; top:4px; right:4px;" type="button" wire:click.prevent="removeGallery({{ $eg['id'] }})">&times;</button>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="status" wire:model.defer="status">
                                        <label class="form-check-label" for="status">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card mb-3">
                                <div class="card-header bg-white"><strong>Details</strong></div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Rating</label>
                                        <input type="number" step="0.1" min="0" max="5" class="form-control @error('rating') is-invalid @enderror" wire:model.defer="rating">
                                        @error('rating') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Short Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" rows="4" wire:model.defer="description"></textarea>
                                        @error('description') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Long Description</label>
                                        <div wire:ignore>
                                            <textarea id="long_description">{!! $long_description ?? '' !!}</textarea>
                                        </div>
                                        @error('long_description') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Location</label>
                                        <input type="text" class="form-control @error('location') is-invalid @enderror" wire:model.defer="location" placeholder="Latitude, Longitude or address">
                                        @error('location') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Map Embed (iframe)</label>
                                        <textarea class="form-control @error('map_embed') is-invalid @enderror" rows="3" wire:model.defer="map_embed" placeholder="Paste iframe embed code"></textarea>
                                        @error('map_embed') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header bg-white"><strong>Amenities</strong></div>
                        <div class="card-body">
                            @foreach($amenities as $i => $a)
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" wire:model.defer="amenities.{{ $i }}" placeholder="e.g. Free Wi-Fi">
                                <button class="btn btn-outline-danger" type="button" wire:click.prevent="removeAmenity({{ $i }})">Delete</button>
                            </div>
                            @endforeach
                            <button class="btn btn-sm btn-outline-primary" type="button" wire:click.prevent="addAmenity">Add amenity</button>
                            @error('amenities') <div class="invalid-feedback d-block mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header bg-white"><strong>Facilities</strong></div>
                        <div class="card-body">
                            @foreach($facilities as $i => $f)
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" wire:model.defer="facilities.{{ $i }}" placeholder="e.g. 24/7 Reception">
                                <button class="btn btn-outline-danger" type="button" wire:click.prevent="removeFacility({{ $i }})">Delete</button>
                            </div>
                            @endforeach
                            <button class="btn btn-sm btn-outline-primary" type="button" wire:click.prevent="addFacility">Add facility</button>
                            @error('facilities') <div class="invalid-feedback d-block mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header bg-white"><strong>SEO / Meta</strong></div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Meta title</label>
                                <input type="text" class="form-control" wire:model.defer="meta_title">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meta description</label>
                                <input type="text" class="form-control" wire:model.defer="meta_description">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Meta keywords</label>
                                <input type="text" class="form-control" wire:model.defer="meta_keywords">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.hotel.list') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading wire:target="saveHotel" class="spinner-border spinner-border-sm me-2"></span>
                            Save Hotel
                        </button>
                    </div>
                </form>
                <script src="https://cdn.tiny.cloud/1/pvxf2rey6dhbd0zfoep9pxag4n66tqcoa74t54qq0aybqjbs/tinymce/8/tinymce.min.js" referrerpolicy="origin"></script>
                <script>
                    document.addEventListener('livewire:init', function() {
                        initTiny();
                        Livewire.hook('message.processed', () => {
                            if (!tinymce.get('long_description')) initTiny();
                        });
                    });

                    function initTiny() {
                        tinymce.init({
                            selector: '#long_description',
                            height: 350,
                            menubar: false,
                            plugins: 'lists link image table code',
                            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
                            setup: function(editor) {
                                editor.on('Change KeyUp', function() {
                                    @this.set('long_description', editor.getContent());
                                });
                                editor.on('init', function() {
                                    const content = @json($long_description ?? '');
                                    if (content) editor.setContent(content);
                                });
                            }
                        });
                    }
                </script>
            </div>
        </div>
    </div>
</div>