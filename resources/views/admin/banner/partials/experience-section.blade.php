<div class="card h-100" style="border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
    <div class="card-header" style="background: linear-gradient(135deg, #e67e22, #d35400); 
                                  color: white; 
                                  border-radius: 12px 12px 0 0; 
                                  padding: 18px 20px;">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="icon-briefcase me-2" style="font-size: 20px;"></i>
                <div>
                    <h5 class="mb-0" style="font-size: 16px; font-weight: 600;">Experience</h5>
                    <small class="opacity-75">Professional career</small>
                </div>
            </div>
            <a href="{{ route('admin.banner.experiences') }}" class="btn btn-sm btn-light"
               style="border: none; border-radius: 6px; padding: 5px 15px; font-size: 13px;">
                <i class="icon-edit me-1"></i> Manage
            </a>
        </div>
    </div>
    <div class="card-body" style="padding: 20px;">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <tbody>
                    @forelse($banner->experiences()->limit(3)->get() as $experience)
                    <tr style="border-bottom: 1px solid #f1f1f1;">
                        <td style="padding: 12px 0;">
                            <div class="d-flex">
                                <div class="me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #e67e22, #d35400); 
                                                        border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                    <i class="icon-briefcase text-white" style="font-size: 18px;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1" style="font-size: 14px; font-weight: 600; color: #2c3e50;">
                                        {{ $experience->position }}
                                    </h6>
                                    <p class="mb-1" style="font-size: 13px; color: #666;">
                                        {{ $experience->organization }}
                                    </p>
                                    <small class="text-muted" style="font-size: 12px;">
                                        {{ $experience->start_year }} - {{ $experience->end_year ?? 'Present' }}
                                    </small>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center py-4">
                            <i class="icon-briefcase text-muted mb-2" style="font-size: 32px;"></i>
                            <p class="text-muted mb-0" style="font-size: 14px;">No experience added yet</p>
                            <a href="{{ route('admin.banner.experiences') }}" class="btn btn-sm btn-primary mt-2"
                               style="background: linear-gradient(135deg, #e67e22, #d35400); border: none; border-radius: 6px; padding: 6px 15px; font-size: 13px;">
                                <i class="icon-plus me-1"></i> Add Experience
                            </a>
                        </td>
                    </tr>
                    @endforelse
                    
                    @if($banner->experiences()->count() > 3)
                    <tr>
                        <td class="text-center py-2">
                            <a href="{{ route('admin.banner.experiences') }}" class="text-primary" style="font-size: 13px;">
                                View all {{ $banner->experiences()->count() }} experience entries →
                            </a>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>