import { ethers } from "ethers";
import { useState } from "react";
import contratoABI from "./contratoABI.json";

const contratoEndereco = "0x..."; // Endereço do contrato

function ApostaForm() {
  const [prognosticos, setPrognosticos] = useState(["", "", "", "", ""]);
  const [loading, setLoading] = useState(false);

  const handleApostar = async () => {
    if (window.ethereum) {
      const provider = new ethers.providers.Web3Provider(window.ethereum);
      const signer = provider.getSigner();
      const contrato = new ethers.Contract(contratoEndereco, contratoABI, signer);

      try {
        setLoading(true);
        const tx = await contrato.apostar(prognosticos, {
          value: ethers.utils.parseEther("0.00033"),
        });
        await tx.wait();
        alert("Aposta realizada com sucesso!");
      } catch (error) {
        alert("Erro ao realizar aposta: " + error.message);
      } finally {
        setLoading(false);
      }
    } else {
      alert("Por favor, conecte sua carteira.");
    }
  };

  return (
    <div>
      <h2>Faça sua aposta</h2>
      {prognosticos.map((p, i) => (
        <input
          key={i}
          type="number"
          value={p}
          onChange={(e) => {
            const novosPrognosticos = [...prognosticos];
            novosPrognosticos[i] = e.target.value;
            setPrognosticos(novosPrognosticos);
          }}
        />
      ))}
      <button onClick={handleApostar} disabled={loading}>
        {loading ? "Apostando..." : "Apostar"}
      </button>
    </div>
  );
}

export default ApostaForm;
