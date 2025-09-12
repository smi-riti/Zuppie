<div>
    <!-- Bottom Navigation Bar for Mobile and Mini iPad -->
    <nav class="fixed bottom-3 left-2 right-2 rounded-xl bg-white/95 backdrop-blur-md border border-gray-200/50 z-50 lg:hidden shadow-2xl bottom-nav-tablet">
        <div class="flex items-center justify-around  ">
            <!-- Home -->
            <a href="{{ route('home') }}" class="flex flex-col items-center space-y-1 p-3 rounded-xl transition-all duration-300 hover:bg-purple-50 group active:scale-95">
                <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-gradient-to-r from-purple-400 to-pink-400 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-home text-sm"></i>
                </div>
                <span class="text-xs font-medium text-gray-600 group-hover:text-purple-600 transition-colors duration-300">Home</span>
            </a>
            
            
            
            <!-- Enquiry -->
            <button 
                wire:click="$dispatch('open-enquiry-form')" 
                class="flex flex-col items-center space-y-1 p-3 rounded-xl transition-all duration-300 hover:bg-purple-50 group active:scale-95">
                <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-gradient-to-r from-purple-400 to-pink-400 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-edit text-sm"></i>
                </div>
                <span class="text-xs font-medium text-gray-600 group-hover:text-purple-600 transition-colors duration-300">Enquiry</span>
            </button>
            
            <!-- Mail Us -->
            <a href="mailto:{{ $settings['email'] }}" class="flex flex-col items-center space-y-1 p-3 rounded-xl transition-all duration-300 hover:bg-purple-50 group active:scale-95">
                <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-gradient-to-r from-purple-400 to-pink-400 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-envelope text-sm"></i>
                </div>
                <span class="text-xs font-medium text-gray-600 group-hover:text-purple-600 transition-colors duration-300">Mail</span>
            </a>
            
            <!-- Call Us -->
            <a href="tel:{{ $settings['phone_no'] }}" class="flex flex-col items-center space-y-1 p-3 rounded-xl transition-all duration-300 hover:bg-purple-50 group active:scale-95">
                <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-gradient-to-r from-purple-400 to-pink-400 text-white shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-phone text-sm"></i>
                </div>
                <span class="text-xs font-medium text-gray-600 group-hover:text-purple-600 transition-colors duration-300">Call</span>
            </a>
        </div>
    </nav>

    <style>
        /* Smooth scroll behavior for navigation */
        html {
            scroll-behavior: smooth;
        }
        
        /* Professional button animations */
        .bottom-nav-tablet a:hover,
        .bottom-nav-tablet button:hover {
            transform: translateY(-2px);
        }
        
        /* Enhanced backdrop blur */
        .backdrop-blur-custom {
            backdrop-filter: blur(20px) saturate(180%);
        }
    </style>
</div>