// Exemplo básico de um servidor Express.js
const express = require('express');
const app = express();
const port = 3000;
const Web3 = require('web3');
const contractABI = require('./abi/LoteriaPrognosticos.json'); //Importe o ABI do contrato

// Configuração do Web3 (substitua com sua URL e endereço do contrato)
const web3 = new Web3('SUA_URL_DA_BLOCKCHAIN'); // Ex: 'http://localhost:8545'
const contractAddress = 'SEU_ENDEREÇO_DO_CONTRATO';
const contract = new web3.eth.Contract(contractABI, contractAddress);

app.use(express.json()); // Middleware para lidar com JSON

// Rota para obter prognósticos
app.get('/prognosticos', async (req, res) => {
    try {
        // Implemente a lógica para buscar prognósticos do contrato
        // Exemplo:
        // const totalPrognosticos = await contract.methods.proximoIdPrognostico().call();
        // const prognosticos = [];
        // for (let i = 1; i < totalPrognosticos; i++) {
        //     const prognostico = await contract.methods.prognosticos(i).call();
        //     prognosticos.push(prognostico);
        // }
        // res.json(prognosticos);
        // Implemente uma versão real com tratamento de erros e dados do banco de dados

        res.json({ message: "Endpoint não implementado ainda. Implemente para buscar os prognósticos do contrato." }); //Placeholder
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Erro ao buscar prognósticos' });
    }
});

// Rota para realizar uma aposta
app.post('/apostar', async (req, res) => {
    const { prognosticos } = req.body;
    const fromAddress = req.body.fromAddress; // Pegue o endereço do usuário do body da requisição
    const privateKey = req.body.privateKey; //Pegue a chave privada do usuário

    //Validar dados e prognosticos aqui

    try {

        const gasEstimate = await contract.methods.apostar(prognosticos).estimateGas({from: fromAddress, value: web3.utils.toWei('0.00033', 'ether')});

        // Assinar e enviar a transação
        const tx = {
            from: fromAddress,
            to: contractAddress,
            gas: gasEstimate,
            data: contract.methods.apostar(prognosticos).encodeABI(),
            value: web3.utils.toWei('0.00033', 'ether'),
        };

        const signedTx = await web3.eth.accounts.signTransaction(tx, privateKey);
        const transaction = await web3.eth.sendSignedTransaction(signedTx.rawTransaction);

        console.log('Transação:', transaction);
        res.json({ message: 'Aposta realizada com sucesso!', transactionHash: transaction.transactionHash });
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Erro ao realizar a aposta' });
    }
});

app.listen(port, () => {
    console.log(`Servidor rodando em http://localhost:${port}`);
});
