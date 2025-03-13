const { web3, contract } = require('../config/web3Config');

exports.apostar = async (req, res) => {
    const { prognosticos, valor, metodoPagamento } = req.body;

    if (metodoPagamento === 'metamask') {
        try {
            const tx = contract.methods.apostar(prognosticos);
            const receipt = await tx.send({ from: req.userAddress, value: valor });
            res.json({ success: true, receipt });
        } catch (error) {
            res.status(500).json({ success: false, message: error.message });
        }
    } else {
        res.status(400).json({ success: false, message: 'Método de pagamento inválido' });
    }
};