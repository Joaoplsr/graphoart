import { Outlet } from "react-router-dom";
import { useStateContext } from "../contexts/ContextProvider";
import { useNavigate } from "react-router-dom";
import { useEffect } from "react";

export default function AdminLayout() {
  const { user, token } = useStateContext();
  const navigate = useNavigate();
  
  useEffect(() => {
    if (!token) {
      navigate("/login");
    }
  }, [token]);

  return (
    <>
      <h1>AdminLayout</h1>
      <Outlet />
    </>
  );
}