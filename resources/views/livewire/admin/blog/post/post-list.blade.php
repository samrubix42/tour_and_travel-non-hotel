<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-white">
            <div>
                <h4 class="mb-0">Posts</h4>
                <p class="small text-muted mb-0">Manage blog posts</p>
            </div>
            <a href="{{ route('admin.blog.post.create') }}" class="btn btn-primary">New Post</a>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 d-flex gap-2">
                    <input wire:model.debounce.live.300ms="search" class="form-control" placeholder="Search posts...">
                    <select wire:model="perPage" class="form-select" style="width:90px;">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                    </select>
                </div>
            </div>

            @if(session()->has('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Created</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                        <tr>
                            <td style="width:64px;">
                                @if($post->thumbnail_image)
                                <img src="{{ $post->thumbnail_image }}" alt="" class="rounded" style="width:56px;height:56px;object-fit:cover;">
                                @else
                                <div class="bg-light rounded" style="width:56px;height:56px;"></div>
                                @endif
                            </td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category->name ?? '-' }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>{{ $post->created_at->format('Y-m-d') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.blog.post.edit', $post->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <button wire:click="delete({{ $post->id }})" class="btn btn-sm btn-outline-danger">Delete</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No posts found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex align-items-center">
            <div class="m-0 text-muted">Showing {{ $posts->firstItem() ?? 0 }} to {{ $posts->lastItem() ?? 0 }} of {{ $posts->total() }}</div>
            <div class="ms-auto">{{ $posts->links() }}</div>
        </div>
    </div>
</div>
