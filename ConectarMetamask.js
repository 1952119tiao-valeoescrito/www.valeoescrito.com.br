import { ethers } from "ethers";
import { useState, useEffect } from "react";
import contratoABI from "./contratoABI.json";

const contratoEndereco = "0x..."; // Endereço do contrato

function ApostaForm() {
  const [prognosticos, setPrognosticos] = useState(["", "", "", "", ""]);
  const [loading, setLoading] = useState(false);
  const [conta, setConta] = useState(null); // Estado para armazenar a conta conectada
  const [saldo, setSaldo] = useState("0"); // Estado para armazenar o saldo da conta

  // Conectar à MetaMask
  const conectarMetaMask = async () => {
    if (window.ethereum) {
      try {
        const provider = new ethers.providers.Web3Provider(window.ethereum);
        await provider.send("eth_requestAccounts", []); // Solicitar acesso à conta
        const signer = provider.getSigner();
        const enderecoConta = await signer.getAddress();
        setConta(enderecoConta);

        // Atualizar saldo
        const saldoConta = await provider.getBalance(enderecoConta);
        setSaldo(ethers.utils.formatEther(saldoConta));
      } catch (error) {
        console.error("Erro ao conectar à MetaMask:", error);
      }
    } else {
      alert("Por favor, instale a MetaMask.");
    }
  };

  // Efeito para conectar automaticamente à MetaMask ao carregar a página
  useEffect(() => {
    if (window.ethereum) {
      window.ethereum.on("accountsChanged", (contas) => {
        if (contas.length > 0) {
          setConta(contas[0]);
        } else {
          setConta(null);
        }
      });
    }
  }, []);

  // Função para realizar a aposta
  const handleApostar = async () => {
    if (!conta) {
      alert("Por favor, conecte sua carteira.");
      return;
    }

    if (prognosticos.some((p) => p === "")) {
      alert("Por favor, preencha todos os prognósticos.");
      return;
    }

    if (window.ethereum) {
      const provider = new ethers.providers.Web3Provider(window.ethereum);
      const signer = provider.getSigner();
      const contrato = new ethers.Contract(contratoEndereco, contratoABI, signer);

      try {
        setLoading(true);
        const tx = await contrato.apostar(prognosticos, {
          value: ethers.utils.parseEther("0.00033"), // Valor da aposta
        });
        await tx.wait(); // Aguardar confirmação da transação
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
      {!conta ? (
        <button onClick={conectarMetaMask}>Conectar MetaMask</button>
      ) : (
        <div>
          <p>Conectado como: {conta}</p>
          <p>Saldo: {saldo} ETH</p>
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
              placeholder={`Prognóstico ${i + 1}`}
            />
          ))}
          <button onClick={handleApostar} disabled={loading}>
            {loading ? "Apostando..." : "Apostar"}
          </button>
        </div>
      )}
    </div>
  );
}

export default ApostaForm;
