<div>
    <div x-data="{
        messages: [
            'Creating Unforgettable Events',
            'Turning Moments Into Memories',
            'Your Vision, Our Expertise'
        ],
        subtitles: [
            'Precision and Passion in Every Detail',
            'Memorable Moments Crafted With Love',
            'Seamless Event Planning You Can Trust'
        ],
        displayText: '',
        currentIndex: 0,
        isTyping: false,
        typingSpeed: 80,
        pauseBetween: 2000,

        init() {
            this.startTyping();
        },

        async startTyping() {
            while (true) {
                let message = this.messages[this.currentIndex];
                await this.typeText(message);
                await this.sleep(this.pauseBetween);
                await this.deleteText();
                this.currentIndex = (this.currentIndex + 1) % this.messages.length;
            }
        },

        async typeText(text) {
            this.isTyping = true;
            this.displayText = '';
            for (let char of text) {
                this.displayText += char;
                await this.sleep(this.typingSpeed);
            }
            this.isTyping = false;
        },

        async deleteText() {
            this.isTyping = true;
            while (this.displayText.length > 0) {
                this.displayText = this.displayText.slice(0, -1);
                await this.sleep(40);
            }
            this.isTyping = false;
        },

        sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
    }" class="relative h-[75vh]  flex items-center justify-center overflow-hidden bg-black">
        <!-- Background Image with Gradient Overlay -->
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('{{ asset('images/hero-banner.jpg') }}'); background-color: #8B5CF6;">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/70 via-purple-400/60 to-pink-400/60"></div>
        </div>

        <!-- Floating Balloons -->
        <div class="absolute inset-0 pointer-events-none">
            <div
                class="w-8 h-10 bg-gradient-to-b from-pink-400 to-pink-600 rounded-full opacity-60 animate-bounce absolute top-[15%] left-[8%]">
            </div>
            <div
                class="w-6 h-8 bg-gradient-to-b from-purple-400 to-purple-600 rounded-full opacity-60 animate-bounce absolute bottom-[20%] right-[12%] delay-200">
            </div>
            <div
                class="w-8 h-12 bg-gradient-to-b from-fuchsia-400 to-fuchsia-600 rounded-full opacity-60 animate-bounce absolute top-[30%] right-[10%] delay-500">
            </div>
        </div>

        <!-- Content -->
        <div class="relative z-10 text-center px-4 sm:px-6 w-full max-w-4xl mx-auto">
            <!-- Main Heading with Animated Gradient -->
            <h1 class="text-3xl sm:text-5xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                <span class="animated-gradient">Creating Unforgettable Events</span>
            </h1>

            <!-- Subtitle -->
            <p class="text-lg sm:text-xl md:text-2xl text-purple-100 italic mb-8">
                Precision and Passion in Every Detail
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('event-packages') }}" wire:navigate
                    class="inline-block px-8 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-2xl rounded-full shadow-lg hover:shadow-xl transition-all hover:scale-105">
                    View Event Packages
                </a>
                <button wire:click="$dispatch('open-enquiry-form')"
                    class="inline-block px-8 py-3 bg-white/20 backdrop-blur-sm border border-white/30 text-white font-2xl rounded-full shadow-lg hover:shadow-xl transition-all hover:scale-105">
                    Book Consultation
                </button>
            </div>
        </div>
    </div>

    <style>
        .animated-gradient {
            background: linear-gradient(
                to right,
                #FFFFFF,
                #F9FAFB,
                #FFFFFF,
                #F0ABFC,
                #E879F9,
                #C084FC,
                #A855F7,
                #FFFFFF
            );
            background-size: 400% 100%;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient-shift 8s ease infinite;
        }

        @keyframes gradient-shift {
            0%, 100% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
        }
    </style>
</div>
