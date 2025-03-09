import React, { useState, useEffect } from 'react';
import Web3 from 'web3';
import detectEthereumProvider from '@metamask/detect-provider';

function App() {
  const [web3, setWeb3] = useState(null);
  const [account, setAccount] = useState(null);
  const [contract, setContract] = useState(null); // Vamos usar isso mais tarde
  const [taxaAposta, setTaxaAposta] = useState(null);
  const [encerramentoApostas, setEncerramentoApostas] = useState(null);
  const [prognosticos, setPrognosticos] = useState(['', '', '', '', '']);
  const [mensagem, setMensagem] = useState('');

  // Substitua pelos valores reais do seu contrato
  const contractAddress = '0x8fa024467a4ab1286e78da4a876d18abaea667a38f1e2679069ce6b1ee8663d7';
  const contractABI = [
    // Cole o ABI do seu contrato aqui (você obterá isso após compilar o contrato)
  ];

  useEffect(() => {
    const init = async () => {
      // Detecta o provedor Ethereum (MetaMask)
      const provider = await detectEthereumProvider();

      if (provider) {
        // Se o provedor for encontrado, inicializa o Web3
        const web3Instance = new Web3(provider);
        setWeb3(web3Instance);

        // Obtém a conta do usuário
        const accounts = await web3Instance.eth.getAccounts();
        if (accounts.length > 0) {
          setAccount(accounts[0]);
        }

        // Solicita acesso à conta se necessário
        try {
          await window.ethereum.request({ method: 'eth_requestAccounts' });
          const accounts = await web3Instance.eth.getAccounts();
          setAccount(accounts[0]);
        } catch (error) {
          console.error("User denied account access");
        }

        // Cria uma instância do contrato (se você tiver o ABI)
        if (contractABI.length > 0) {
          const contractInstance = new web3Instance.eth.Contract(contractABI, contractAddress);
          setContract(contractInstance);

          // Obtém informações do contrato
          const _taxaAposta = await contractInstance.methods.taxaAposta().call();
          setTaxaAposta(_taxaAposta);

          const _encerramentoApostas = await contractInstance.methods.encerramentoApostas().call();
          setEncerramentoApostas(new Date(_encerramentoApostas * 1000).toLocaleString()); // Converte para data legível
        }

      } else {
        console.log('Please install MetaMask!');
        setMensagem('Por favor, instale o MetaMask!');
      }
    };

    init();
  }, []);

  const handlePrognosticoChange = (index, value) => {
    const newPrognosticos = [...prognosticos];
    newPrognosticos[index] = value;
    setPrognosticos(newPrognosticos);
  };

  const handleApostar = async () => {
    if (!contract) {
      setMensagem('Contrato não inicializado. Verifique o ABI e o endereço.');
      return;
    }

    try {
      // Converte os prognósticos para números
      const prognosticosNumericos = prognosticos.map(Number);

      // Chama a função apostar do contrato
      await contract.methods.apostar(prognosticosNumericos)
        .send({ from: account, value: taxaAposta });

      setMensagem('Aposta realizada com sucesso!');
    } catch (error) {
      console.error("Erro ao apostar:", error);
      setMensagem('Erro ao apostar: ' + error.message);
    }
  };

  return (
    <div className="App">
      <h1>Loteria de Prognósticos</h1>
      {account ? (
        <p>Conectado com a conta: {account}</p>
      ) : (
        <button onClick={async () => {
          try {
            await window.ethereum.request({ method: 'eth_requestAccounts' });
            const accounts = await web3.eth.getAccounts();
            setAccount(accounts[0]);
          } catch (error) {
            console.error("User denied account access");
          }
        }}>Conectar com MetaMask</button>
      )}

      {taxaAposta && encerramentoApostas && (
        <div>
          <p>Taxa de Aposta: {web3 ? web3.utils.fromWei(taxaAposta, 'ether') : 'Carregando...'} ETH</p>
          <p>Encerramento das Apostas: {encerramentoApostas}</p>
        </div>
      )}

      <h2>Apostar</h2>
      <div>
        {prognosticos.map((prognostico, index) => (
          <input
            key={index}
            type="number"
            placeholder={`Prognóstico ${index + 1}`}
            value={prognostico}
            onChange={(e) => handlePrognosticoChange(index, e.target.value)}
          />
        ))}
        <button onClick={handleApostar}>Apostar</button>
      </div>

      {mensagem && <p>{mensagem}</p>}
    </div>
  );
}

export default App;
