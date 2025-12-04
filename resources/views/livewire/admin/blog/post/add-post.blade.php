<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">New Post</h4>
            <a href="{{ route('admin.blog.post.list') }}" class="btn btn-secondary">Back to list</a>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input wire:model.live="title" class="form-control @error('title') is-invalid @enderror">
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input wire:model.defer="slug" class="form-control @error('slug') is-invalid @enderror">
                            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Content</label>
                            <div wire:ignore>
                                <textarea id="main_content" class="form-control tinymce @error('main_content') is-invalid @enderror">{!! $main_content ?? '' !!}</textarea>
                            </div>
                            <input type="hidden" id="main_content_input" wire:model.defer="main_content">
                            @error('main_content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tags (comma separated)</label>
                            <input wire:model.defer="tags" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select wire:model.defer="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">-- Select --</option>
                                @foreach($categories as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta title</label>
                            <input wire:model.defer="meta_title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta description</label>
                            <textarea wire:model.defer="meta_description" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta keywords</label>
                            <input wire:model.defer="meta_keywords" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Featured image</label>
                            <input type="file" wire:model="featured_image" accept="image/*" class="form-control">
                            @error('featured_image') <div class="text-danger small">{{ $message }}</div> @enderror
                            <div class="mt-2">
                                <div wire:loading wire:target="featured_image" class="text-muted small">Uploading featured image…</div>
                                @if($featured_image)
                                <img src="{{ $featured_image->temporaryUrl() }}" style="width:140px;height:90px;object-fit:cover;" class="rounded">
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Thumbnail image</label>
                            <input type="file" wire:model="thumbnail_image" accept="image/*" class="form-control">
                            @error('thumbnail_image') <div class="text-danger small">{{ $message }}</div> @enderror
                            <div class="mt-2">
                                <div wire:loading wire:target="thumbnail_image" class="text-muted small">Uploading thumbnail…</div>
                                @if($thumbnail_image)
                                <img src="{{ $thumbnail_image->temporaryUrl() }}" style="width:120px;height:80px;object-fit:cover;" class="rounded">
                                @endif
                            </div>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary" type="submit" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="save">Save Post</span>
                                <span wire:loading wire:target="save"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving…</span>
                            </button>
                        </div>
                    </div>
                </div>
                        <script src="https://cdn.tiny.cloud/1/pvxf2rey6dhbd0zfoep9pxag4n66tqcoa74t54qq0aybqjbs/tinymce/8/tinymce.min.js" referrerpolicy="origin"></script>
                        <script>
                            function initTiny() {
                                if (typeof tinymce === 'undefined') return;
                                // remove existing editor if present
                                if (tinymce.get('main_content')) {
                                    tinymce.get('main_content').remove();
                                }
                                tinymce.init({
                                    selector: '#main_content',
                                    height: 400,
                                    plugins: 'link image media table code lists',
                                    toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image media | code',
                                    setup: function (editor) {
                                        // initialize editor content from hidden input (if any)
                                        var hidden = document.getElementById('main_content_input');
                                        try {
                                            var initial = hidden ? hidden.value : '';
                                            if (initial) {
                                                editor.setContent(initial);
                                            }
                                        } catch (e) {}

                                        function sync() {
                                            var content = editor.getContent();
                                            if (hidden) {
                                                hidden.value = content;
                                                hidden.dispatchEvent(new Event('input'));
                                            }
                                        }

                                        editor.on('Change KeyUp', sync);
                                    }
                                });
                            }

                            document.addEventListener('livewire:init', function () {
                                initTiny();
                                Livewire.hook('message.processed', (message, component) => {
                                    initTiny();
                                });
                            });
                        </script>
            </form>
        </div>
    </div>
</div>
