const Web3 = require('web3');
const web3 = new Web3('https://mainnet.infura.io/v3/YOUR_INFURA_PROJECT_ID');
const contractAbi = [/* Cole o ABI do contrato aqui */];
const contractAddress = 'YOUR_CONTRACT_ADDRESS';
const contract = new web3.eth.Contract(contractAbi, contractAddress);

module.exports = { web3, contract };