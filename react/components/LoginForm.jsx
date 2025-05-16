import { useEffect, useState } from "react";
import api from "../api/axios-client";
import { useNavigate } from "react-router-dom";
import { useStateContext } from "../contexts/ContextProvider";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

export default function LoginForm() {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [disabled, setDisabled] = useState(false);
    const navigate = useNavigate();
    const { token, setToken, setUser, user } = useStateContext();

  
    useEffect(() => {
      if (token) {
        navigate(`/${user?.role}`);
      }
    }, [token]);

    const handleSubmit = (e) => {
        e.preventDefault();
        setDisabled(true);
        api.post("/auth/login", { email, password })
            .then((response) => {
                setDisabled(false);
                toast.success(response.data.message);
                const role = response.data.role.trim().toLowerCase();
                localStorage.setItem("ACCESS_TOKEN", response.data.token);
                setToken(response.data.token);
                setUser({
                    role: role,
                    name: response.data.name,
                });
            })
            .catch((error) => {
                toast.error(error.data.message);
                setDisabled(false);
            });
    };

    return (
        <div className="flex justify-center items-center h-screen bg-[#1e293b]">
            <div className="bg-[#1e293b] p-8 rounded-lg shadow-lg w-full max-w-sm">
                <h2 className="text-2xl font-bold text-center text-[#818cf8] mb-6">
                    Login
                </h2>
                <div className="mb-4">
                    <label
                        htmlFor="email"
                        className="block text-sm text-white mb-1"
                    >
                        Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        value={email}
                        onChange={(e) => setEmail(e.target.value)}
                        placeholder="seuemail@exemplo.com"
                        className="w-full px-4 py-2 bg-[#334155] text-white rounded-md outline-none focus:ring-2 focus:ring-[#6366f1]"
                    />
                </div>
                <div className="mb-6">
                    <label
                        htmlFor="password"
                        className="block text-sm text-white mb-1"
                    >
                        Senha
                    </label>
                    <input
                        type="password"
                        id="password"
                        value={password}
                        onChange={(e) => setPassword(e.target.value)}
                        placeholder="********"
                        className="w-full px-4 py-2 bg-[#334155] text-white rounded-md outline-none focus:ring-2 focus:ring-[#6366f1]"
                    />
                </div>
                <button
                    className={`w-full bg-[#6366f1] text-white font-semibold py-2 rounded-md hover:bg-[#4f46e5] transition-colors ${
                        disabled
                            ? "opacity-50 cursor-not-allowed"
                            : "cursor-pointer"
                    }`}
                    onClick={handleSubmit}
                >
                    {disabled ? "Entrando..." : "Entrar"}
                </button>
                <p className="text-center text-sm text-gray-400 mt-6">
                    Bem-vindo ao GraphoArt.
                </p>
            </div>
            <ToastContainer />
        </div>
    );
}
