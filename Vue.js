loteria-app/
├── src/
│   ├── components/
│   │   ├── FormularioAposta.jsx       (Componente React para o formulário de aposta)
│   │   ├── QRCodeDisplay.jsx       (Componente para exibir o QR Code)
│   │   └── ... (Outros componentes da interface)
│   ├── pages/
│   │   ├── Apostar.jsx                (Página de aposta que inclui o FormularioAposta)
│   │   ├── Resultados.jsx             (Página para exibir resultados)
│   │   ├── Premios.jsx                (Página para exibir prêmios)
│   │   ├── Contato.jsx                (Página de contato)
│   │   └── ... (Outras páginas)
│   ├── services/
│   │   ├── blockchainService.js     (Serviços para interagir com a blockchain)
│   │   └── pagamentoService.js      (Serviços relacionados a pagamentos)
│   ├── styles/
│   │   ├── FormularioAposta.css      (Estilos CSS para o FormularioAposta)
│   │   ├── global.css                 (Estilos globais da aplicação)
│   │   └── ... (Outros arquivos de estilo)
│   ├── App.jsx                      (Componente principal da aplicação React)
│   ├── index.js                     (Ponto de entrada da aplicação React)
│   └── ... (Outros arquivos React)
├── backend/
│   ├── routes/
│   │   ├── apostas.js               (Rotas para gerenciar apostas)
│   │   ├── pagamentos.js            (Rotas para processar pagamentos)
│   │   └── ... (Outras rotas)
│   ├── controllers/
│   │   ├── apostaController.js      (Lógica para lidar com apostas)
│   │   └── pagamentoController.js     (Lógica para lidar com pagamentos)
│   ├── models/
│   │   ├── aposta.js                (Modelo de dados para apostas)
│   │   └── ... (Outros modelos)
│   ├── app.js                       (Arquivo principal do servidor Node.js)
│   └── ... (Outros arquivos Node.js)
├── contracts/
│   ├── LoteriaPrognosticos.sol   (Código fonte do contrato inteligente em Solidity)
│   └── migrations/              (Scripts para migrar o contrato para a blockchain)
├── hardhat.config.js             (Arquivo de configuração do Hardhat)
├── package.json                   (Arquivo de metadados do projeto)
├── README.md                      (Arquivo de documentação do projeto)
└── ... (Outros arquivos)
