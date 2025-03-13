const axios = require('axios');

exports.createPixPayment = async (amount, description) => {
    const response = await axios.post('https://api.mercadopago.com/v1/payments', {
        transaction_amount: amount,
        description: description,
        payment_method_id: 'pix',
        payer: {
            email: 'user@example.com',
        },
    }, {
        headers: {
            'Authorization': `Bearer YOUR_ACCESS_TOKEN`,
            'Content-Type': 'application/json',
        },
    });

    return response.data.point_of_interaction.transaction_data.qr_code;
};