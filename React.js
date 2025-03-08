import React, { useState } from "react";

function AddPrognostico({ contract }) {
  const [descricao, setDescricao] = useState("");

  const handleAdicionar = async () => {
    try {
      const tx = await contract.adicionarPrognostico(descricao);
      await tx.wait();
      alert("Prognóstico adicionado com sucesso!");
      setDescricao("");
    } catch (error) {
      console.error("Erro ao adicionar prognóstico:", error);
    }
  };

  return (
    <div>
      <h2>Adicionar Prognóstico</h2>
      <input
        type="text"
        value={descricao}
        onChange={(e) => setDescricao(e.target.value)}
        placeholder="Descrição do prognóstico"
      />
      <button onClick={handleAdicionar}>Adicionar</button>
    </div>
  );
}

export default AddPrognostico;
