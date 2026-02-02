<div class="card h-100" style="border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
    <div class="card-header" style="background: linear-gradient(135deg, #3498db, #2980b9); 
                                  color: white; 
                                  border-radius: 12px 12px 0 0; 
                                  padding: 18px 20px;">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="icon-book-open me-2" style="font-size: 20px;"></i>
                <div>
                    <h5 class="mb-0" style="font-size: 16px; font-weight: 600;">Education</h5>
                    <small class="opacity-75">Academic background</small>
                </div>
            </div>
            <a href="{{ route('admin.banner.educations') }}" class="btn btn-sm btn-light"
               style="border: none; border-radius: 6px; padding: 5px 15px; font-size: 13px;">
                <i class="icon-edit me-1"></i> Manage
            </a>
        </div>
    </div>
    <div class="card-body" style="padding: 20px;">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <tbody>
                    @forelse($banner->educations()->limit(3)->get() as $education)
                    <tr style="border-bottom: 1px solid #f1f1f1;">
                        <td style="padding: 12px 0;">
                            <div class="d-flex">
                                <div class="me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #3498db, #2980b9); 
                                                        border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                    <i class="icon-graduation-cap text-white" style="font-size: 18px;"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1" style="font-size: 14px; font-weight: 600; color: #2c3e50;">
                                        {{ $education->degree_title }}
                                    </h6>
                                    <p class="mb-1" style="font-size: 13px; color: #666;">
                                        {{ $education->institution }}
                                    </p>
                                    <small class="text-muted" style="font-size: 12px;">
                                        {{ $education->start_year }} - {{ $education->end_year }}
                                    </small>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center py-4">
                            <i class="icon-book-open text-muted mb-2" style="font-size: 32px;"></i>
                            <p class="text-muted mb-0" style="font-size: 14px;">No education added yet</p>
                            <a href="{{ route('admin.banner.educations') }}" class="btn btn-sm btn-primary mt-2"
                               style="background: linear-gradient(135deg, #3498db, #2980b9); border: none; border-radius: 6px; padding: 6px 15px; font-size: 13px;">
                                <i class="icon-plus me-1"></i> Add Education
                            </a>
                        </td>
                    </tr>
                    @endforelse
                    
                    @if($banner->educations()->count() > 3)
                    <tr>
                        <td class="text-center py-2">
                            <a href="{{ route('admin.banner.educations') }}" class="text-primary" style="font-size: 13px;">
                                View all {{ $banner->educations()->count() }} education entries →
                            </a>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>