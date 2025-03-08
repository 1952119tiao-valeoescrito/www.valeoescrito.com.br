// Exemplo básico de um componente React para apostar
import React, { useState, useEffect } from 'react';
import Web3 from 'web3';

function ApostaForm() {
    const [prognosticos, setPrognosticos] = useState([1, 2, 3, 4, 5]);
    const [fromAddress, setFromAddress] = useState('');
    const [privateKey, setPrivateKey] = useState('');

    const handleSubmit = async (event) => {
        event.preventDefault();

        //Validar dados

        try {
            const response = await fetch('http://localhost:3000/apostar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ prognosticos: prognosticos, fromAddress: fromAddress, privateKey: privateKey }),
            });

            const data = await response.json();
            console.log(data);
            alert(data.message);

        } catch (error) {
            console.error('Erro:', error);
            alert('Erro ao apostar: ' + error.message);
        }
    };

    return (
        <form onSubmit={handleSubmit}>
            <div>
                <label>
                    Prognosticos (IDs separados por vírgula):
                    <input
                        type="text"
                        value={prognosticos.join(',')}
                        onChange={e => setPrognosticos(e.target.value.split(',').map(Number))}
                    />
                </label>
            </div>
            <div>
                <label>
                    Seu Endereço:
                    <input
                        type="text"
                        value={fromAddress}
                        onChange={e => setFromAddress(e.target.value)}
                    />
                </label>
            </div>
             <div>
                <label>
                    Sua Chave Privada:
                    <input
                        type="text"
                        value={privateKey}
                        onChange={e => setPrivateKey(e.target.value)}
                    />
                </label>
            </div>
            <button type="submit">Apostar</button>
        </form>
    );
}

export default ApostaForm;
