// Exemplo de conexão com MetaMask
import Web3 from 'web3';

async function conectarMetaMask() {
  if (window.ethereum) {
    try {
      await window.ethereum.request({ method: 'eth_requestAccounts' });
      const web3 = new Web3(window.ethereum);
      const accounts = await web3.eth.getAccounts();
      return accounts[0]; // Retorna o endereço da conta
    } catch (error) {
      console.error("Erro ao conectar com MetaMask:", error);
      return null;
    }
  } else {
    console.log("MetaMask não detectado");
    return null;
  }
}
