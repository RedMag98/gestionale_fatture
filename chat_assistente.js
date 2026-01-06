function toggleChat() {
    const chat = document.getElementById("chat-widget");
    chat.style.display = chat.style.display === "flex" ? "none" : "flex";
}

function handleEnter(e) {
    if (e.key === "Enter") {
        sendMessage();
    }
}

function sendMessage() {
    const input = document.getElementById("chat-input");
    const text = input.value.trim();
    if (text === "") return;

    addMessage(text, "user");
    input.value = "";

    setTimeout(() => {
        const response = getBotResponse(text); 
        addMessage(response, "bot");
    }, 500);
}

function addMessage(text, sender) {
    const body = document.getElementById("chat-body");
    const div = document.createElement("div");
    div.className = sender === "user" ? "user-message" : "bot-message";
    div.innerHTML = text;
    body.appendChild(div);
    body.scrollTop = body.scrollHeight;
}


function cleanText(text) {
    return text.toLowerCase().replace(/[?!.]/g, "").trim();
}

function getBotResponse(text) {
    const t = cleanText(text); 

   
    if (t.includes("fattura") && (t.includes("creo") || t.includes("nuova") || t.includes("fare"))) {
        return "Per creare una fattura vai su ➕ Nuova Fattura dal menu principale.";
    }

  
    if ((t.includes("pdf") || t.includes("fattura")) && t.includes("scarico")) {
        return "Puoi scaricare il PDF cliccando su 📄 PDF nell'elenco fatture.";
    }

   
    if (t.includes("cliente") && (t.includes("aggiungo") || t.includes("crea") || t.includes("nuovo"))) {
        return "Per aggiungere un cliente vai su 👥 Clienti → Aggiungi Cliente e compila Nome, P.IVA e Email.";
    }

   
    if (t.includes("modifica") && t.includes("cliente")) {
        return "Per modificare un cliente vai su 👥 Clienti e clicca ✏️ Modifica accanto al cliente.";
    }

    
    if (t.includes("modifica") && t.includes("fattura")) {
        return "Per modificare una fattura vai su Elenco Fatture e clicca ✏️ Modifica accanto alla fattura.";
    }

   
    if (t.includes("elimina") && t.includes("cliente")) {
        return "Per eliminare un cliente vai su 👥 Clienti e clicca 🗑 Elimina accanto al cliente.";
    }

   
    if (t.includes("elimina") && t.includes("fattura")) {
        return "Per eliminare una fattura vai su Elenco Fatture e clicca 🗑 Elimina accanto alla fattura.";
    }

   
    if (t.includes("logout") || t.includes("esci")) {
        return "Per uscire dal gestionale usa il pulsante Logout in alto a destra.";
    }

  
    if (t.includes("aiuto") || t.includes("cosa puoi fare")) {
        return "Puoi chiedermi cose come: <br>• Come creo una fattura?<br>• Come aggiungo un cliente?<br>• Come modifico o elimino fatture o clienti.<br>• Come scarico il PDF di una fattura.";
    }

    return "❓ Non ho capito. Prova a chiedermi ad esempio: <br>• Come creo una fattura?<br>• Come aggiungo un cliente?<br>• Come scaricare il pdf di una fattura?";
}
