@extends('layouts.app')

@section('content')
<div class="w-full max-w-4xl bg-[#efefef] text-[#333] p-8 rounded-2xl shadow-lg border border-[#D5CBBF] mt-8 mb-16">
    
    <div class="flex justify-between items-center mb-8 border-b border-[#C5BBAF] pb-4">
        <h2 class="text-3xl font-bold text-[#333]">My Appointments</h2>
        <a href="{{ route('home') }}#counsellors" class="px-4 py-2 bg-[#5a7b6b] hover:bg-[#4a6758] text-white rounded-lg shadow font-bold transition">
            {{ $bookings->isEmpty() ? 'Book A Session' : 'Book Another Session' }}
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-[#C5BBAF] text-[#4a3b32]">
                    <th class="p-4">Date & Time</th>
                    <th class="p-4">Counsellor</th>
                    <th class="p-4">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr class="border-b border-[#C5BBAF] hover:bg-[#F2EAE1] transition">
                        <td class="p-4 whitespace-nowrap">
                            <span class="font-bold text-[#333]">{{ \Carbon\Carbon::parse($booking->date)->format('l, F j, Y') }}</span><br>
                            <span class="text-[#555]">{{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}</span>
                        </td>
                        <td class="p-4 font-medium text-[#4a3b32]">
                            {{ $booking->counsellor->name ?? 'N/A' }}
                        </td>
                        <td class="p-4">
                            @if($booking->status === 'pending')
                                <div class="flex flex-col space-y-2">
                                    <span class="px-3 py-1 bg-yellow-200 text-yellow-800 rounded-full text-sm font-bold shadow-sm w-max">Pending</span>
                                    <form action="{{ route('user.cancel', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');" class="flex flex-col space-y-1 mt-1">
                                        @csrf
                                        <input type="text" name="cancellation_reason" placeholder="Reason..." class="w-full p-1.5 text-xs bg-white border border-[#D5CBBF] rounded focus:outline-none text-[#333]" required>
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-bold underline text-left mt-1">Cancel</button>
                                    </form>
                                </div>
                            @elseif($booking->status === 'accepted')
                                <div class="flex flex-col space-y-2">
                                    <span class="px-3 py-1 bg-green-200 text-green-800 rounded-full text-sm font-bold shadow-sm w-max">Accepted</span>
                                    <form action="{{ route('user.cancel', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');" class="flex flex-col space-y-1 mt-1">
                                        @csrf
                                        <input type="text" name="cancellation_reason" placeholder="Reason..." class="w-full p-1.5 text-xs bg-white border border-[#D5CBBF] rounded focus:outline-none text-[#333]" required>
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-bold underline text-left mt-1">Cancel</button>
                                    </form>
                                </div>
                            @elseif($booking->status === 'completed')
                                <span class="px-3 py-1 bg-blue-200 text-blue-800 rounded-full text-sm font-bold shadow-sm">Completed</span>
                            @else
                                <span class="px-3 py-1 bg-red-200 text-red-800 rounded-full text-sm font-bold shadow-sm">Cancelled</span>
                                @if($booking->cancelled_by)
                                    <p class="text-xs font-bold text-red-600 uppercase mt-2">By: {{ $booking->cancelled_by }}</p>
                                @endif
                                @if($booking->cancellation_reason)
                                    <p class="text-xs {{ $booking->cancelled_by ? 'mt-1' : 'mt-2' }} text-[#555]">Reason: {{ $booking->cancellation_reason }}</p>
                                @endif
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-8 text-center text-[#555] font-medium">You have no upcoming or past appointments.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="w-full max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-[#D5CBBF] mb-16">
    <div class="flex justify-between items-center mb-8 border-b border-[#C5BBAF] pb-4">
        <div>
            <h2 class="text-3xl font-bold text-[#333]">My Creative Activities</h2>
            <p class="text-[#555] text-sm mt-1">Blogs, Paintings, and Poetry you've shared with the community.</p>
        </div>
        <a href="{{ route('reading.create') }}" class="px-4 py-2 bg-[#b97a61] hover:bg-[#a06953] text-white rounded-lg shadow font-bold transition flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Submit New
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($activities as $activity)
            <div class="bg-[#FAF6F4] p-5 rounded-xl border border-[#D5CBBF] flex flex-col h-full relative group">
                <div class="absolute top-4 right-4 flex space-x-2">
                    @if($activity->status === 'pending')
                        <span class="px-2 py-0.5 bg-yellow-100 text-yellow-800 text-[10px] font-bold rounded-full uppercase">Under Review</span>
                    @elseif($activity->status === 'approved')
                        <span class="px-2 py-0.5 bg-green-100 text-green-800 text-[10px] font-bold rounded-full uppercase">Published</span>
                    @else
                        <span class="px-2 py-0.5 bg-red-100 text-red-800 text-[10px] font-bold rounded-full uppercase">Rejected</span>
                    @endif
                </div>
                
                <div class="text-[10px] uppercase font-bold tracking-wider text-[#b97a61] mb-2">{{ $activity->type }}</div>
                
                <h3 class="font-bold text-[#333] text-lg mb-2 pr-20">{{ $activity->title }}</h3>
                
                @if($activity->type === 'painting' && $activity->image)
                    <div class="relative overflow-hidden rounded-lg mb-3 border border-[#D5CBBF] group cursor-pointer" onclick="openLightbox('{{ asset('images/activities/' . $activity->image) }}', '{{ addslashes($activity->title) }}')">
                        <img src="{{ asset('images/activities/' . $activity->image) }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <div class="bg-white/30 backdrop-blur-md p-2 rounded-full">
                                <i data-lucide="zoom-in" class="w-5 h-5 text-white"></i>
                            </div>
                        </div>
                    </div>
                @elseif($activity->content)
                    <div class="text-sm text-[#555] line-clamp-3 mb-4 italic">"{!! strip_tags($activity->content) !!}"</div>
                @endif
                
                <div class="mt-auto pt-4 border-t border-[#EADBCC] flex justify-between items-center">
                    <span class="text-xs text-[#8C7D70]">{{ $activity->created_at->format('M d, Y') }}</span>
                    <div class="flex space-x-3 items-center">
                        <a href="{{ route('reading.edit', $activity) }}" class="text-xs font-bold text-[#5a7b6b] hover:text-[#4a6758] underline">Edit</a>
                        <form action="{{ route('reading.destroy', $activity) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-xs font-bold text-red-500 hover:text-red-700 underline">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full p-8 text-center bg-[#FAF6F4] border border-[#D5CBBF] rounded-xl text-[#555]">
                You haven't submitted any activities yet. Click "Submit New" to share your creativity!
            </div>
        @endforelse
    </div>
</div>



<!-- Lightbox Modal -->
<div id="lightbox-modal" class="fixed inset-0 bg-black/95 hidden flex-col items-center justify-center p-4 backdrop-blur-md transition-opacity duration-300" style="z-index: 9999;" onclick="closeLightbox()">
    <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white/70 hover:text-white transition bg-white/10 hover:bg-white/20 p-2 rounded-full backdrop-blur-sm z-50">
        <i data-lucide="x" class="w-6 h-6"></i>
    </button>
    <div class="relative max-w-5xl w-full max-h-[85vh] flex items-center justify-center" onclick="event.stopPropagation()">
        <img id="lightbox-img" src="" alt="Painting" class="max-w-full max-h-[85vh] object-contain rounded-xl shadow-2xl">
    </div>
    <div class="mt-6 text-center" onclick="event.stopPropagation()">
        <h3 id="lightbox-title" class="serif text-2xl font-bold text-white mb-2 tracking-wide"></h3>
    </div>
</div>
@endsection

@section('scripts')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
    var quill = null;
    
    document.addEventListener('DOMContentLoaded', function() {
        quill = new Quill('#editor-container', {
            theme: 'snow'
        });
        
        var form = document.getElementById('activity-form');
        form.onsubmit = function() {
            var type = document.getElementById('activity-type').value;
            if (type !== 'painting') {
                if (quill.getText().trim().length === 0) {
                    alert('Content is required');
                    return false;
                }
                document.getElementById('activity-content').value = quill.root.innerHTML;
            }
        };
        
        toggleActivityFields();
    });
    function toggleActivityFields() {
        const type = document.getElementById('activity-type').value;
        const imageField = document.getElementById('image-field-container');
        const contentField = document.getElementById('content-field-container');
        const categoryField = document.getElementById('category-field-container');
        const imageInput = document.getElementById('activity-image');
        
        if (type === 'painting') {
            imageField.style.display = 'block';
            contentField.style.display = 'none';
            categoryField.style.display = 'none';
            imageInput.required = true;
        } else if (type === 'blog') {
            imageField.style.display = 'none';
            contentField.style.display = 'block';
            categoryField.style.display = 'block';
            imageInput.required = false;
        } else {
            // Poetry
            imageField.style.display = 'none';
            contentField.style.display = 'block';
            categoryField.style.display = 'none';
            imageInput.required = false;
        }
    }

    function openLightbox(imageSrc, title) {
        const modal = document.getElementById('lightbox-modal');
        const img = document.getElementById('lightbox-img');
        const titleEl = document.getElementById('lightbox-title');
        
        img.src = imageSrc;
        titleEl.textContent = title;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeLightbox() {
        const modal = document.getElementById('lightbox-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.getElementById('lightbox-img').src = '';
    }
</script>
@endsection
