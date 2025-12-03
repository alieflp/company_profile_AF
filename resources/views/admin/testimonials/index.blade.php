@extends('layouts.admin')
@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-slate-900">Testimonials</h2>
    <p class="text-sm text-slate-600 mt-1">Review and approve client testimonials</p>
</div>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Client</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Message</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Rating</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @foreach($testimonials ?? [] as $testimonial)
                <tr class="hover:bg-slate-50 transition">
                    <td class="px-6 py-4">
                        <div>
                            <p class="font-semibold text-slate-900">{{ $testimonial->name }}</p>
                            @if($testimonial->company)
                                <p class="text-xs text-slate-500">{{ $testimonial->company }}</p>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <button type="button" onclick="showTestimonialModal(this)" 
                            data-name="{{ $testimonial->name }}"
                            data-company="{{ $testimonial->company ?? '' }}"
                            data-position="{{ $testimonial->position ?? '' }}"
                            data-message="{{ $testimonial->message ?? $testimonial->content ?? '' }}"
                            data-rating="{{ $testimonial->rating ?? 0 }}"
                            class="text-sm text-blue-600 hover:text-blue-700 font-medium text-left hover:underline">
                            {{ Str::limit($testimonial->message ?? $testimonial->content ?? '', 80) }}
                        </button>
                    </td>
                    <td class="px-6 py-4">
                        @if(!empty($testimonial->rating))
                            <div class="flex items-center gap-1">
                                @for($i=1; $i<=5; $i++)
                                    @php $filled = $i <= (int) $testimonial->rating; @endphp
                                    <svg class="h-4 w-4 {{ $filled ? 'text-amber-400' : 'text-slate-300' }}" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.802 2.035a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.802-2.035a1 1 0 00-1.176 0l-2.802 2.035c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                            </div>
                        @else
                            <span class="text-xs text-slate-400">No rating</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($testimonial->is_approved ?? $testimonial->approved ?? false)
                            <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Published
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 rounded-full bg-amber-100 px-2.5 py-1 text-xs font-medium text-amber-700">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                                Pending
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            @if(!($testimonial->is_approved ?? $testimonial->approved ?? false))
                                <form method="POST" action="{{ route('admin.testimonials.update', $testimonial->id) }}" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="is_approved" value="1">
                                    <input type="hidden" name="name" value="{{ $testimonial->name }}">
                                    <input type="hidden" name="message" value="{{ $testimonial->message ?? $testimonial->content ?? '' }}">
                                    <button type="submit" class="inline-flex items-center gap-1 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:from-blue-700 hover:to-cyan-700 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        Approve
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.testimonials.update', $testimonial->id) }}" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="is_approved" value="0">
                                    <input type="hidden" name="name" value="{{ $testimonial->name }}">
                                    <input type="hidden" name="message" value="{{ $testimonial->message ?? $testimonial->content ?? '' }}">
                                    <button type="submit" class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-200 transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        Unpublish
                                    </button>
                                </form>
                            @endif
                            <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 rounded-lg bg-red-50 px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-100 transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            @if(empty($testimonials) || count($testimonials) === 0)
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>
                        <p class="text-lg font-semibold text-slate-700 mb-1">No Testimonials Yet</p>
                        <p class="text-sm text-slate-500">Client testimonials will appear here once submitted</p>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

{{-- Modal for viewing full testimonial --}}
<div id="testimonialModal" class="hidden fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 p-4" style="display: none; align-items: center; justify-content: center;">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between rounded-t-2xl">
            <h3 class="text-lg font-bold text-slate-900">Testimonial Details</h3>
            <button onclick="closeTestimonialModal()" class="text-slate-400 hover:text-slate-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-6 space-y-6">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Client Name</p>
                <p id="modal-name" class="text-lg font-semibold text-slate-900"></p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Position</p>
                    <p id="modal-position" class="text-sm text-slate-700"></p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Company</p>
                    <p id="modal-company" class="text-sm text-slate-700"></p>
                </div>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase mb-1">Rating</p>
                <div id="modal-rating" class="flex items-center gap-1"></div>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase mb-2">Testimonial Message</p>
                <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                    <p id="modal-message" class="text-slate-700 leading-relaxed whitespace-pre-wrap"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showTestimonialModal(button) {
    const modal = document.getElementById('testimonialModal');
    const name = button.dataset.name;
    const company = button.dataset.company || '-';
    const position = button.dataset.position || '-';
    const message = button.dataset.message;
    const rating = parseInt(button.dataset.rating) || 0;
    
    document.getElementById('modal-name').textContent = name;
    document.getElementById('modal-company').textContent = company;
    document.getElementById('modal-position').textContent = position;
    document.getElementById('modal-message').textContent = message;
    
    // Render rating stars
    const ratingContainer = document.getElementById('modal-rating');
    ratingContainer.innerHTML = '';
    for (let i = 1; i <= 5; i++) {
        const star = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        star.setAttribute('class', `h-5 w-5 ${i <= rating ? 'text-amber-400' : 'text-slate-300'}`);
        star.setAttribute('viewBox', '0 0 20 20');
        star.setAttribute('fill', 'currentColor');
        star.innerHTML = '<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.802 2.035a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.802-2.035a1 1 0 00-1.176 0l-2.802 2.035c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>';
        ratingContainer.appendChild(star);
    }
    
    modal.style.display = 'flex';
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeTestimonialModal() {
    const modal = document.getElementById('testimonialModal');
    modal.style.display = 'none';
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeTestimonialModal();
    }
});

// Close when clicking outside modal
document.getElementById('testimonialModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeTestimonialModal();
    }
});
</script>
@endsection