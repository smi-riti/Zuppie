<div class="loader-overlay">
    @if($type === 'spinner')
        <div class="spinner-container {{ $size }}">
            <div class="spinner"></div>
            @if($message)
                <p class="loading-message">{{ $message }}</p>
            @endif
        </div>
    @elseif($type === 'dots')
        <div class="dots-container {{ $size }}">
            <div class="dots">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
            @if($message)
                <p class="loading-message">{{ $message }}</p>
            @endif
        </div>
    @elseif($type === 'pulse')
        <div class="pulse-container {{ $size }}">
            <div class="pulse"></div>
            @if($message)
                <p class="loading-message">{{ $message }}</p>
            @endif
        </div>
    @endif
    <style>
.loader-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.9);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

/* Spinner Loader */
.spinner-container {
    text-align: center;
}

.spinner {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #8b5cf6;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

.spinner-container.small .spinner {
    width: 30px;
    height: 30px;
}

.spinner-container.medium .spinner {
    width: 50px;
    height: 50px;
}

.spinner-container.large .spinner {
    width: 70px;
    height: 70px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Dots Loader */
.dots-container {
    text-align: center;
}

.dots {
    display: flex;
    gap: 8px;
}

.dot {
    background: #8b5cf6;
    border-radius: 50%;
    animation: pulse 1.5s ease-in-out infinite;
}

.dots-container.small .dot {
    width: 8px;
    height: 8px;
}

.dots-container.medium .dot {
    width: 12px;
    height: 12px;
}

.dots-container.large .dot {
    width: 16px;
    height: 16px;
}

.dot:nth-child(2) {
    animation-delay: 0.2s;
}

.dot:nth-child(3) {
    animation-delay: 0.4s;
}

/* Pulse Loader */
.pulse-container {
    text-align: center;
}

.pulse {
    background: #8b5cf6;
    border-radius: 50%;
    animation: pulse 2s ease-in-out infinite;
}

.pulse-container.small .pulse {
    width: 40px;
    height: 40px;
}

.pulse-container.medium .pulse {
    width: 60px;
    height: 60px;
}

.pulse-container.large .pulse {
    width: 80px;
    height: 80px;
}

@keyframes pulse {
    0% {
        transform: scale(0);
        opacity: 1;
    }
    100% {
        transform: scale(1);
        opacity: 0;
    }
}

.loading-message {
    margin-top: 15px;
    color: #6b7280;
    font-size: 14px;
    font-weight: 500;
}
</style>

</div>

