<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeOrbit | Master JavaScript</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f0216; color: #ffffff; overflow-x: hidden; scroll-behavior: smooth; }
        
        /* --- GALAXY BACKGROUND ANIMATION --- */
        .galaxy-wrapper {
            position: absolute;
            inset: 0;
            overflow: hidden;
            z-index: -1;
            background: radial-gradient(circle at center, #1a0b2e 0%, #0f0216 100%);
        }
        .stars {
            width: 1px; height: 1px; background: transparent;
            box-shadow: 1744px 122px #FFF, 134px 1321px #FFF, 92px 42px #FFF, 1200px 800px #FFF, 400px 600px #FFF, 1800px 300px #FFF, 800px 1400px #FFF, 1500px 900px #FFF, 300px 1100px #FFF, 600px 200px #FFF;
            animation: animStar 50s linear infinite;
        }
        .stars2 {
            width: 2px; height: 2px; background: transparent;
            box-shadow: 1044px 822px #FFF, 534px 121px #FFF, 892px 942px #FFF, 1600px 400px #FFF, 200px 800px #FFF, 1100px 1300px #FFF, 1400px 100px #FFF, 900px 600px #FFF, 100px 1500px #FFF;
            animation: animStar 100s linear infinite;
        }
        @keyframes animStar {
            from { transform: translateY(0px); }
            to { transform: translateY(-2000px); }
        }
        .nebula {
            position: absolute; width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(191,247,71,0.08) 0%, rgba(0,0,0,0) 70%);
            top: 10%; left: 60%; transform: translate(-50%, -50%);
            filter: blur(40px); animation: pulseNebula 8s ease-in-out infinite alternate;
        }
        @keyframes pulseNebula {
            0% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
            100% { transform: translate(-50%, -50%) scale(1.2); opacity: 1; }
        }

        /* --- JS PLANET GLOW --- */
        .js-planet {
            background: radial-gradient(circle at 30% 30%, #f7df1e 0%, #b8a50b 50%, #4a4303 100%);
            box-shadow: 0 0 60px rgba(247, 223, 30, 0.4), inset -20px -20px 40px rgba(0,0,0,0.5);
            animation: floatPlanet 6s ease-in-out infinite;
        }
        @keyframes floatPlanet {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        /* --- TESTIMONIAL MARQUEE --- */
        .marquee-container {
            display: flex;
            overflow: hidden;
            white-space: nowrap;
            mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        }
        .marquee-content {
            display: flex;
            gap: 2rem;
            animation: scroll 40s linear infinite;
        }
        .marquee-content:hover {
            animation-play-state: paused;
        }
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* --- TERMINAL TYPEWRITER CURSOR --- */
        .typewriter-cursor::after {
            content: '▋';
            animation: blink 1s step-end infinite;
            margin-left: 2px;
            color: #BFF747;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }
    </style>
</head>
<body class="flex flex-col md:flex-row">

    <?php include 'includes/sidebar.php'; ?>

    <main class="md:ml-64 w-full md:w-[calc(100%-16rem)] relative flex-1">
        
        <section class="relative min-h-screen flex items-center justify-center pt-20 pb-12 px-6 md:px-12 border-b border-white/10">
            <div class="galaxy-wrapper">
                <div class="nebula"></div>
                <div class="stars"></div>
                <div class="stars2"></div>
                <div class="stars" style="top: 2000px;"></div>
                <div class="stars2" style="top: 2000px;"></div>
            </div>

            <div class="max-w-4xl mx-auto text-center relative z-10">
                <div class="inline-block px-4 py-2 rounded-full border border-[#BFF747]/30 bg-[#BFF747]/10 text-[#BFF747] text-xs md:text-sm font-bold tracking-widest uppercase mb-8 backdrop-blur-md">
                    System Initialized V2.0
                </div>
                <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight tracking-tight">
                    Master JavaScript on a <br class="hidden md:block"><span class="text-[#BFF747] drop-shadow-[0_0_15px_rgba(191,247,71,0.5)]">Cosmic Scale.</span>
                </h1>
                <p class="text-lg md:text-2xl text-[#a097a6] mb-10 max-w-2xl mx-auto leading-relaxed">
                    CodeOrbit is an AI-powered learning platform designed to make JavaScript education feel like a space exploration journey.
                </p>
                
                <form action="#" method="POST" class="flex flex-col sm:flex-row gap-4 justify-center max-w-lg mx-auto">
                    <input type="email" placeholder="Enter your email to board" required class="flex-1 px-6 py-4 rounded-full bg-white/5 border border-white/20 text-white focus:outline-none focus:border-[#BFF747] backdrop-blur-md placeholder-white/40">
                    <button type="submit" class="px-8 py-4 bg-[#BFF747] text-[#0f0216] font-bold rounded-full hover:bg-white hover:shadow-[0_0_20px_rgba(191,247,71,0.4)] transition-all">
                        Initialize Launch
                    </button>
                </form>
            </div>
        </section>

        <section id="about" class="py-24 px-6 md:px-12 border-b border-white/10 relative bg-[#0a010e]">
            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-[#BFF747] text-sm font-bold tracking-widest uppercase mb-3">Origin Story</h2>
                    <h3 class="text-4xl font-bold text-white mb-6">The goal is not just to teach, but to apply.</h3>
                    <div class="space-y-4 text-[#a097a6] leading-relaxed text-lg">
                        <p>CodeOrbit was born from the idea that traditional learning is fragmented. Watching disconnected tutorials leaves you stranded in the void.</p>
                        <p>We wanted to build an ecosystem. A place where you launch from basic fundamentals on Earth, orbit through complex theory on the JS Planet, and eventually conquer the Full Stack Galaxy.</p>
                    </div>
                </div>
                <div class="relative bg-white/5 border border-white/10 p-8 rounded-3xl min-h-[300px] flex flex-col">
                    <div class="absolute top-4 left-4 flex gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    </div>
                    <pre class="font-mono text-sm text-[#BFF747] mt-6 overflow-x-auto whitespace-pre flex-1"><code id="typewriter-code" class="typewriter-cursor"></code></pre>
                </div>
            </div>
        </section>

        <section class="py-24 px-6 md:px-12 border-b border-white/10 relative">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-[#BFF747] text-sm font-bold tracking-widest uppercase mb-3">System Capabilities</h2>
                    <h3 class="text-4xl font-bold text-white">Why Train With Us?</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white/5 border border-white/10 p-8 rounded-3xl hover:border-[#BFF747]/50 transition-all group">
                        <div class="w-14 h-14 bg-[#BFF747]/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <span class="text-2xl">🤖</span>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3">AI Oracle Support</h4>
                        <p class="text-[#a097a6]">Stuck on a bug? Our built-in AI Oracle analyzes your code in real-time, providing hints without giving away the final answer.</p>
                    </div>
                    <div class="bg-white/5 border border-white/10 p-8 rounded-3xl hover:border-[#BFF747]/50 transition-all group">
                        <div class="w-14 h-14 bg-[#BFF747]/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <span class="text-2xl">🚀</span>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3">Visual Progression</h4>
                        <p class="text-[#a097a6]">Watch your rocket fly through the curriculum timeline as you scroll. Know exactly where you are in your mission at all times.</p>
                    </div>
                    <div class="bg-white/5 border border-white/10 p-8 rounded-3xl hover:border-[#BFF747]/50 transition-all group">
                        <div class="w-14 h-14 bg-[#BFF747]/10 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <span class="text-2xl">📐</span>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3">System Design Bay</h4>
                        <p class="text-[#a097a6]">Don't just write code. Use our integrated architecture deck to draw, plan, and save your full-stack application blueprints.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-32 px-6 md:px-12 border-b border-white/10 bg-[#0a010e] overflow-hidden">
            <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center gap-16">
                
                <div class="w-full md:w-1/2 flex justify-center relative">
                    <div class="absolute inset-0 bg-[#f7df1e]/10 blur-[100px] rounded-full"></div>
                    <div class="w-64 h-64 md:w-80 md:h-80 rounded-full js-planet relative z-10 flex items-center justify-center border-4 border-[#f7df1e]/50">
                        <span class="text-[#0f0216] font-black text-6xl md:text-8xl tracking-tighter">JS</span>
                        
                        <div class="absolute w-[140%] h-[40%] border-t-2 border-b-2 border-white/20 rounded-[50%] transform -rotate-12 pointer-events-none"></div>
                    </div>
                </div>

                <div class="w-full md:w-1/2 text-center md:text-left">
                    <div class="inline-block px-3 py-1 rounded-full border border-[#f7df1e]/40 bg-[#f7df1e]/10 text-[#f7df1e] text-xs font-bold tracking-widest uppercase mb-4">
                        Current Coordinates
                    </div>
                    <h3 class="text-4xl md:text-5xl font-black text-white mb-6">Explore the <br><span class="text-[#f7df1e]">JavaScript Planet</span></h3>
                    <p class="text-[#a097a6] text-lg mb-8 leading-relaxed">
                        This is the core destination. Dive deep into 150+ interactive contexts covering Variables, Objects, Asynchronous programming, and advanced Pattern Printing. Completely free, completely comprehensive.
                    </p>
                    
                    <ul class="space-y-4 mb-10 text-[#a097a6]">
                        <li class="flex items-center gap-3 justify-center md:justify-start">
                            <svg class="w-5 h-5 text-[#BFF747]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> 5 Major Mission Sectors
                        </li>
                        <li class="flex items-center gap-3 justify-center md:justify-start">
                            <svg class="w-5 h-5 text-[#BFF747]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Live In-Browser IDE Challenges
                        </li>
                        <li class="flex items-center gap-3 justify-center md:justify-start">
                            <svg class="w-5 h-5 text-[#BFF747]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> No account required to launch
                        </li>
                    </ul>

                    <a href="courses.php?skipAnim=true" class="inline-flex items-center gap-3 px-8 py-4 bg-[#f7df1e] text-[#0f0216] font-bold rounded-full hover:bg-white hover:scale-105 transition-all shadow-[0_0_30px_rgba(247,223,30,0.3)]">
                        Establish Orbit <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </section>

        <section class="py-24 border-b border-white/10 relative">
            <div class="text-center mb-16 px-6">
                <h2 class="text-[#BFF747] text-sm font-bold tracking-widest uppercase mb-3">Transmission Logs</h2>
                <h3 class="text-4xl font-bold text-white">What Explorers Are Saying</h3>
            </div>
            
            <div class="marquee-container w-full py-4">
                <div class="marquee-content">
                    <?php
                    // Array of 10 anonymous testimonials
                    $testimonials = [
                        "The scrolling rocket timeline made learning nested loops finally click in my brain.",
                        "Best free JS resource on the internet. Period.",
                        "The AI Oracle in the practice arena is like having a senior dev sitting next to me.",
                        "I love how the concepts are broken down into 30 tiny contexts. Very easy to digest.",
                        "The space theme isn't just a gimmick; the analogies actually make the code easier to understand.",
                        "Finally, a tutorial that doesn't just give you the answer but makes you think.",
                        "The System Design Bay is a game changer for planning my personal projects.",
                        "I went from struggling with arrays to building a full interactive cart in 3 days.",
                        "Clean UI, no ads, no paywalls. Just pure educational value.",
                        "10/10. Ready for the React Planet to launch!"
                    ];

                    // Output twice for the seamless CSS loop
                    for ($i = 0; $i < 2; $i++) {
                        foreach ($testimonials as $text) {
                            echo '
                            <div class="w-80 md:w-96 flex-shrink-0 bg-white/5 border border-white/10 p-6 rounded-2xl whitespace-normal flex flex-col justify-between">
                                <p class="text-[#a097a6] italic mb-6">"' . $text . '"</p>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-xs">👨‍🚀</div>
                                    <span class="text-white font-bold text-sm">Anonymous Cadet</span>
                                </div>
                            </div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </section>

        <section class="py-32 px-6 md:px-12 text-center relative bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')]">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-4xl md:text-6xl font-black text-white mb-6">Ready to leave the atmosphere?</h2>
                <p class="text-xl text-[#a097a6] mb-10">Join the JS Orbit Batch and start mastering JavaScript today. No credit card required. Just your curiosity.</p>
                <a href="courses.php?skipAnim=true" class="inline-block px-10 py-5 bg-[#BFF747] text-[#0f0216] text-lg font-bold rounded-full hover:bg-white hover:scale-105 transition-all shadow-[0_0_30px_rgba(191,247,71,0.3)]">
                    Begin JS Training Sequence
                </a>
            </div>
        </section>

        <?php include 'includes/footer.php'; ?>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const codeText = `const CodeOrbit = {
  mission: "Mastery",
  status: "Online",
  modules: [
    "Interactive Puzzles",
    "AI Assistance",
    "Visual Timelines"
  ],
  launch: function() {
    return "Ignition Sequence Start...";
  }
};`;
            const codeElement = document.getElementById('typewriter-code');
            let i = 0;
            let isTyping = false;
            
            // Intersection Observer to trigger the animation only when scrolled into view
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting && !isTyping) {
                    isTyping = true;
                    setTimeout(typeWriter, 400); // Small delay before typing starts
                    observer.disconnect(); // Only play once
                }
            });
            
            // Start observing the Origin Story container
            const terminalDiv = codeElement.closest('.relative');
            if(terminalDiv) observer.observe(terminalDiv);

            function typeWriter() {
                if (i < codeText.length) {
                    codeElement.textContent += codeText.charAt(i);
                    i++;
                    // Randomize typing speed to make it look realistic
                    const typingSpeed = Math.floor(Math.random() * 30) + 20; 
                    setTimeout(typeWriter, typingSpeed);
                }
            }
        });
    </script>

</body>
</html>