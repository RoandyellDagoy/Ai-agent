import React, { useEffect, useState } from "react";
import api from "../api/api.jsx";

const Dashboard = () => {
 const [user, setUser] = useState(null);
  const [messages, setMessages] = useState([
    { sender: "bot", text: "👋 Hello! I'm your AI assistant. How can I help you today?" },
  ]);
  const [input, setInput] = useState("");

  // Fetch authenticated user
  useEffect(() => {
    api
      .get("/user")
      .then((res) => setUser(res.data))
      .catch(() => setUser(null));
  }, []);

  // Handle chat send
  const handleSend = async (e) => {
    e.preventDefault();
    if (!input.trim()) return;

    // Add user message
    const newMessage = { sender: "user", text: input };
    setMessages((prev) => [...prev, newMessage]);
    setInput("");

    try {
      const res = await api.post("/gemini/generate", { prompt: input });
      const botMessage = { sender: "bot", text: res.data.reply };
      setMessages((prev) => [...prev, botMessage]);
    } catch (err) {
      setMessages((prev) => [
        ...prev,
        { sender: "bot", text: "⚠️ Sorry, I had trouble connecting." },
      ]);
    }
  };

  return (
    <div className="flex flex-col h-screen bg-gray-100">
      {/* Header */}
      <div className="p-4 bg-blue-600 text-white font-bold text-lg">
        {user ? `Welcome, ${user.name} 👋` : "Chatbot"}
      </div>

      {/* Chat messages */}
      <div className="flex-1 overflow-y-auto p-4 space-y-3">
        {messages.map((msg, i) => (
          <div
            key={i}
            className={`flex ${
              msg.sender === "user" ? "justify-end" : "justify-start"
            }`}
          >
            <div
              className={`px-4 py-2 rounded-2xl max-w-xs ${
                msg.sender === "user"
                  ? "bg-blue-500 text-white"
                  : "bg-gray-200 text-gray-800"
              }`}
            >
              {msg.text}
            </div>
          </div>
        ))}
      </div>

      {/* Input box */}
      <form
        onSubmit={handleSend}
        className="p-4 bg-white border-t flex items-center space-x-2"
      >
        <input
          type="text"
          value={input}
          onChange={(e) => setInput(e.target.value)}
          placeholder="Type your message..."
          className="flex-1 p-2 border rounded-full focus:outline-none"
        />
        <button
          type="submit"
          className="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600"
        >
          Send
        </button>
      </form>
    </div>
  );
}

export default Dashboard