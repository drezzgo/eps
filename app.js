const express = require('express');
const app = express();
const path = require('path');  // Módulo para trabajar con rutas de archivos
const PORT = process.env.PORT || 3000;

app.use(express.static('public'));  // Middleware para servir archivos estáticos

// Ruta principal
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

// Otras rutas pueden ser manejadas de manera similar

app.listen(PORT, () => {
  console.log(`Servidor iniciado en http://localhost:${PORT}`);
});