import { createContext, useContext } from "react";

export type GlobalContextProps = {
  headerHeight: number;
  setHeaderHeight: (height: number) => void;
};

export const GlobalContext = createContext<GlobalContextProps>({
  headerHeight: 0,
  setHeaderHeight: () => {},
});

function useGlobal() {
  const context = useContext(GlobalContext);

  if (!context) {
    throw new Error("useGlobal must be used within a GlobalProvider");
  }

  return context;
}

export { useGlobal };
