import React, { useState, useEffect } from 'react';
import Web3 from 'web3';
import detectEthereumProvider from '@metamask/detect-provider';

// Configurações do Contrato (SUBSTITUA COM SEUS VALORES!)
const contractAddress = '0x8fa024467a4ab1286e78da4a876d18abaea667a38f1e2679069ce6b1ee8663d7'; // Seu contrato
const contractABI = [
  {
    "inputs": [
      {
        "internalType": "address",
        "name": "_vrfCoordinator",
        "type": "address"
      },
      {
        "internalType": "bytes32",
        "name": "_keyHash",
        "type": "bytes32"
      },
      {
        "internalType": "uint64",
        "name": "_subscriptionId",
        "type": "uint64"
      }
    ],
    "stateMutability": "nonpayable",
    "type": "constructor"
  },
  {
    "inputs": [
      {
        "internalType": "address",
        "name": "have",
        "type": "address"
      },
      {
        "internalType": "address",
        "name": "want",
        "type": "address"
      }
    ],
    "name": "OnlyCoordinatorCanFulfill",
    "type": "error"
  },
  {
    "anonymous": false,
    "inputs": [
      {
        "indexed": true,
        "internalType": "address",
        "name": "apostador",
        "type": "address"
      },
      {
        "indexed": false,
        "internalType": "uint256[5]",
        "name": "prognosticos",
        "type": "uint256[5]"
      },
    ],
    "name": "ApostaRealizada",
    "type": "event"
  },
  {
    "anonymous": false,
    "inputs": [
      {
        "indexed": true,
        "internalType": "address",
        "name": "apostador",
        "type": "address"
      },
      {
        "indexed": false,
        "internalType": "uint256",
        "name": "valor",
        "type": "uint256"
      }
    ],
    "name": "PremioDistribuido",
    "type": "event"
  },
  {
    "anonymous": false,
    "inputs": [
      {
        "indexed": false,
        "internalType": "uint256",
        "name": "id",
        "type": "uint256"
      },
      {
        "indexed": false,
        "internalType": "string",
        "name": "descricao",
        "type": "string"
      }
    ],
    "name": "PrognosticoAdicionado",
    "type": "event"
  },
  {
    "anonymous": false,
    "inputs": [
      {
        "indexed": false,
        "internalType": "uint256[]",
        "name": "resultados",
        "type": "uint256[]"
      }
    ],
    "name": "SorteioRealizado",
    "type": "event"
  },
  {
    "inputs": [
      {
        "internalType": "string",
        "name": "_descricao",
        "type": "string"
      }
    ],
    "name": "adicionarPrognostico",
    "outputs": [],
    "stateMutability": "nonpayable",
    "type": "function"
  },
  {
    "inputs": [
      {
        "internalType": "uint256[5]",
        "name": "_prognosticos",
        "type": "uint256[5]"
      }
    ],
    "name": "apostar",
    "outputs": [],
    "stateMutability": "payable",
    "type": "function"
  },
  {
    "inputs": [
      {
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
      }
    ],
    "name": "apostas",
    "outputs": [
      {
        "internalType": "address",
        "name": "apostador",
        "type": "address"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [],
    "name": "callbackGasLimit",
    "outputs": [
      {
        "internalType": "uint32",
        "name": "",
        "type": "uint32"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [],
    "name": "distribuirPremios",
    "outputs": [],
    "stateMutability": "nonpayable",
    "type": "function"
  },
  {
    "inputs": [],
    "name": "dono",
    "outputs": [
      {
        "internalType": "address",
        "name": "",
        "type": "address"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [],
    "name": "encerramentoApostas",
    "outputs": [
      {
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [],
    "name": "keyHash",
    "outputs": [
      {
        "internalType": "bytes32",
        "name": "",
        "type": "bytes32"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [],
    "name": "numWords",
    "outputs": [
      {
        "internalType": "uint32",
        "name": "",
        "type": "uint32"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [
      {
        "internalType": "uint256",
        "name": "_id",
        "type": "uint256"
      }
    ],
    "name": "obterPrognostico",
    "outputs": [
      {
        "internalType": "string",
        "name": "",
        "type": "string"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [
      {
        "internalType": "address",
        "name": "",
        "type": "address"
      }
    ],
    "name": "premiacao",
    "outputs": [
      {
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [
      {
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
      }
    ],
    "name": "prognosticos",
    "outputs": [
      {
        "internalType": "uint256",
        "name": "id",
        "type": "uint256"
      },
      {
        "internalType": "string",
        "name": "descricao",
        "type": "string"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [],
    "name": "proximoIdPrognostico",
    "outputs": [
      {
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [
      {
        "internalType": "uint256",
        "name": "requestId",
        "type": "uint256"
      },
      {
        "internalType": "uint256[]",
        "name": "randomWords",
        "type": "uint256[]"
      }
    ],
    "name": "rawFulfillRandomWords",
    "outputs": [],
    "stateMutability": "nonpayable",
    "type": "function"
  },
  {
    "inputs": [],
    "name": "reaberturaApostas",
    "outputs": [
      {
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [],
    "name": "reabrirApostas",
    "outputs": [],
    "stateMutability": "nonpayable",
    "type": "function"
  },
  {
    "inputs": [],
    "name": "requestConfirmations",
    "outputs": [
      {
        "internalType": "uint16",
        "name": "",
        "type": "uint16"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [],
    "name": "requestId",
    "outputs": [
      {
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [
      {
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
      }
    ],
    "name": "resultados",
    "outputs": [
      {
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [],
    "name": "solicitarSorteio",
    "outputs": [],
    "stateMutability": "nonpayable",
    "type": "function"
  },
  {
    "inputs": [],
    "name": "sorteioRealizado",
    "outputs": [
      {
        "internalType": "bool",
        "name": "",
        "type": "bool"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [],
    "name": "subscriptionId",
    "outputs": [
      {
        "internalType": "uint64",
        "name": "",
        "type": "uint64"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [],
    "name": "taxaAposta",
    "outputs": [
      {
        "internalType": "uint256",
        "name": "",
        "type": "uint256"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  },
  {
    "inputs": [],
    "name": "vrfCoordinator",
    "outputs": [
      {
        "internalType": "contract VRFCoordinatorV2Interface",
        "name": "",
        "type": "address"
      }
    ],
    "stateMutability": "view",
    "type": "function"
  }
];

const network = 'goerli'; // Substitua pela rede em que o contrato foi implantado (ex: 'mainnet', 'sepolia')

function App() {
  const [web3, setWeb3] = useState(null);
  const [account, setAccount] = useState(null);
  const [contract, setContract] = useState(null);
  const [taxaAposta, setTaxaAposta] = useState(null);
  const [encerramentoApostas, setEncerramentoApostas] = useState(null);
  const [prognosticos, setPrognosticos] = useState(['', '', '', '', '']);
  const [mensagem, setMensagem] = useState('');

  useEffect(() => {
    const init = async () => {
      const provider = await detectEthereumProvider();

      if (provider) {
        const web3Instance = new Web3(provider);
        setWeb3(web3Instance);

        try {
          await window.ethereum.request({ method: 'eth_requestAccounts' });
          const accounts = await web3Instance.eth.getAccounts();
          setAccount(accounts[0]);

          // Verificar se a rede correta está selecionada
          const chainId = await web3Instance.eth.getChainId();
          const networkId = chainId.toString(); // Chain ID como string

          let expectedChainId;
          switch (network) {
            case 'mainnet':
              expectedChainId = '1';
              break;
            case 'goerli':
              expectedChainId = '5';
              break;
            case 'sepolia':
              expectedChainId = '11155111';
              break;
            // Adicione outras redes conforme necessário
            default:
              expectedChainId = null;
          }

          if (expectedChainId && networkId !== expectedChainId) {
            setMensagem(`Por favor, conecte-se à rede ${network}.`);
            return;
          }

          const contractInstance = new web3Instance.eth.Contract(contractABI, contractAddress);
          setContract(contractInstance);

          // Carregar dados do contrato
          loadContractData(contractInstance, web3Instance);

        } catch (error) {
          console.error("Erro ao conectar:", error);
          setMensagem('Erro ao conectar: ' + error.message);
        }

      } else {
        console.log('Please install MetaMask!');
        setMensagem('Por favor, instale o MetaMask!');
      }
    };

    init();
  }, [network]);

  const loadContractData = async (contractInstance, web3Instance) => {
    try {
      const _taxaAposta = await contractInstance.methods.taxaAposta().call();
      setTaxaAposta(_taxaAposta);

      const _encerramentoApostas = await contractInstance.methods.encerramentoApostas().call();
      setEncerramentoApostas(new Date(_encerramentoApostas * 1000).toLocaleString());
    } catch (error) {
      console.error("Erro ao carregar dados do contrato:", error);
      setMensagem('Erro ao carregar dados do contrato: ' + error.message);
    }
  };

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
      const prognosticosNumericos = prognosticos.map(Number);

      // Converter a taxa de aposta para o formato correto (Wei)
      const apostaValue = taxaAposta;

      await contract.methods.apostar(prognosticosNumericos)
        .send({ from: account, value: apostaValue });

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
