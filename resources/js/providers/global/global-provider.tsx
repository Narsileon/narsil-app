import { ReactNode, useState } from "react";
import { GlobalContext } from "./global-context";

type GlobalProviderProps = {
  children: ReactNode;
};

function GlobalProvider({ children }: GlobalProviderProps) {
  const [headerHeight, setHeaderHeight] = useState(70);

  return (
    <GlobalContext.Provider
      value={{
        headerHeight: headerHeight,
        setHeaderHeight: setHeaderHeight,
      }}
    >
      {children}
    </GlobalContext.Provider>
  );
}

export default GlobalProvider;
