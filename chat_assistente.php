<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<div id="chat-widget">
    <div id="chat-header" onclick="toggleChat()">
        💬 Assistente Virtuale
    </div>

    <div id="chat-body">
        <div class="bot-message">
            👋 Ciao <?php echo $_SESSION['username'] ?? ''; ?>!  
            Sono Stefania, il tuo assistente virtuale. Come posso aiutarti?
        </div>
    </div>

    <div id="chat-footer">
        <input type="text" id="chat-input" placeholder="Scrivi qui..." onkeypress="handleEnter(event)">
        <button onclick="sendMessage()">Invia</button>
    </div>
</div>

<div id="chat-button" onclick="toggleChat()">💬</div>

<style>
#chat-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #007BFF;
    color: white;
    width: 55px;
    height: 55px;
    border-radius: 50%;
    font-size: 26px;
    text-align: center;
    line-height: 55px;
    cursor: pointer;
    z-index: 9999;
}

#chat-widget {
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 300px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.3);
    display: none;
    flex-direction: column;
    z-index: 9999;
}

#chat-header {
    background: #007BFF;
    color: white;
    padding: 12px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 10px 10px 0 0;
}

#chat-body {
    padding: 10px;
    height: 220px;
    overflow-y: auto;
    font-size: 14px;
}

#chat-footer {
    display: flex;
    border-top: 1px solid #ddd;
}

#chat-footer input {
    flex: 1;
    border: none;
    padding: 10px;
}

#chat-footer button {
    background: #007BFF;
    color: white;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
}

.user-message {
    text-align: right;
    margin-bottom: 8px;
}

.bot-message {
    text-align: left;
    margin-bottom: 8px;
    color: #333;
}
</style>

<script src="chat_assistente.js"></script>
