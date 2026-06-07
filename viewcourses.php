<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeOrbit | Study Area</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f0216; color: #ffffff; overflow-x: hidden; }
        
        /* * ROCKET FLIGHT ENGINE */
        #scrollRocket {
            position: fixed;
            bottom: 10%;
            transform: translate(-50%, 50%);
            transition: bottom 0.1s ease-out;
            z-index: 50;
        }

        /* SVG and Popup Morphing Transitions */
        #scrollRocket .rocket-svg {
            transition: transform 0.4s ease, opacity 0.4s ease;
            transform-origin: center center;
        }
        
        #scrollRocket .next-mission-popup {
            position: absolute;
            left: 50%;
            bottom: 0; /* Align with track center */
            opacity: 0;
            transform: translate(-50%, 50%) scale(0.5);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            pointer-events: none;
            white-space: nowrap;
        }

        /* DOCKED STATE: Hides rocket, shows Next Button */
        #scrollRocket.docked .rocket-svg {
            opacity: 0;
            transform: scale(0);
        }
        #scrollRocket.docked .next-mission-popup {
            opacity: 1;
            transform: translate(-50%, 50%) scale(1);
            pointer-events: auto;
        }

        /* Thruster Animation */
        #rocketFlame {
            transform-origin: top center;
            transform: scaleY(0);
            opacity: 0;
            transition: transform 0.7s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.7s ease-in;
        }
        .is-flying #rocketFlame {
            transform: scaleY(1);
            opacity: 1;
            animation: flicker 0.1s infinite alternate 0.7s; 
        }

        @keyframes flicker {
            0% { transform: scaleY(0.9); opacity: 0.8; }
            100% { transform: scaleY(1.1); opacity: 1; }
        }

        /* Puzzle Nodes */
        .puzzle-node { transition: all 0.3s ease; }
        .puzzle-node.active {
            background-color: #BFF747;
            box-shadow: 0 0 25px #BFF747;
            border-color: #BFF747;
            transform: translate(-50%, -50%) scale(1.6);
        }
        .context-card { transition: all 0.4s ease; }
        .context-card.active {
            border-color: rgba(191, 247, 71, 0.5);
            background: rgba(191, 247, 71, 0.05);
            transform: translateX(10px);
        }

        @keyframes bounceUp {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-bounce-up { animation: bounceUp 2s infinite; }
    </style>
</head>
<body class="flex flex-col md:flex-row relative">

    <?php include 'includes/sidebar.php'; ?>

    <?php
    // Fetch Current and Next Lecture Data
    $lectureId = isset($_GET['id']) ? $_GET['id'] : null;
    $currentLecture = null;
    $nextLecture = null;

    if ($lectureId) {
        $jsonData = file_get_contents('js.json');
        $data = json_decode($jsonData, true);
        $lectures = $data['lectures'];
        $totalLectures = count($lectures);
        
        for ($i = 0; $i < $totalLectures; $i++) {
            if ($lectures[$i]['id'] === $lectureId) {
                $currentLecture = $lectures[$i];
                // Check if there is a next lecture in the array
                if ($i + 1 < $totalLectures) {
                    $nextLecture = $lectures[$i + 1];
                }
                break;
            }
        }
    }
    ?>

    <?php if ($currentLecture && !empty($currentLecture['content'])): ?>
        <div id="scrollRocket" class="hidden md:block" >
            
            <svg class="rocket-svg" width="34" height="65" viewBox="0 0 60 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M30 0 C45 20 45 60 45 70 L15 70 C15 60 15 20 30 0Z" fill="rgba(191,247,71,0.15)" stroke="#BFF747" stroke-width="2"/>
                <path d="M15 50 L0 80 L15 70 Z" fill="#BFF747"/>
                <path d="M45 50 L60 80 L45 70 Z" fill="#BFF747"/>
                <circle cx="30" cy="35" r="5" fill="#0f0216" stroke="#BFF747" stroke-width="2"/>
                <path id="rocketFlame" d="M24 75 L36 75 L30 105 Z" fill="#BFF747" filter="drop-shadow(0 0 8px #BFF747)" />
            </svg>

            <?php if ($nextLecture): ?>
            <a href="viewcourses.php?id=<?php echo urlencode($nextLecture['id']); ?>" class="next-mission-popup bg-[#0f0216] border-2 border-[#BFF747] rounded-2xl p-5 flex flex-col items-center justify-center shadow-[0_0_30px_rgba(191,247,71,0.4)] hover:bg-[#1a0525] transition-colors group">
                <span class="text-[#a097a6] text-xs uppercase tracking-widest mb-1 flex items-center gap-2">
                    Next Mission <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="#BFF747" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </span>
                <span class="text-[#BFF747] font-bold text-lg"><?php echo htmlspecialchars($nextLecture['title']); ?></span>
                <span class="text-xs text-white/50 mt-1"><?php echo htmlspecialchars($nextLecture['date']); ?></span>
            </a>
            <?php else: ?>
            <div class="next-mission-popup bg-[#0f0216] border-2 border-white/20 rounded-2xl p-5 flex flex-col items-center shadow-lg">
                <span class="text-white font-bold text-lg">Planet Explored 🏁</span>
                <span class="text-[#a097a6] text-xs mt-1">All missions complete.</span>
            </div>
            <?php endif; ?>

        </div>
    <?php endif; ?>

    <main class="md:ml-64 w-full md:w-[calc(100%-16rem)] min-h-screen pt-12 md:pt-12 px-4 md:px-12 pb-12 overflow-hidden">
        <div class="max-w-4xl mx-auto relative flex flex-col h-full">

            <?php if ($currentLecture): ?>
                
                <?php if (!empty($currentLecture['content'])): ?>
                <div class="mb-20 pb-12 border-b border-white/10 flex flex-col items-center justify-center text-center mt-12 md:pl-24">
                    <div class="w-16 h-16 bg-[#BFF747]/20 border-2 border-[#BFF747] rounded-full flex items-center justify-center text-3xl mb-4 shadow-[0_0_30px_rgba(191,247,71,0.4)]">
                        🏁
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-2">Orbit Reached</h2>
                    <p class="text-[#a097a6] mb-8">You have completed all mission contexts.</p>
                    
                    <div class="flex flex-col md:flex-row gap-4 items-center">
                        
                        <a href="practice.php?lec=<?php echo urlencode($currentLecture['id']); ?>" class="px-8 py-4 bg-[#BFF747] text-[#0f0216] text-lg font-bold rounded-full hover:-translate-y-1 hover:shadow-[0_10px_20px_rgba(191,247,71,0.2)] transition-all duration-300">
                            Solve Question Module &rarr;
                        </a>
                        
                        <?php if ($nextLecture): ?>
                        <a href="viewcourses.php?id=<?php echo urlencode($nextLecture['id']); ?>" class="px-8 py-4 bg-transparent border-2 border-[#BFF747] text-[#BFF747] font-bold rounded-full hover:bg-[#BFF747] hover:text-[#0f0216] transition-all duration-300 flex flex-col items-center md:hidden">
                            <span>Next: <?php echo htmlspecialchars(explode(":", $nextLecture['title'])[0]); ?></span>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="relative w-full">
                    <div id="documentTrack" class="absolute top-0 bottom-0 left-[2rem] md:left-[4rem] w-[2px] bg-white/10 -translate-x-1/2 z-0 hidden md:block"></div>

                    <div class="space-y-16 pl-4 md:pl-[8rem] py-10 relative">
                        <?php 
                        if (!empty($currentLecture['content'])) {
                            $reversedContent = array_reverse($currentLecture['content']);
                            foreach ($reversedContent as $context) {
                                echo '
                                <div class="context-card relative bg-white/5 border border-white/10 p-6 md:p-8 rounded-2xl">
                                    <div class="puzzle-node absolute left-[-2rem] md:left-[-4rem] top-1/2 -translate-y-1/2 -translate-x-1/2 w-4 h-4 bg-[#0f0216] border-2 border-white/40 rounded-full z-20 hidden md:block"></div>
                                    <span class="text-[#BFF747] font-mono text-sm tracking-widest uppercase mb-2 block">Context ' . htmlspecialchars($context['step']) . ' / 30</span>
                                    <h3 class="text-2xl font-bold text-white mb-4">' . htmlspecialchars($context['heading']) . '</h3>
                                    <p class="text-[#a097a6] leading-relaxed text-lg">' . htmlspecialchars($context['text']) . '</p>
                                </div>';
                            }
                        } else {
                            echo '<p class="text-white mt-20">Content is currently being uploaded from Earth. Please check back soon.</p>';
                        }
                        ?>
                    </div>
                </div>

                <div class="mt-10 pt-16 border-t border-white/10 pb-[20vh] md:pl-24">
                    <a href="courses.php" class="text-[#a097a6] hover:text-[#BFF747] inline-flex items-center gap-2 mb-8 transition-colors uppercase text-sm font-bold tracking-wider">
                        &larr; Abort Mission
                    </a>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4 text-[#BFF747] leading-tight"><?php echo htmlspecialchars($currentLecture['title']); ?></h1>
                    <p class="text-[#a097a6] bg-white/5 inline-block px-4 py-2 rounded-lg border border-white/10">Total Duration: <?php echo htmlspecialchars($currentLecture['duration']); ?></p>
                    
                    <?php if (!empty($currentLecture['content'])): ?>
                    <div class="mt-16 flex flex-col md:flex-row items-center gap-6 animate-bounce-up bg-white/5 p-6 rounded-2xl border border-[#BFF747]/30 inline-flex">
                        <svg width="40" height="60" viewBox="0 0 60 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="opacity-80">
                            <path d="M30 0 C45 20 45 60 45 70 L15 70 C15 60 15 20 30 0Z" fill="rgba(191,247,71,0.1)" stroke="#BFF747" stroke-width="2"/>
                            <path d="M15 50 L0 80 L15 70 Z" fill="#BFF747"/>
                            <path d="M45 50 L60 80 L45 70 Z" fill="#BFF747"/>
                            <circle cx="30" cy="35" r="6" fill="#0f0216" stroke="#BFF747" stroke-width="2"/>
                        </svg>
                        <div class="text-center md:text-left">
                            <span class="block text-[#BFF747] font-bold text-xl uppercase tracking-widest mb-1">Initiate Launch</span>
                            <span class="block text-[#a097a6] text-sm">Scroll UP to ignite thrusters</span>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

            <?php else: ?>
                <div class="text-center mt-20">
                    <h2 class="text-2xl text-red-400 mb-4">Error: Mission coordinates not found.</h2>
                    <p class="text-[#a097a6]">The requested lecture could not be loaded.</p>
                </div>
            <?php endif; ?>

        </div>
    </main>

    <script>
        // Force Scroll to bottom instantly
        window.onload = () => {
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'instant' });
            setTimeout(() => {
                window.scrollTo({ top: document.body.scrollHeight, behavior: 'instant' });
                alignRocketToTrack(); 
            }, 150);
        };

        // Align Rocket precisely with the Track rail
        function alignRocketToTrack() {
            const track = document.getElementById('documentTrack');
            const rocket = document.getElementById('scrollRocket');
            if (track && rocket && window.innerWidth >= 768) {
                const rect = track.getBoundingClientRect();
                rocket.style.left = `${rect.left + (rect.width / 2)}px`;
            }
        }
        window.addEventListener('resize', alignRocketToTrack);

        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.context-card');
            const rocket = document.getElementById('scrollRocket');
            
            let lastScrollTop = window.scrollY || document.documentElement.scrollTop;
            let scrollTimeout;

            if (rocket) {
                window.addEventListener('scroll', () => {
                    const scrollTop = window.scrollY || document.documentElement.scrollTop;
                    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
                    
                    if (docHeight > 0) {
                        const scrollPercent = (docHeight - scrollTop) / docHeight;
                        
                        // Map scroll to viewport height
                        const minBottom = 10;
                        const maxBottom = 85; 
                        const currentBottom = minBottom + (scrollPercent * (maxBottom - minBottom));
                        
                        rocket.style.bottom = `${Math.max(minBottom, Math.min(maxBottom, currentBottom))}%`;

                        // --- THE SHAPE-SHIFT LOGIC ---
                        // If we reach the top of the track (84% or higher), convert to button
                        if (currentBottom >= 84) {
                            rocket.classList.add('docked');
                            document.body.classList.remove('is-flying'); // Cut engine
                        } else {
                            rocket.classList.remove('docked');
                            
                            // Normal thruster logic when not docked
                            if (scrollTop < lastScrollTop - 2) {
                                document.body.classList.add('is-flying');
                            } else if (scrollTop > lastScrollTop + 2) {
                                document.body.classList.remove('is-flying');
                            }
                        }
                    }

                    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;

                    // Stop engine 150ms after scrolling stops (if not docked)
                    clearTimeout(scrollTimeout);
                    scrollTimeout = setTimeout(() => {
                        document.body.classList.remove('is-flying');
                    }, 150);

                    // --- COLLISION DETECTION LOGIC ---
                    if (window.innerWidth >= 768) {
                        const rocketRect = rocket.getBoundingClientRect();
                        const rocketCenterY = rocketRect.top + (rocketRect.height / 2);

                        cards.forEach(card => {
                            const node = card.querySelector('.puzzle-node');
                            if (!node) return;
                            
                            const nodeRect = node.getBoundingClientRect();
                            const nodeCenterY = nodeRect.top + (nodeRect.height / 2);

                            // Glow when rocket nose touches node
                            if (Math.abs(nodeCenterY - rocketCenterY) < 40) {
                                card.classList.add('active');
                                node.classList.add('active');
                            } else {
                                card.classList.remove('active');
                                node.classList.remove('active');
                            }
                        });
                    }
                });
            }
            
            alignRocketToTrack(); // Initial alignment
        });
    </script>

</body>
</html>