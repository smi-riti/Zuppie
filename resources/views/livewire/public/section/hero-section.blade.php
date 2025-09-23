<div>
    <div x-data="heroSection()" class="relative h-[75vh]  flex items-center justify-center overflow-hidden bg-black">
        <!-- Background Image with Gradient Overlay -->
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('{{ asset('images/zuppieventpakage.jpg') }}');">
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
            <!-- Typewriter Heading -->
            <h1 class="text-3xl sm:text-5xl md:text-5xl lg:text-6xl font-medium text-white leading-tight mb-6">
                <span x-text="displayText"></span>
                <span x-show="isTyping" class="typewriter-cursor">|</span>
            </h1>

            <!-- Subtitle -->
            <p x-text="subtitles[currentIndex]" class="text-lg sm:text-xl md:text-2xl text-purple-100 italic mb-8"></p>

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

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('heroSection', () => ({
                messages: [
                    "Creating Unforgettable Events",
                    "Turning Moments Into Memories",
                    "Your Vision, Our Expertise"
                ],
                subtitles: [
                    "Precision and Passion in Every Detail",
                    "Memorable Moments Crafted With Love",
                    "Seamless Event Planning You Can Trust"
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
            }));
        });
    </script>

    <style>
        .typewriter-cursor {
            display: inline-block;
            margin-left: 2px;
            animation: blink 1s step-end infinite;
            opacity: 0.8;
        }

        @keyframes blink {
            50% {
                opacity: 0;
            }
        }
    </style>


</div>
