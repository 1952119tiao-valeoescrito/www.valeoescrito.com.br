// index.js
const ethers = require('ethers');

// Substitua pela sua chave API do Infura ou Alchemy
const provider = new ethers.JsonRpcProvider("SUA_CHAVE_API_AQUI");

async function main() {
  try {
    const blockNumber = await provider.getBlockNumber();
    console.log("Número do último bloco:", blockNumber);
  } catch (error) {
    console.error("Erro ao obter o número do bloco:", error);
  }
}

main();
