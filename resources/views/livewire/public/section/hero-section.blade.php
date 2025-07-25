<div>
    <div 
    x-data="heroSection()"
    class="relative w-full min-h-screen flex items-center justify-center overflow-hidden"
>
    <!-- Dynamic Background -->
    <div 
        x-bind:style="`background-image: ${backgrounds[currentIndex]}`"
        class="absolute inset-0 bg-cover bg-center transition-all duration-1000 ease-in-out"
    >
        <!-- Purple-Pink Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-purple-900/70 via-purple-700/60 to-pink-600/50"></div>
    </div>

    <!-- Floating Balloons - Responsive Sizing -->
    <template x-for="(balloon, index) in balloons" :key="index">
        <div 
            class="absolute rounded-full opacity-70 floating-element"
            :class="[
                balloon.sizeClasses,
                balloon.colorClasses,
                balloon.positionClasses
            ]"
            x-transition:enter="transition ease-out duration-1000"
            x-transition:enter-start="opacity-0 translate-y-10"
            x-transition:enter-end="opacity-70 translate-y-0"
        >
            <div class="absolute top-0 left-1/2 w-0.5 h-6 sm:h-8 bg-white/30 transform -translate-x-1/2 translate-y-full"></div>
        </div>
    </template>

    <!-- Content -->
    <div class="relative z-10 text-center px-4 sm:px-6 w-full max-w-4xl mx-auto">
        <!-- Main Heading with Typewriter Effect -->
        <div class="mb-4 sm:mb-6 md:mb-8 min-h-[3.5rem] xs:min-h-[4rem] sm:min-h-[5rem] md:min-h-[6rem] lg:min-h-[7rem] flex items-center justify-center">
            <h1 
                x-text="displayText"
                class="text-2xl xs:text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight px-2"
                :class="{'typewriter-cursor': isTyping}"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-10"
            ></h1>
        </div>
        
        <!-- Author Text (appears instantly) -->
        <div class="mb-6 sm:mb-8 md:mb-10">
            <p 
                x-text="quotes[currentIndex].author"
                class="text-base xs:text-lg sm:text-xl md:text-2xl text-purple-100 italic px-2"
                x-transition:enter="transition ease-out duration-500 delay-200"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300 delay-100"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-10"
            ></p>
        </div>
        
        <!-- CTA Buttons - Responsive Stacking -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a 
                href="{{ route('event-packages') }}"
                class="inline-block px-8 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all hover:scale-105"
                x-transition:enter="transition ease-out duration-500 delay-400"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
            >
                View Event Packages
            </a>
            <a 
                href="#contact"
                class="inline-block px-8 py-3 bg-white/20 backdrop-blur-sm border border-white/30 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all hover:scale-105"
                x-transition:enter="transition ease-out duration-500 delay-400"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
            >
                Book Consultation
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('heroSection', () => ({
            currentIndex: 0,
            displayText: '',
            isTyping: false,
            typingSpeed: 30, // milliseconds per character
            backgrounds: [
                'url(https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80)',
                'url(https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80)',
                'url(https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80)',
                'url(https://images.unsplash.com/photo-1531058020387-3be344556be6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80)'
            ],
            quotes: [
                { text: 'Creating unforgettable events with precision and passion', author: 'Your Vision, Our Expertise' },
                { text: 'From concept to execution, we handle every detail', author: 'Seamless Event Management' },
                { text: 'Turning your special occasions into cherished memories', author: 'Memorable Moments Created' },
                { text: 'Professional event planning for every occasion', author: 'Excellence in Every Event' }
            ],
            balloons: [
                { 
                    sizeClasses: 'w-8 h-10 xs:w-10 xs:h-12 sm:w-12 sm:h-16',
                    colorClasses: 'bg-gradient-to-b from-pink-400 to-pink-600',
                    positionClasses: 'top-[15%] left-[5%] xs:top-[20%] xs:left-[10%]'
                },
                { 
                    sizeClasses: 'w-6 h-8 xs:w-8 xs:h-10 sm:w-10 sm:h-12',
                    colorClasses: 'bg-gradient-to-b from-purple-400 to-purple-600',
                    positionClasses: 'top-[30%] right-[5%] xs:top-[35%] xs:right-[10%]'
                },
                { 
                    sizeClasses: 'w-8 h-10 xs:w-10 xs:h-12 sm:w-12 sm:h-16',
                    colorClasses: 'bg-gradient-to-b from-fuchsia-400 to-fuchsia-600',
                    positionClasses: 'bottom-[20%] left-[5%] xs:bottom-[25%] xs:left-[10%]'
                },
                { 
                    sizeClasses: 'w-6 h-8 xs:w-8 xs:h-10 sm:w-10 sm:h-12',
                    colorClasses: 'bg-gradient-to-b from-pink-400 to-pink-600',
                    positionClasses: 'bottom-[15%] right-[5%] xs:bottom-[20%] xs:right-[10%]'
                },
                { 
                    sizeClasses: 'w-8 h-10 xs:w-10 xs:h-12 sm:w-12 sm:h-16',
                    colorClasses: 'bg-gradient-to-b from-purple-400 to-purple-600',
                    positionClasses: 'top-[25%] right-[5%] xs:top-[20%] xs:right-[15%]'
                },
                { 
                    sizeClasses: 'w-6 h-8 xs:w-8 xs:h-10 sm:w-10 sm:h-12',
                    colorClasses: 'bg-gradient-to-b from-fuchsia-400 to-fuchsia-600',
                    positionClasses: 'bottom-[25%] left-[5%] xs:bottom-[20%] xs:left-[15%]'
                }
            ],
            init() {
                // Initialize with first quote
                this.typeText(this.quotes[0].text);
                
                // Set up rotation interval
                setInterval(() => {
                    this.currentIndex = (this.currentIndex + 1) % this.backgrounds.length;
                    this.typeText(this.quotes[this.currentIndex].text);
                }, 5000);
            },
            typeText(newText) {
                // Clear current text
                this.displayText = '';
                this.isTyping = true;
                
                // Type the main text
                let i = 0;
                const typing = setInterval(() => {
                    if (i < newText.length) {
                        this.displayText += newText.charAt(i);
                        i++;
                    } else {
                        clearInterval(typing);
                        this.isTyping = false;
                    }
                }, this.typingSpeed);
            }
        }));
    });
</script>

<style>
    /* Floating animation for balloons */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
    }
    
    /* Typewriter cursor animation */
    .typewriter-cursor::after {
        content: '|';
        animation: blink 1s step-end infinite;
        opacity: 0.7;
    }
    
    @keyframes blink {
        from, to { opacity: 0; }
        50% { opacity: 1; }
    }
    
    /* Responsive adjustments */
    @media (max-width: 640px) {
        .hero-bg {
            background-attachment: scroll;
        }
        
        .floating-element {
            animation-duration: 8s;
        }
    }
    
    @media (max-width: 400px) {
        .floating-element {
            opacity: 0.5;
        }
    }
</style>
</div>