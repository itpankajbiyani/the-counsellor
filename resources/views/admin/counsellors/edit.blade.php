@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto">
    @include('admin.nav')

    <div class="w-full max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-[#D5CBBF] mt-8 mb-16">
        <div class="flex items-center mb-8 border-b border-[#C5BBAF] pb-4">
            <a href="{{ route('admin.counsellors.index') }}" class="mr-4 text-[#8C7D70] hover:text-[#5E7363] transition">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </a>
            <div>
                <h2 class="text-3xl font-bold text-[#333]">Edit Counsellor Profile</h2>
            </div>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                <ul class="list-disc pl-5 mt-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.counsellors.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full p-3 bg-[#FAF6F4] border @error('name') border-red-500 @else border-[#D5CBBF] @enderror rounded-xl focus:ring-2 focus:ring-[#5a7b6b]" required maxlength="255">
            </div>
            
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full p-3 bg-[#FAF6F4] border @error('email') border-red-500 @else border-[#D5CBBF] @enderror rounded-xl focus:ring-2 focus:ring-[#5a7b6b]" required maxlength="255">
            </div>
            
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">About</label>
                <textarea name="about" rows="3" class="w-full p-3 bg-[#FAF6F4] border @error('about') border-red-500 @else border-[#D5CBBF] @enderror rounded-xl focus:ring-2 focus:ring-[#5a7b6b]">{{ old('about', $user->about) }}</textarea>
            </div>
            
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">Qualification</label>
                <input type="text" name="qualification" value="{{ old('qualification', $user->qualification) }}" class="w-full p-3 bg-[#FAF6F4] border @error('qualification') border-red-500 @else border-[#D5CBBF] @enderror rounded-xl focus:ring-2 focus:ring-[#5a7b6b]">
            </div>
            
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">Experience (Years)</label>
                <select name="experience" class="w-full p-3 bg-[#FAF6F4] border @error('experience') border-red-500 @else border-[#D5CBBF] @enderror rounded-xl focus:ring-2 focus:ring-[#5a7b6b]">
                    <option value="">Select Experience</option>
                    <option value="1+" {{ old('experience', $user->experience) == '1+' ? 'selected' : '' }}>1+</option>
                    <option value="2+" {{ old('experience', $user->experience) == '2+' ? 'selected' : '' }}>2+</option>
                    <option value="3+" {{ old('experience', $user->experience) == '3+' ? 'selected' : '' }}>3+</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block text-[#333] font-bold mb-1">Image (Max 4MB, JPG/PNG)</label>
                
                @if($user->image)
                    <div class="mb-4 flex items-center justify-center">
                        <img id="current-image-preview" src="{{ asset('images/counsellors/' . $user->image) }}" class="h-32 w-32 object-cover rounded-full border-2 border-[#D5CBBF]">
                    </div>
                @endif
                
                <div class="flex items-center justify-center w-full">
                    <label for="image-upload" class="flex flex-col items-center justify-center w-full h-32 border-2 border-[#D5CBBF] border-dashed rounded-xl cursor-pointer bg-[#FAF6F4] hover:bg-[#F2EAE1] @error('image') border-red-500 @enderror relative overflow-hidden">
                        <div id="upload-placeholder" class="flex flex-col items-center justify-center pt-5 pb-6 {{ $user->image ? 'hidden' : '' }}">
                            <i data-lucide="upload-cloud" class="w-8 h-8 mb-4 text-[#5a7b6b]"></i>
                            <p class="mb-2 text-sm text-[#555]"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        </div>
                        <img id="image-preview" src="#" class="hidden absolute inset-0 w-full h-full object-cover">
                        <input id="image-upload" name="image" type="file" class="hidden" accept=".jpg,.jpeg,.png" onchange="previewImage(event, 'image-preview', 'upload-placeholder', 'current-image-preview', 'image-error')" />
                    </label>
                </div>
                <span id="image-error" class="text-red-500 text-xs font-bold mt-1 block"></span>
            </div>
            
            <div class="border-t border-[#C5BBAF] mt-8 pt-6">
                <h4 class="font-bold text-[#333] mb-4">Security Settings</h4>
                <div class="mb-4">
                    <label class="block text-[#333] font-bold mb-1">New Password (optional)</label>
                    <input type="password" name="password" class="w-full p-3 bg-[#FAF6F4] border @error('password') border-red-500 @else border-[#D5CBBF] @enderror rounded-xl focus:ring-2 focus:ring-[#5a7b6b]" minlength="6" placeholder="Leave blank to keep current">
                </div>
                <div class="mb-6">
                    <label class="block text-[#333] font-bold mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="w-full p-3 bg-[#FAF6F4] border border-[#D5CBBF] rounded-xl focus:ring-2 focus:ring-[#5a7b6b]" minlength="6" placeholder="Re-type new password">
                </div>
            </div>
            
            <div class="flex justify-end gap-4 mt-8">
                <a href="{{ route('admin.counsellors.index') }}" class="px-6 py-2.5 bg-gray-200 text-[#333] font-bold rounded-xl hover:bg-gray-300 transition">Cancel</a>
                <button type="submit" class="px-6 py-2.5 bg-[#5E7363] text-white font-bold rounded-xl hover:bg-[#4A5D4E] transition shadow">Save Changes</button>
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
    if (errorSpan) errorSpan.textContent = ''; 
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        if (file.size > 4 * 1024 * 1024) {
            if (errorSpan) errorSpan.textContent = 'Error: The image must not be greater than 4 MB.';
            input.value = ''; 
            return;
        }
        
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            if (errorSpan) errorSpan.textContent = 'Error: Only JPG, JPEG, and PNG formats are allowed.';
            input.value = ''; 
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
