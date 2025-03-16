const fs = require('fs');

fs.readFile('package.json', 'utf8', (err, data) => {
  if (err) {
    console.error('Erro ao ler o package.json:', err);
    return;
  }

  try {
    JSON.parse(data);
    console.log('package.json é um JSON válido!');
  } catch (error) {
    console.error('Erro ao analisar o package.json:', error);
  }
});