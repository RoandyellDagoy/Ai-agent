import React from "react";
import { Link, useNavigate } from "react-router-dom";
import api from "../api/api.jsx";

const Navbar = () => {
   const navigate = useNavigate();

  const handleLogout = async () => {
    try {
      await api.post("/logout");
    } catch {}
    localStorage.removeItem("token");
    navigate("/login");
  };

  return (
    <nav className="flex justify-between items-center p-4 bg-gray-800 text-white">
      <h1 className="font-bold text-lg">My App</h1>
      <div className="space-x-4">
        <Link to="/dashboard">Dashboard</Link>
        <button
          onClick={handleLogout}
          className="bg-red-500 px-3 py-1 rounded hover:bg-red-600"
        >
          Logout
        </button>
      </div>
    </nav>
  );
}

export default Navbar