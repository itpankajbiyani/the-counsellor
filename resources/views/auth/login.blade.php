@extends('layouts.app')

@section('content')
<div class="w-full max-w-md mx-auto mt-16 mb-16">

    <!-- User Registration/Login via OTP -->
    <div class="bg-[#E5DCD3] text-[#333] p-8 rounded-2xl shadow-lg border border-[#D5CBBF]">
        <h2 class="text-2xl font-bold text-[#333] mb-6 text-center">User Login</h2>
        
        @if(!session()->has('otp_phone'))
            <form action="{{ route('otp.send') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-[#333] font-bold mb-2">Mobile Number</label>
                    <input type="text" name="phone" class="w-full p-3 bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5a7b6b] text-[#333]" placeholder="e.g. 9876543210" required minlength="10" maxlength="10" pattern="\d{10}" title="Please enter a valid 10-digit mobile number" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);">
                </div>
                <button type="submit" class="w-full py-3 mt-2 font-bold text-white bg-[#5a7b6b] hover:bg-[#4a6758] rounded-lg shadow transition text-lg">Send OTP</button>
            </form>
        @else
            <div class="bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg p-3 mb-6 text-center text-sm text-[#555]">
                We've sent an OTP to <span class="font-bold text-[#333]">{{ session('otp_phone') }}</span>
            </div>
            
            <form action="{{ route('otp.verify') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-[#333] font-bold mb-2">Enter OTP</label>
                    <input type="text" name="otp" class="w-full p-3 bg-[#FAF6F4] border border-[#D5CBBF] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#5a7b6b] text-[#333]" placeholder="6-digit code" required minlength="6" maxlength="6" pattern="\d{6}" title="Please enter the exactly 6-digit OTP" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);">
                    <p class="text-sm text-[#555] mt-2">OTP is valid for 3 minutes.</p>
                </div>
                <button type="submit" class="w-full py-3 mt-2 font-bold text-white bg-[#5a7b6b] hover:bg-[#4a6758] rounded-lg shadow transition text-lg">Verify & Login</button>
            </form>
            
            <div class="flex justify-between items-center mt-4">
                <form action="{{ route('otp.send') }}" method="POST" id="resend-form">
                    @csrf
                    <input type="hidden" name="phone" value="{{ session('otp_phone') }}">
                    @php
                        $elapsed = \Carbon\Carbon::now()->timestamp - session('otp_sent_at', 0);
                        $timeLeft = max(0, 60 - $elapsed);
                    @endphp
                    <button type="submit" id="resend-btn" class="text-[#5a7b6b] hover:text-[#4a6758] font-bold underline disabled:opacity-50 disabled:cursor-not-allowed" {{ $timeLeft > 0 ? 'disabled' : '' }}>
                        Resend OTP <span id="timer">{{ $timeLeft > 0 ? '('.$timeLeft.'s)' : '' }}</span>
                    </button>
                </form>
                
                <form action="{{ route('otp.clear') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-[#555] hover:text-[#333] underline">Change Number</button>
                </form>
            </div>

            @if($timeLeft > 0)
            <script>
                let timeLeft = {{ $timeLeft }};
                const timerSpan = document.getElementById('timer');
                const resendBtn = document.getElementById('resend-btn');
                
                const interval = setInterval(() => {
                    timeLeft--;
                    if (timeLeft <= 0) {
                        clearInterval(interval);
                        timerSpan.innerText = '';
                        resendBtn.disabled = false;
                    } else {
                        timerSpan.innerText = '(' + timeLeft + 's)';
                    }
                }, 1000);
            </script>
            @endif
        @endif
    </div>

</div>
@endsection
