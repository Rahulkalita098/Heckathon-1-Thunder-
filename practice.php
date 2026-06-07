<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeOrbit | Practice Arena</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f0216; color: #ffffff; overflow: hidden; }
        .font-mono { font-family: 'Fira Code', monospace; }
        
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.02); }
        ::-webkit-scrollbar-thumb { background: rgba(191, 247, 71, 0.2); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(191, 247, 71, 0.5); }

        #monaco-editor { width: 100%; height: 100%; position: absolute; top: 0; left: 0; }
        
        .ai-message { border-left: 2px solid #BFF747; background: rgba(191, 247, 71, 0.05); }
        .user-message { border-right: 2px solid #a097a6; background: rgba(255, 255, 255, 0.05); }
        
        /* Pulse for successful execution */
        @keyframes pulseSuccess {
            0% { box-shadow: inset 0 0 0px rgba(74, 222, 128, 0); }
            50% { box-shadow: inset 0 0 20px rgba(74, 222, 128, 0.2); }
            100% { box-shadow: inset 0 0 0px rgba(74, 222, 128, 0); }
        }
        .console-success { animation: pulseSuccess 1s ease-out; }
    </style>
</head>
<body class="flex flex-col md:flex-row h-screen">

    <?php include 'includes/sidebar.php'; ?>

    <?php
    // Get the lecture ID from URL (e.g. ?lec=lec01). Default to lec01
    $lecId = isset($_GET['lec']) ? $_GET['lec'] : 'lec01';
    
    // Load JSON Database
    $jsonData = file_get_contents('practicequestion.json');
    $data = json_decode($jsonData, true);
    
    // Fallback to lec01 if the ID is invalid
    $challenges = isset($data[$lecId]) ? $data[$lecId] : $data['lec01'];
    ?>

    <main class="md:ml-64 w-full md:w-[calc(100%-16rem)] h-screen flex flex-col md:flex-row pt-16 md:pt-0">
        
        <div class="w-full md:w-1/3 h-1/2 md:h-full border-b md:border-b-0 md:border-r border-white/10 flex flex-col bg-[#0a010e] overflow-hidden">
            
            <div class="flex border-b border-white/10 shrink-0">
                <button id="tab-brief" class="flex-1 py-4 font-bold text-[#BFF747] border-b-2 border-[#BFF747] bg-white/5 transition-colors">Mission Brief</button>
                <button id="tab-ai" class="flex-1 py-4 font-bold text-[#a097a6] hover:text-white transition-colors flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg> AI Oracle
                </button>
            </div>

            <div class="p-4 border-b border-white/10 flex justify-between gap-2 shrink-0 overflow-x-auto" id="question-nav">
                </div>

            <div id="panel-brief" class="flex-1 overflow-y-auto p-6 relative block">
                <div class="inline-block px-3 py-1 rounded-full border border-[#BFF747]/30 bg-[#BFF747]/10 text-[#BFF747] text-xs font-bold tracking-widest uppercase mb-4" id="q-difficulty">
                    Difficulty: --
                </div>
                <h2 class="text-2xl font-bold mb-4" id="q-title">Loading...</h2>
                <div class="text-[#a097a6] leading-relaxed whitespace-pre-wrap" id="q-desc"></div>
            </div>

            <div id="panel-ai" class="flex-1 hidden flex-col relative overflow-hidden">
                <div id="chat-history" class="flex-1 overflow-y-auto p-6 space-y-4">
                    
                    <div class="ai-message p-4 rounded-r-xl rounded-bl-xl text-sm text-[#a097a6] leading-relaxed">
                        <strong class="text-[#BFF747] block mb-3 text-base font-bold">🛰️ Connection Established: CodeOrbit Online</strong>
                        <p class="mb-3 text-white">Greetings, Cadet! Welcome aboard.</p>
                        <p class="mb-3">I am your <strong>AI Oracle</strong>, transmitting directly from the neural core of CodeOrbit. Under the steady guidance of <strong>Commander Rahul Kalita</strong>, my mission is to help you navigate the vast, sparkling cosmos of JavaScript.</p>
                        <p class="mb-2">Whether you are:</p>
                        <ul class="space-y-1 mb-4 ml-2">
                            <li>☄️ Steering through turbulent loops,</li>
                            <li>🕳️ Dodging syntax black holes, or</li>
                            <li>🚀 Launching your very first functions...</li>
                        </ul>
                        <p class="mb-4">...I am here to guide your trajectory. I won't just hand over the coordinates (no direct answers here!), but I will help you master the controls.</p>
                        <p class="font-bold text-[#BFF747]">What JS mission or coding challenge are we tackling today?</p>
                    </div>

                </div>
                
                <div class="p-4 border-t border-white/10 bg-white/5 shrink-0 z-10">
                    <form id="ai-form" class="flex gap-2">
                        <input type="text" id="ai-input" placeholder="Ask the Oracle..." class="flex-1 bg-transparent border border-white/20 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-[#BFF747]">
                        <button type="submit" class="px-4 py-2 bg-[#BFF747] text-[#0f0216] font-bold rounded-lg hover:bg-white transition-colors cursor-pointer">Ask</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="w-full md:w-2/3 h-1/2 md:h-full flex flex-col">
            
            <div class="h-14 border-b border-white/10 flex items-center justify-between px-6 bg-[#0a010e] shrink-0">
                <div class="flex items-center gap-2 text-sm text-[#a097a6] font-mono">
                    <svg class="w-4 h-4 text-[#BFF747]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2z"/></svg> main.js
                </div>
                <button id="runCodeBtn" class="px-6 py-2 bg-[#BFF747] text-[#0f0216] font-bold rounded-lg hover:bg-white transition-all flex items-center gap-2 shadow-[0_0_15px_rgba(191,247,71,0.3)] hover:scale-105">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg> Execute Code
                </button>
            </div>

            <div class="flex-1 relative bg-[#1e1e1e]">
                <div id="monaco-editor"></div>
            </div>

            <div class="h-1/3 border-t border-white/10 bg-[#0a010e] flex flex-col shrink-0" id="console-wrapper">
                <div class="px-4 py-2 text-xs font-bold text-[#a097a6] uppercase tracking-widest border-b border-white/10 bg-white/5 flex justify-between">
                    <span>System Console Output</span>
                    <button id="clearConsoleBtn" class="hover:text-white transition-colors">Clear</button>
                </div>
                <div class="flex-1 p-4 overflow-y-auto">
                    <pre id="console-output" class="font-mono text-sm text-[#BFF747] whitespace-pre-wrap"></pre>
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.36.1/min/vs/loader.min.js"></script>
    <script>
        // Data injected from PHP
        const challenges = <?php echo json_encode($challenges); ?>;
        let currentIndex = 0;

        // UI Elements
        const titleEl = document.getElementById('q-title');
        const descEl = document.getElementById('q-desc');
        const diffEl = document.getElementById('q-difficulty');
        const navContainer = document.getElementById('question-nav');
        const consoleOutput = document.getElementById('console-output');
        const consoleWrapper = document.getElementById('console-wrapper');
        
        // 1. Initialize Navigation Pills
        function renderNav() {
            navContainer.innerHTML = '';
            challenges.forEach((ch, index) => {
                const btn = document.createElement('button');
                btn.className = `px-4 py-1.5 rounded-lg text-sm font-bold transition-all border ${index === currentIndex ? 'bg-[#BFF747]/20 border-[#BFF747] text-[#BFF747]' : 'bg-transparent border-white/10 text-[#a097a6] hover:border-white/30'}`;
                btn.innerText = `Q${index + 1}`;
                btn.onclick = () => loadQuestion(index);
                navContainer.appendChild(btn);
            });
        }

        // 2. Load Question Data into UI & Editor
        function loadQuestion(index) {
            currentIndex = index;
            const q = challenges[index];
            
            titleEl.innerText = q.title;
            // Basic markdown handling for bold text
            descEl.innerHTML = q.description.replace(/\*\*(.*?)\*\*/g, '<strong class="text-white">$1</strong>');
            diffEl.innerText = 'Difficulty: ' + q.difficulty;
            
            consoleOutput.innerHTML = ''; // Clear console
            renderNav(); // Update active pill state

            if(window.editor) {
                window.editor.setValue(q.initialCode);
            }
        }

        // 3. Initialize Monaco Editor
        require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.36.1/min/vs' }});
        require(['vs/editor/editor.main'], function() {
            window.editor = monaco.editor.create(document.getElementById('monaco-editor'), {
                value: "// Loading...",
                language: 'javascript',
                theme: 'vs-dark',
                minimap: { enabled: false },
                automaticLayout: true,
                fontSize: 14,
                fontFamily: "'Fira Code', monospace",
                scrollBeyondLastLine: false,
                padding: { top: 16 }
            });
            // Load the first question once editor is ready
            loadQuestion(0);
        });

        // 4. Tab Switching Logic
        const tabBrief = document.getElementById('tab-brief');
        const tabAi = document.getElementById('tab-ai');
        const panelBrief = document.getElementById('panel-brief');
        const panelAi = document.getElementById('panel-ai');

        tabBrief.addEventListener('click', () => {
            tabBrief.className = "flex-1 py-4 font-bold text-[#BFF747] border-b-2 border-[#BFF747] bg-white/5 transition-colors";
            tabAi.className = "flex-1 py-4 font-bold text-[#a097a6] hover:text-white transition-colors flex items-center justify-center gap-2";
            panelBrief.classList.remove('hidden');
            panelBrief.classList.add('block');
            panelAi.classList.add('hidden');
            panelAi.classList.remove('flex');
        });

        tabAi.addEventListener('click', () => {
            tabAi.className = "flex-1 py-4 font-bold text-[#BFF747] border-b-2 border-[#BFF747] bg-white/5 transition-colors flex items-center justify-center gap-2";
            tabBrief.className = "flex-1 py-4 font-bold text-[#a097a6] hover:text-white transition-colors";
            panelAi.classList.remove('hidden');
            panelAi.classList.add('flex');
            panelBrief.classList.remove('block');
            panelBrief.classList.add('hidden');
        });

        // Clear Console
        document.getElementById('clearConsoleBtn').addEventListener('click', () => consoleOutput.innerHTML = '');

        // 5. Code Execution & Validation Engine
        document.getElementById('runCodeBtn').addEventListener('click', () => {
            if(!window.editor) return;
            const userCode = window.editor.getValue();
            const validationCode = challenges[currentIndex].validation;
            
            let outputText = "";
            let consoleHistory = []; 

            // Intercept console.log
            const originalLog = console.log;
            console.log = (...args) => {
                const msg = args.map(arg => typeof arg === 'object' ? JSON.stringify(arg) : arg).join(" ");
                outputText += "> " + msg + "\n";
                consoleHistory.push(msg);
                originalLog.apply(console, args); 
            };

            consoleOutput.innerHTML = '<span class="text-white/50">Compiling and running tests...</span>\n\n';
            consoleWrapper.classList.remove('console-success');

            setTimeout(() => {
                try {
                    // Execute user code and validation rules
                    const fullExecutableCode = `
                        ${userCode}
                        ${validationCode}
                    `;
                    
                    const executeSequence = new Function('consoleHistory', fullExecutableCode);
                    executeSequence(consoleHistory);
                    
                    // SUCCESS
                    consoleOutput.innerHTML += outputText;
                    consoleOutput.innerHTML += `\n<span class="text-green-400 font-bold">✅ SUCCESS: Mission parameters met!</span>`;
                    consoleWrapper.classList.add('console-success');

                } catch (error) {
                    // FAILURE
                    consoleOutput.innerHTML += outputText;
                    consoleOutput.innerHTML += `\n<span class="text-red-400 font-bold">❌ FAILED: ${error.message}</span>`;
                    
                    // Auto-send context-aware error to AI
                    sendSystemMessageToAI(error.message);
                }

                // Restore real console
                console.log = originalLog;
            }, 300);
        });

        // 6. AI Oracle Logic (Connected to backend API)
        const chatHistory = document.getElementById('chat-history');
        const aiInput = document.getElementById('ai-input');

        function appendMessage(sender, text) {
            const div = document.createElement('div');
            if(sender === 'User') {
                div.className = 'user-message p-4 rounded-l-xl rounded-br-xl text-sm text-white ml-8 leading-relaxed';
                div.innerHTML = `<strong class="text-white block mb-1">You:</strong>${text}`;
            } else {
                div.className = 'ai-message p-4 rounded-r-xl rounded-bl-xl text-sm text-[#a097a6] mr-8 leading-relaxed';
                div.innerHTML = `<strong class="text-[#BFF747] block mb-1">AI Oracle:</strong>${text}`;
            }
            chatHistory.appendChild(div);
            chatHistory.scrollTop = chatHistory.scrollHeight;
        }

        // NEW: Advanced Context-Aware Error Diagnostic
        function sendSystemMessageToAI(errorMessage) {
            tabAi.click(); // Switch to AI tab visually
            
            // Gather current question context
            const currentQ = challenges[currentIndex];
            
            // Build the secret, detailed prompt to send to Gemini
            const detailedPromptForAI = `I am currently working on a coding challenge named: "${currentQ.title}".
Here is the description of the task I am trying to solve:
---
${currentQ.description}
---
When I executed my JavaScript code, the system generated this error:
"${errorMessage}"

Based on the task description and the error, please explain what went wrong and give me a clear hint on how to fix it. Do NOT write the final correct code for me.`;
            
            // Build the clean, user-facing visual message
            const cleanUserVisual = `
                <span class="text-red-300 italic mb-2 block">System Auto-Diagnostic:</span> 
                I failed the <strong>${currentQ.title}</strong> mission. The system gave me this error:
                <code class="bg-black/50 text-red-400 p-2 rounded mt-2 mb-2 block font-mono text-xs border border-red-500/30">${errorMessage}</code>
                Can you explain what went wrong and provide a hint?`;
            
            // Post it to the chat UI for the user to see
            appendMessage('User', cleanUserVisual);
            
            // Trigger the AI fetch quietly with the detailed backend prompt
            fetchAIResponse(detailedPromptForAI);
        }

        // Separate function to handle the actual API Fetching
        async function fetchAIResponse(messagePayload) {
            const typingDiv = document.createElement('div');
            typingDiv.className = 'text-xs text-[#BFF747] italic animate-pulse mt-2 mb-2';
            typingDiv.id = 'ai-typing';
            typingDiv.innerText = 'Oracle is analyzing system logs...';
            chatHistory.appendChild(typingDiv);
            chatHistory.scrollTop = chatHistory.scrollHeight;

            try {
                // Call our secure PHP backend
                const response = await fetch('ask_ai.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ message: messagePayload })
                });
                
                const data = await response.json();
                document.getElementById('ai-typing').remove();
                
                if (data.reply) {
                    appendMessage('AI', data.reply);
                } else {
                    appendMessage('AI', '<span class="text-red-400 font-bold">Transmission Error:</span> ' + (data.error || 'Unknown error occurred.'));
                }
            } catch (error) {
                document.getElementById('ai-typing').remove();
                appendMessage('AI', '<span class="text-red-400 font-bold">Comms Offline:</span> Unable to reach the server. Make sure ask_ai.php is configured correctly.');
            }
        }

        // Handle user typing and submitting the form manually
        document.getElementById('ai-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const message = aiInput.value.trim();
            if(!message) return;

            // Show user message in chat
            appendMessage('User', message);
            aiInput.value = '';

            // Send to AI
            fetchAIResponse(message);
        });

    </script>
</body>
</html>