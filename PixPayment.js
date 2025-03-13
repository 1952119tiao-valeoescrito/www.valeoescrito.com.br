import React, { useState } from 'react';
import axios from 'axios';

const PixPayment = () => {
    const [qrCode, setQrCode] = useState('');

    const handlePixPayment = async () => {
        const response = await axios.post('/api/pix', { amount: '0.00033', description: 'Aposta na Loteria' });
        setQrCode(response.data.qrCode);
    };

    return (
        <div>
            <button onClick={handlePixPayment}>Pagar com Pix</button>
            {qrCode && <img src={qrCode} alt="QR Code Pix" />}
        </div>
    );
};

export default PixPayment;