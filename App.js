import React from 'react';
import MetamaskConnect from './components/MetamaskConnect';
import ApostaForm from './components/ApostaForm';
import PixPayment from './components/PixPayment';
import './styles/App.css';

function App() {
    return (
        <div className="App">
            <h1>Loteria Web App</h1>
            <MetamaskConnect />
            <ApostaForm />
            <PixPayment />
        </div>
    );
}

export default App;