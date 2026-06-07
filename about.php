<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeOrbit | About</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f0216; color: #ffffff; overflow-x: hidden; scroll-behavior: smooth; }
        
        /* --- TERMINAL TYPEWRITER CURSOR --- */
        .typewriter-cursor::after {
            content: '▋';
            animation: blink 1s step-end infinite;
            margin-left: 4px;
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

    <main class="md:ml-64 w-full md:w-[calc(100%-16rem)] relative flex-1 flex flex-col min-h-screen">
        
        <div class="flex-1 pt-24 md:pt-16 px-6 md:px-12 pb-24">
            <div class="max-w-5xl mx-auto">
                
                <div class="inline-block px-3 py-1 rounded-full border border-[#BFF747]/30 bg-[#BFF747]/10 text-[#BFF747] text-xs font-bold tracking-widest uppercase mb-4">
                    System Origin
                </div>
                <h1 class="text-4xl md:text-6xl font-black mb-10 text-white tracking-tight">About <span class="text-[#BFF747]">CodeOrbit</span></h1>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start mb-20">
                    <div class="space-y-6 text-[#a097a6] text-lg leading-relaxed">
                        <p>
                            CodeOrbit was born from the idea that the goal is not just to teach concepts, but to help learners apply them. The traditional way of learning is fragmented—leaving you floating in the void without direction.
                        </p>
                        <p>
                            We wanted to build an ecosystem. A structured universe where you start on Earth with the basics and orbit your way through complex theories and full-stack architectures.
                        </p>
                        
                        <div class="pt-6">
                            <h3 class="text-xl font-bold text-white mb-4 uppercase tracking-widest text-sm">Our Core Pillars</h3>
                            <ul class="space-y-3">
                                <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#BFF747]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> AI-powered explanations</li>
                                <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#BFF747]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Practical coding challenges</li>
                                <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#BFF747]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Real-world architecture planning</li>
                                <li class="flex items-center gap-3"><svg class="w-5 h-5 text-[#BFF747]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Visual progression tracking</li>
                            </ul>
                        </div>
                    </div>

                    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 relative shadow-2xl min-h-[350px] flex flex-col">
                        <div class="flex items-center gap-2 border-b border-white/10 pb-4 mb-4">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                            <span class="ml-2 text-xs text-[#a097a6] font-mono">mission_log.txt</span>
                        </div>
                        <pre class="font-mono text-sm md:text-base text-[#BFF747] whitespace-pre-wrap flex-1 overflow-y-auto"><code id="mission-log-typewriter" class="typewriter-cursor"></code></pre>
                    </div>
                </div>

                <div class="mt-20 border-t border-white/10 pt-20">
                    <div class="text-center mb-16">
                        <h2 class="text-[#BFF747] text-sm font-bold tracking-widest uppercase mb-3">System Advantages</h2>
                        <h3 class="text-3xl md:text-4xl font-bold text-white">Why Choose CodeOrbit?</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-white/5 border border-white/10 p-8 rounded-2xl hover:-translate-y-2 transition-transform duration-300">
                            <div class="w-12 h-12 bg-[#BFF747]/10 rounded-xl flex items-center justify-center text-2xl mb-6">
                                🚀
                            </div>
                            <h4 class="text-xl font-bold text-white mb-3">Immersive Journey</h4>
                            <p class="text-[#a097a6] leading-relaxed">We replaced boring lists with a scrolling rocket timeline. Visualizing your progress keeps you motivated to conquer the next module.</p>
                        </div>

                        <div class="bg-white/5 border border-white/10 p-8 rounded-2xl hover:-translate-y-2 transition-transform duration-300">
                            <div class="w-12 h-12 bg-[#BFF747]/10 rounded-xl flex items-center justify-center text-2xl mb-6">
                                🧠
                            </div>
                            <h4 class="text-xl font-bold text-white mb-3">Contextual AI</h4>
                            <p class="text-[#a097a6] leading-relaxed">Our AI Oracle doesn't just give you the answer. It analyzes your specific code and provides hints to help you solve the problem yourself.</p>
                        </div>

                        <div class="bg-white/5 border border-white/10 p-8 rounded-2xl hover:-translate-y-2 transition-transform duration-300">
                            <div class="w-12 h-12 bg-[#BFF747]/10 rounded-xl flex items-center justify-center text-2xl mb-6">
                                ⚙️
                            </div>
                            <h4 class="text-xl font-bold text-white mb-3">Beyond Syntax</h4>
                            <p class="text-[#a097a6] leading-relaxed">Knowing how to write a loop isn't enough. Our integrated System Design Bay teaches you how to map out and architect full-scale applications.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?php include 'includes/footer.php'; ?>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const logText = `[SYSTEM LOG - INITIATING]
COMMANDER: Rahul Kalita
STATUS: Day 5 of Thunder Batch...

> Focusing on strengthening JavaScript fundamentals.
> Taking the first public step toward a project I've been planning for some time.
> The goal is to change how code is learned.

CodeOrbit initialization sequence...
[==========          ] 50%
[====================] 100%

SUCCESS. Ready for launch.`;

            const typeElement = document.getElementById('mission-log-typewriter');
            let index = 0;
            let isTyping = false;

            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting && !isTyping) {
                    isTyping = true;
                    setTimeout(typeWriter, 500); // Wait half a second before starting
                    observer.disconnect(); 
                }
            });

            // Observe the terminal window
            const terminalContainer = typeElement.closest('.bg-white\\/5');
            if (terminalContainer) observer.observe(terminalContainer);

            function typeWriter() {
                if (index < logText.length) {
                    typeElement.textContent += logText.charAt(index);
                    index++;
                    
                    // Add slight random pauses for realistic typing, and longer pauses for new lines
                    let speed = Math.floor(Math.random() * 30) + 10;
                    if (logText.charAt(index - 1) === '\n') speed = 300;
                    if (logText.charAt(index - 1) === '.') speed = 200;

                    setTimeout(typeWriter, speed);
                }
            }
        });
    </script>
</body>
</html>