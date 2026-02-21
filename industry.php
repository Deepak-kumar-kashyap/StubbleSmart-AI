<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StubbleSmart AI - Industry Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap');
        body { font-family: 'Outfit', sans-serif; }
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        #map { height: 450px; border-radius: 1.5rem; }
        .marker-pin {
            width: 24px; height: 24px; border-radius: 50% 50% 50% 0;
            border: 2px solid white; box-shadow: 0 0 15px rgba(0,0,0,0.3);
            transform: rotate(-45deg);
            display: flex; align-items: center; justify-content: center;
        }
        .marker-inner {
            width: 8px; height: 8px; background: white; border-radius: 50%;
            transform: rotate(45deg);
        }
        .status-pending { background: #eab308; }
        .status-verified { background: #22c55e; }
        .status-collected { background: #3b82f6; }
        
        .card-active { border-left: 4px solid #22c55e; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
    </style>
</head>
<body class="bg-[#050505] min-h-screen text-gray-200">
    <nav class="p-6 border-b border-white/5 flex justify-between items-center sticky top-0 bg-[#050505]/80 backdrop-blur-md z-[1000]">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/20">
                <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <h1 class="text-2xl font-black tracking-tighter">STUBBLE<span class="text-green-400">SMART</span></h1>
        </div>
        <div class="space-x-8 text-sm font-semibold uppercase tracking-widest">
            <a href="index.php" class="text-gray-400 hover:text-green-400 Transition-all">Home</a>
            <a href="farmer.php" class="text-gray-400 hover:text-green-400 Transition-all">Farmer App</a>
            <a href="industry.php" class="text-green-400 border-b-2 border-green-400 pb-1">Industry Dashboard</a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto p-8 space-y-10">
        <!-- Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="glass p-6 rounded-3xl group hover:bg-white/10 transition-all cursor-default">
                <p class="text-gray-500 font-medium text-sm">Total Supply</p>
                <h3 id="statTotal" class="text-4xl font-black text-white mt-1">0</h3>
                <div class="w-full h-1 bg-white/10 mt-4 rounded-full overflow-hidden">
                    <div class="w-full h-full bg-green-500"></div>
                </div>
            </div>
            <div class="glass p-6 rounded-3xl group hover:bg-white/10 transition-all cursor-default">
                <p class="text-gray-500 font-medium text-sm">Verified Lots</p>
                <h3 id="statVerified" class="text-4xl font-black text-green-400 mt-1">0</h3>
                <div class="w-full h-1 bg-white/10 mt-4 rounded-full overflow-hidden">
                    <div id="barVerified" class="w-0 h-full bg-green-400 transition-all duration-1000"></div>
                </div>
            </div>
            <div class="glass p-6 rounded-3xl group hover:bg-white/10 transition-all cursor-default">
                <p class="text-gray-500 font-medium text-sm">Collected</p>
                <h3 id="statCollected" class="text-4xl font-black text-blue-400 mt-1">0</h3>
                <div class="w-full h-1 bg-white/10 mt-4 rounded-full overflow-hidden">
                    <div id="barCollected" class="w-0 h-full bg-blue-400 transition-all duration-1000"></div>
                </div>
            </div>
            <div class="bg-green-500/10 border border-green-500/20 p-6 rounded-3xl shadow-xl shadow-green-500/5">
                <p class="text-green-400 font-bold text-sm uppercase tracking-tighter">Carbon Offset</p>
                <h3 id="statCarbon" class="text-4xl font-black text-white mt-1">0 <span class="text-xl">tons</span></h3>
                <p class="text-xs text-green-500/60 mt-2 italic">Prevented from burning</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Map Section -->
            <div class="lg:col-span-2 space-y-6">
                <div class="flex justify-between items-center px-2">
                    <h2 class="text-3xl font-black text-white tracking-tight">Geospatial Distribution</h2>
                    <div class="flex items-center gap-4">
                        <button onclick="exportToCSV()" class="bg-white/5 border border-white/10 px-4 py-2 rounded-xl text-xs font-bold hover:bg-white/10 transition-all flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Export CSV
                        </button>
                        <div class="flex gap-2">
                            <span class="flex items-center gap-1.5 text-xs text-gray-500"><div class="w-2 h-2 rounded-full status-pending"></div> Pending</span>
                            <span class="flex items-center gap-1.5 text-xs text-gray-500"><div class="w-2 h-2 rounded-full status-verified"></div> Verified</span>
                            <span class="flex items-center gap-1.5 text-xs text-gray-500"><div class="w-2 h-2 rounded-full status-collected"></div> Collected</span>
                        </div>
                    </div>
                </div>
                <div class="glass p-3 rounded-[2rem] shadow-2xl">
                    <div id="map"></div>
                </div>
            </div>

            <!-- List Section -->
            <div class="space-y-6">
                <div class="flex justify-between items-center px-1">
                    <h3 class="text-2xl font-black text-white tracking-tight">Supply Ledger</h3>
                    <button onclick="fetchData()" class="text-xs font-bold text-green-400 hover:rotate-180 transition-all duration-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    </button>
                </div>
                <div id="listingContainer" class="space-y-5 h-[500px] overflow-y-auto pr-3 custom-scrollbar">
                    <!-- Cards injected here -->
                    <div class="flex flex-col items-center justify-center h-full text-gray-700 animate-pulse">
                        <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <p class="font-bold uppercase tracking-widest text-xs">Syncing Ledger...</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const map = L.map('map', { zoomControl: false }).setView([22.0, 78.0], 4);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; STUBBLE SMART AI'
        }).addTo(map);

        let markers = [];
        let rawData = []; // Store data for CSV export

        async function updateStatus(id, status) {
            const formData = new FormData();
            formData.append('id', id);
            formData.append('status', status);

            try {
                const res = await fetch('api/update_status.php', { method: 'POST', body: formData });
                const data = await res.json();
                if (data.success) fetchData();
            } catch (err) { console.error(err); }
        }

        async function fetchData() {
            try {
                const response = await fetch('api/get_stubbles.php');
                const data = await response.json();
                rawData = data.stubbles; // Store for export
                
                // Update Stats
                document.getElementById('statTotal').innerText = data.stats.total;
                document.getElementById('statVerified').innerText = data.stats.verified;
                document.getElementById('statCollected').innerText = data.stats.collected;
                document.getElementById('statCarbon').innerHTML = `${data.stats.carbon_saved.toFixed(1)} <span class="text-xl">tons</span>`;

                // Update Progress Bars
                document.getElementById('barVerified').style.width = (data.stats.verified / data.stats.total * 100) + '%';
                document.getElementById('barCollected').style.width = (data.stats.collected / data.stats.total * 100) + '%';
                
                const container = document.getElementById('listingContainer');
                container.innerHTML = '';
                markers.forEach(m => map.removeLayer(m));
                markers = [];

                if (data.stubbles.length === 0) {
                    container.innerHTML = '<div class="text-center py-20 text-gray-700 font-bold uppercase tracking-widest text-xs">No supply reported</div>';
                    return;
                }

                data.stubbles.forEach(item => {
                    const lat = parseFloat(item.latitude);
                    const lon = parseFloat(item.longitude);

                    // Marker
                    const dotClass = `status-${item.status}`;
                    const customMarker = L.divIcon({
                        className: 'custom-div-icon',
                        html: `<div class='marker-pin ${dotClass}'><div class='marker-inner'></div></div>`,
                        iconSize: [24, 24],
                        iconAnchor: [12, 24]
                    });

                    const marker = L.marker([lat, lon], { icon: customMarker }).addTo(map);
                    marker.bindPopup(`
                        <div class="text-black font-sans p-2">
                            <img src="${item.image_path}" class="w-32 h-20 object-cover rounded-lg mb-2">
                            <p class="font-bold uppercase text-[10px] text-gray-500 mb-1">${item.status}</p>
                            <p class="text-xs">Location: ${lat.toFixed(4)}, ${lon.toFixed(4)}</p>
                        </div>
                    `);
                    markers.push(marker);

                    // Card
                    const card = document.createElement('div');
                    const statusColors = { 
                        pending: 'border-yellow-500 bg-yellow-500/5', 
                        verified: 'border-green-500 bg-green-500/5', 
                        collected: 'border-blue-500 bg-blue-500/5' 
                    };
                    
                    card.className = `glass p-4 rounded-3xl border-l-4 ${statusColors[item.status]} group hover:bg-white/10 transition-all cursor-pointer relative overflow-hidden`;
                    
                    let actionButton = '';
                    if (item.status === 'pending') {
                        actionButton = `<button onclick="event.stopPropagation(); updateStatus(${item.id}, 'verified')" class="mt-3 w-full bg-green-500 text-black text-[10px] font-black uppercase py-2 rounded-xl hover:bg-white transition-all">Verify Supply</button>`;
                    } else if (item.status === 'verified') {
                        actionButton = `<button onclick="event.stopPropagation(); updateStatus(${item.id}, 'collected')" class="mt-3 w-full bg-blue-500 text-white text-[10px] font-black uppercase py-2 rounded-xl hover:bg-white hover:text-black transition-all">Schedule Collection</button>`;
                    }

                    card.innerHTML = `
                        <div onclick="map.setView([${lat}, ${lon}], 14)" class="flex gap-4">
                            <div class="relative">
                                <img src="${item.image_path}" class="w-16 h-16 rounded-2xl object-cover shadow-lg">
                                <div class="absolute -top-1 -right-1 w-4 h-4 marker-pin ${dotClass} border-1"></div>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <h4 class="font-bold text-white text-sm capitalize">${item.status} Lot</h4>
                                    <span class="text-[10px] text-gray-600 font-mono">#${item.id}</span>
                                </div>
                                <p class="text-[10px] text-gray-500 font-medium">${Math.round(item.confidence * 100)}% Match • ${lat.toFixed(4)}, ${lon.toFixed(4)}</p>
                                ${actionButton}
                            </div>
                        </div>
                    `;
                    container.appendChild(card);
                });

                if (markers.length > 0) {
                    const group = new L.featureGroup(markers);
                    map.fitBounds(group.getBounds().pad(0.2));
                }

            } catch (err) { console.error(err); }
        }

        function exportToCSV() {
            if (rawData.length === 0) return alert("No data to export");
            
            const headers = ["ID", "Latitude", "Longitude", "Confidence", "Status", "Created At"];
            const rows = rawData.map(item => [
                item.id,
                item.latitude,
                item.longitude,
                item.confidence,
                item.status,
                item.created_at
            ]);

            let csvContent = "data:text/csv;charset=utf-8," 
                + headers.join(",") + "\n"
                + rows.map(e => e.join(",")).join("\n");

            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "stubblesmart_report.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        fetchData();
        setInterval(fetchData, 30000); // Polling for live updates
    </script>
</body>
</html>
