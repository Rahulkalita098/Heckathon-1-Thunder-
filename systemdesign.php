<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeOrbit | System Design Bay</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f0216; color: #ffffff; overflow: hidden; }
        
        /* Iframe container needs to fill the remaining height exactly */
        #drawio-container {
            flex-grow: 1;
            position: relative;
            background: #1e1e1e; /* Match draw.io dark mode background */
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* Subtle neon pulse for the save button */
        .neon-pulse {
            animation: softPulse 2s infinite alternate;
        }
        @keyframes softPulse {
            0% { box-shadow: 0 0 5px rgba(191, 247, 71, 0.2); }
            100% { box-shadow: 0 0 15px rgba(191, 247, 71, 0.5); }
        }
    </style>
</head>
<body class="flex flex-col md:flex-row h-screen">

    <?php include 'includes/sidebar.php'; ?>

    <main class="md:ml-64 w-full h-screen flex flex-col pt-16 md:pt-0">
        
        <div class="h-16 md:h-20 border-b border-white/10 flex items-center justify-between px-6 bg-[#0a010e] shrink-0">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-white flex items-center gap-3">
                    <span class="text-2xl">📐</span> Architecture Deck
                </h1>
                <p class="text-xs text-[#a097a6] hidden md:block">Map out databases, APIs, and microservices.</p>
            </div>
            
            <div class="flex items-center gap-4">
                <button id="exportBtn" class="px-4 py-2 bg-transparent text-[#a097a6] border border-[#a097a6]/30 font-bold rounded-lg hover:text-white hover:border-white transition-all text-sm hidden md:block">
                    Export Image
                </button>
                <button id="saveBtn" class="px-6 py-2 bg-[#BFF747] text-[#0f0216] font-bold rounded-lg hover:bg-white transition-colors neon-pulse flex items-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Save Blueprint
                </button>
            </div>
        </div>

        <div class="bg-[#BFF747]/5 border-b border-[#BFF747]/20 px-6 py-2 flex justify-between items-center shrink-0">
            <span class="text-xs text-[#BFF747] font-mono tracking-widest uppercase">Canvas Engine Online</span>
            <span class="text-xs text-[#a097a6]">Double-click canvas to add elements</span>
        </div>

        <div id="drawio-container">
            <iframe id="drawio-iframe" src="https://embed.diagrams.net/?embed=1&ui=dark&spin=1&proto=json&configure=1"></iframe>
        </div>

    </main>

    <script>
        const iframe = document.getElementById('drawio-iframe');
        const saveBtn = document.getElementById('saveBtn');
        const exportBtn = document.getElementById('exportBtn');
        
        // This holds the raw XML data of the diagram
        let currentXmlData = null;

        // Custom Configuration for Draw.io (removes unwanted buttons, sets color palettes)
        const drawIoConfig = {
            compressXml: false,
            // Hide the default save/exit buttons since we have our own UI header
            ui: "dark",
            css: ".geMenubarContainer { display: none !important; }", 
            colorNames: {
                "0f0216": "Deep Space",
                "BFF747": "Neon Accent",
                "a097a6": "Muted Star"
            },
            customColorSchemes: [
                [
                    {fill: '#0f0216', stroke: '#BFF747'},
                    {fill: '#1e1e1e', stroke: '#a097a6'}
                ]
            ]
        };

        // Listen for messages from the iframe
        window.addEventListener('message', function(e) {
            // Ensure the message is actually from the iframe
            if (e.source !== iframe.contentWindow) return;

            try {
                const msg = JSON.parse(e.data);

                switch (msg.event) {
                    case 'configure':
                        // Draw.io is ready for our custom config
                        iframe.contentWindow.postMessage(JSON.stringify({
                            action: 'configure',
                            config: drawIoConfig
                        }), '*');
                        break;

                    case 'init':
                        // Draw.io is fully loaded. 
                        // If you have saved XML in your database, you load it here.
                        const savedBlueprint = localStorage.getItem('codeOrbit_blueprint');
                        if (savedBlueprint) {
                            iframe.contentWindow.postMessage(JSON.stringify({
                                action: 'load',
                                autosave: 1,
                                xml: savedBlueprint
                            }), '*');
                        } else {
                            // Load a blank template
                            iframe.contentWindow.postMessage(JSON.stringify({
                                action: 'load',
                                autosave: 1,
                                xml: '<mxGraphModel><root><mxCell id="0"/><mxCell id="1" parent="0"/></root></mxGraphModel>'
                            }), '*');
                        }
                        break;

                    case 'autosave':
                        // Draw.io sends this automatically as the user works
                        currentXmlData = msg.xml;
                        break;

                    case 'export':
                        // When we request an export, it returns the data URI here
                        if (msg.format === 'png') {
                            downloadFile('architecture_deck.png', msg.data);
                        } else if (msg.format === 'xml') {
                            // Handle manual save
                            currentXmlData = msg.xml;
                            localStorage.setItem('codeOrbit_blueprint', currentXmlData);
                            alert('Blueprint saved to local storage! (Connect database later)');
                        }
                        break;
                }
            } catch (err) {
                // Ignore messages that aren't valid JSON
            }
        });

        // Trigger manual save
        saveBtn.addEventListener('click', () => {
            iframe.contentWindow.postMessage(JSON.stringify({
                action: 'export',
                format: 'xml',
                spin: 'Saving...'
            }), '*');
            
            // Visual feedback
            const originalText = saveBtn.innerHTML;
            saveBtn.innerHTML = 'Saved ✓';
            setTimeout(() => { saveBtn.innerHTML = originalText; }, 2000);
        });

        // Trigger PNG export
        exportBtn.addEventListener('click', () => {
            iframe.contentWindow.postMessage(JSON.stringify({
                action: 'export',
                format: 'png',
                spin: 'Exporting Image...'
            }), '*');
        });

        // Helper function to trigger a file download
        function downloadFile(filename, dataUri) {
            const link = document.createElement('a');
            link.href = dataUri;
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
</body>
</html>