import React, { createContext, useState, useEffect } from "react"
import Carpetas from "../Carpetas/Carpetas"

export const Store = createContext(null)
function App() {
  const [showModal, setShowModal] = useState(false);

  return (
    <Store.Provider
      value={{ showModal, setShowModal }}
    >
      <Carpetas />
    </Store.Provider>
  )
}

export default App
