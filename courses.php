<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeOrbit | Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f0216; color: #ffffff; overflow-x: hidden; scroll-behavior: smooth; }
        
        /* Launch Map Animations */
        @keyframes launch {
            0% { bottom: 10%; opacity: 1; }
            100% { bottom: 75%; opacity: 1; transform: scale(0.8); }
        }
        .animate-launch {
            animation: launch 2.5s cubic-bezier(0.25, 1, 0.5, 1) forwards;
            animation-delay: 0.5s;
        }
        .planet-pulse {
            animation: pulseGlow 2s infinite alternate;
        }
        @keyframes pulseGlow {
            0% { box-shadow: 0 0 10px rgba(191,247,71,0.2); }
            100% { box-shadow: 0 0 30px rgba(191,247,71,0.6); }
        }
        
        /* Transition classes for hiding the map */
        .fade-out-up {
            opacity: 0;
            transform: translateY(-20px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="flex flex-col md:flex-row">

    <?php include 'includes/sidebar.php'; ?>

    <main class="md:ml-64 w-full md:w-[calc(100%-16rem)] min-h-screen pt-24 md:pt-12 px-6 md:px-12 pb-12">
        <div class="max-w-4xl mx-auto">
            
            <div id="launchMapContainer" class="relative w-full h-[500px] bg-white/5 border border-white/10 rounded-3xl mb-12 flex flex-col items-center justify-between py-8 overflow-hidden transition-all duration-700">
                
                <div class="absolute top-24 bottom-24 w-0.5 border-l-2 border-dashed border-white/20"></div>

                <button id="jsPlanetBtn" class="z-20 text-center group cursor-pointer transition-transform hover:scale-110 flex flex-col items-center">
                    <div class="w-20 h-20 bg-[#BFF747]/20 border-2 border-[#BFF747] rounded-full flex items-center justify-center text-4xl planet-pulse mb-3 backdrop-blur-sm">
                        🌕
                    </div>
                    <h2 class="text-2xl font-bold text-[#BFF747]">JavaScript Planet</h2>
                    <span class="text-xs text-[#a097a6] uppercase tracking-widest mt-1 group-hover:text-white transition-colors">Click to Establish Orbit</span>
                </button>

                <div class="absolute bottom-[10%] opacity-0 animate-launch z-10" id="mapRocket">
                    <svg width="40" height="70" viewBox="0 0 60 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M30 0 C45 20 45 60 45 70 L15 70 C15 60 15 20 30 0Z" fill="rgba(191,247,71,0.1)" stroke="#BFF747" stroke-width="2"/>
                        <path d="M15 50 L0 80 L15 70 Z" fill="#BFF747"/>
                        <path d="M45 50 L60 80 L45 70 Z" fill="#BFF747"/>
                        <circle cx="30" cy="35" r="6" fill="#0f0216" stroke="#BFF747" stroke-width="2"/>
                        <path d="M26 80 L34 80 L30 100 Z" fill="#BFF747" filter="drop-shadow(0 0 6px #BFF747)">
                            <animate attributeName="opacity" values="0.6;1;0.6" dur="0.1s" repeatCount="indefinite" />
                        </path>
                    </svg>
                </div>

                <div class="z-20 text-center flex flex-col items-center">
                    <div class="text-4xl mb-2 grayscale opacity-70">🌍</div>
                    <div class="text-[#a097a6] font-bold tracking-widest uppercase text-sm">Earth Base</div>
                </div>
            </div>

            <div id="missionContainer" class="hidden opacity-0 transform translate-y-10 transition-all duration-700 ease-out">
                <div class="border-b border-white/10 pb-4 mb-8">
                    <h1 class="text-3xl md:text-4xl font-bold text-white">JavaScript <span class="text-[#BFF747]">Planet</span></h1>
                    <p class="text-[#a097a6] mt-2 text-lg">Orbit established. Select a mission to begin your training.</p>
                </div>
                
                <div class="space-y-6">
                    <?php
                    // Load and parse the JSON file
                    $jsonData = file_get_contents('js.json');
                    $data = json_decode($jsonData, true);

                    if ($data && isset($data['lectures'])) {
                        foreach ($data['lectures'] as $lecture) {
                            echo '
                            <div class="bg-white/5 border border-white/10 p-6 rounded-2xl hover:border-[#BFF747]/50 transition-all flex flex-col md:flex-row justify-between items-start md:items-center gap-4 group">
                                <div>
                                    <h3 class="text-xl font-bold text-white group-hover:text-[#BFF747] transition-colors">' . htmlspecialchars($lecture['title']) . '</h3>
                                    <div class="flex items-center gap-4 mt-2 text-sm text-[#a097a6]">
                                        <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> ' . htmlspecialchars($lecture['date']) . '</span>
                                        <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> ' . htmlspecialchars($lecture['duration']) . '</span>
                                    </div>
                                </div>
                                <a href="viewcourses.php?id=' . urlencode($lecture['id']) . '" class="w-full md:w-auto px-6 py-3 bg-[#BFF747]/10 text-[#BFF747] border border-[#BFF747]/30 font-bold rounded-xl hover:bg-[#BFF747] hover:text-[#0f0216] transition-all text-center">
                                    Launch Module
                                </a>
                            </div>';
                        }
                    } else {
                        echo '<p class="text-red-400">Error loading mission data. Check js.json.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const jsPlanetBtn = document.getElementById('jsPlanetBtn');
            const mapContainer = document.getElementById('launchMapContainer');
            const missionContainer = document.getElementById('missionContainer');

            // Skip animation logic
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('skipAnim') === 'true') {
                mapContainer.style.display = 'none';
                missionContainer.classList.remove('hidden', 'opacity-0', 'translate-y-10');
                return;
            }

            jsPlanetBtn.addEventListener('click', () => {
                // Remove pulse, lock active state
                jsPlanetBtn.querySelector('div').classList.remove('planet-pulse');
                jsPlanetBtn.querySelector('div').classList.add('bg-[#BFF747]/40');
                
                // Fade out the map
                mapContainer.classList.add('fade-out-up');
                
                setTimeout(() => {
                    // Hide the map completely from DOM layout
                    mapContainer.style.display = 'none';
                    
                    // Reveal the mission list
                    missionContainer.classList.remove('hidden');
                    
                    // Trigger reflow to ensure the fade-in animation plays
                    void missionContainer.offsetWidth; 
                    
                    // Fade in and slide up
                    missionContainer.classList.remove('opacity-0', 'translate-y-10');
                }, 600); // Matches the CSS transition time
            });
        });
    </script>
</body>
</html>