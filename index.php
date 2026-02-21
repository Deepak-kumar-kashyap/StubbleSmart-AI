<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StubbleSmart AI | Sustainable Future</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap');
        body { font-family: 'Outfit', sans-serif; scroll-behavior: smooth; }
        .hero-bg {
            background: linear-gradient(rgba(5, 5, 5, 0.7), rgba(5, 5, 5, 0.9)), url('stubble_clean_energy_hero_1771682748805.png');
            background-size: cover;
            background-position: center;
        }
        .glass {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .text-glow { text-shadow: 0 0 20px rgba(34, 197, 94, 0.5); }
        .blob {
            position: absolute;
            width: 500px; height: 500px;
            background: rgba(34, 197, 94, 0.1);
            filter: blur(100px);
            border-radius: 50%;
            z-index: -1;
        }
    </style>
</head>
<body class="bg-[#050505] text-gray-200 overflow-x-hidden">
    <!-- Blobs -->
    <div class="blob top-[-100px] right-[-100px]"></div>
    <div class="blob bottom-[-100px] left-[-100px] bg-blue-500/05"></div>

    <!-- Header -->
    <nav class="fixed top-0 w-full z-50 glass border-b border-white/5 px-8 py-4 flex justify-between items-center bg-[#050505]/50">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/40 rotate-3">
                <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <h1 class="text-2xl font-black tracking-tighter text-white">STUBBLE<span class="text-green-500">SMART</span></h1>
        </div>
        <div class="hidden md:flex gap-10 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">
            <a href="#how" class="hover:text-green-400 transition-all">Workflow</a>
            <a href="#impact" class="hover:text-green-400 transition-all">Impact</a>
            <a href="farmer.php" class="hover:text-green-400 transition-all">Farmer portal</a>
        </div>
        <a href="industry.php" class="bg-white text-black px-6 py-2.5 rounded-full font-black text-xs uppercase tracking-widest hover:bg-green-500 hover:text-white transition-all shadow-xl">
            Live Feed
        </a>
    </nav>

    <!-- Hero -->
    <header class="hero-bg min-h-screen flex items-center pt-24 px-8 overflow-hidden">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div data-aos="fade-right" data-aos-duration="1200">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-green-500/10 border border-green-500/20 text-green-400 text-[10px] font-black uppercase tracking-widest mb-6">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    AI-Verified Sustainable Logistics
                </div>
                <h2 class="text-7xl md:text-8xl font-black text-white leading-[0.9] tracking-tighter mb-8">
                    Harvest <span class="text-green-500 text-glow">Value</span>,<br>Not Smoke.
                </h2>
                <p class="text-lg text-gray-400 max-w-lg leading-relaxed mb-10">
                    India produces 30 million tons of stubble waste. We use on-device AI to verify supply and connect farmers to bio-energy markets instantly.
                </p>
                <div class="flex flex-wrap gap-5">
                    <a href="farmer.php" class="bg-green-500 text-black px-10 py-5 rounded-2xl font-black text-lg hover:scale-105 active:scale-95 transition-all shadow-2xl shadow-green-500/20 flex items-center gap-3">
                        Join as Farmer
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <a href="industry.php" class="glass px-10 py-5 rounded-2xl font-black text-lg hover:bg-white/5 transition-all">
                        Industry Access
                    </a>
                </div>
            </div>
            <div class="relative hidden lg:block" data-aos="zoom-in" data-aos-delay="400">
                <div class="absolute inset-0 bg-green-500/20 blur-[120px] rounded-full animate-pulse"></div>
                <div class="glass p-2 rounded-[3.5rem] relative overflow-hidden backdrop-blur-2xl">
                    <img src="stubble_clean_energy_hero_1771682748805.png" alt="Bio Energy" class="w-full h-auto rounded-[3rem] shadow-2xl">
                    <!-- Floating Stat -->
                    <div class="absolute bottom-10 left-10 glass p-6 rounded-3xl animate-bounce-slow">
                        <p class="text-[10px] font-black text-green-500 uppercase tracking-widest">Global Impact</p>
                        <h4 class="text-3xl font-black text-white mt-1">1.5 <span class="text-sm font-medium">Tons</span></h4>
                        <p class="text-[9px] text-gray-500 mt-1 uppercase">CO2 saved per ton stubble</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Workflow Section -->
    <section id="how" class="py-32 px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-24" data-aos="fade-up">
                <h3 class="text-4xl md:text-5xl font-black text-white mb-4">The Intelligent Workflow</h3>
                <p class="text-gray-500 uppercase font-bold tracking-widest text-xs">From Field to Fuel in 3 Simple Steps</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="glass p-10 rounded-[2.5rem] group hover:bg-white/5 transition-all border-b-4 border-yellow-500" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-yellow-500/10 rounded-2xl flex items-center justify-center mb-8 border border-yellow-500/20">
                        <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                    </div>
                    <h4 class="text-2xl font-black text-white mb-4">AI Verification</h4>
                    <p class="text-gray-400 text-sm leading-relaxed">Farmers snap a photo. Our on-device MobileNet model verifies stubble quality instantly, preventing fraud without a server.</p>
                </div>
                <!-- Step 2 -->
                <div class="glass p-10 rounded-[2.5rem] group hover:bg-white/5 transition-all border-b-4 border-green-500" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-green-500/10 rounded-2xl flex items-center justify-center mb-8 border border-green-500/20">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                    </div>
                    <h4 class="text-2xl font-black text-white mb-4">Geospatial Logistics</h4>
                    <p class="text-gray-400 text-sm leading-relaxed">Locations are mapped in real-time. Industries optimize routes to collect verified stubble from the nearest fields.</p>
                </div>
                <!-- Step 3 -->
                <div class="glass p-10 rounded-[2.5rem] group hover:bg-white/5 transition-all border-b-4 border-blue-500" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-blue-500/10 rounded-2xl flex items-center justify-center mb-8 border border-blue-500/20">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-2xl font-black text-white mb-4">Carbon Economy</h4>
                    <p class="text-gray-400 text-sm leading-relaxed">Farmers earn money and carbon credits. Industries get green raw material. The environment wins with zero smoke.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Section -->
    <section id="impact" class="relative py-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div class="order-2 lg:order-1" data-aos="fade-right">
                <div class="space-y-6">
                    <div class="glass p-8 rounded-3xl border-l-4 border-red-500 bg-red-500/05">
                        <h4 class="text-red-400 font-black text-lg mb-2">The Old Way: Burning</h4>
                        <p class="text-sm text-gray-500">Toxic smog, health crises, wasted soil nutrients, and zero profit for the farmer.</p>
                    </div>
                    <div class="glass p-8 rounded-3xl border-l-4 border-green-500 bg-green-500/05">
                        <h4 class="text-green-400 font-black text-lg mb-2">The StubbleSmart Way</h4>
                        <p class="text-sm text-gray-500">Verified bio-energy supply, clean air, soil health preservation, and new revenue streams.</p>
                    </div>
                </div>
            </div>
            <div class="order-1 lg:order-2" data-aos="fade-left">
                <h3 class="text-5xl font-black text-white mb-8">Why it matters?</h3>
                <p class="text-lg text-gray-400 leading-relaxed mb-8">
                    Stubble burning is one of the leading causes of air pollution in North India during winter. We are not just building an app; we are building an ecosystem to end this crisis forever.
                </p>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h5 class="text-4xl font-black text-green-500">30%</h5>
                        <p class="text-xs text-gray-600 uppercase font-bold mt-2">Reduction in Smog</p>
                    </div>
                    <div>
                        <h5 class="text-4xl font-black text-white">₹5.2k</h5>
                        <p class="text-xs text-gray-600 uppercase font-bold mt-2">Avg. Farmer Profit</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-32 px-8">
        <div class="max-w-5xl mx-auto glass p-12 md:p-20 rounded-[4rem] text-center relative overflow-hidden" data-aos="zoom-in">
            <div class="absolute inset-0 bg-green-500/05 animate-pulse"></div>
            <h3 class="text-5xl md:text-6xl font-black text-white mb-8 relative">Ready to make a change?</h3>
            <p class="text-xl text-gray-400 mb-12 relative max-w-2xl mx-auto">Join the decentralized marketplace for agricultural waste today.</p>
            <div class="flex flex-wrap justify-center gap-6 relative">
                <a href="farmer.php" class="bg-white text-black px-12 py-5 rounded-2xl font-black text-xl hover:bg-green-500 hover:text-white transition-all">Start Reporting</a>
                <a href="industry.php" class="bg-transparent border-2 border-white/20 px-12 py-5 rounded-2xl font-black text-xl hover:bg-white/5 transition-all">Industry Portal</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-20 border-t border-white/5 text-center">
        <div class="flex justify-center gap-3 mb-8">
            <div class="w-8 h-8 bg-white/5 rounded-lg flex items-center justify-center text-gray-500 hover:text-green-500 cursor-pointer transition-all">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
            </div>
            <!-- More icons... -->
        </div>
        <p class="text-[10px] font-black uppercase tracking-[0.4em] text-gray-600">&copy; 2026 STUBBLE SMART AI • SOLVING SMOG WITH CODE</p>
    </footer>

    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
    </script>
</body>
</html>
