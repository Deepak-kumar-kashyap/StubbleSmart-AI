<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StubbleSmart AI - Farmer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/mobilenet"></script>
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-900 to-black min-h-screen text-white font-sans">
    <nav class="p-6 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <h1 class="text-xl font-bold tracking-tighter">StubbleSmart <span class="text-green-400">AI</span></h1>
        </div>
        <div class="space-x-4 text-xs font-bold uppercase tracking-wider">
            <a href="index.php" class="hover:text-green-400 transition-colors">Home</a>
            <a href="farmer.php" class="text-green-400">Farmer Portal</a>
            <a href="industry.php" class="hover:text-green-400 transition-colors">Industry</a>
        </div>
    </nav>

    <main class="max-w-md mx-auto p-6 space-y-6">
        <!-- Dashboard Card -->
        <div class="glass rounded-3xl p-6 flex justify-between items-center border-l-4 border-green-500">
            <div>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Est. Earnings</p>
                <h3 id="estEarnings" class="text-2xl font-black text-white">₹0.00</h3>
            </div>
            <div class="text-right">
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Carbon Credits</p>
                <h3 id="estCredits" class="text-xl font-black text-green-400">0.0 t</h3>
            </div>
        </div>

        <div class="glass rounded-3xl p-8 shadow-2xl space-y-6">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold">Report Stubble</h2>
                <p class="text-gray-400 mt-2 text-sm">Earn while you save the environment.</p>
            </div>

            <div class="relative group">
                <input type="file" id="imageInput" accept="image/*" class="hidden">
                <label for="imageInput" class="flex flex-col items-center justify-center border-2 border-dashed border-green-500/50 rounded-2xl p-10 cursor-pointer hover:bg-green-500/10 transition-all group-hover:border-green-400">
                    <svg class="w-12 h-12 text-green-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="font-medium text-lg">Capture Photo</span>
                    <span class="text-sm text-gray-500 mt-1">Tap to open camera</span>
                </label>
            </div>

            <div id="previewContainer" class="hidden space-y-4">
                <img id="imagePreview" class="w-full h-auto rounded-2xl shadow-lg border border-green-500/30" src="" alt="Preview">
                <div id="status" class="text-center font-semibold text-green-400 animate-pulse">Initializing AI...</div>
            </div>

            <button id="submitBtn" disabled class="w-full bg-green-500 hover:bg-green-600 disabled:bg-gray-700 disabled:cursor-not-allowed text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-green-500/20">
                Verify & Upload
            </button>
        </div>
    </main>

    <script>
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const previewContainer = document.getElementById('previewContainer');
        const status = document.getElementById('status');
        const submitBtn = document.getElementById('submitBtn');
        
        let model;
        let coords = { lat: 0, lon: 0 };
        let confidence = 0;

        // Load MobileNet
        async function loadModel() {
            try {
                status.innerText = "Loading AI Model...";
                model = await mobilenet.load();
                status.innerText = "Ready to verify.";
                status.classList.remove('animate-pulse');
            } catch (err) {
                console.error("Model load error:", err);
                status.innerText = "Error loading AI model. Please refresh.";
                status.classList.add('text-red-400');
            }
        }
        loadModel();

        // Get Location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(pos => {
                coords.lat = pos.coords.latitude;
                coords.lon = pos.coords.longitude;
            });
        }

        imageInput.addEventListener('change', async (e) => {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = async (event) => {
                imagePreview.src = event.target.result;
                
                // Wait for the image element to actually load the src
                imagePreview.onload = async () => {
                    previewContainer.classList.remove('hidden');
                    status.innerText = "Verifying stubble...";
                    
                    // Ensure model is loaded
                    if (!model) {
                        status.innerText = "Waiting for AI model to initialize...";
                        while (!model) {
                            await new Promise(resolve => setTimeout(resolve, 500));
                        }
                    }

                    try {
                        // AI Prediction
                        const predictions = await model.classify(imagePreview);
                        console.log(predictions);
                        
                        const matches = predictions.filter(p => 
                            p.className.toLowerCase().includes('hay') || 
                            p.className.toLowerCase().includes('straw') || 
                            p.className.toLowerCase().includes('grass') ||
                            p.className.toLowerCase().includes('field') ||
                            p.className.toLowerCase().includes('agriculture')
                        );

                        if (matches.length > 0) {
                            confidence = matches[0].probability;
                            status.innerText = `Verified! Stubble detected (${Math.round(confidence * 100)}%)`;
                            status.classList.remove('text-green-400', 'text-red-400', 'animate-pulse');
                            status.classList.add('text-green-300');
                            submitBtn.disabled = false;

                            // Update Estimation Logic
                            // Assume 1 verification = 2 tons for MVP
                            const tons = 2;
                            const earnings = tons * 2500; // Rs. 2500 per ton
                            const credits = tons * 1.5; // 1.5 credits per ton
                            
                            document.getElementById('estEarnings').innerText = `₹${earnings.toLocaleString()}`;
                            document.getElementById('estCredits').innerText = `${credits.toFixed(1)} t`;
                        } else {
                            status.innerText = "Warning: Stubble not clearly detected. Please retake.";
                            status.classList.remove('text-green-400', 'animate-pulse');
                            status.classList.add('text-red-400');
                            submitBtn.disabled = false;
                        }
                    } catch (err) {
                        console.error("Classification error:", err);
                        status.innerText = "Error during verification. Try again.";
                        status.classList.remove('animate-pulse');
                        status.classList.add('text-red-400');
                    }
                };
            };
            reader.readAsDataURL(file);
        });

        submitBtn.addEventListener('click', async () => {
            const formData = new FormData();
            formData.append('image', imageInput.files[0]);
            formData.append('latitude', coords.lat);
            formData.append('longitude', coords.lon);
            formData.append('confidence', confidence);

            status.innerText = "Uploading...";
            submitBtn.disabled = true;

            try {
                const response = await fetch('upload.php', {
                    method: 'POST',
                    body: formData
                });
                
                const responseText = await response.text();
                let result;
                try {
                    result = JSON.parse(responseText);
                } catch (e) {
                    console.error("Raw response:", responseText);
                    throw new Error("Invalid server response. Check console for details.");
                }

                if (result.success) {
                    alert('Upload successful!');
                    location.reload();
                } else {
                    alert('Upload failed: ' + result.message);
                    submitBtn.disabled = false;
                }
            } catch (err) {
                alert('Error: ' + err.message);
                submitBtn.disabled = false;
            }
        });
    </script>
</body>
</html>
