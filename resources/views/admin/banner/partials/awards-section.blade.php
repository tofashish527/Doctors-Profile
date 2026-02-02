<div class="card h-100" style="border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
    <div class="card-header" style="background: linear-gradient(135deg, #f39c12, #e67e22); 
                                  color: white; 
                                  border-radius: 12px 12px 0 0; 
                                  padding: 18px 20px;">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="icon-award me-2" style="font-size: 20px;"></i>
                <div>
                    <h5 class="mb-0" style="font-size: 16px; font-weight: 600;">Awards & Recognition</h5>
                    <small class="opacity-75">Professional achievements</small>
                </div>
            </div>
            <a href="{{ route('admin.banner.awards') }}" class="btn btn-sm btn-light"
               style="border: none; border-radius: 6px; padding: 5px 15px; font-size: 13px;">
                <i class="icon-edit me-1"></i> Manage
            </a>
        </div>
    </div>
    <div class="card-body" style="padding: 20px;">
        <div class="row g-3">
            @forelse($banner->awards()->limit(4)->get() as $award)
            <div class="col-md-6">
                <div class="award-item d-flex align-items-start p-3 border rounded">
                    <div class="award-icon me-3" style="font-size: 24px; color: #f39c12;">
                        <i class="{{ $award->icon }}"></i>
                    </div>
                    <div>
                        <h6 class="mb-1" style="font-size: 14px; font-weight: 600;">{{ $award->title }}</h6>
                        <small class="text-muted">{{ $award->organization }}, {{ $award->year }}</small>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-4">
                <i class="icon-award text-muted mb-2" style="font-size: 32px;"></i>
                <p class="text-muted mb-0" style="font-size: 14px;">No awards added yet</p>
                <a href="{{ route('admin.banner.awards') }}" class="btn btn-sm btn-primary mt-2"
                   style="background: linear-gradient(135deg, #f39c12, #e67e22); border: none; border-radius: 6px; padding: 6px 15px; font-size: 13px;">
                    <i class="icon-plus me-1"></i> Add Award
                </a>
            </div>
            @endforelse
            
            @if($banner->awards()->count() > 4)
            <div class="col-12 text-center">
                <a href="{{ route('admin.banner.awards') }}" class="text-primary" style="font-size: 13px;">
                    View all {{ $banner->awards()->count() }} awards →
                </a>
            </div>
            @endif
        </div>
    </div>
</div>