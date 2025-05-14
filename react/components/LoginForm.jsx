import { useEffect, useState } from "react";
import api from "../api/axios-client";
import { useAuth } from "../contexts/AuthContext";
import { useNavigate } from "react-router-dom";

export default function LoginForm() {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [disabled, setDisabled] = useState(false);
    const { login } = useAuth();
    const navigate = useNavigate();

    useEffect(() => {
        const token = localStorage.getItem("ACCESS_TOKEN");
        if (token) {
            login({ name: localStorage.getItem("NAME"), role: localStorage.getItem("ROLE") });
            navigate(`/${localStorage.getItem("ROLE")}`);
        }
    }, []);

    const handleSubmit = (e) => {
        e.preventDefault();
        setDisabled(true);
        api.post("/auth/login", { email, password })
            .then((response) => {
                setDisabled(false);
                localStorage.setItem("ACCESS_TOKEN", response.data.token);
                localStorage.setItem("ROLE", response.data.role);
                localStorage.setItem("NAME", response.data.name);
                login({ name: response.data.name, role: response.data.role });
                navigate(`/${response.data.role}`);
            })
            .catch((error) => {
                console.log(error);
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
        </div>
    );
}
