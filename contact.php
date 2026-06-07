<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeOrbit | Contact</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f0216; color: #ffffff; overflow-x: hidden; }
    </style>
</head>
<body class="flex flex-col md:flex-row">

    <?php include 'includes/sidebar.php'; ?>

    <main class="md:ml-64 w-full min-h-screen pt-24 md:pt-12 px-6 md:px-12 pb-12 flex items-center justify-center">
        
        <div class="w-full max-w-5xl bg-white/5 backdrop-blur-xl border border-[#BFF747]/20 rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row mt-4 md:mt-0">
            
            <div class="w-full md:w-5/12 bg-[#0a010e] p-8 md:p-12 border-b md:border-b-0 md:border-r border-white/10 flex flex-col justify-center">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">Establish <span class="text-[#BFF747]">Contact</span></h1>
                <p class="text-sm md:text-base text-[#a097a6] mb-10 leading-relaxed">Enroll in the JS Mastery program, request system architecture guidance, or just reach out directly.</p>
                
                <div class="space-y-6">
                    <div>
                        <p class="text-xs text-[#a097a6] uppercase tracking-widest mb-1">Commander</p>
                        <p class="text-xl font-bold text-white">Rahul Kalita</p>
                    </div>
                    
                    <div>
                        <p class="text-xs text-[#a097a6] uppercase tracking-widest mb-1">Direct Comms</p>
                        <p class="text-lg font-mono text-[#BFF747]">+91 6003632275</p>
                    </div>
                    
                    <div>
                        <p class="text-xs text-[#a097a6] uppercase tracking-widest mb-3">Professional Networks</p>
                        <div class="flex gap-4">
                            <a href="https://www.linkedin.com/in/rahul-kalita-bab402240" target="_blank" class="px-4 py-2 border border-white/20 rounded-lg text-sm text-white hover:border-[#BFF747] hover:text-[#BFF747] transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                LinkedIn
                            </a>
                            <a href="https://x.com/Rahul89007335" target="_blank" class="px-4 py-2 border border-white/20 rounded-lg text-sm text-white hover:border-[#BFF747] hover:text-[#BFF747] transition-all flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                Twitter / X
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full md:w-7/12 p-8 md:p-12 flex flex-col justify-center">
                <form action="#" method="POST" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-medium text-[#a097a6] mb-2 uppercase tracking-wide">Designation (Name)</label>
                            <input type="text" class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#BFF747] transition-colors" required>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-medium text-[#a097a6] mb-2 uppercase tracking-wide">Comms Channel (Email)</label>
                            <input type="email" class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#BFF747] transition-colors" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-[#a097a6] mb-2 uppercase tracking-wide">Transmission (Message)</label>
                        <textarea rows="5" class="w-full bg-black/20 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-[#BFF747] transition-colors" required></textarea>
                    </div>

                    <button type="submit" class="w-full py-4 bg-[#BFF747] text-[#0f0216] font-bold rounded-xl hover:bg-[#a5db36] hover:shadow-[0_0_20px_rgba(191,247,71,0.3)] transition-all flex justify-center items-center gap-3 mt-2">
                        Transmit Message <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            </div>

        </div>
    </main>

</body>
</html>