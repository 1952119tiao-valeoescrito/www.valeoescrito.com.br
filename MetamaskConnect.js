import React, { useState } from 'react';
import axios from 'axios';

const ApostaForm = () => {
    const [prognosticos, setPrognosticos] = useState(['', '', '', '', '']);

    const handleSubmit = async (e) => {
        e.preventDefault();
        const response = await axios.post('/api/apostar', { prognosticos, valor: '0.00033', metodoPagamento: 'metamask' });
        console.log(response.data);
    };

    return (
        <form onSubmit={handleSubmit}>
            <input type="number" placeholder="Prognóstico 1" onChange={(e) => setPrognosticos([e.target.value, ...prognosticos.slice(1)])} />
            {/* Repetir para os outros 4 prognósticos */}
            <button type="submit">Apostar</button>
        </form>
    );
};

export default ApostaForm;