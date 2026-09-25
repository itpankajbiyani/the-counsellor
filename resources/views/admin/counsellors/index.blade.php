@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('admin.nav')

    <div class="grid md:grid-cols-3 gap-8">
        
        <!-- Add Counsellor Form -->
        <div class="bg-[#E5DCD3] p-6 rounded-2xl shadow-lg border border-[#D5CBBF] md:col-span-1 h-fit">
            <h3 class="text-xl font-bold text-[#333] mb-4">Add Counsellor</h3>
            <form action="{{ route('admin.counsellors.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-[#333] font-bold mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full p-2 bg-[#FAF6F4] border @error('name') border-red-500 @else border-[#D5CBBF] @enderror rounded focus:ring-2 focus:ring-[#5a7b6b]" required maxlength="255">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-[#333] font-bold mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full p-2 bg-[#FAF6F4] border @error('email') border-red-500 @else border-[#D5CBBF] @enderror rounded focus:ring-2 focus:ring-[#5a7b6b]" required maxlength="255">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-[#333] font-bold mb-1">About</label>
                    <textarea name="about" rows="3" class="w-full p-2 bg-[#FAF6F4] border @error('about') border-red-500 @else border-[#D5CBBF] @enderror rounded focus:ring-2 focus:ring-[#5a7b6b]">{{ old('about') }}</textarea>
                    @error('about') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-[#333] font-bold mb-1">Experience (Years)</label>
                    <select name="experience" class="w-full p-2 bg-[#FAF6F4] border @error('experience') border-red-500 @else border-[#D5CBBF] @enderror rounded focus:ring-2 focus:ring-[#5a7b6b]">
                        <option value="">Select Experience</option>
                        <option value="0-1 years" {{ old('experience') == '0-1 years' ? 'selected' : '' }}>0-1 years</option>
                        <option value="1-3 years" {{ old('experience') == '1-3 years' ? 'selected' : '' }}>1-3 years</option>
                        <option value="3-5 years" {{ old('experience') == '3-5 years' ? 'selected' : '' }}>3-5 years</option>
                        <option value="5-10 years" {{ old('experience') == '5-10 years' ? 'selected' : '' }}>5-10 years</option>
                        <option value="10+ years" {{ old('experience') == '10+ years' ? 'selected' : '' }}>10+ years</option>
                    </select>
                    @error('experience') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-[#333] font-bold mb-1">Image (Max 4MB, JPG/PNG)</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="image-upload" class="flex flex-col items-center justify-center w-full h-32 border-2 border-[#D5CBBF] border-dashed rounded-lg cursor-pointer bg-[#FAF6F4] hover:bg-[#F2EAE1] @error('image') border-red-500 @enderror relative overflow-hidden">
                            <div id="upload-placeholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-[#5a7b6b]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-[#555]"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            </div>
                            <img id="image-preview" src="#" class="hidden absolute inset-0 w-full h-full object-cover">
                            <input id="image-upload" name="image" type="file" class="hidden" accept=".jpg,.jpeg,.png" onchange="previewImage(event, 'image-preview', 'upload-placeholder', null, 'image-error')" />
                        </label>
                    </div>
                    @error('image') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                    <span id="image-error" class="text-red-500 text-xs font-bold mt-1 block"></span>
                </div>
                <div class="mb-4">
                    <label class="block text-[#333] font-bold mb-1">Password</label>
                    <input type="password" name="password" class="w-full p-2 bg-[#FAF6F4] border @error('password') border-red-500 @else border-[#D5CBBF] @enderror rounded focus:ring-2 focus:ring-[#5a7b6b]" required minlength="6">
                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="mb-6">
                    <label class="block text-[#333] font-bold mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full p-2 bg-[#FAF6F4] border border-[#D5CBBF] rounded focus:ring-2 focus:ring-[#5a7b6b]" required minlength="6">
                </div>
                <button type="submit" class="w-full py-2 font-bold text-white bg-[#5a7b6b] hover:bg-[#4a6758] rounded shadow">Add Counsellor</button>
            </form>
        </div>

        <!-- List Counsellors -->
        <div class="bg-[#E5DCD3] p-6 rounded-2xl shadow-lg border border-[#D5CBBF] md:col-span-2">
            <h3 class="text-xl font-bold text-[#333] mb-4">Manage Counsellors ({{ count($counsellors) }})</h3>
            <div class="space-y-4">
                @forelse($counsellors as $counsellor)
                    <div class="p-4 bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            @if($counsellor->image)
                                <img src="{{ asset('images/counsellors/' . $counsellor->image) }}" class="w-12 h-12 object-cover rounded-full border border-[#D5CBBF] shadow-sm">
                            @else
                                <div class="w-12 h-12 flex items-center justify-center bg-[#E5DCD3] rounded-full text-[#5a7b6b] border border-[#D5CBBF] shadow-sm">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <div class="font-bold text-[#333] text-lg">{{ $counsellor->name }}</div>
                                <div class="text-sm text-[#555]">{{ $counsellor->email }}</div>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.counsellors.edit', $counsellor) }}" class="px-3 py-1 bg-blue-500 text-white text-sm font-bold rounded hover:bg-blue-600">Edit</a>
                            <form action="{{ route('admin.counsellors.destroy', $counsellor) }}" method="POST" onsubmit="return confirm('Delete this counsellor? All their data might be affected.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white text-sm font-bold rounded hover:bg-red-600">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-[#555]">No counsellors found.</div>
                @endforelse
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
function previewImage(event, previewId, placeholderId, currentImageId, errorSpanId) {
    const input = event.target;
    const errorSpan = document.getElementById(errorSpanId);
    if (errorSpan) errorSpan.textContent = ''; // clear error
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Validate Size (4MB)
        if (file.size > 4 * 1024 * 1024) {
            if (errorSpan) errorSpan.textContent = 'Error: The image must not be greater than 4 MB.';
            input.value = ''; // clear file
            return;
        }
        
        // Validate Extension
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            if (errorSpan) errorSpan.textContent = 'Error: Only JPG, JPEG, and PNG formats are allowed.';
            input.value = ''; // clear file
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
            document.getElementById(previewId).classList.remove('hidden');
            if (document.getElementById(placeholderId)) {
                document.getElementById(placeholderId).classList.add('hidden');
            }
            if (currentImageId && document.getElementById(currentImageId)) {
                document.getElementById(currentImageId).classList.add('hidden');
            }
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
