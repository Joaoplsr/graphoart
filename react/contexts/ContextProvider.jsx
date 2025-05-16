import { createContext, useContext, useState } from "react";

const StateContext = createContext({
  user: null,
  token: null,
  setUser: () => {},
  setToken: () => {},
});

export const ContextProvider = ({ children }) => {
  const [token, _setToken] = useState(localStorage.getItem("ACCESS_TOKEN"));
  const [user, _setUser] = useState(() => {
    const savedUser = localStorage.getItem("USER_INFO");
    return savedUser ? JSON.parse(savedUser) : null;
  });

  const setToken = (token) => {
    _setToken(token);
    if (token) {
      localStorage.setItem("ACCESS_TOKEN", token);
    } else {
      localStorage.removeItem("ACCESS_TOKEN");
    }
  };

  const setUser = (user) => {
    _setUser(user);
    if (user) {
      localStorage.setItem("USER_INFO", JSON.stringify(user));
    } else {
      localStorage.removeItem("USER_INFO");
    }
  };

  return (
    <StateContext.Provider value={{ user, setUser, token, setToken }}>
      {children}
    </StateContext.Provider>
  );
};

export const useStateContext = () => useContext(StateContext);
