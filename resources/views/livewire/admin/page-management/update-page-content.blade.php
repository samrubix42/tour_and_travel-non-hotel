<div>
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body">
                        <h3 class="mb-3">Edit Page</h3>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold">Page Title</label>
                                <input type="text" wire:model="page_title" class="form-control form-control-lg">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Slug</label>
                                <input type="text" wire:model="slug" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Page Content</label>
                                <div wire:ignore>
                                    <textarea id="editor-update" class="form-control">{!! $page_content ?? '' !!}</textarea>
                                </div>
                                <input type="hidden" id="page_content_input_update" wire:model="page_content">
                            </div>
                            <hr class="my-3">
                            <h4 class="fw-bold">SEO Settings</h4>
                            <div class="col-12">
                                <label class="form-label">Meta Title</label>
                                <input type="text" wire:model="meta_title" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Meta Description</label>
                                <textarea wire:model="meta_description" rows="2" class="form-control"></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Meta Keywords</label>
                                <input type="text" wire:model="meta_keywords" class="form-control" placeholder="keyword1, keyword2">
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('admin.page.management') }}" class="btn btn-secondary">Back</a>
                            <button class="btn btn-primary" wire:click="savePage">Save Page</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.tiny.cloud/1/pvxf2rey6dhbd0zfoep9pxag4n66tqcoa74t54qq0aybqjbs/tinymce/8/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        function initTinyUpdate() {
            if (typeof tinymce === 'undefined') return;
            const textarea = document.getElementById('editor-update');
            if (!textarea) return;
            if (tinymce.get('editor-update')) tinymce.get('editor-update').remove();

            tinymce.init({
                selector: '#editor-update',
                height: 400,
                plugins: 'link image media table code lists',
                toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image media | code',
                setup: function (editor) {
                    editor.on('init', function () {
                        try {
                            const hidden = document.getElementById('page_content_input_update');
                            if (hidden && hidden.value) editor.setContent(hidden.value);
                        } catch (e) {}
                    });
                    const sync = function () {
                        const content = editor.getContent();
                        try {
                            const hidden = document.getElementById('page_content_input_update');
                            if (hidden) { hidden.value = content; hidden.dispatchEvent(new Event('input', { bubbles: true })); }
                        } catch (e) {}
                    };
                    editor.on('change keyup paste', sync);
                }
            });
        }

        document.addEventListener('livewire:init', function () {
            initTinyUpdate();
            if (window.Livewire && Livewire.hook) Livewire.hook('message.processed', () => initTinyUpdate());
        });
    </script>
</div>

