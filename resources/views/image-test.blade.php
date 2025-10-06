<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Loading Test</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .test-section { margin: 20px 0; border: 1px solid #ccc; padding: 15px; }
        .test-image { max-width: 200px; max-height: 150px; border: 1px solid #ddd; margin: 10px; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h1>Image Loading Diagnostic</h1>
    
    <div class="test-section">
        <h2>Direct Image Access Test</h2>
        <p>Testing if images can be accessed directly via URL:</p>
        
        <div>
            <h3>Logo Tests:</h3>
            <img src="/images/zuppie-logo.png" alt="Logo PNG" class="test-image" onload="this.nextSibling.innerHTML='✅ PNG Loaded'" onerror="this.nextSibling.innerHTML='❌ PNG Failed'">
            <span class="status"></span><br>
            
            <img src="/images/zuppie-logo.jpeg" alt="Logo JPEG" class="test-image" onload="this.nextSibling.innerHTML='✅ JPEG Loaded'" onerror="this.nextSibling.innerHTML='❌ JPEG Failed'">
            <span class="status"></span><br>
        </div>
        
        <div>
            <h3>Gallery Image Tests:</h3>
            <img src="/images/birthday-party-decoration.avif" alt="Birthday" class="test-image" onload="this.nextSibling.innerHTML='✅ Birthday Loaded'" onerror="this.nextSibling.innerHTML='❌ Birthday Failed'">
            <span class="status"></span><br>
            
            <img src="/images/wedding-setup-1.jpg" alt="Wedding" class="test-image" onload="this.nextSibling.innerHTML='✅ Wedding Loaded'" onerror="this.nextSibling.innerHTML='❌ Wedding Failed'">
            <span class="status"></span><br>
            
            <img src="/images/our-team.png" alt="Team" class="test-image" onload="this.nextSibling.innerHTML='✅ Team Loaded'" onerror="this.nextSibling.innerHTML='❌ Team Failed'">
            <span class="status"></span><br>
            
            <img src="/images/hero-banner.jpg" alt="Hero" class="test-image" onload="this.nextSibling.innerHTML='✅ Hero Loaded'" onerror="this.nextSibling.innerHTML='❌ Hero Failed'">
            <span class="status"></span><br>
        </div>
    </div>
    
    <div class="test-section">
        <h2>Asset Helper Test</h2>
        <p>Testing Laravel asset() helper URLs:</p>
        <div id="asset-test">
            <script>
                // Test asset URLs
                const testUrls = [
                    '{{ asset("images/zuppie-logo.png") }}',
                    '{{ asset("images/birthday-party-decoration.avif") }}',
                    '{{ asset("images/wedding-setup-1.jpg") }}',
                    '{{ asset("images/our-team.png") }}'
                ];
                
                testUrls.forEach((url, index) => {
                    const img = new Image();
                    const div = document.createElement('div');
                    div.innerHTML = `Testing: ${url} - `;
                    
                    img.onload = () => {
                        div.innerHTML += '<span class="success">✅ Loaded</span>';
                        document.getElementById('asset-test').appendChild(div);
                    };
                    
                    img.onerror = () => {
                        div.innerHTML += '<span class="error">❌ Failed</span>';
                        document.getElementById('asset-test').appendChild(div);
                    };
                    
                    img.src = url;
                });
            </script>
        </div>
    </div>
    
    <div class="test-section">
        <h2>Component Test</h2>
        <p>Testing our local-image component:</p>
        
        <h3>Local Image Component:</h3>
        <x-local-image 
            src="images/zuppie-logo.png" 
            alt="Component Logo Test" 
            class="test-image"
            :lazy="false"
            :critical="true" />
            
        <h3>ImageKit Component Test:</h3>
        <x-imagekit-image 
            src="https://ik.imagekit.io/zuppie/test-image.jpg" 
            alt="ImageKit Test" 
            class="test-image"
            :lazy="false"
            :critical="true" />
    </div>
    
    <script>
        console.log('Current URL:', window.location.href);
        console.log('Asset URLs being tested...');
    </script>
</body>
</html>