class AIChat {
    constructor() {
        this.API_URL = 'https://free.v36.cm/v1/chat/completions';
        this.API_KEY = 'sk-ds9Z2kxZhgbvDfQY6c9b6408B43c4c0988925dD2FaB8F877';
        this.chatContainer = document.getElementById('chatContainer');
        this.userInput = document.getElementById('userInput');
        this.sendBtn = document.getElementById('sendBtn');
        this.voiceBtn = document.getElementById('voiceBtn');
        this.testConnectionBtn = document.getElementById('testConnectionBtn');
        
        this.recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
        this.recognition.continuous = true;
        this.recognition.interimResults = true;
        this.recognition.lang = 'zh-TW';
        
        this.isListening = false;
        this.currentMessage = '';
        
        this.conversationHistory = [
            {
                role: 'system',
                content: `你是一個友善的AI助手，請注意以下要求：
                1. 永遠使用繁體中文回答
                2. 以親切專業的口吻對話
                3. 回答要簡潔但完整
                4. 適時使用emoji表情符號增加親和力
                5. 如果被問到程式相關問題，請提供具體的程式碼範例`
            }
        ];
        
        this.loadingTemplate = document.getElementById('loadingTemplate');
        
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        this.sendBtn.addEventListener('click', () => this.sendMessage());
        this.userInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.sendMessage();
            }
        });
        
        this.voiceBtn.addEventListener('click', () => this.toggleVoiceRecognition());
        
        this.recognition.addEventListener('result', (e) => {
            const transcript = Array.from(e.results)
                .map(result => result[0])
                .map(result => result.transcript)
                .join('');
            
            this.currentMessage = transcript;
            this.userInput.value = transcript;
        });
        
        this.recognition.addEventListener('end', () => {
            if (this.isListening) {
                this.recognition.start();
            }
        });
        
        this.testConnectionBtn.addEventListener('click', () => this.testConnection());
    }

    toggleVoiceRecognition() {
        if (this.isListening) {
            this.stopListening();
        } else {
            this.startListening();
        }
    }

    startListening() {
        this.isListening = true;
        this.voiceBtn.classList.add('listening');
        this.recognition.start();
    }

    stopListening() {
        this.isListening = false;
        this.voiceBtn.classList.remove('listening');
        this.recognition.stop();
        if (this.currentMessage.trim()) {
            this.sendMessage();
        }
    }

    showLoadingIndicator() {
        const loadingNode = this.loadingTemplate.content.cloneNode(true);
        this.chatContainer.appendChild(loadingNode);
        this.chatContainer.scrollTop = this.chatContainer.scrollHeight;
    }

    removeLoadingIndicator() {
        const loadingElement = this.chatContainer.querySelector('.loading');
        if (loadingElement) {
            loadingElement.remove();
        }
    }

    async sendMessage() {
        const message = this.userInput.value.trim();
        if (!message) return;

        this.addMessage(message, 'user');
        this.userInput.value = '';
        this.currentMessage = '';

        this.conversationHistory.push({
            role: 'user',
            content: message
        });

        this.showLoadingIndicator();

        try {
            const response = await fetch(this.API_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${this.API_KEY}`
                },
                body: JSON.stringify({
                    model: 'gpt-3.5-turbo',
                    messages: this.conversationHistory
                })
            });

            this.removeLoadingIndicator();

            const data = await response.json();
            if (data.choices && data.choices[0]) {
                const aiResponse = data.choices[0].message.content;
                
                this.conversationHistory.push({
                    role: 'assistant',
                    content: aiResponse
                });

                if (this.conversationHistory.length > 21) {
                    this.conversationHistory = [
                        this.conversationHistory[0],
                        ...this.conversationHistory.slice(-20)
                    ];
                }

                this.addMessage(aiResponse, 'ai');
                
                if (this.speechEnabled) {
                    this.notificationSound?.play();
                    this.speakText(aiResponse);
                }
            }
        } catch (error) {
            this.removeLoadingIndicator();
            console.error('Error:', error);
            this.addMessage('抱歉，發生錯誤。請稍後再試。', 'ai');
        }
    }

    async testConnection() {
        this.testConnectionBtn.disabled = true;
        this.testConnectionBtn.textContent = '測試中...';
        
        try {
            const response = await fetch(this.API_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${this.API_KEY}`
                },
                body: JSON.stringify({
                    model: 'gpt-3.5-turbo',
                    messages: [
                        this.conversationHistory[0],
                        {
                            role: 'user',
                            content: '你好，這是一個測試訊息。'
                        }
                    ]
                })
            });

            if (response.ok) {
                const data = await response.json();
                if (data.choices && data.choices[0]) {
                    this.addMessage('✅ API連線測試成功！', 'system');
                } else {
                    this.addMessage('❌ API回應格式異常，請檢查API設定。', 'system');
                }
            } else {
                this.addMessage(`❌ API連線失敗：${response.status} ${response.statusText}`, 'system');
            }
        } catch (error) {
            console.error('Connection test error:', error);
            this.addMessage(`❌ API連線錯誤：${error.message}`, 'system');
        } finally {
            this.testConnectionBtn.disabled = false;
            this.testConnectionBtn.textContent = '測試連線';
        }
    }

    addMessage(content, type) {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message', `${type}-message`);
        messageDiv.textContent = content;
        this.chatContainer.appendChild(messageDiv);
        this.chatContainer.scrollTop = this.chatContainer.scrollHeight;
    }
}

// 初始化應用
document.addEventListener('DOMContentLoaded', () => {
    new AIChat();
}); 