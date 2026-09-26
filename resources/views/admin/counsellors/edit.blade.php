@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('admin.nav')

    <div class="bg-white p-10 rounded-3xl shadow-xl border border-gray-100 max-w-3xl mx-auto">
        <div class="mb-8 border-b border-gray-100 pb-4">
            <h3 class="serif text-3xl font-bold text-[#4A5D4E]">Edit Counsellor Profile</h3>
            <p class="text-sm text-gray-500 mt-2">Update the information and credentials for this counsellor.</p>
        </div>
        <form action="{{ route('admin.counsellors.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            @if($user->image)
                <div class="mb-8 flex justify-center">
                    <div class="relative group">
                        <img id="current-image-preview" src="{{ asset('images/counsellors/' . $user->image) }}" class="h-40 w-40 object-cover rounded-full border-4 border-[#FAF6F1] shadow-md bg-white">
                        <div class="absolute inset-0 bg-black bg-opacity-40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                            <span class="text-white font-bold text-sm">Current Photo</span>
                        </div>
                    </div>
                </div>
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full p-3 bg-gray-50 border @error('name') border-red-500 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-[#A5C3AE] focus:bg-white transition" required maxlength="255" placeholder="e.g. Dr. Jane Doe">
                    @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full p-3 bg-gray-50 border @error('email') border-red-500 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-[#A5C3AE] focus:bg-white transition" required maxlength="255" placeholder="jane@example.com">
                    @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">About / Bio</label>
                <textarea name="about" rows="4" class="w-full p-3 bg-gray-50 border @error('about') border-red-500 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-[#A5C3AE] focus:bg-white transition" placeholder="Brief description about the counsellor's expertise...">{{ old('about', $user->about) }}</textarea>
                @error('about') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Highest Qualification</label>
                    <input type="text" name="qualification" value="{{ old('qualification', $user->qualification) }}" class="w-full p-3 bg-gray-50 border @error('qualification') border-red-500 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-[#A5C3AE] focus:bg-white transition" placeholder="e.g. Ph.D. in Psychology">
                    @error('qualification') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Experience</label>
                    <div class="relative">
                        <select name="experience" class="w-full p-3 bg-gray-50 border @error('experience') border-red-500 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-[#A5C3AE] focus:bg-white transition appearance-none">
                            <option value="">Select Years of Experience</option>
                            <option value="1+" {{ old('experience', $user->experience) == '1+' ? 'selected' : '' }}>1+ Years</option>
                            <option value="2+" {{ old('experience', $user->experience) == '2+' ? 'selected' : '' }}>2+ Years</option>
                            <option value="3+" {{ old('experience', $user->experience) == '3+' ? 'selected' : '' }}>3+ Years</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    @error('experience') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Profile Photo (Max 4MB, JPG/PNG)</label>
                <div class="flex items-center justify-center w-full">
                    <label for="image-upload" class="flex flex-col items-center justify-center w-full h-40 border-2 border-[#A5C3AE] border-dashed rounded-2xl cursor-pointer bg-[#F8FAF9] hover:bg-[#F2ECE4] transition group relative overflow-hidden">
                        <div id="upload-placeholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                            <div class="w-12 h-12 bg-white rounded-full shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 transition">
                                <svg class="w-6 h-6 text-[#5E7363]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                            </div>
                            <p class="mb-1 text-sm text-gray-600"><span class="font-bold text-[#4A5D4E]">Click to upload</span> a new photo</p>
                            <p class="text-xs text-gray-400">or drag and drop here</p>
                        </div>
                        <img id="image-preview" src="#" class="hidden absolute inset-0 w-full h-full object-cover">
                        <input id="image-upload" name="image" type="file" class="hidden" accept=".jpg,.jpeg,.png" onchange="previewImage(event, 'image-preview', 'upload-placeholder', 'current-image-preview', 'image-error')" />
                    </label>
                </div>
                @error('image') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                <span id="image-error" class="text-red-500 text-xs font-bold mt-1 block"></span>
            </div>
            
            <div class="bg-[#FAF6F1] p-6 rounded-2xl border border-[#F0E6CD] mb-8">
                <h4 class="font-bold text-[#4A5D4E] mb-4 flex items-center"><svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7z"></path></svg> Security Settings</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">New Password (optional)</label>
                        <input type="password" name="password" class="w-full p-3 bg-white border @error('password') border-red-500 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-[#A5C3AE] transition" minlength="6" placeholder="Leave blank to keep current">
                        @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="w-full p-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#A5C3AE] transition" minlength="6" placeholder="Re-type new password">
                    </div>
                </div>
            </div>
            
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.counsellors.index') }}" class="px-8 py-3 font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-full transition shadow-sm">Cancel</a>
                <button type="submit" class="px-8 py-3 font-bold text-white bg-[#5E7363] hover:bg-[#4A5D4E] rounded-full transition shadow-md flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Save Changes
                </button>
            </div>
        </form>
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
