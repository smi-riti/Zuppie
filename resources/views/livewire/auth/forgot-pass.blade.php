<div
    class="min-h-screen flex items-center justify-center bg-gradient-to-br from-zuppie-100 via-zuppie-pink-100 to-white py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white rounded-2xl shadow-xl p-8">
        @if(!$emailSent)
            <div>
                <h2 class="text-center text-2xl font-bold text-zuppie-900">Forgot Your Password?</h2>
                <p class="mt-2 text-center text-sm text-zuppie-pink-600">
                    No problem. Enter your email address, and we'll send you a password reset link.
                </p>
            </div>

            @if($error)
                <div class="text-sm text-zuppie-pink-600 bg-zuppie-pink-50 border border-zuppie-pink-200 rounded-lg p-3 text-center">
                    {{ $error }}
                </div>
            @endif

            <form wire:submit.prevent="sendResetLink" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-zuppie-700">Email</label>
                    <input wire:model="email" id="email" type="email" autofocus class="mt-1 block w-full px-4 py-3 border border-zuppie-300 rounded-lg text-zuppie-900
                            placeholder-zuppie-400 focus:outline-none focus:ring-2 focus:ring-zuppie-pink-500 focus:border-zuppie-pink-500
                            transition duration-200">
                    @error('email')
                        <span class="text-sm text-zuppie-pink-600 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm
                            text-sm font-medium text-white bg-gradient-to-r from-zuppie-600 to-zuppie-pink-600
                            hover:from-zuppie-700 hover:to-zuppie-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                            focus:ring-zuppie-pink-500 transition duration-200 disabled:opacity-50" wire:loading.attr="disabled">
                        <span wire:loading.remove>Email Password Reset Link</span>
                        <span wire:loading class="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin h-7 w-7 text-white mr-2" fill="none"
                                viewBox="0 0 640 640">
                                <circle class="opacity-50" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M272 112C272 85.5 293.5 64 320 64C346.5 64 368 85.5 368 112C368 138.5 346.5 160 320 160C293.5 160 272 138.5 272 112zM272 528C272 501.5 293.5 480 320 480C346.5 480 368 501.5 368 528C368 554.5 346.5 576 320 576C293.5 576 272 554.5 272 528zM112 272C138.5 272 160 293.5 160 320C160 346.5 138.5 368 112 368C85.5 368 64 346.5 64 320C64 293.5 85.5 272 112 272zM480 320C480 293.5 501.5 272 528 272C554.5 272 576 293.5 576 320C576 346.5 554.5 368 528 368C501.5 368 480 346.5 480 320zM139 433.1C157.8 414.3 188.1 414.3 206.9 433.1C225.7 451.9 225.7 482.2 206.9 501C188.1 519.8 157.8 519.8 139 501C120.2 482.2 120.2 451.9 139 433.1zM139 139C157.8 120.2 188.1 120.2 206.9 139C225.7 157.8 225.7 188.1 206.9 206.9C188.1 225.7 157.8 225.7 139 206.9C120.2 188.1 120.2 157.8 139 139zM501 433.1C519.8 451.9 519.8 482.2 501 501C482.2 519.8 451.9 519.8 433.1 501C414.3 482.2 414.3 451.9 433.1 433.1C451.9 414.3 482.2 414.3 501 433.1z" />
                            </svg>
                            Sending...
                        </span>
                    </button>
                </div>
            </form>
        @else
            <div class="text-center">
                <h2 class="text-2xl font-bold text-zuppie-900">Check Your Email</h2>
                <p class="mt-2 text-sm text-green-600 bg-green-50 border border-green-200 rounded-lg p-3">
                    We've emailed your password reset link!
                </p>
                <a href="{{ route('login') }}"
                    class="mt-4 inline-block text-sm font-medium text-zuppie-600 hover:text-zuppie-800 transition duration-200">
                    Back to Login
                </a>
            </div>
        @endif
    </div>
</div>