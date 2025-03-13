const express = require('express');
const router = express.Router();
const loteriaController = require('../controllers/loteriaController');

router.post('/apostar', loteriaController.apostar);

module.exports = router;